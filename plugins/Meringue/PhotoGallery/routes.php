<?php

use App\Helpers\Route;

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/Meringue/PhotoGallery/galleries', '\Plugins\Meringue\PhotoGallery\GalleryController@index')->name('PhotoGallery.index');
    Route::get('/Meringue/PhotoGallery/galleries/new', '\Plugins\Meringue\PhotoGallery\GalleryController@create')->name('PhotoGallery.create');
    Route::get('/Meringue/PhotoGallery/galleries/{gallery}', '\Plugins\Meringue\PhotoGallery\GalleryController@show')->name('PhotoGallery.show');
    Route::post('/Meringue/PhotoGallery/galleries', '\Plugins\Meringue\PhotoGallery\GalleryController@store')->name('PhotoGallery.store');
    Route::patch('/Meringue/PhotoGallery/galleries/{gallery}', '\Plugins\Meringue\PhotoGallery\GalleryController@update')->name('PhotoGallery.update');
    Route::delete('/Meringue/PhotoGallery/galleries/{gallery}', '\Plugins\Meringue\PhotoGallery\GalleryController@delete')->name('PhotoGallery.delete');
    Route::get('/Meringue/PhotoGallery/galleries/{gallery}/edit', '\Plugins\Meringue\PhotoGallery\GalleryController@edit')->name('PhotoGallery.edit');

    Route::post('/Meringue/PhotoGallery/galleries/{gallery}/images', '\Plugins\Meringue\PhotoGallery\ImageController@create')->name('PhotoGallery.image.create');
    Route::delete('/Meringue/PhotoGallery/galleries/{gallery}/images/{image}', '\Plugins\Meringue\PhotoGallery\ImageController@delete')->name('PhotoGallery.image.delete');
});

// Assets
Route::asset('PhotoGallery/isotope', __DIR__ . "/assets/js/isotope.js", 'assets.js.isotope');
Route::asset('PhotoGallery/js/slick', __DIR__ . "/assets/js/slick.min.js", 'assets.js.slick');
Route::asset('PhotoGallery/css/slick', __DIR__ . "/assets/css/slick.css", 'assets.css.isotope');
