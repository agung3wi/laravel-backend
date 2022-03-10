<?php

namespace Tas\Master\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerLevelController extends Controller
{
    public function index()
    {
        return response()->json([
            "message" => "This customer level"
        ]);
    }
}
