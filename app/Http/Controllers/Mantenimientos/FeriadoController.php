<?php

namespace App\Http\Controllers\Mantenimientos;

use App\Http\Controllers\Controller;
use App\Models\Feriado;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class FeriadoController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Mantenimientos/Feriados/Index', [
            'records' => Feriado::query()->orderBy('fecha', 'desc')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'fecha' => ['required', 'date', 'unique:feriados,fecha'],
            'es_recuperable' => ['required', 'boolean'],
            'estado' => ['required', 'boolean'],
        ]);

        Feriado::create($data);

        return back()->with('success', 'Feriado registrado.');
    }

    public function update(Request $request, Feriado $feriado)
    {
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'fecha' => ['required', 'date', Rule::unique('feriados', 'fecha')->ignore($feriado->id)],
            'es_recuperable' => ['required', 'boolean'],
            'estado' => ['required', 'boolean'],
        ]);

        $feriado->update($data);

        return back()->with('success', 'Feriado actualizado.');
    }

    public function destroy(Feriado $feriado)
    {
        $feriado->delete();

        return back()->with('success', 'Feriado eliminado.');
    }
}
