<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Menu;

class MenuController extends Controller
{
    public function all(Request $request)
    {
        $id_jenis_menu = $request->input('id_jenis_menu') != null ? 
                    $request->input('id_jenis_menu') : null;

        $id_region = $request->input('id_region') != null ? 
                    $request->input('id_region') : null;

        $max_price = $request->input('max_price') != null ? 
                    $request->input('max_price') : null;

        $min_price = $request->input('min_price') != null ? 
                    $request->input('min_price') : null;

        $pagination_num = $request->input('pagination_num') != null ? 
                    $request->input('pagination_num') : null;

        $menu = Menu::getMenu($id_jenis_menu, $id_region, $max_price, $min_price, $pagination_num);
        
        return response()->json([
            'data' => $menu
        ], 200);
    }
}
