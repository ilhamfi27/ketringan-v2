<?php

namespace App\Http\Controllers\api\v1;

use App\Customer;
use App\Discount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Testimoni;

class HomeController extends Controller
{
    public function mainScreen(Request $request)
    {
        $voucherLimit = $request->voucherLimit == null ? 
                            3 : $request->voucherLimit;
        $testimoniLimit = $request->testimoniLimit == null ? 
                            3 : $request->testimoniLimit;
        $membershipLimit = $request->membershipLimit == null ? 
                            8 : $request->membershipLimit;
                            
        $vouchers = Discount::enabled()->limit($voucherLimit)->get();
        $testimoni = Testimoni::enabled()->limit($testimoniLimit)->get();
        $memberships = Customer::where('Membership', 'VIP')->limit($membershipLimit)->get();

        return response()->json([
            'data' => [
                'vouchers' => $vouchers,
                'testimonies' => $testimoni,
                'memberships' => $memberships,
            ]
        ], 200);
    }
}
