<?php

namespace App\Http\Controllers\Mantenimientos;

use App\Http\Controllers\Controller;
use App\Models\Empleado;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
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

        $data['codigo'] = $data['numero_documento'];

        Empleado::create($data);

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

        $data['codigo'] = $data['numero_documento'];

        $empleado->update($data);

        return back()->with('success', 'Empleado actualizado.');
    }

    public function destroy(Empleado $empleado)
    {
        $empleado->delete();

        return back()->with('success', 'Empleado eliminado.');
    }

    public function consultarReniec(Request $request): JsonResponse
    {
        $data = $request->validate([
            'numero_documento' => ['required', 'string', 'size:8'],
        ]);

        $response = Http::timeout(20)->get(
            'https://ww1.sunat.gob.pe/ol-ti-itfisdenreg/itfisdenreg.htm',
            [
                'accion' => 'obtenerDatosDni',
                'numDocumento' => $data['numero_documento'],
            ],
        );

        if (! $response->ok()) {
            return response()->json([
                'error' => 'No se pudo consultar RENIEC en este momento.',
            ], 502);
        }

        $payload = $response->json();

        if (isset($payload['error'])) {
            return response()->json([
                'error' => $payload['error'],
            ], 404);
        }

        $fullName = data_get($payload, 'lista.0.nombresapellidos');

        if (! is_string($fullName) || $fullName === '') {
            return response()->json([
                'error' => 'No se recibieron datos validos de RENIEC.',
            ], 422);
        }

        [$apellidos, $nombres] = array_map(
            static fn ($value) => trim((string) $value),
            array_pad(explode(',', $fullName, 2), 2, ''),
        );

        return response()->json([
            'message' => 'success',
            'numero_documento' => $data['numero_documento'],
            'nombres' => $nombres,
            'apellidos' => $apellidos,
            'nombresapellidos' => $fullName,
        ]);
    }
}