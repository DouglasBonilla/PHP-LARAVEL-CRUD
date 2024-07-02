<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstudiantesController;

Route::group(['prefix' => 'estudiantes', 'middleware' => 'auth_docentes'], function(){
    Route::get('/', [EstudiantesController::class, 'index'])->name('estudiantes.index');
    Route::get('/show/{id}', [EstudiantesController::class, 'show'])->name('estudiantes.show');
    Route::get('/create', [EstudiantesController::class, 'create'])->name('estudiantes.create');
    Route::post('/create', [EstudiantesController::class, 'store'])->name('estudiantes.store');
    Route::get('/edit/{id}', [EstudiantesController::class, 'edit'])->name('estudiantes.edit');
    Route::post('/edit/{id}', [EstudiantesController::class, 'update'])->name('estudiantes.update');
    Route::get('/delete/{id}', [EstudiantesController::class, 'delete'])->name('estudiantes.delete');
    Route::post('/delete/{id}', [EstudiantesController::class, 'destroy'])->name('estudiantes.destroy');
});