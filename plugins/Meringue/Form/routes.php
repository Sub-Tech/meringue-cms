<?php

Route::post('/form/submit', '\Plugins\Meringue\Form\Form@handleResponse');

Route::get('/admin/Meringue/Form/{form}/build', '\Plugins\Meringue\Form\FormBuilder@index');
Route::post('/admin/Meringue/Form/{form}/inputs', '\Plugins\Meringue\Form\FormBuilder@createInput');

Route::get('/admin/Meringue/Form/forms', '\Plugins\Meringue\Form\Form@index');
