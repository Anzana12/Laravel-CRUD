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
    return redirect('/mahasiswa');
});

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::post('/mahasiswa/{id}', 'MahasiswaController@update');
Route::post('/mahasiswa/{id}/delete', 'MahasiswaController@destroy');
Route::resource('mahasiswa', 'MahasiswaController');
