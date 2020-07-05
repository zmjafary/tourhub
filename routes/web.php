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

Auth::routes();
Route::get('/', 'HomeController@welcome')->name('welcome');

Route::middleware('auth')->group(function() {
	Route::get('/home', 'HomeController@index')->name('home');

	Route::get('/approve/{id}', 'AdminController@approve')->name('approve');
	Route::get('/unapprove/{id}', 'AdminController@unApprove')->name('unApprove');

	Route::get('/add-user-to-company/{user}', 'AdminController@addUserToCompanyView')->name('addUserToCompanyView');
	Route::post('/add-user-to-company/{user}', 'AdminController@addUserToCompany')->name('addUserToCompany');
	Route::get('/remove-user-to-company/{id}', 'AdminController@removeUserFromCompany')->name('removeUserFromCompany');
	Route::get('/edit-company-user/{id}', 'AdminController@editCompanyUser')->name('editCompanyUser');
	Route::post('/update-company-user/{id}', 'AdminController@updateCompanyUser')->name('updateCompanyUser');
});

Route::get('index', function (){
    return view('index');
})->name('index');

Route::get('about', function (){
    return view('about');
})->name('about');

Route::get('contact', function (){
    return view('contact');
})->name('contact');
