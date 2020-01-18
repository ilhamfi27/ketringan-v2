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

        $idRegion = $request->input('id_region') != null ? 
                    $request->input('id_region') : null;

        $maxPrice = $request->input('max_price') != null ? 
                    $request->input('max_price') : null;

        $minPrice = $request->input('min_price') != null ? 
                    $request->input('min_price') : null;

        $paginationNum = $request->input('pagination_num') != null ? 
                    $request->input('pagination_num') : null;

        $menu = Menu::getMenu($idKategori, $idRegion, $maxPrice, $minPrice, 
                                    $paginationNum);
        
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
