<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class UploadController extends Controller
{  

    function uploadImage(Request $request){

        $field = $request -> validate([     
            "image" => "required | image | mimes:png,jpg,jpeg",
        ]);

        $image_name = time(). "." . $request->image->extension();
        $request->image->move(public_path("image"), $image_name);
        return response()->json(["image"=>$image_name], 201, [], JSON_PRETTY_PRINT);
    }
}
    