<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'Frontend\HomeController');
Route::get('/category/{slug}', 'Backend\CategoryController@category_post')->name('category.post');
Route::get('/all-posts', 'Backend\PostController@get_all_post')->name('all.posts');
Route::get('/single-post/{slug}', 'Backend\PostController@single_post')->name('single.posts');



Auth::routes();

Route::get('/home', 'Backend\DashboardController@index')->name('home');
//Route::get('/{anypath}', 'Backend\DashboardController@index')->where('path','.*');

Route::group(['namespace'=>'Backend'], function(){
    //------Category Routes-------
   Route::get('/categories', 'CategoryController@index')->name('categories');
   Route::get('/active-categories', 'CategoryController@active_categories')->name('active.categories');
   Route::post('/add-category', 'CategoryController@add')->name('add.category');
   Route::get('/edit-category/{id}', 'CategoryController@edit')->name('edit.category');
   Route::post('/update-category/{id}', 'CategoryController@update')->name('update.category');
   Route::get('destroy/category/{id}', 'CategoryController@destroy')->name('category.destroy');
   //-------Posts Route-------
    Route::get('/posts', 'PostController@index')->name('posts');
    Route::post('/add-post', 'PostController@add')->name('add.post');
    Route::get('/edit-post/{id}', 'PostController@edit')->name('edit.post');
    Route::post('/update-post/{id}', 'PostController@update')->name('update.post');
    Route::get('/destroy/post/{id}', 'PostController@destroy')->name('post.destroy');

});

