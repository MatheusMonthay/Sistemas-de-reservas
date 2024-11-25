<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OcorrenciaController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\UserController;
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

    Route::resource('reservas', ReservaController::class);

    Route::get('/profile', [UserController::class, 'editProfile'])->name('user.editProfile');
    Route::put('/profile', [UserController::class, 'updateProfile'])->name('user.updateProfile');

    Route::get('/ocorrencias', [OcorrenciaController::class, 'index'])->name('ocorrencias.index');

    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

        
        Route::get('/admin/professores', [AdminController::class, 'indexProfessores'])->name('admin.professores');
        Route::post('/admin/professores', [AdminController::class, 'createProfessor'])->name('admin.professores.create');
        Route::get('/professores/{id}/edit', [AdminController::class, 'editProfessor'])->name('admin.professores.edit');
        Route::put('/professores/{id}/update', [AdminController::class, 'updateProfessor'])->name('admin.professores.update');
        Route::delete('/professores/{id}/delete', [AdminController::class, 'deleteProfessor'])->name('admin.professores.destroy');    
        
        Route::get('/admin/ambientes', [AdminController::class, 'indexAmbientes'])->name('admin.ambientes');
        Route::post('/admin/ambientes', [AdminController::class, 'createAmbiente'])->name('admin.ambientes.create');
        Route::get('/ambientes/{id}/edit', [AdminController::class, 'editAmbiente'])->name('admin.ambientes.edit');
        Route::put('/ambientes/{id}/update', [AdminController::class, 'updateAmbiente'])->name('admin.ambientes.update');
        Route::delete('/ambientes/{id}/delete', [AdminController::class, 'deleteAmbiente'])->name('admin.ambientes.destroy');


        Route::get('/admin/equipamentos', [AdminController::class, 'indexEquipamentos'])->name('admin.equipamentos');
        Route::post('/admin/equipamentos', [AdminController::class, 'createEquipamento'])->name('admin.equipamentos.create');
        Route::get('/equipamentos/{id}/edit', [AdminController::class, 'editEquipamento'])->name('admin.equipamentos.edit');
        Route::put('/equipamentos/{id}/update', [AdminController::class, 'updateEquipamento'])->name('admin.equipamentos.update');
        Route::delete('/equipamentos/{id}/delete', [AdminController::class, 'deleteEquipamento'])->name('admin.equipamentos.destroy');
        
    });
});