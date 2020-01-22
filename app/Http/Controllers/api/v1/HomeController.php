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
        $vouchers = Discount::enabled()->limit(3)->get();
        $testimoni = Testimoni::enabled()->limit(3)->get();
        $memberships = Customer::where('Membership', 'VIP')->limit(8)->get();

        return response()->json([
            'data' => [
                'vouchers' => $vouchers,
                'testimonies' => $testimoni,
                'memberships' => $memberships,
            ]
        ], 200);
    }
}
