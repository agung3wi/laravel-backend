<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $productList = Product::all();
        return response()->json([
            "message" => "Success",
            "data" => $productList
        ]);
    }

    public function create()
    {
        // Validasi Data
        request()->validate([
            'product_name' => 'required|max:200|min:5',
            'product_sku' => 'required|max:200|min:5',
            'description' => 'max:1024',
        ]);

        $validator = Validator::make(request()->all(), [
            'product_name' => 'required|max:200|min:5',
            'product_sku' => 'required|max:200|min:5',
            'description' => 'max:1024',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "message" => "Input not Valid",
                "error_list" => $validator->errors()
            ]);
        }

        // Validasi Business
        $productExist = Product::selectRaw("1")
            ->where("product_sku", request("product_sku"))->first();

        if (!is_null($productExist)) {
            return response()->json([
                "message" => "Product SKU with code " . request("product_sku") . " already exists"
            ], 422);
        }

        $product = new Product();
        $product->product_name = request("product_name", "");
        $product->product_sku = request("product_sku", "");
        $product->description = request("description", "");
        $product->save();

        return response()->json([
            "message" => "Success",
            "data" => $product
        ], 201);
    }

    public function update($id)
    {
        // Validasi Data
        $validator = Validator::make(request()->all(), [
            'product_name' => 'required|max:200|min:5',
            'description' => 'max:1024',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "message" => "Input not Valid",
                "error_list" => $validator->errors()
            ]);
        }

        $product = Product::find($id);

        if (is_null($product)) {
            return response()->json([
                "message" => "Product with id $id not found"
            ], 422);
        }

        $product->product_name = request("product_name", "");
        $product->description = request("description", "");
        $product->save();
        return response()->json([
            "message" => "Success",
            "data" => $product
        ]);
    }

    public function delete($id)
    {
        // Validasi Data

        $product = Product::find($id);

        if (is_null($product)) {
            return response()->json([
                "message" => "Product with id $id not found"
            ], 422);
        }

        $product->delete();

        return response()->json([
            "message" => "Data successfully deleted",
            "data" => null
        ]);
    }

    public function detail($id)
    {
        // Validasi Data

        $product = Product::find($id);

        if (is_null($product)) {
            return response()->json([
                "message" => "Product with id $id not found"
            ], 422);
        }

        return response()->json([
            "message" => "Success",
            "data" => $product
        ]);
    }
}
