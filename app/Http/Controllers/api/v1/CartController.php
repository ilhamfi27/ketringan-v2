<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Support\Facades\Auth;
use App\Cart;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{

    public function all()
    {
        $user = Auth::user();
        $idKonsumen = $user->customer()->first()->Id_Konsumen;
        $matchCondition = ['id_konsumen' => $idKonsumen,];
        $cartItems = Cart::where($matchCondition)->get();
        $items = [];

        foreach ($cartItems as $key => $value) {
            $menu = $value->menu()->first();
            $vendor = $menu->vendor()->first();
            $detailMenu = [
                'Nama_Paket' => $menu->Nama_Paket,
                'Gambar_Paket' => $menu->Gambar_Paket,
                'Harga_Paket' => $menu->Harga_Paket,
                'Minimal_Pemesanan' => $vendor->Minimal_Pemesanan,
                'Nama_Vendor' => $vendor->Nama_Vendor,
            ];
            $cartItems[$key]['menu'] = $detailMenu;
        }

        return response()->json([
            'data' => $cartItems,
        ], 200);
    }
    
    public function store(Request $request)
    {
        $user           = Auth::user();
        $idKonsumen     = $user->customer()->first()->Id_Konsumen;
        $quantities     = $request->quantity;
        $menuIds        = $request->id_menu;
        $cartData       = [];
        $customerCart   = Cart::where('id_konsumen', $idKonsumen);

        /**
         * check menu on cart by customer id
         * if exists, the correspond item quantity will plus by 1
         */
        $existingCartItem = $customerCart
                            ->whereIn('id_menu', $menuIds)->get();
        $cartItemMenuId = $existingCartItem->pluck('id_menu')->toArray();
        
        DB::beginTransaction();
        try {
            foreach ($menuIds as $idx => $id) {
                if (in_array($id, $cartItemMenuId)) {
                    $cartItem = $this->getCartItem($idKonsumen, $id);
                    $cartItem->quantity += 1;
                    $cartItem->save();
                } else {
                    Cart::create([
                        'id_konsumen'   => $idKonsumen,
                        'id_menu'       => $id,
                        'quantity'      => $quantities[$idx],
                        'created_at'    => Carbon::now(),
                        'updated_at'    => Carbon::now(),
                    ]);
                }
            }
            
            DB::commit();

            return response()->json([
                'message' => 'Data Disimpan!'
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            
            return response()->json([
                'message' => env('APP_ENV') != 'production' ? $e : 'Internal Server Error',
            ], 500);
        }

    }

    private function getCartItem($customerId, $menuid)
    {
        $customerCart = Cart::where('id_konsumen', $customerId);
        return $customerCart->where('id_menu', $menuid)->first();
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
