<?php

namespace App\Http\Controllers\Mantenimientos;

use App\Http\Controllers\Controller;
use App\Models\Periodo;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PeriodoController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Mantenimientos/Periodos/Index', [
            'records' => Periodo::query()->orderBy('fecha_inicio', 'desc')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'fecha_inicio' => ['required', 'date'],
            'fecha_fin' => ['required', 'date', 'after_or_equal:fecha_inicio'],
            'cerrado' => ['required', 'boolean'],
            'estado' => ['required', 'boolean'],
        ]);

        Periodo::create($data);

        return back()->with('success', 'Periodo registrado.');
    }

    public function update(Request $request, Periodo $periodo)
    {
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'fecha_inicio' => ['required', 'date'],
            'fecha_fin' => ['required', 'date', 'after_or_equal:fecha_inicio'],
            'cerrado' => ['required', 'boolean'],
            'estado' => ['required', 'boolean'],
        ]);

        $periodo->update($data);

        return back()->with('success', 'Periodo actualizado.');
    }

    public function destroy(Periodo $periodo)
    {
        $periodo->delete();

        return back()->with('success', 'Periodo eliminado.');
    }
}
