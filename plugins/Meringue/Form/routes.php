<?php

Route::post('/form/submit', '\Plugins\Meringue\Form\Form@handleResponse');

Route::get('/admin/Meringue/Form/forms', '\Plugins\Meringue\Form\Form@index')->name('Form.index');
Route::get('/admin/Meringue/Form/new', '\Plugins\Meringue\Form\FormBuilder@create')->name('Form.create');
Route::post('admin/Meringue/Form/create', '\Plugins\Meringue\Form\FormBuilder@store')->name('Form.store');
Route::get('/admin/Meringue/Form/{form}/edit', '\Plugins\Meringue\Form\FormBuilder@edit')->name('Form.edit');
Route::post('/admin/Meringue/Form/{form}/inputs', '\Plugins\Meringue\Form\FormBuilder@createInput')->name('Form.input.create');
Route::get('/admin/Meringue/Form/{form}/inputs/{input}/delete', '\Plugins\Meringue\Form\FormBuilder@deleteInput')->name('Form.input.delete');
