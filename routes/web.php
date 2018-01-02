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

    Route::get('/update/{user}', 'admin\ParentController@update')
        ->name('update_parent')
        ->middleware('can:create,user');

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

    Route::get('/list', 'admin\StudentsController@index')
        ->name('list_student')
        ->middleware('can:view,busRegistration\Child');

    Route::get('/edit/{user}/{child}', 'admin\StudentsController@edit')
        ->name('edit_student')
        ->middleware('can:create,busRegistration\Child');

    Route::post('/update/{user}/{child}', 'admin\StudentsController@update')
        ->name('update_student')
        ->middleware('can:create,busRegistration\Child');

    Route::get('/api/list', 'admin\StudentsController@childList')
        ->name('list_of_students');

});


Route::group(['prefix' => 'schools'], function () {
    
    Route::get('/', 'SchoolController@index')
        ->name('list_school')
        ->middleware('can:view,busRegistration\School');

    Route::get('/create', 'SchoolController@create')
        ->name('create_school')
        ->middleware('can:create,busRegistration\School');

    Route::post('/store', 'SchoolController@store')
        ->name('store_school')
        ->middleware('can:create,busRegistration\School');

    Route::get('/remove/{school}', 'SchoolController@destroy')
        ->name('remove_school')
        ->middleware('can:remove,busRegistration\School');

});

Route::group(['prefix' => 'grades'], function () {

    Route::get('/', 'GradeController@index')
        ->name('list_grade')
        ->middleware('can:view,busRegistration\Grade');

    Route::get('/create', 'GradeController@create')
        ->name('create_grade')
        ->middleware('can:create,busRegistration\Grade');

    Route::post('/store', 'GradeController@store')
        ->name('store_grade')
        ->middleware('can:create,busRegistration\Grade');

    Route::get('/remove/{grade}', 'GradeController@destroy')
        ->name('remove_grade')
        ->middleware('can:remove,busRegistration\Grade');

});

Route::group(['prefix' => 'tags'], function () {

    Route::get('/', 'TagController@index')
        ->name('list_tag')
        ->middleware('can:view,busRegistration\Tag');

    Route::get('/create', 'TagController@create')
        ->name('create_tag')
        ->middleware('can:create,busRegistration\Tag');

    Route::post('/store', 'TagController@store')
        ->name('store_tag')
        ->middleware('can:create,busRegistration\Tag');

    Route::get('/remove/{tag}', 'TagController@destroy')
        ->name('remove_tag')
        ->middleware('can:remove,busRegistration\Tag');

});

Route::group(['prefix' => 'payments'], function () {

    Route::get('/{order}', 'Admin\PaymentController@index')
        ->name('begin_payment');

    Route::post('/{order}', 'Admin\PaymentController@submitPayment')
        ->name('submit_payment');

});

