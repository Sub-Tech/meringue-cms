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


Auth::routes();

Route::get('/bob', '\Plugins\Meringue\Text\TextController@index')->name('home');


Route::get('/home', 'HomeController@index')->name('home');



// Admin Routes
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', function (){    return redirect('admin/dashboard');});

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });

    // Page Routes
    Route::prefix('page')->group(function () {
        Route::get('manage', 'Admin\PageController@manage');
        Route::get('edit/{page}', 'Admin\PageController@edit');
    });

    // Plugin Routes
    Route::prefix('plugin')->group(function () {
        Route::get('manage', 'Admin\PluginController@manage');
        Route::post('activate', 'Admin\PluginController@activate');
        Route::get('refresh', 'Admin\PluginController@refreshPluginsRegistry');
        Route::prefix('block')->group(function () {
            Route::get('refresh', 'Admin\PluginController@refreshBlocksRegistry');
        });
    });

    // Block Routes
    Route::prefix('block')->group(function () {
        Route::post('{block}', 'Admin\BlockController@update');
    });
});

// Route for all other pages to go via the CMS
Route::get('{slug}', 'PageController@index');