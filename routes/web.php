<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OcorrenciaController;
use App\Http\Controllers\ReservaController;
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

Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/reservas', [ReservaController::class, 'index'])->name('reservas.index');
    Route::get('/ocorrencias', [OcorrenciaController::class, 'index'])->name('ocorrencias.index');

    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

        
        Route::get('/admin/professores', [AdminController::class, 'indexProfessores'])->name('admin.professores');
        Route::post('/admin/professores', [AdminController::class, 'createProfessor'])->name('admin.professores.create');
        Route::get('/professores/{id}/edit', [AdminController::class, 'editProfessor'])->name('admin.professores.edit');
        Route::post('/professores/{id}/update', [AdminController::class, 'updateProfessor'])->name('admin.professores.update');
        Route::delete('/professores/{id}/delete', [AdminController::class, 'deleteProfessor'])->name('admin.professores.delete');    
        
        Route::get('/admin/ambientes', [AdminController::class, 'indexAmbientes'])->name('admin.ambientes');
        Route::post('/admin/ambientes', [AdminController::class, 'createAmbiente'])->name('admin.ambientes.create');
        Route::get('/ambientes/{id}/edit', [AdminController::class, 'editAmbiente'])->name('admin.ambientes.edit');
        Route::post('/ambientes/{id}/update', [AdminController::class, 'updateAmbiente'])->name('admin.ambientes.update');
        Route::delete('/ambientes/{id}/delete', [AdminController::class, 'deleteAmbiente'])->name('admin.ambientes.delete');


        Route::get('/admin/equipamentos', [AdminController::class, 'indexEquipamentos'])->name('admin.equipamentos');
        Route::post('/admin/equipamentos', [AdminController::class, 'createEquipamento'])->name('admin.equipamentos.create');
        Route::get('/equipamentos/{id}/edit', [AdminController::class, 'editEquipamento'])->name('admin.equipamentos.edit');
        Route::post('/equipamentos/{id}/update', [AdminController::class, 'updateEquipamento'])->name('admin.equipamentos.update');
        Route::delete('/equipamentos/{id}/delete', [AdminController::class, 'deleteEquipamento'])->name('admin.equipamentos.delete');
        
    });
});