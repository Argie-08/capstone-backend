<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminController extends Controller
{
    function adminRegister(Request $request){
        $field = $request -> validate([
            
            "username" => "required",
            "password" => "required | confirmed"
        ]);
        $admin = Admin::create([                            
          
            "username" => $field["username"],
            "password" => Hash::make($field["password"]) 
        ]);     

        $token = $admin ->createToken("secret")->plainTextToken;

        return response ()->json([
            "message" => "User registered",
            "user" => $admin,
            "token" => $token
        ], 201, [], JSON_PRETTY_PRINT);
    }

    function adminLogIn(Request $request){       
        $field = $request-> validate([    
            "username"=>"required",
            "password"=>"required"
        ]);

        $admin = Admin::where("username", $field["username"])->first(); 
        $password = Admin::where("password", $field["password"])->first(); 

        if (!$admin){
            return response()->json([
                "message" => "Incorrect username"
            ], 404, [], JSON_PRETTY_PRINT);
        } else {
            if (!$password){
                return response()->json([
                    "message" => "Incorrect password"
                ], 404, [], JSON_PRETTY_PRINT);
        }

        $token = $admin ->createToken("secret")->plainTextToken;  

        return response()->json([
            "message"=> "success",
            "user"=> $admin,
            "token" => $token
        ], 201, [], JSON_PRETTY_PRINT);
        
    }
}
}