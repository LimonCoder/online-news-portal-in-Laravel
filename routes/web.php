<?php

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
    return view('welcome');
});

Route::get('/logout',function(){
    auth()->logout();
    return redirect("/");
});

Auth::routes(['register' => false]);


Route::get('/home', function(){
    $user = Auth::user()->username;
    echo $user;
})->middleware('auth');
