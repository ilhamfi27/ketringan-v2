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
        $id_konsumen = $user->customer()->first()->Id_Konsumen;
        $match_condition = ['id_konsumen' => $id_konsumen,];
        $cart_items = Cart::where($match_condition)->get();
        $items = [];

        foreach ($cart_items as $key => $value) {
            $menu = $value->menu()->first();
            $minimal_pemesanan = $menu->vendor()->first()->Minimal_Pemesanan;
            $detailMenu['Minimal_Pemesanan'] = $minimal_pemesanan;
            $cart_items[$key]['menu'] = $detailMenu;
        }

        return response()->json([
            'data' => $cart_items,
        ], 200);
    }

    public function store(Request $request)
    {
        $user           = Auth::user();
        $id_konsumen    = $user->customer()->first()->Id_Konsumen;
        $quantities     = $request->quantity;
        $cart_data      = [];

        /**
         * check menu on cart by customer id
         * if exists, the correspond item quantity will plus by 1
         */
        $cart_item = Cart::where('id_konsumen', $id_konsumen)
                        ->whereIn('id_menu', $request->id_menu);
        $cart_item_exist = $cart_item->count() > 0 ? TRUE : FALSE;

        if ($cart_item_exist){
            $items = $cart_item->get();
            foreach ($items as $item) {
                $item->quantity += 1;
                $item->save();
            }
            return response()->json([
                'message' => 'Data Updated!'
            ], 200);
        }

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
                'message' => 'Data Stored!'
            ], 200);
        }

        return response()->json([
            'message' => 'Data Store Error!'
        ], 500);
    }

    public function quantity_change(Request $request)
    {
        $cart_id        = $request->cart_id;
        $quantity       = $request->quantity;
        
        $cart = Cart::find($cart_id);
        $cart->quantity = $quantity;
        
        if ($cart->save()) {
            return response()->json([
                'message' => 'Data Updated!'
            ], 200);
        }

        return response()->json([
            'message' => 'Data Update Error!'
        ], 500);
    }

    public function destroy(Request $request)
    {
        $cart_id        = $request->cart_id;
        
        $cart = Cart::find($cart_id);
        
        if ($cart->delete()) {
            return response()->json([
                'message' => 'Data Deleted!'
            ], 200);
        }

        return response()->json([
            'message' => 'Data Delete Error!'
        ], 500);
    }
}
