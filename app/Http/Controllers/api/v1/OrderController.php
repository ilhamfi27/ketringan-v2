<?php

namespace App\Http\Controllers\api\v1;

use App\Bank;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\MakePayment;
use Illuminate\Support\Facades\Auth;
use App\Menu;
use App\Order;
use App\OrderedMenu;
use App\Payment;
use App\Transfer;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Cart;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $uniqueCode = rand(1,300);
        $checkout = $request->all();
        $checkout['Total_Harga'] = Menu::sumPrices($checkout['Id_Menu_Paket'], 
                        $checkout['Jumlah_Pemesanan']) - $uniqueCode;

        DB::beginTransaction();
        try {
            /**
             * Order insertion section
             * 
             * @param Alamat_Pengiriman
             * @param No_Telfon_Aktif
             * @param No_Telfon_Alternatif
             * @param Total_Harga
             * @param Tanggal_Kegiatan
             * @param Waktu_Kegiatan
             */
            $lastOrder = Order::latest()->first();
            $idKonsumen = $this->getKonsumenId();
            
            $kodePesanan = 'PSNE'.date('ymd')
                        .($lastOrder == null ? 1 : $lastOrder->Id_Pesanan + 1);
            
            $orderCompleteData = [
                'Tanggal_Pesan' => Carbon::now(),
                'Id_Konsumen' => $idKonsumen,
                'Kode_Pesanan' => $kodePesanan,
            ];
            $order = Order::create($checkout + $orderCompleteData);

            // buat nyimpen Id_Pesanan di array dari post request
            $checkout['Id_Pesanan'] = $order->Id_Pesanan;
            
            /**
             * End of order insertion section
             * Start of ordered menu
             * 
             * @param Id_Menu_Paket
             * @param Catatan
             * @param Jumlah_Pemesanan
             */
            $orderedData = [];
            foreach ($checkout['Id_Menu_Paket'] as $idx => $menu) {
                $menuPrice = Menu::find($menu)->Harga_Paket;
                $orderedData[$idx] = [
                    'Id_Menu_Paket' => $menu,
                    'Catatan' => $checkout['Catatan'],
                    'Jumlah_Kotak' => $checkout['Jumlah_Pemesanan'][$idx],
                    'Id_Pesanan' => $order->Id_Pesanan,
                    'Harga' => $menuPrice,
                ];
            }
            $orderedMenu = OrderedMenu::insert($orderedData);
            
            /**
             * End of ordered menu insertion section
             * Start of payment
             * 
             * @param Metode_Pembayaran
             * @param Id_Diskon
             * @param Potongan_Diskon
             */
            $paymentCompleteData = [
                'Tagihan' => $checkout['Total_Harga'],
                'Total_Tagihan' => $checkout['Total_Harga'],
                'Sisa_Tagihan' => $checkout['Total_Harga'],
                'Total_Telah_Dibayar' => 0,
                'Kode_Unik' => $uniqueCode,
            ];
            $checkout['Id_Diskon'] = $checkout['Id_Diskon'] == "" || $checkout['Id_Diskon'] == null ? 
                                        0 : $checkout['Id_Diskon'];
            $payment = Payment::create($checkout + $paymentCompleteData);
            $checkout['Id_Pembayaran'] = $payment->Id_Pembayaran;
            /**
             * End of payment insertion section
             * Start of transfer
             * 
             * @param Id_Bank
             */
            $transferCompleteData = [
                'Keterangan' => 'cash',
                'Tgl_Batas_Transfer' => Carbon::now()->subDays(1),
            ];
            $transfer = Transfer::create($checkout + $transferCompleteData);
            /**
             * End of transfer insertion section
             * Start of destroy cart data
             * 
             * @param id_konsumen
             * @param id_menu
             */
            $cart = Cart::where('id_konsumen', $idKonsumen)
                        ->whereIn('id_menu', $checkout['Id_Menu_Paket'])->get();
            $cart->each(function ($cart, $key) {
                $cart->delete();
            });

            DB::commit();
            
            $user = Auth::user();
            $paymentDetail = (object) [
                'data_menu' => Menu::whereIn('Id_Menu_Paket', $checkout['Id_Menu_Paket']),
                'syarat' => '#',
                'link' => env('APP_URL') 
                          . '/api/v1/order/detail/'. $kodePesanan,
                'data_bank' => Bank::find($checkout['Id_Bank']),
                'nama' => $checkout['nama'],
                'kode_pesanan' => $kodePesanan,
                'kode_unik' => $uniqueCode,
                'alamat' => $checkout['Alamat_Pengiriman'],
                'tanggal' => $checkout['Tanggal_Kegiatan'],
                'waktu' => $checkout['Waktu_Kegiatan'],
                'total_biaya' => $checkout['Total_Harga'],
                'potongan' => $checkout['Potongan_Diskon'],
            ];

            Mail::to($user)->send(new MakePayment($paymentDetail));
        
            return response()->json([
                'message' => 'Checkout Successful!',
                'data' => [
                    'Kode_Pesanan' => $order->Kode_Pesanan,
                ]
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
        
            return response()->json([
                'message' => env('APP_ENV') != 'production' ? $e : 'Internal Server Error',
            ], 500);
        }
    }

    public function detail(Request $request)
    {
        $kodePesanan = $request->route('code');
        $idKonsumen = $this->getKonsumenId();
        $order = Order::where('Kode_Pesanan', $kodePesanan)
                    ->first();

        if($idKonsumen != $order->Id_Konsumen){
            return response()->json([
                'message' => "Forbidden!",
            ], 403);
        }

        $dataPesanan = Order::detail($order->Id_Pesanan);
        $dataMenu = OrderedMenu::orderDetail($order->Id_Pesanan);
        
        return response()->json([
            'data' => [
                'pesanan' => $dataPesanan,
                'menu' => $dataMenu,
            ],
        ], 200);
    }

    private function getKonsumenId()
    {
        $user = Auth::user();
        return $user->customer()->first()->Id_Konsumen;
    }
}
