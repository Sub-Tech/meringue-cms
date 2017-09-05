<?php

Route::post('staff/refresh', '\Plugins\SubTech\Staff\Staff@refreshStaff');

Route::get('admin/plugin/manage/SubTech/Staff', '\Plugins\SubTech\Staff\Staff@manageStaff');
