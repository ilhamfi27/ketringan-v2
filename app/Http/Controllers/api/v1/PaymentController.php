<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\ImageUpload;
use App\Order;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Bank;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmationPaymentNotification;

class PaymentController extends Controller
{
    use ImageUpload;

    public function confirm(Request $request)
    {
        DB::beginTransaction();
        try {
            $user = Auth::user();
            $customer = $user->customer()->first();

            $idPesanan = $request->id_pesanan;
            $order = Order::find($idPesanan);
            $transfer = $order->transfer()->first();

            $buktiPembayaran = $request->bukti_pembayaran;
            $buktiPembayaranUrl = $this->storePaymentProof($buktiPembayaran);

            $transfer->Nama_Pemegang_Rekening = $request->nama_pengirim;
            $transfer->Nama_Bank_Pengirim = $request->bank_pengirim;
            $transfer->Bukti_Transfer = $buktiPembayaranUrl;
            $transfer->Tgl_Transfer = Carbon::now();

            $order->Status_Pesanan = 'menunggu_verifikasi';
            
            $order->save();
            $transfer->save();

            DB::commit();
            
            $paymentDetail = (object) [
                'data_bank' => Bank::find($transfer->Id_Bank),
                'nama' => $customer->Nama_Konsumen,
                'kode_pesanan' => $order->Kode_Pesanan,
                'total_biaya' => $order->Total_Harga,
            ];
            Mail::to('finance@ketringan.com')
                ->cc(['rafatabahar@gmail.com', 'fitriachusniah@gmail.com'])
                ->send(new ConfirmationPaymentNotification($paymentDetail));
            
            return response()->json([
                'message' => 'Upload Successful!',
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            echo $e;
        }
    }
}
