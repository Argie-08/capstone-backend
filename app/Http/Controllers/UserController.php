<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    function register(Request $request){
        $field = $request -> validate([
            "first_name" => "required",
            "last_name" => "required",
            "address" => "required",
            "landmark" => "nullable",
            "contact_number" => "required",
            "email" => "required | email | unique:users,email",
            "username" => "required",
            "password" => "required | confirmed"
        ]);
        $user = User::create([                            
            "first_name"=> $field["first_name"],
            "last_name"=> $field["last_name"],
            "address"=> $field["address"],
            "landmark"=> $field["landmark"],
            "contact_number"=> $field["contact_number"],
            "email" => $field["email"],
            "username" => $field["username"],
            "password" => Hash::make($field["password"]) 
        ]);     

        $token = $user ->createToken("secret")->plainTextToken;

        return response ()->json([
            "message" => "User registered",
            "user" => $user,
            "token" => $token
        ], 201, [], JSON_PRETTY_PRINT);
    }
    function login(Request $request){       
        $field = $request-> validate([    
            "username"=>"required",
            "password"=>"required"
        ]);

        $user = User::where("username", $field["username"])->first(); 
        // $password = User::where("password", $field["password"])->first(); 

        if (!$user){
            return response()->json([
                "message" => "username does not exist"
            ], 404, [], JSON_PRETTY_PRINT);
        }

        $token = $user ->createToken("secret")->plainTextToken;  

        return response()->json([
            "message"=> "success",
            "user"=> $user,
            "token" => $token
        ], 201, [], JSON_PRETTY_PRINT);
        
    }
    public function updateUser(Request $request, $id) {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                "message" => "User does not exist"
            ], 404);
        }
        
        $field = $request->validate([
            "first_name" => "required",
            "last_name" => "required",
            "address" => "required",
            "landmark" => "nullable",
            "contact_number" => "required",
            "email" => "required",
           
        ]);

        $user->first_name = $field["first_name"];
        $user->last_name = $field["last_name"];
        $user->address = $field["address"];
        $user->landmark = $field["landmark"];
        $user->contact_number = $field["contact_number"];
        $user->email = $field["email"];
        $user->save();

        return response()->json([
            "message" => "Data has been updated"
        ], 200);
    }

    function logout(){
        Auth()->user()->tokens()->delete();

        return response()->json([
            "message" => "logged out"
        ], 200, [], JSON_PRETTY_PRINT);
    }
    function getUsers (Request $request){
        $product = User::all();
        return response()->json(User::all(), 200, [], JSON_PRETTY_PRINT);
    }
    function getUser ($id){
        $product = User::where("id", $id)->first();
        return response()->json($product, 200, [], JSON_PRETTY_PRINT);
    }}
