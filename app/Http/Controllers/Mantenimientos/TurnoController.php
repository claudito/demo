<?php

namespace App\Http\Controllers\Mantenimientos;

use App\Http\Controllers\Controller;
use App\Models\Turno;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class TurnoController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Mantenimientos/Turnos/Index', [
            'records' => Turno::query()->latest()->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'hora_inicio' => ['required', 'date_format:H:i'],
            'hora_fin' => ['required', 'date_format:H:i'],
            'estado' => ['required', 'boolean'],
        ]);

        Turno::create($data);

        return back()->with('success', 'Turno registrado.');
    }

    public function update(Request $request, Turno $turno)
    {
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'hora_inicio' => ['required', 'date_format:H:i'],
            'hora_fin' => ['required', 'date_format:H:i'],
            'estado' => ['required', 'boolean'],
        ]);

        $turno->update($data);

        return back()->with('success', 'Turno actualizado.');
    }

    public function destroy(Turno $turno)
    {
        $turno->delete();

        return back()->with('success', 'Turno eliminado.');
    }
}
