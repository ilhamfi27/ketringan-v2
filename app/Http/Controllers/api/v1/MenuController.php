<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Menu;
use App\MenuCategory;
use App\MenuType;

class MenuController extends Controller
{
    public function all(Request $request)
    {
        $idKategori = $request->input('id_kategori') != null ? 
                    $request->input('id_kategori') : null;

        $id_region = $request->input('id_region') != null ? 
                    $request->input('id_region') : null;

        $max_price = $request->input('max_price') != null ? 
                    $request->input('max_price') : null;

        $min_price = $request->input('min_price') != null ? 
                    $request->input('min_price') : null;

        $pagination_num = $request->input('pagination_num') != null ? 
                    $request->input('pagination_num') : null;

        $menu = Menu::getMenu($idKategori, $id_region, $max_price, $min_price, 
                                    $pagination_num);
        
        return response()->json([
            'data' => $menu
        ], 200);
    }

    public function getKategoriByJenis(Request $request)
    {
        $menuCategories = MenuCategory::whereIn('Id_Jenis_Menu', $request->id_jenis_menu)
                            ->get();

        return response()->json([
            'data' => $menuCategories
        ], 200);
    }
}
