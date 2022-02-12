<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

//login to admin
Route::group(['middleware'=>['auth','admin']], function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });

});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//company routes
Route::get('/company', [App\Http\Controllers\CompanyController::class, 'index'])->name('company');

Route::post('/company', [App\Http\Controllers\CompanyController::class, 'store']);

Route::delete('/company/{id}', [App\Http\Controllers\CompanyController::class, 'destroy'])->name('company.delete');

Route::get('/editCompany/{id}', [App\Http\Controllers\CompanyController::class, 'show']);

Route::get('/addCompany', [App\Http\Controllers\CompanyController::class, 'create']);

Route::put('/company/{id}',[App\Http\Controllers\CompanyController::class,'update'])->name('company.put');

//employee routes
Route::get('/employee', [App\Http\Controllers\EmployeeController::class, 'index'])->name('employee');

Route::post('/employee', [App\Http\Controllers\EmployeeController::class, 'store']);

Route::get('/addEmployee', [App\Http\Controllers\EmployeeController::class, 'create']);

Route::get('/editEmployee/{id}',[App\Http\Controllers\EmployeeController::class, 'show']);

Route::delete('/employee/{id}', [App\Http\Controllers\EmployeeController::class, 'destroy'])->name('employee.delete');

Route::put('/employee/{id}',[App\Http\Controllers\EmployeeController::class,'update'])->name('employee.put');
