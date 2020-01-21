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
        $idJenisMenu = $request->id_jenis_menu != null ? 
                    $request->id_jenis_menu : null;

        $idKategori = $request->id_kategori != null ? 
                    $request->id_kategori : null;

        $idRegion = $request->id_region != null ? 
                    $request->id_region : null;

        $maxPrice = $request->max_price != null ? 
                    $request->max_price : null;

        $minPrice = $request->min_price != null ? 
                    $request->min_price : null;

        $paginationNum = $request->pagination_num != null ? 
                    $request->pagination_num : null;

        $menu = Menu::getMenu($idJenisMenu, $idKategori, $idRegion, $maxPrice, 
                            $minPrice, $paginationNum);

        $kategori = MenuCategory::where('Id_Jenis_Menu', $request->id_jenis_menu)
                        ->get();
        
        return response()->json([
            'kategori' => $kategori,
            'data' => $menu,
        ], 200);
    }

    public function getKategoriByJenis(Request $request)
    {
        $menuCategories = MenuCategory::where('Id_Jenis_Menu', $request->id_jenis_menu)
                            ->get();

        return response()->json([
            'data' => $menuCategories
        ], 200);
    }
}
