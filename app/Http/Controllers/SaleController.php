<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    function index()
    {
        $sales = Sale::get();
        return response()->json($sales);
    }
}
