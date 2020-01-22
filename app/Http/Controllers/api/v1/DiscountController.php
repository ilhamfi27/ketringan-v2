<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Discount;
use App\Payment;

class DiscountController extends Controller
{
    public function useVoucher(Request $request)
    {
        $user = Auth::user();
        $customer = $user->customer()->first();
        $customerId = $customer->Id_Konsumen;

        $kodeDiskon = $request->kode_diskon;
        $currentPrice = $request->nominal;

        $discount = Discount::getByKodeDiskon($kodeDiskon)->first();
        
        if ($discount != null) {
            $discountEnabled = $discount->enabled()->first();
        }

        if ($discount == null){
            return response()->json([
                'message' => 'Kode Tidak Valid',
            ], 401);
        }

        if ($discountEnabled == null){
            return response()->json([
                'message' => 'Voucher Tidak Aktif',
            ], 401);
        }

        $customerHasDiscount = Payment::customerDiscount($customerId, $discount->Id_Diskon)
                                    ->count();
        if ($customerHasDiscount > 0) {
            return response()->json([
                'message' => 'Kode Sudah Terpakai',
            ], 401);
        }

        if ($currentPrice != null && $currentPrice >= $discount->Minimal_Pembelian) {
            switch ($discount->Jenis_Diskon) {
                case 'reguler':
                    $hargaDiskon = $currentPrice - $discount->Besar_Diskon;
                    break;

                case 'persen':
                    $diskon = $currentPrice * ($discount->Besar_Diskon * 0.01);
                    $hargaDiskon = $currentPrice - ($diskon > $discount->Maksimal_Diskon ?
                                            $discount->Maksimal_Diskon : $diskon);
                    break;
                
                default:
                    # code...
                    break;
            }
            $data['harga_diskon'] = $hargaDiskon;
        }
        
        $data['diskon'] = [
            'Id_Diskon' => $discount->Id_Diskon,
            'Kode_Diskon' => $discount->Kode_Diskon,
            'Minimal_Pembelian' => $discount->Minimal_Pembelian,
            'Jenis_Diskon' => $discount->Jenis_Diskon,
            'Besar_Diskon' => $discount->Besar_Diskon,
            'Maksimal_Diskon' => $discount->Maksimal_Diskon,
        ];

        return response()->json([
            'data' => $data,
        ], 200);
    }

    public function allVoucher()
    {
        $vouchers = Discount::enabled()->get();

        return response()->json([
            'data' => $vouchers,
        ], 200);
    }
}
