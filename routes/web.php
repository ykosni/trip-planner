<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PlanController;
use App\Http\Controllers\ActivityController;


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
    return view('index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// プラン関連のルート
Route::resource('plans', PlanController::class);

// アクティビティ関連のルート
Route::get('plans/{plan}/activities/create', [ActivityController::class, 'create'])->name('activities.create');
Route::post('plans/{plan}/activities', [ActivityController::class, 'store'])->name('activities.store');
Route::get('plans/{plan}/activities/edit', [ActivityController::class, 'edit'])->name('activities.edit');
Route::put('plans/{plan}/activities', [ActivityController::class, 'update'])->name('activities.update');
Route::delete('plans/{plan}/activities/{activity}', [ActivityController::class, 'destroy'])->name('activities.destroy');

//Route::get('plans/{plan}/activities/{activities}', [ActivityController::class, 'show'])->name('activities.show');
//Route::get('plans/{plan}/activities', [ActivityController::class, 'index'])->name('activities.index');

// Route::resource('activities', ActivityController::class);



require __DIR__.'/auth.php';
