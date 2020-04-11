<?php

use Illuminate\Support\Facades\Route;
use App\Lists as Lists;
use App\User as UsersModel;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

//Route::resource("user","users");
//Route::resource("list","lists");

Route::get("/user",function(){
	abort(404);
});
Route::get("/user/account","users@edit");
Route::get("/user/profile/{id}","users@show");
Route::get("/list/create","lists@create");
Route::post("/list/store","lists@store");
Route::get("/list/show/{slug?}","lists@show");
Route::get("/list/edit/{slug}","lists@edit");
Route::post("/list/update","lists@update");
Route::post("/list/delete","lists@delete");

Auth::routes();

Route::get('/home',function(){
	if(Auth::check()){
		$user = UsersModel::find(Auth::id());
		return view("home",["listData"=>$user->lists()->where("id",Auth::id())->get()]);
	}else{
		return view('home');
	}
})->name('home');
