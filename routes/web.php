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
    return redirect()->route('consulta.index');
})->middleware('auth');

Auth::routes();
Route::get('consulta/exportar/{id}', 'ConsultaController@exportar')->name('consulta.exportar');
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('paciente', 'PacienteController'); //ROTA DO PACIENTE
Route::resource('consulta', 'ConsultaController'); //ROTA DO PACIENTE
Route::get('consulta/create/{paciente}', 'ConsultaController@create')->name('consulta.create'); //ADICIONA PARÂMETROS PARA O MÉTODO CREATE
