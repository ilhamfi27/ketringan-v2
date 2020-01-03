<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function confirm(Request $request)
    {
        DB::beginTransaction();
        try {
            $idPesanan = $request->id_pesanan;
            $order = Order::find($idPesanan);
            $transfer = $order->transfer()->first();

            $buktiPembayaran = $request->bukti_pembayaran;
            $buktiPembayaranUrl = $buktiPembayaran->store('proof_of_payment');

            $transfer->Nama_Pemegang_Rekening = $request->nama_pengirim;
            $transfer->Nama_Bank_Pengirim = $request->bank_pengirim;
            $transfer->Bukti_Transfer = $buktiPembayaranUrl;
            $transfer->Tgl_Transfer = Carbon::now();

            $order->Status_Pesanan = 'menunggu_verifikasi';
            
            $order->save();
            $transfer->save();

            DB::commit();
            
            return response()->json([
                'success' => TRUE,
                'message' => 'Bukti Pembayaran Berhasil Upload!',
            ], 201);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => FALSE,
                'message' => $e,
            ], 500);
        }
    }
}
