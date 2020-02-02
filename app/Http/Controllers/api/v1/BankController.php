<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Bank;

class BankController extends Controller
{
    public function all()
    {
        $banks = Bank::all();
        
        return response()->json([
            'data' => $banks,
        ], 200);
    }

    public function show(Request $request)
    {
        $bankId = $request->route('id');
        $bank = Bank::find($bankId);
        
        return response()->json([
            'data' => $bank,
        ], 200);
    }
}
