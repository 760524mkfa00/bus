<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'users'], function () {

    Route::get('/', 'UserController@index')
        ->name('list_users')
        ->middleware('can:update,busRegistration\User');

    // TODO: Replace with the register URL
    Route::get('/edit/{user}', 'UserController@edit')
        ->name('edit_user')
        ->middleware('can:update,user');

    Route::post('/edit/{user}', 'UserController@update')
        ->name('update_user')
        ->middleware('can:update,user');

    Route::get('/remove/{user}', 'UserController@destroy')
        ->name('remove_user')
        ->middleware('can:update,user');

});

Route::group(['prefix' => 'users/roles'], function () {

    Route::get('/', 'RoleController@index')
        ->name('list_role')
        ->middleware('can:view,busRegistration\Role');

    Route::get('/create', 'RoleController@create')
        ->name('create_role')
        ->middleware('can:create,busRegistration\Role');

    Route::post('/store', 'RoleController@store')
        ->name('store_role')
        ->middleware('can:create,busRegistration\Role');

    Route::get('/create/{role}', 'RoleController@createPermission')
        ->name('create_permission')
        ->middleware('can:createPermission,busRegistration\Role');

    Route::post('/store/{role}', 'RoleController@storePermission')
        ->name('store_permission')
        ->middleware('can:createPermission,role');

    Route::get('/remove/{role}/{key}', 'RoleController@destroyPermission')
        ->name('remove_permission')
        ->middleware('can:removePermission,role');

});


Route::group(['prefix' => 'student'], function () {

    Route::get('/create', 'application\applicationController@registerStudent')
        ->name('student_create');

    Route::post('/store', 'application\applicationController@storeStudent')
        ->name('store_student');

});
