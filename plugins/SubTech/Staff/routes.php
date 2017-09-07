<?php

Route::get('staff/refresh', '\Plugins\SubTech\Staff\Staff@refreshStaff')->name('staff.refresh');

Route::get('admin/plugin/manage/SubTech/Staff', '\Plugins\SubTech\Staff\Staff@manageStaff')->name('staff.manage');
