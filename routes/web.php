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
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

// Home Controller
Route::get('/', 'HomeController@index' )->name('web.index');

Route::get('/category/{id}', 'HomeController@postshow_By_category' )->where('id', '[0-9]+');

Auth::routes(['register' => false]);

Route::get('/logout',function(){
    Auth::logout();
    return Redirect('/');
});


Route::get('/home', 'AdminController@index')->name('admin.home');

// category-subcategory Controller
Route::get('/category', 'CategoryController@index')->name('category.home');
Route::post('/store', 'CategoryController@store');
Route::get('/categories','CategoryController@categories');
Route::get('/categorieslist','CategoryController@categories_list');
Route::post('/categories_delete','CategoryController@category_delete');

// Post Controller 
Route::get('/post', 'PostController@index')->name('post.index');
Route::get('/post/create', 'PostController@create')->name('post.create');
Route::post('/getsubcategorybycategory', 'PostController@getsubcategoryBycategory');
Route::post('/post/store', 'PostController@store');
Route::get('/post/postslist', 'PostController@posts_list');


