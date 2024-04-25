<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

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

	Route::get(conf('backend_url'), [LoginController::class, 'showLoginForm'])->name('login');
	Route::post(conf('backend_url'), [LoginController::class, 'login'])->name('loginPost');
	Route::post(conf('backend_url').'/logut', [LoginController::class, 'logout'])->name('logout');

	// Admin Routes

	Route::group(['prefix' => conf("backend_url"), 'namespace' => 'App\Http\Controllers\Admin', 'middleware' => ['web', 'auth']], function () {

        // Dashboard
        Route::get('dashboard', [
            'as' => 'admin.dashboard',
            'uses' => 'DashboardController@index',
            // 'middleware' => ['checkPrivilege:dev;dashboard'],
        ]);

        // Roles
        Route::get('role', [
            'as' => 'role.index',
            'uses' => 'RoleController@index',
            // 'middleware' => ['checkPrivilege:role'],
        ]);
        Route::get('role/list', [
            'as' => 'role.list',
            'uses' => 'RoleController@result',
            // 'middleware' => ['checkPrivilege:role'],
        ]);

        Route::get('role/create-update/{id?}', [
            'as' => 'role.create.update',
            'uses' => 'RoleController@createUpdate',
            'middleware' => ['checkPrivilege:role'],
        ]);
        Route::post('role/create-update', [
            'as' => 'role.create.update.post',
            'uses' => 'RoleController@createUpdatePost',
            'middleware' => ['checkPrivilege:role'],
        ]);
        Route::get('role/action/{id}/{status}', [
            'as' => 'role.action',
            'uses' => 'RoleController@action',
            'middleware' => ['checkPrivilege:role'],
        ]);

    });

