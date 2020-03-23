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

Route::get('/registrar_sintomas', 'interfaces@registrar_sintomas')->name('registrar_sintomas');

Route::get('/registrar_dato_mapa', 'interfaces@registrar_dato_mapa')->name('registrar_dato_mapa');

Route::post('/registrar_sistema_post', 'interfaces@registrar_sistema_post')->name('registrar_sistema_post');

Route::post('/ingreso_usuario',  'interfaces@ingreso_usuario')->name('ingreso_usuario');
Route::post('/ingreso_establecimiento',  'interfaces@ingreso_establecimiento')->name('ingreso_establecimiento');

Route::get('/noticias', 'interfaces@noticias')->name('noticias');

Route::post('/guardarNoticia',  'interfaces@guardarNoticia')->name('guardarNoticia');

Route::get('/preguntas', 'interfaces@preguntas')->name('preguntas');

Route::post('/responder/{id}',  'interfaces@responder')->name('responder');