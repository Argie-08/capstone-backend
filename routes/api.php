<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;


Route::post("/registered", [UserController::class, "register"]);
Route::post("/loginhere", [UserController::class, "login"]);

Route::get("/users/{id}", [UserController::class, "getUser"]);
Route::get("/users", [UserController::class, "getUsers"]);

Route::get("/products",  [ProductController::class, "getProducts"]);
Route::get("/products/{id}",  [ProductController::class, "getProduct"]);
Route::put("/products",  [ProductController::class, "updateProduct"]);
Route::post("/products", [ProductController::class, "createProduct"]);
Route::post("/upload-images", [UploadController::class, "uploadImage"]);
Route::get("/testimonial",  [TestimonialController::class, "getTestimonials"]);
Route::get("/testimonial/{user_id}",  [TestimonialController::class, "getTestimonial"]);

Route::get("/orders",  [OrderController::class, "getOrders"]);




Route::group(["middleware" => ["auth:sanctum"]], function() {
    Route::post("/testimonial",  [TestimonialController::class, "createTestimonial"]);
    Route::post("/logouthere", [UserController::class, "logout"]);
    Route::post("/order", [OrderController::class, "postOrder"]);
    // Route::post("/orders", [OrderController::class, "postOrders"]);
    Route::get("/orders/{user_id}",  [OrderController::class, "getOrder"]);
    Route::put("/users/{id}", [UserController::class, "updateUser"]);
});