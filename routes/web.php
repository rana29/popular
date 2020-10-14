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

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


/***********************logincontroller*************************************/


Route::group(['middleware'=>['auth','admin','login','verified']],function(){

Route::prefix('admin')->name('admin.')->group(function(){

Route::get('/dashbord','AdminController@dashbord')->name('dashbord');

});

}); 


Route::group(['middleware'=>['auth','author','login']],function(){

Route::prefix('author')->name('author.')->group(function(){

Route::get('/dashbord','AuthorController@dashbord')->name('dashbord');

	
});
});


/******************Productcontroller***********************/


Route::prefix('product')->name('product.')->group(function(){

    
	Route::get('/create','ProductController@create')->name('create');
	Route::post('/store','Productcontroller@store')->name('store');
	Route::get('/manage','ProductController@manage')->name('manage');
	Route::get('/active/{id}/{status}','ProductController@active')->name('active');
	Route::get('/edit/{id}','ProductController@edit')->name('edit');
	Route::post('/update/{id}','ProductController@update')->name('update');
	Route::get('/delete/{id}','ProductController@delete')->name('delete');
	Route::get('/detil/{id}','ProductController@detil')->name('detil');
	
});



/************************cartcontroller**************************/


Route::prefix('cart')->name('cart.')->group(function(){
	
	Route::post('/store','cartcontroller@store')->name('store');
	Route::get('/manage','cartcontroller@manage')->name('manage');
	Route::post('/update','cartcontroller@update')->name('update');
	Route::get('/delete/{rowId}','cartcontroller@delete')->name('delete');
});


