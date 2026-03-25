<?php

namespace App\Http\Controllers\Mantenimientos;

use App\Http\Controllers\Controller;
use App\Models\Empleado;
use App\Services\Mantenimientos\EmpleadoService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class EmpleadoController extends Controller
{
    public function __construct(private readonly EmpleadoService $empleadoService)
    {
    }

    public function index(): Response
    {
        return Inertia::render('Mantenimientos/Empleados/Index', [
            'records' => $this->empleadoService->list(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'numero_documento' => [
                'required',
                'string',
                'max:30',
                'unique:empleados,numero_documento',
                'unique:empleados,codigo',
            ],
            'nombres' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            'cargo' => ['nullable', 'string', 'max:255'],
            'condicion_laboral' => ['nullable', 'string', 'max:255'],
            'estado' => ['required', 'boolean'],
        ]);

        $this->empleadoService->create($data);

        return back()->with('success', 'Empleado registrado.');
    }

    public function update(Request $request, Empleado $empleado)
    {
        $data = $request->validate([
            'numero_documento' => [
                'required',
                'string',
                'max:30',
                Rule::unique('empleados', 'numero_documento')->ignore($empleado->id),
                Rule::unique('empleados', 'codigo')->ignore($empleado->id),
            ],
            'nombres' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            'cargo' => ['nullable', 'string', 'max:255'],
            'condicion_laboral' => ['nullable', 'string', 'max:255'],
            'estado' => ['required', 'boolean'],
        ]);

        $this->empleadoService->update($empleado, $data);

        return back()->with('success', 'Empleado actualizado.');
    }

    public function destroy(Empleado $empleado)
    {
        $this->empleadoService->delete($empleado);

        return back()->with('success', 'Empleado eliminado.');
    }

    public function consultarReniec(Request $request): JsonResponse
    {
        $data = $request->validate([
            'numero_documento' => ['required', 'string', 'size:8'],
        ]);

        $result = $this->empleadoService->consultarReniec($data['numero_documento']);

        return response()->json($result['data'], $result['status']);
    }
}