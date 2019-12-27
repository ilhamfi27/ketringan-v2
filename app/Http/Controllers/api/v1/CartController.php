<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Support\Facades\Auth;
use App\Cart;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;


class CartController extends Controller
{
    public function store(Request $request)
    {
        $user           = Auth::user();
        $id_konsumen    = $user->konsumen()->first()->Id_Konsumen;
        $quantities     = $request->quantity;
        $cart_data      = [];

        foreach ($request->id_menu as $idx => $id) {
            array_push($cart_data, [
                'id_konsumen'   => 29,
                'id_menu'       => $id,
                'quantity'      => $quantities[$idx],
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ]);
        }
        
        $cart = new Cart;
        if ($cart->insert($cart_data)) {
            return response()->json([
                'success' => TRUE,
                'message' => 'Data Stored!'
            ], 200);
        }

        return response()->json([
            'success' => FALSE,
            'message' => 'Data Store Error!'
        ], 500, $headers);
    }
}
