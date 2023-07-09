<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\TodoController;


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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth', 'verified'])->group(function(){
    Route::get('/todos', [TodoController::class,'index'])->name('todos');
    Route::post('/todos', [TodoController::class,'store'])->name('todos.store');
    Route::put('/todos/{todo}/update', [TodoController::class,'update'])->name('todos.update');
    Route::delete('/todos/{todo}', [TodoController::class,'destroy'])->name('todos.destroy');
});

require __DIR__.'/auth.php';