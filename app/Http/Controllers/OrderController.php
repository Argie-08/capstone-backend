<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    function getOrders (Request $request){
        $order = Order::all();
        return response()->json(Order::all(), 200, [], JSON_PRETTY_PRINT);
    }
    function getOrder ($user_id){
        $order = Order::where("user_id", $user_id)->get();
        return response()->json($order, 200, [], JSON_PRETTY_PRINT);
    }
    function postOrder(Request $request){
        $field = $request -> validate([
            "item" => "required",
            "price" => "required",
            "quantity" => "required",
            "total" => "required",
            
        ]);
        
        $order = Order::create([
            "item" => $field["item"],
            "price" => $field["price"],
            "quantity" => $field["quantity"],
            "total" => $field["total"],
            "quantity" => $field["quantity"],
            "user_id" => auth()->user()->id,
        ]);

        return response()->json(["message"=>"Added to Cart", "data"=>$order ], 201, [], JSON_PRETTY_PRINT);
    }
}
