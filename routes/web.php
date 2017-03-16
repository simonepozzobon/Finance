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
    return view('welcome');
});

Route::prefix('todo')->group(function() {
  Route::resource('api', 'TodoController', ['except' => ['create']]);
  // Route::prefix('api')->group(function () {
  //   Route::get('/{id}', 'TodoController@show')->name('api.todos.show');
  //   Route::put('/{id}', 'TodoController@update')->name('api.todos.update');
  //   Route::get('/{id}/edit', 'TodoController@edit')->name('api.todos.edit');
  //   Route::delete('/{id}', 'TodoController@destroy')->name('api.todos.delete');
  //   Route::post('/', 'TodoController@store')->name('api.todos.store');
  //   Route::get('/', 'TodoController@index')->name('api.todos.index');
  // });
  Route::get('/', function() {
    return view('todo');
  })->name('todo.index');
});
