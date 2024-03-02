<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\taskController;
use App\Models\Task;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function (Request $request) {
    $data['tasks'] = Task::where('user_id', auth()->user()->id)->paginate(5);
    $data['request'] = $request->all();
    return view('dashboard', $data);
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/task',taskController::class)->except(['edit', 'create']);

    Route::get('/task/export/{extension}', [taskController::class, 'exportTasks'])->name('task.export');
});

require __DIR__.'/auth.php';
