<?php

namespace App\Services\Mantenimientos;

use App\Models\Empleado;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Http;

class EmpleadoService
{
    public function list(): Collection
    {
        return Empleado::query()->latest()->get();
    }

    public function create(array $data): Empleado
    {
        return Empleado::create($this->normalizeData($data));
    }

    public function update(Empleado $empleado, array $data): Empleado
    {
        $empleado->update($this->normalizeData($data));

        return $empleado;
    }

    public function delete(Empleado $empleado): void
    {
        $empleado->delete();
    }

    public function consultarReniec(string $numeroDocumento): array
    {
        $response = Http::timeout(20)->get(
            'https://ww1.sunat.gob.pe/ol-ti-itfisdenreg/itfisdenreg.htm',
            [
                'accion' => 'obtenerDatosDni',
                'numDocumento' => $numeroDocumento,
            ],
        );

        if (! $response->ok()) {
            return [
                'status' => 502,
                'data' => [
                    'error' => 'No se pudo consultar RENIEC en este momento.',
                ],
            ];
        }

        $payload = $response->json();

        if (isset($payload['error'])) {
            return [
                'status' => 404,
                'data' => [
                    'error' => $payload['error'],
                ],
            ];
        }

        $fullName = data_get($payload, 'lista.0.nombresapellidos');

        if (! is_string($fullName) || $fullName === '') {
            return [
                'status' => 422,
                'data' => [
                    'error' => 'No se recibieron datos validos de RENIEC.',
                ],
            ];
        }

        [$apellidos, $nombres] = array_map(
            static fn ($value) => trim((string) $value),
            array_pad(explode(',', $fullName, 2), 2, ''),
        );

        return [
            'status' => 200,
            'data' => [
                'message' => 'success',
                'numero_documento' => $numeroDocumento,
                'nombres' => $nombres,
                'apellidos' => $apellidos,
                'nombresapellidos' => $fullName,
            ],
        ];
    }

    private function normalizeData(array $data): array
    {
        $data['codigo'] = $data['numero_documento'];

        return $data;
    }
}