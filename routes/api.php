<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;





Route::get("/products",  [ProductController::class, "getProducts"]);
Route::get("/products/{id}",  [ProductController::class, "getProduct"]);
Route::put("/product/{id}",  [ProductController::class, "updateProduct"]);
Route::delete("/product/{id}",  [ProductController::class, "deleteProduct"]);
Route::post("/products", [ProductController::class, "createProduct"]);
Route::post("/upload-images", [UploadController::class, "uploadImage"]);
Route::get("/testimonial",  [TestimonialController::class, "getTestimonials"]);
Route::get("/testimonial/{user_id}",  [TestimonialController::class, "getTestimonial"]);
Route::post("/registered", [UserController::class, "register"]);
Route::post("/loginhere", [UserController::class, "login"]);

Route::post("/admin/register", [AdminController::class, "adminRegister"]);
Route::post("/admin/logIn", [AdminController::class, "adminLogIn"]);

Route::get("/users/{id}", [UserController::class, "getUser"]);
Route::get("/users", [UserController::class, "getUsers"]);

Route::get("/orders",  [OrderController::class, "getOrders"]);




Route::group(["middleware" => ["auth:sanctum"]], function() {
    Route::post("/testimonial",  [TestimonialController::class, "createTestimonial"]);
    Route::post("/logouthere", [UserController::class, "logout"]);
    Route::post("/order", [OrderController::class, "postOrder"]);
    Route::get("/orders/{user_id}",  [OrderController::class, "getOrder"]);
    Route::put("/users/{id}", [UserController::class, "updateUser"]);
});