<?php

use App\Http\Controllers\ExamenesController;
use App\Http\Controllers\ExamenesPreguntasController;
use App\Http\Controllers\PreguntasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RespuestasController;
use App\Http\Controllers\UserController;
use App\Models\Preguntas;
use App\Models\Respuestas;
use Illuminate\Support\Facades\Route;

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

    Route::resource('/examenes', ExamenesController::class);
    Route::post('examenes/random', [ExamenesPreguntasController::class, 'random'])->name('examenes.random');
    Route::get('examenes/data/{id}', [ExamenesController::class, 'getDataOfExam']);
    

    Route::resource('/preguntas', PreguntasController::class);
    Route::get('/preguntas/{pregunta}/respuestas', [PreguntasController::class, 'respuestas'])->name('preguntas.respuestas');

    Route::get('/respuesta/pregunta/{id}', [RespuestasController::class, 'createById']);
    Route::resource('/respuestas', RespuestasController::class);

    Route::resource('/examenespreguntas', ExamenesPreguntasController::class);

   
    Route::get('/user/data',[UserController::class, 'getUsers'])->name('user.data');
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');

    



});

require __DIR__.'/auth.php';
