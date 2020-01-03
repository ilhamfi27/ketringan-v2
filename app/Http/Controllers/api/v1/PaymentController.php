<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;

class PaymentController extends Controller
{
    public function confirm(Request $request)
    {
        $idPesanan = $request->id_pesanan;
        $order = Order::find($idPesanan);
        $transfer = $order->transfer()->first();

        $namaPengirim = $request->nama_pengirim;
        $bankPengirim = $request->bank_pengirim;
        $buktiPembayaran = $request->bukti_pembayaran;
    }
}
