<?php

use Illuminate\Support\Facades\Route;



Route::prefix('admin')->name('admin.')->namespace('Admin')->group(function(){
    Route::get('login', 'LoginController@index')->name('index');
    Route::post('login', 'LoginController@login')->name('login');
    
    Route::middleware(['auth'])->group(function () {
        Route::get('logout', 'LoginController@logout')->name('logout');
        Route::get('dashboard', 'SupportController@dashboard')->name('dashboard');
       
        Route::prefix('support')->name('support.')->group(function(){
            Route::get('/', 'SupportController@index')->name('index');      
            Route::get('list', 'SupportController@list')->name('list');      
            Route::get('add', 'SupportController@add')->name('add'); 
            Route::post('addTicket', 'SupportController@addTicket')->name('addTicket'); 
            Route::post('statusChange', 'SupportController@statusChange')->name('statusChange'); 

            Route::get('view/{id}', 'SupportController@view')->name('view');
            Route::post('reply/{id}', 'SupportController@reply')->name('reply');
        });      
        
    });
});

Route::get('/', function () {
    return view('welcome');
});
