<?php

use App\Http\Controllers\Mantenimientos\EmpleadoController;
use App\Http\Controllers\Mantenimientos\FeriadoController;
use App\Http\Controllers\Mantenimientos\HorarioController;
use App\Http\Controllers\Mantenimientos\PeriodoController;
use App\Http\Controllers\Mantenimientos\TipoBoletaController;
use App\Http\Controllers\Mantenimientos\TurnoController;
use App\Http\Controllers\Mantenimientos\UbigeoController;
use App\Http\Controllers\Security\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('users', [UserController::class, 'index'])->name('users.index');

    Route::prefix('mantenimientos')->name('mantenimientos.')->group(function () {
        Route::get('/', fn () => redirect()->route('mantenimientos.empleados.index'));

        Route::get('empleados/consultar-reniec', [EmpleadoController::class, 'consultarReniec'])->name('empleados.consultar-reniec');
        Route::get('empleados', [EmpleadoController::class, 'index'])->name('empleados.index');
        Route::post('empleados', [EmpleadoController::class, 'store'])->name('empleados.store');
        Route::put('empleados/{empleado}', [EmpleadoController::class, 'update'])->name('empleados.update');
        Route::delete('empleados/{empleado}', [EmpleadoController::class, 'destroy'])->name('empleados.destroy');

        Route::get('feriados', [FeriadoController::class, 'index'])->name('feriados.index');
        Route::post('feriados', [FeriadoController::class, 'store'])->name('feriados.store');
        Route::put('feriados/{feriado}', [FeriadoController::class, 'update'])->name('feriados.update');
        Route::delete('feriados/{feriado}', [FeriadoController::class, 'destroy'])->name('feriados.destroy');

        Route::get('horarios', [HorarioController::class, 'index'])->name('horarios.index');
        Route::post('horarios', [HorarioController::class, 'store'])->name('horarios.store');
        Route::put('horarios/{horario}', [HorarioController::class, 'update'])->name('horarios.update');
        Route::delete('horarios/{horario}', [HorarioController::class, 'destroy'])->name('horarios.destroy');

        Route::get('turnos', [TurnoController::class, 'index'])->name('turnos.index');
        Route::post('turnos', [TurnoController::class, 'store'])->name('turnos.store');
        Route::put('turnos/{turno}', [TurnoController::class, 'update'])->name('turnos.update');
        Route::delete('turnos/{turno}', [TurnoController::class, 'destroy'])->name('turnos.destroy');

        Route::get('periodos', [PeriodoController::class, 'index'])->name('periodos.index');
        Route::post('periodos', [PeriodoController::class, 'store'])->name('periodos.store');
        Route::put('periodos/{periodo}', [PeriodoController::class, 'update'])->name('periodos.update');
        Route::delete('periodos/{periodo}', [PeriodoController::class, 'destroy'])->name('periodos.destroy');

        Route::get('tipos-boletas', [TipoBoletaController::class, 'index'])->name('tipos-boletas.index');
        Route::post('tipos-boletas', [TipoBoletaController::class, 'store'])->name('tipos-boletas.store');
        Route::put('tipos-boletas/{tipoBoleta}', [TipoBoletaController::class, 'update'])->name('tipos-boletas.update');
        Route::delete('tipos-boletas/{tipoBoleta}', [TipoBoletaController::class, 'destroy'])->name('tipos-boletas.destroy');
        Route::get('ubigeos', [UbigeoController::class, 'index'])->name('ubigeos.index');
        Route::post('ubigeos', [UbigeoController::class, 'store'])->name('ubigeos.store');
        Route::put('ubigeos/{ubigeo}', [UbigeoController::class, 'update'])->name('ubigeos.update');
        Route::delete('ubigeos/{ubigeo}', [UbigeoController::class, 'destroy'])->name('ubigeos.destroy');
    });
});
