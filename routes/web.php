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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/','LoginController@index');

Route::post('/put_login', 'LoginController@putLogin');

Route::get('/menu', 'MenuController@index');

Route::get('/mst_shain', 'ShainController@index');
