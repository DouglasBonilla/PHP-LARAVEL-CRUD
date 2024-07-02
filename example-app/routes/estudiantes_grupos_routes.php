<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstudiantesGrupoController;


Route::group(['prefix' => 'docentes_grupos','middleware' => 'auth_docentes'], function () {
    Route::get('/', [EstudiantesGrupoController::class, 'index'])->name('estudiantes_grupos.index');
    Route::get('/show/{id}', [EstudiantesGrupoController::class, 'show'])->name('estudiantes_grupos.show');
    Route::get('/create', [EstudiantesGrupoController::class, 'create'])->name('estudiantes_grupos.create');
    Route::post('/create', [EstudiantesGrupoController::class, 'store'])->name('estudiantes_grupos.store');
    Route::get('/edit/{id}', [EstudiantesGrupoController::class, 'edit'])->name('estudiantes_grupos.edit');
    Route::post('/edi/{id}', [EstudiantesGrupoController::class, 'update'])->name('estudiantes_grupos.update');
    Route::get('/delete/{id}', [EstudiantesGrupoController::class, 'delete'])->name('estudiantes_grupos.delete');
    Route::post('/delete/{id}', [EstudiantesGrupoController::class, 'destroy'])->name('estudiantes_grupos.destroy');
});