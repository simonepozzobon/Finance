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
  Route::resource('todo-api', 'TodoController', ['except' => ['create']]);
  Route::get('/', function() {
    return view('todo');
  })->name('todo.index');
});

Route::prefix('project')->group(function() {
  Route::resource('project-api', 'ProjectController', ['except' => ['create']]);
  Route::get('/', function() {
    return view('project');
  })->name('project.index');
});
