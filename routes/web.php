<?php

Route::get('/', 'HomeControler@index');
Route::get('/dashboard', 'Admin\DashboardControler@index');
Route::get('/account', 'Admin\AdminController@index');
Route::get('/account/callback', 'Admin\AdminController@callback');
Route::post('/account/callback/addaccounts', 'Admin\AdminController@addAccounts');

Route::post('/account/pull', 'Admin\AdminController@pullData');

Route::post('/dashboard/temp', 'Admin\DashboardControler@loadTemp');
Route::post('/dashboard/saved', 'Admin\DashboardControler@loadSaved');

Route::post('/dashboard/save', 'Admin\DashboardControler@saveToPost');
Route::post('/dashboard/delete', 'Admin\DashboardControler@deletePost');

Route::get('/changePassword','User\UserController@changePasswordForm');
Route::post('/changePassword','User\UserController@changePassword')->name('changePassword');

Route::post('admin/save-settings' , 'Admin\AdminController@updateSettings')->name('admin/save-settings');
Route::post('admin/get-posts' , 'Admin\AdminController@getPosts')->name('admin/save-settings');
Route::get('admin/get-posts' , 'Admin\AdminController@getPosts')->name('admin/save-settings');

Auth::routes();
