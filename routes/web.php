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

Route::get('/menu', 'MenuController@index')->name('/menu');

Route::get('/mst_shain', 'ShainController@index');

Route::post('/serchShain', 'ShainController@kensaku');

Route::get('/serchShain', 'ShainController@kensaku');

Route::post('/shainregist', 'ShainController@disNewRegist');
Route::post('/checkshaindata/{edit}', 'ShainController@checkShainData');
Route::post('/exeinstshain', 'ShainController@exeInstShain');

Route::post('/shainedit','ShainController@dispEditRegist');
Route::post('/exeupdshain','ShainController@exeUpdShain')->name('/exeupdshain');

