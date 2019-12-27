<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Menu;

class MenuController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/v1/menu",
     *      description="Get All Menu",
     *      @OA\Parameter(
     *          name="id_region",
     *          in="query",
     *          description="Get Menu Where Id Region is x",
     *          required=false,
     *      ),
     *      @OA\Parameter(
     *          name="id_kategori",
     *          in="query",
     *          description="Get Menu Where Id Kategori is x",
     *          required=false,
     *      ),
     *      @OA\Parameter(
     *          name="max_price",
     *          in="query",
     *          description="Get Menu Where Max Price is x",
     *          required=false,
     *      ),
     *      @OA\Parameter(
     *          name="min_price",
     *          in="query",
     *          description="Get Menu Where Min Price is x",
     *          required=false,
     *      ),
     *      @OA\Response(
     *          response="200", 
     *          description="Request OK",
     *      )
     * )
     */
    public function all(Request $request)
    {
        $id_region = $request->input('id_region') != null ? 
                    $request->input('id_region') : null;
        
        $max_price = $request->input('max_price') != null ? 
                    $request->input('max_price') : null;

        $min_price = $request->input('min_price') != null ? 
                    $request->input('min_price') : null;

        $pagination_num = $request->input('pagination_num') != null ? 
                    $request->input('pagination_num') : null;

        $menu = Menu::getMenu($id_region, $max_price, $min_price, $pagination_num);
        
        return response()->json([
            'success' => TRUE,
            'data' => $menu
        ], 200);
    }
}
