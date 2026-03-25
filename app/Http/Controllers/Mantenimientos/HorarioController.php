<?php

namespace App\Http\Controllers\Mantenimientos;

use App\Http\Controllers\Controller;
use App\Models\Horario;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class HorarioController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Mantenimientos/Horarios/Index', [
            'records' => Horario::query()->latest()->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'hora_entrada' => ['required', 'date_format:H:i'],
            'hora_salida' => ['required', 'date_format:H:i'],
            'tolerancia_minutos' => ['required', 'integer', 'min:0', 'max:240'],
            'estado' => ['required', 'boolean'],
        ]);

        Horario::create($data);

        return back()->with('success', 'Horario registrado.');
    }

    public function update(Request $request, Horario $horario)
    {
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'hora_entrada' => ['required', 'date_format:H:i'],
            'hora_salida' => ['required', 'date_format:H:i'],
            'tolerancia_minutos' => ['required', 'integer', 'min:0', 'max:240'],
            'estado' => ['required', 'boolean'],
        ]);

        $horario->update($data);

        return back()->with('success', 'Horario actualizado.');
    }

    public function destroy(Horario $horario)
    {
        $horario->delete();

        return back()->with('success', 'Horario eliminado.');
    }
}
