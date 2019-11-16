<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Menu;

class MenuController extends Controller
{
    public function all(Request $request)
    {
        $id_region = $request->input('id_region') != null ? 
                    $request->input('id_region') : null;
        
        $id_kategori = $request->input('id_kategori') != null ? 
                    $request->input('id_kategori') : null;
        
        $max_price = $request->input('max_price') != null ? 
                    $request->input('max_price') : null;

        $min_price = $request->input('min_price') != null ? 
                    $request->input('min_price') : null;
        
        $menu = Menu::getMenu($id_region, $id_kategori, $max_price, $min_price);
        
        return response()->json([
            'error' => 'false',
            'data' => $menu
        ], 200);
    }
}
