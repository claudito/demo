<?php

namespace App\Http\Controllers\Mantenimientos;

use App\Http\Controllers\Controller;
use App\Models\TipoBoleta;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class TipoBoletaController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Mantenimientos/TiposBoletas/Index', [
            'records' => TipoBoleta::query()->latest()->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'descripcion' => ['nullable', 'string'],
            'estado' => ['required', 'boolean'],
        ]);

        TipoBoleta::create($data);

        return back()->with('success', 'Tipo de boleta registrado.');
    }

    public function update(Request $request, TipoBoleta $tipoBoleta)
    {
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'descripcion' => ['nullable', 'string'],
            'estado' => ['required', 'boolean'],
        ]);

        $tipoBoleta->update($data);

        return back()->with('success', 'Tipo de boleta actualizado.');
    }

    public function destroy(TipoBoleta $tipoBoleta)
    {
        $tipoBoleta->delete();

        return back()->with('success', 'Tipo de boleta eliminado.');
    }
}
