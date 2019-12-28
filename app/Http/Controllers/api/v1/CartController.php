<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Support\Facades\Auth;
use App\Cart;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;


class CartController extends Controller
{

    public function all()
    {
        $user = Auth::user();
        $id_konsumen = $user->konsumen()->first()->Id_Konsumen;
        $match_condition = ['id_konsumen' => $id_konsumen,];
        $cart_items = Cart::where($match_condition)->get();
        $items = [];

        foreach ($cart_items as $key => $value) {
            $cart_items[$key]['menu'] = $value->menu->first();
        }

        return response()->json([
            'success' => TRUE,
            'data' => $cart_items,
        ], 200);
    }

    public function store(Request $request)
    {
        $user           = Auth::user();
        $id_konsumen    = $user->konsumen()->first()->Id_Konsumen;
        $quantities     = $request->quantity;
        $cart_data      = [];

        foreach ($request->id_menu as $idx => $id) {
            array_push($cart_data, [
                'id_konsumen'   => $id_konsumen,
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

    public function quantity_change(Request $request)
    {
        $cart_id        = $request->cart_id;
        $quantity       = $request->quantity;
        
        $cart = Cart::find($cart_id);
        $cart->quantity = $quantity;
        
        if ($cart->save()) {
            return response()->json([
                'success' => TRUE,
                'message' => 'Data Updated!'
            ], 200);
        }

        return response()->json([
            'success' => FALSE,
            'message' => 'Data Update Error!'
        ], 500, $headers);
    }

    public function destroy(Request $request)
    {
        $cart_id        = $request->cart_id;
        
        $cart = Cart::find($cart_id);
        
        if ($cart->delete()) {
            return response()->json([
                'success' => TRUE,
                'message' => 'Data Deleted!'
            ], 200);
        }

        return response()->json([
            'success' => FALSE,
            'message' => 'Data Delete Error!'
        ], 500, $headers);
    }
}
