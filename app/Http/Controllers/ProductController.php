<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    function getProducts (Request $request){
        $product = Product::all();
        return response()->json(Product::all(), 200, [], JSON_PRETTY_PRINT);
    }
    function getProduct ($id){
        $product = Product::where("id", $id)->first();
        return response()->json($product, 200, [], JSON_PRETTY_PRINT);
    }
    function createProduct(Request $request){
        $field = $request -> validate([
            "name" => "required",
            "category" => "required",
            "details" => "required",
            "price" => "required",
            "quantity" => "required",
            "image" => "nullable",
            "usage" => "required"
        ]);
        
        $product = Product::create([
            "name" => $field["name"],
            "category" => $field["category"],
            "details" => $field["details"],
            "price" => $field["price"],
            "quantity" => $field["quantity"],
            "image" => $field["image"],
            "usage" => $field["usage"]
        ]);

        return response()->json(["message"=>"Data Inserted", "data"=>$product ], 201, [], JSON_PRETTY_PRINT);
    }

}
