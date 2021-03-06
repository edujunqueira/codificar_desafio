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

Route::get('/', "HomeController@homePage");

Route::get('/api/gastadores', "DeputadoController@getGastadoresAnual");

Route::get('/api/gastadores/{mes}', "DeputadoController@getGastadores");

//Route::get('/api/gastadores', "DeputadoController@getGastadores");

Route::get('/api/redesSociais', "SocialController@getRedesSociais");
