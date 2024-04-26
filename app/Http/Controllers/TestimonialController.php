<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    function getTestimonials (Request $request){
        $testimonial = Testimonial::all();
        return response()->json(Testimonial::all(), 200, [], JSON_PRETTY_PRINT);
    }
    function getTestimonial ($user_id){
        $testimonial = Testimonial::where("user_id", $user_id)->get();
        return response()->json($testimonial, 200, [], JSON_PRETTY_PRINT);
    }
    function createTestimonial (Request $request){
        $field = $request -> validate([
            "content" => "required",
          
            
        ]);
        
        $testimonial = Testimonial::create([
            "content" => $field["content"],
            "user_id" => auth()->user()->id,
        ]);
        return response()->json(["message" => "comment inserted", 
        "data" => $testimonial], 201, [], JSON_PRETTY_PRINT);
    }
}
