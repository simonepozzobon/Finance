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

// ToDo List
Route::prefix('todo')->group(function() {
  Route::resource('todo-api', 'TodoController', ['except' => ['create']]);
  Route::get('/', function() {
    return view('todo');
  })->name('todo.index');
});

// Project List
Route::prefix('project')->group(function() {
  Route::resource('project-api', 'ProjectController', ['except' => ['create']]);
  Route::get('/', function() {
    return view('project');
  })->name('project.index');
});

// Clients List
Route::prefix('client')->group(function() {
  Route::resource('client-api', 'ClientController', ['except' => ['create']]);
  Route::get('/', function() {
    return view('client');
  })->name('client.index');
});

// Invoice Panel
Route::prefix('invoices')->group(function(){
  Route::resource('invoice-api', 'InvoiceController', ['except' => ['create']]);
  Route::get('/', function() {
    return view('invoices');
  })->name('invoice.index');
});


// Settings Panel
Route::prefix('settings')->group(function() {
  Route::prefix('status')->group(function() {
    Route::resource('/status-api', 'StatusController@index', ['except' => ['create']]);
    Route::get('/', function() {
      return view('settings.status');
    })->name('status.index');
  });
});
