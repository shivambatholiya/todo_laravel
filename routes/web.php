<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('todo');
// });

Route::get('/', [TodoController::class, 'showTasks']);
Route::post('/add_task', [TodoController::class, 'add_task']);
Route::post('/update_task_status/{id}', [TodoController::class, 'update_task_status']);
Route::post('/delete_task/{id}', [TodoController::class, 'delete_task']);

