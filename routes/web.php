<?php

use Illuminate\Support\Facades\Route;
use App\User;
use App\Models\Role;
use App\Models\Permission;

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

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');

Route::resource('/role', 'RoleController')->names('role');
Route::resource('/user', 'UserController', [
    'except' => ['create', 'store']
])->names('user');

Route::get('/test', function() {
    $user = User::find(4);
    $user->roles()->sync([13]);
    
    return $user->roles;
});