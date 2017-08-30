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

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', 'Admin\PageController@index')->name('admin.index');

    Route::get('pages', 'Admin\PageController@index')->name('admin.page.index');
    Route::post('pages', 'Admin\PageController@store')->name('admin.page.store');
    Route::get('pages/add', 'Admin\PageController@create')->name('admin.page.create');
    Route::get('pages/{page}/edit', 'Admin\PageController@edit')->name('admin.page.edit');
    Route::patch('pages/{page}', 'Admin\PageController@update')->name('admin.page.update');

    Route::post('pages/{page}/sections', 'Admin\SectionController@store')->name('section.store');

    Route::get('plugins', 'Admin\PluginController@index')->name('admin.plugin.index');
    Route::post('plugin/activate', 'Admin\PluginController@activate');

    Route::post('plugin/instance', 'Admin\PluginInstanceController@store')->name('instance.store');
    Route::patch('plugin/instance/{instanceId}', 'Admin\PluginInstanceController@update')->name('instance.update');

    Route::post('block/new', 'Admin\BlockController@store')->name('block.store');
    Route::post('block/{block}', 'Admin\BlockController@update')->name('block.update');
    Route::delete('block/{block}', 'Admin\BlockController@delete')->name('block.delete');

    Route::get('block/{block}/modal/{instance?}', 'Admin\PluginModalController@show');
});

// Route for all other pages to go via the CMS
Route::get('{slug?}', 'PageController@index');