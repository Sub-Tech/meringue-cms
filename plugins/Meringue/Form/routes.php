<?php

Route::post('/form/submit', '\Plugins\Meringue\Form\Response@store');

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/Meringue/Form/forms', '\Plugins\Meringue\Form\Form@index')->name('Form.index');
    Route::get('/Meringue/Form/new', '\Plugins\Meringue\Form\FormBuilder@create')->name('Form.create');
    Route::post('/Meringue/Form/create', '\Plugins\Meringue\Form\FormBuilder@store')->name('Form.store');
    Route::get('/Meringue/Form/{form}/edit', '\Plugins\Meringue\Form\FormBuilder@edit')->name('Form.edit');
    Route::get('/Meringue/Form/{form}/responses', '\Plugins\Meringue\Form\Response@index')->name('Form.responses');
    Route::get('/Meringue/Form/{form}/responses/{response}', '\Plugins\Meringue\Form\Response@show')->name('Form.response');
    Route::post('/Meringue/Form/{form}/inputs', '\Plugins\Meringue\Form\FormBuilder@createInput')->name('Form.input.create');
    Route::get('/Meringue/Form/{form}/inputs/{input}/delete', '\Plugins\Meringue\Form\FormBuilder@deleteInput')->name('Form.input.delete');
});