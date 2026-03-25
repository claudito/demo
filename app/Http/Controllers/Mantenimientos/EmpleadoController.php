<?php

namespace App\Http\Controllers\Mantenimientos;

use App\Http\Controllers\Controller;
use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class EmpleadoController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Mantenimientos/Empleados/Index', [
            'records' => Empleado::query()->latest()->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'codigo' => ['required', 'string', 'max:30', 'unique:empleados,codigo'],
            'nombres' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            'cargo' => ['nullable', 'string', 'max:255'],
            'condicion_laboral' => ['nullable', 'string', 'max:255'],
            'estado' => ['required', 'boolean'],
        ]);

        Empleado::create($data);

        return back()->with('success', 'Empleado registrado.');
    }

    public function update(Request $request, Empleado $empleado)
    {
        $data = $request->validate([
            'codigo' => [
                'required',
                'string',
                'max:30',
                Rule::unique('empleados', 'codigo')->ignore($empleado->id),
            ],
            'nombres' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            'cargo' => ['nullable', 'string', 'max:255'],
            'condicion_laboral' => ['nullable', 'string', 'max:255'],
            'estado' => ['required', 'boolean'],
        ]);

        $empleado->update($data);

        return back()->with('success', 'Empleado actualizado.');
    }

    public function destroy(Empleado $empleado)
    {
        $empleado->delete();

        return back()->with('success', 'Empleado eliminado.');
    }
}
