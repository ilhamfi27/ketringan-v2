<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Menu;
use App\MenuCategory;
use App\MenuType;
use App\QuickOrder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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

        $priceSort = $request->price_sort != null ? 
                    $request->price_sort : null;

        $paginationNum = $request->pagination_num != null ? 
                    $request->pagination_num : null;

        $menu = Menu::getMenu($idJenisMenu, $idKategori, $idRegion, $maxPrice, 
                            $minPrice, $paginationNum, $priceSort);

        $kategori = MenuCategory::where('Id_Jenis_Menu', $request->id_jenis_menu)
                        ->get();
        
        return response()->json([
            'kategori' => $kategori,
            'data' => Menu::addValueToPrice($menu, 3000),
        ], 200);
    }

    public function getKategoriByJenis(Request $request)
    {
        $menuCategory = MenuCategory::where('Id_Jenis_Menu', $request->id_jenis_menu)
                            ->first();

        return response()->json([
            'data' => $menuCategory
        ], 200);
    }

    public function suggestOrder(Request $request)
    {
        $user = Auth::user();
        $customerId =  $user->customer()->first()->Id_Konsumen;
        $newData = $request->all();

        $validator = Validator::make($request->all(), [
            'No_Telf_Aktif' => 'required|numeric',
            'Catatan_Pemesanan' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'error' => $validator->errors()
            ], 400);
        }

        $completeData = [
            'Id_Konsumen' => $customerId,
        ];
        QuickOrder::create($newData + $completeData);

        return response()->json([
            'message' => 'Saran Berhasil Dikirim!',
        ], 200);
    }
}
