<?php

use App\Plugin;

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

Plugin::routes();

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', 'Admin\PageController@index');
    Route::get('/dashboard', 'Admin\PageController@index');

    Route::get('page/manage', 'Admin\PageController@manage');
    Route::get('page/edit/{page}', 'Admin\PageController@edit');

    Route::get('plugin/manage/{vendor}/{plugin}', 'Admin\PluginController@config');
    Route::get('plugin/manage', 'Admin\PluginController@manage');
    Route::get('plugin/refresh', 'Admin\PluginController@refreshPluginsRegistry');
    Route::get('plugin/block/refresh', 'Admin\PluginController@refreshBlocksRegistry');
    Route::post('plugin/activate', 'Admin\PluginController@activate');

    Route::post('block/{block}', 'Admin\BlockController@update');
});

// Route for all other pages to go via the CMS
Route::get('{slug}', 'PageController@index');