<?php

use App\Block;
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
    Route::get('page/edit/{page}', 'Admin\PageController@edit')->name('admin.page.edit');

    Route::post('page/{page}/sections', 'Admin\SectionController@store')->name('section.store');

    Route::get('plugin/manage', 'Admin\PluginController@manage');
    Route::post('plugin/activate', 'Admin\PluginController@activate');
    Route::post('plugin/instance', 'Admin\PluginController@createInstance')->name('instance.store');

//    Route::get('block/refresh', 'Admin\BlockController@refreshRegistry')->name('block.refresh');
    Route::post('block/new', 'Admin\BlockController@store')->name('block.store');
    Route::post('block/{block}', 'Admin\BlockController@update')->name('block.update');
    Route::delete('block/{block}', 'Admin\BlockController@delete')->name('block.delete');

    Route::get('block/{block}/modal/{instance?}', 'Admin\PluginController@renderModal');
});


// Route for all other pages to go via the CMS
Route::get('{slug}', 'PageController@index');