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

//Rota Inicial
Route::get('/', 'LoginController@index')->name('index')->middleware('guest');

//Rotas de login
Route::group(['prefix' => 'login'],function(){
    Route::post('/',['as' => 'login','uses' => 'LoginController@login']);
    Route::get('/logout',['as' => 'logout','uses' => 'LoginController@logout']);
});

//Rotas Internas
Route::group(['prefix' => 'interno', 'middleware' => ['auth']],function(){

    Route::get('/',['as' => 'home','uses' => 'HomeController@index']);
    //Rota de usuários
    Route::group(['prefix' => 'users','middleware' => ["role:adm|adm sys"]],function(){
        Route::get('/',['as' => 'users.index','uses' => 'UserController@index']);
        Route::post('/store',['as' => 'users.store','uses' => 'UserController@store']);
        Route::post('/update',['as' => 'users.update','uses' => 'UserController@update']);
        Route::post('/delete',['as' => 'users.delete','uses'=> 'UserController@destroy']);
        Route::get('/getUser/{id}',['as' => 'users.delete','uses'=> 'UserController@getUser']);
    });
    //Rota de pacientes
    Route::group(['prefix' => 'pacientes'],function(){
        Route::get('/',['as' => 'pacientes.index','uses' => 'PacienteController@index'])->middleware("role:registrador");
        Route::post('/store',['as' => 'pacientes.store','uses' => 'PacienteController@store'])->middleware("role:registrador");
        Route::post('/update',['as' => 'pacientes.update','uses' => 'PacienteController@update'])->middleware("role:registrador|acompanhador");
        Route::post('/delete',['as' => 'pacientes.delete','uses'=> 'PacienteController@destroy'])->middleware("role:registrador");
        Route::get('/acompanhar',['as' => 'paciente.acompanhar','uses' => 'PacienteController@acompanharShow'])->middleware("role:acompanhador");
        Route::get('/getPaciente/{id}',['as' => 'users.delete','uses'=> 'PacienteController@getPaciente']);
    });

});


