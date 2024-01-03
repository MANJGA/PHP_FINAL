<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['is_admin'])->group(function () {
    Route::get('/admin/quizzes', 'AdminController@listQuizzes')->name('admin.quizzes.list');
});

Route::resource('quizzes', QuizController::class);

Route::get('quizzes/{quiz}/questions/create', [QuestionController::class, 'create'])->name('questions.create');

Route::post('quizzes/{quiz}/questions', [QuestionController::class, 'store'])->name('questions.store');

Route::get('questions/{question}/edit', [QuestionController::class, 'edit'])->name('questions.edit');

Route::put('questions/{question}', [QuestionController::class, 'update'])->name('questions.update');

require __DIR__.'/auth.php';
