<?php

namespace App\Http\Controllers\api\v1;

use App\Customer;
use App\Discount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Testimoni;

class HomeController extends Controller
{
    public function mainScreen()
    {
        $vouchers = Discount::enabled()->get();
        $testimoni = Testimoni::enabled()->get();
        $memberships = Customer::where('Membership', 'VIP')->get();

        return response()->json([
            'data' => [
                'vouchers' => $vouchers,
                'testimonies' => $testimoni,
                'memberships' => $memberships,
            ]
        ], 200);
    }
}
