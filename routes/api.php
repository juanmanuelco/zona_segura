<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/registroMovil', 'UsuarioContraller@registroMovil')->name('registroMovil');

Route::post('/loginMovil', 'UsuarioContraller@loginMovil')->name('loginMovil');

Route::post('/envioAnalisis', 'UsuarioContraller@envioAnalisis')->name('envioAnalisis');

Route::get('/mostrarSintomas', 'UsuarioContraller@mostrarSintomas')->name('mostrarSintomas');

Route::get('/verPuntosMapa', 'UsuarioContraller@verPuntosMapa')->name('verPuntosMapa');

Route::get('/verTodasNoticias', 'UsuarioContraller@verTodasNoticias')->name('verTodasNoticias');
Route::get('/verTodasPreguntas', 'UsuarioContraller@verTodasPreguntas')->name('verTodasPreguntas');
Route::post('/enviarPregunta', 'UsuarioContraller@enviarPregunta')->name('enviarPregunta');