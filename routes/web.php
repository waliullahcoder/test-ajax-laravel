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

// Route::get('/', function () {
//     return view('welcome');
// });


// Controller-name@method-name
Route::get('/', 'EmployeesController@index'); // localhost:8000/
Route::get('/getUsers/{id}','EmployeesController@getUsers');

Route::get('/getUserParent/{pid}','EmployeesController@getUsersPid');

Route::get('/', 'DepartmentsController@index');
Route::get('/getEmployees/{id}', 'DepartmentsController@getEmployees');