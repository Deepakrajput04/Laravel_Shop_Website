<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AdminController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Admin Routes

Route::get('/admin',[AdminController::class,'index']);
Route::get('/adminProducts',[AdminController::class,'products']);
Route::post('/AddNewProduct',[AdminController::class,'AddNewProduct']);
Route::post('/UpdateProduct',[AdminController::class,'UpdateProduct']);
Route::get('/deleteProduct/{id}',[AdminController::class,'deleteProduct']);
Route::get('/adminProfile',[AdminController::class,'Profile']);
Route::get('/ourCustomers',[AdminController::class,'customers']);
Route::get('/ourOrders',[AdminController::class,'orders']);
Route::get('/changreOrderStatus/{status}/{id}',[AdminController::class,'changreOrderStatus']);







// Customer Routes


Route::get('/',[MainController::class,'index']);
Route::get('/cart',[MainController::class,'cart']);
Route::get('/shop',[MainController::class,'shop']);
Route::get('/single/{id}',[MainController::class,'singleProduct']);
Route::get('/checkout',[MainController::class,'checkout']);
Route::get('/register',[MainController::class,'register']);
Route::get('/logout',[MainController::class,'logout']);
Route::get('/login',[MainController::class,'login']);
Route::post('/registerUser',[MainController::class,'registerUser']);
Route::post('/loginUser',[MainController::class,'loginUser']);
Route::post('/addToCart',[MainController::class,'addToCart']);
Route::get('/deleteCartiIem/{id}',[MainController::class,'deleteCartiIem']);
Route::post('/updateCart}',[MainController::class,'updateCart']);
Route::get('/checkout',[MainController::class,'checkout']);
Route::get('/profile',[MainController::class,'profile']);
Route::post('/updateUser',[MainController::class,'updateUser']);










