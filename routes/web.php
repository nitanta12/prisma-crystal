<?php

Route::get('/nopermission','NoPermissionController@index');

Route::redirect('/','login');

Route::redirect('/home', '/admin');

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {

	Route::get('/', 'HomeController@dashboard')->name('home');
	Route::resource('campaigns', 'CampaignController');

	Route::group(['middleware' => ['checkrole:Admin']], function () {

	    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
	    Route::resource('permissions', 'PermissionsController');
	    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
	    Route::resource('roles', 'RolesController');
	    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
	    Route::resource('users', 'UsersController');
		Route::resource('clients', 'ClientsController');
		

	});

	Route::group(['middleware' => ['checkrole:CS']], function () {
		Route::resource('vendors', 'VendorsController');
		Route::get('job_estimate/{id}','JobEstimateController@index')->name('job_estimate.index');
		Route::post('job_estimate/create','JobEstimateController@create')->name('job_estimate.create');
		Route::get('job_estimate/delete/{id}','JobEstimateController@delete')->name('job_estimate.delete');
		Route::get('job_estimate/jobs/{template}/{id}','JobEstimateController@jobs')->name('job_estimate.jobs');
		Route::post('job_estimate/jobs/create_jobs','JobEstimateController@create_jobs')->name('job_estimate.jobs.create_jobs');
		Route::post('job_estimate/jobs/delete/{id}/{table_name}','JobEstimateController@delete_jobs_ajax')->name('job_estimate.jobs.delete');

		Route::post('job_estimate/jobs/update/{id}/{table_name}','JobEstimateController@update_jobs_ajax')->name('job_estimate.jobs.update');
		Route::get('job_estimate/print/{id}/{table_name}','JobEstimateController@jobs_print')->name('job_estimate.print');
		Route::post('job_estimate/jobs/update_date','JobEstimateController@update_date')->name('job_estimate.jobs.update_date');
		Route::post('job_estimate/jobs/update_discount','JobEstimateController@update_discount')->name('job_estimate.jobs.update_discount');
		Route::post('job_estimate/jobs/delete_date_ajax/{id}','JobEstimateController@delete_date_ajax')->name('job_estimate.jobs.delete_date');
		Route::post('job_estimate/jobs/delete_discount_ajax/{id}','JobEstimateController@delete_discount_ajax')->name('job_estimate.jobs.delete_discount');
		Route::post('job_estimate/jobs/delete_charge_ajax/{id}','JobEstimateController@delete_charge_ajax')->name('job_estimate.jobs.delete_charge');
		Route::post('job_estimate/process_charges','JobEstimateController@process_charges')->name('job_estimate.process_charges');
		Route::post('job_estimate/update_discount_charge_order/{table}','JobEstimateController@update_discount_charge_order')->name('job_estimate.update_discount_charge_order');
		Route::get('creativeBriefs/{id}', 'CreativeBriefController@index')->name('creativeBriefs.index');
		Route::get('creativeBriefs/create/{id}', 'CreativeBriefController@create')->name('creativeBriefs.create');
		Route::post('creativeBriefs/store', 'CreativeBriefController@store')->name('creativeBriefs.store');
		Route::get('creativeBriefs/edit/{id}', 'CreativeBriefController@edit')->name('creativeBriefs.edit');
		Route::patch('creativeBriefs/update/{id}', 'CreativeBriefController@update')->name('creativeBriefs.update');
		Route::get('creativeBriefs/show/{id}', 'CreativeBriefController@show')->name('creativeBriefs.show');
		Route::delete('creativeBriefs/destroy/{id}', 'CreativeBriefController@destroy')->name('creativeBriefs.destroy');
        // Route::resource('creativeBriefs', 'CreativeBriefController');
        Route::get('creativeAds/{id}', 'CreativeAdsController@index')->name('creativeAds.index');
        Route::post('creativeAds/store', 'CreativeAdsController@store')->name('creativeAds.store');
        Route::delete('creativeAds/destroy/{id}', 'CreativeAdsController@destroy')->name('creativeAds.destroy');

		Route::get('request_bill/{id}','RequestBillController@index')->name('request_bill.index');
        Route::get('verify/{id}','RequestBillController@verify')->name('verify');

        Route::post('job_estimate/add_bill','JobEstimateController@add_bill')->name('job_estimate.add_bill');
        Route::post('job_estimate/update_bill/{id}','JobEstimateController@update_bill')->name('job_estimate.update_bill');

        Route::resource('programs', 'ProgramController');
		Route::post('programs/update_rate/{id}','ProgramController@update_rate');

		Route::get('get_program_by_vendor_ajax/{id}','ProgramController@get_program_by_vendor_ajax');

		Route::get('get_position_by_program_ajax/{id}','ProgramController@get_position_by_program_ajax');

		Route::get('get_rate_by_position_ajax/{id}','ProgramController@get_rate_by_position_ajax');

		Route::post('jobs/update_tv_radio/{type}','JobEstimateController@update_tv_radio');
    });

	Route::group(['middleware' => ['checkrole:Traffic']], function () {
		Route::get('vendor_bill/add','VendorBillController@create')->name('vendor_bill.add');
        Route::post('vendor_bill/store','VendorBillController@store')->name('vendor_bill.store');
        Route::get('vendor_bill/show/{id}','VendorBillController@show')->name('vendor_bill.show');
        Route::get('vendor_bill/edit/{id}','VendorBillController@edit')->name('vendor_bill.edit');
        Route::patch('vendor_bill/update/{id}','VendorBillController@update')->name('vendor_bill.update');
        Route::delete('vendor_bill/destroy/{id}','VendorBillController@destroy')->name('vendor_bill.destroy');
	});

	Route::group(['middleware' => ['checkrole:CS']], function () {

		Route::get('vendor_bill_report','VendorBillController@vendor_bills')->name('vendor_bill_report');
		Route::get('client_bill_report','RequestBillController@client_bill_report')->name('client_bill_report');

	});

	
});
