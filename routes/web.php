<?php

use App\Plugin;
use Illuminate\Support\Facades\Auth;

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
    Route::get('pages/{page}/delete', 'Admin\PageController@delete')->name('admin.page.delete');

    Route::get('menu/edit', 'Admin\MenuController@edit')->name('admin.menu.edit');
    Route::post('menu/option', 'Admin\MenuOptionController@store')->name('menu.option.store');
    Route::patch('menu/option/{menuOption}', 'Admin\MenuOptionController@update')->name('menu.option.update');
    Route::delete('menu/option/{menuOption}', 'Admin\MenuOptionController@destroy')->name('menu.option.destroy');

    Route::post('pages/{page}/sections', 'Admin\SectionController@store')->name('section.store');

    Route::patch('blocks/order', 'Admin\BlockOrderController@update')->name('block.order.update');

    Route::get('plugins', 'Admin\PluginController@index')->name('plugin.index');

    Route::post('plugins/{plugin}/activate', 'Admin\PluginActivationController@store')->name('plugin.activate');
    Route::delete('plugins/{plugin}/deactivate', 'Admin\PluginActivationController@destroy')->name('plugin.unactivate');

    Route::post('instances', 'Admin\PluginInstanceController@store')->name('instance.store');
    Route::patch('instances/{instanceId}', 'Admin\PluginInstanceController@update')->name('instance.update');

    Route::post('sections/{section}/blocks', 'Admin\BlockController@store')->name('block.store');
    Route::post('blocks/{block}', 'Admin\BlockController@update')->name('block.update');

    // TODO update with Section
    Route::delete('blocks/{block}', 'Admin\BlockController@delete')->name('block.delete');

    Route::get('blocks/{block}/modal/{instance?}', 'Admin\PluginModalController@show')->name('modal.show');
});

// Get asset according to file path
Route::get('assets/{filePath?}', 'AssetController@show')->where('filePath', '(.*)');

// Route for all other pages to go via the CMS
Route::get('{slug?}', 'PageController@index');