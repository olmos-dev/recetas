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

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/','InicioController@index')->name('inicio.index');

Auth::routes();

/**Recetas*/
Route::get('recetas','RecetaController@index')->name('receta.index')->middleware('auth');
Route::get('recetas/crear','RecetaController@create')->name('receta.create')->middleware('auth');
Route::post('recetas','RecetaController@store')->name('receta.store')->middleware('auth');
Route::get('recetas/{receta}','RecetaController@show')->name('receta.show');
Route::get('recetas/{receta}/editar','RecetaController@edit')->name('receta.edit')->middleware('auth');
Route::put('recetas/{receta}','RecetaController@update')->name('receta.update')->middleware('auth');
Route::delete('recetas/{receta}','RecetaController@destroy')->name('receta.destroy')->middleware('auth');
/**Buscar Receta */
Route::get('buscar','RecetaController@search')->name('receta.search')->middleware('auth');

/**Perfiles*/
Route::get('perfil/{perfil}','PerfilController@show')->name('perfil.show');
Route::get('perfil/{perfil}/editar','PerfilController@edit')->name('perfil.edit')->middleware('auth');
Route::put('perfil/{perfil}','PerfilController@update')->name('perfil.update')->middleware('auth');

/**Likes de recetas*/
Route::post('recetas/{receta}','LikesController@update')->name('likes.update')->middleware('auth');
Route::get('receta/likes','LikesController@index')->name('likes.index')->middleware('auth');

/**Categorias*/
Route::get('categorias/{categoria}','CategoriaController@show')->name('categoria.show');

//Route::get('/home', 'HomeController@index')->name('home');
