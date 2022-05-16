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

Route::get('/hatchu','HatchuController@index');
Route::post('/searchorder','HatchuController@search');
Route::get('/searchorder','HatchuController@search');

Route::post('/createorder','HatchuController@dispShinki');
Route::post('/hatchuconfilm','HatchuController@hatchuConfilm');

Route::get('/torihikisakisansho','HatchuController@torihikisakiSansho');
Route::post('/torihikisakigetpage','HatchuController@torihikisakiGetPage');
Route::post('/torihikisakigetlist','HatchuController@torihikisakiGetList');

Route::get('/yakuhinsansho','HatchuController@yakuhinSansho');
Route::post('/yakuhingetpage','HatchuController@yakuhinGetPage');
Route::post('/yakuhingetlist','HatchuController@yakuhinGetList');
