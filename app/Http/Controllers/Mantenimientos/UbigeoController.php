<?php

namespace App\Http\Controllers\Mantenimientos;

use App\Http\Controllers\Controller;
use App\Models\Ubigeo;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class UbigeoController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Mantenimientos/Ubigeos/Index', [
            'records' => Ubigeo::query()->orderBy('id')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id' => ['required', 'string', 'max:6', 'unique:ubigeo,id'],
            'departement' => ['required', 'string', 'max:25'],
            'province' => ['required', 'string', 'max:25'],
            'district' => ['required', 'string', 'max:25'],
            'region' => ['nullable', 'string', 'max:10'],
            'zone' => ['nullable', 'string', 'max:6'],
            'zip_code' => ['nullable', 'string', 'max:10'],
        ]);

        Ubigeo::create($data);

        return back()->with('success', 'Ubigeo registrado.');
    }

    public function update(Request $request, Ubigeo $ubigeo)
    {
        $data = $request->validate([
            'id' => [
                'required',
                'string',
                'max:6',
                Rule::unique('ubigeo', 'id')->ignore($ubigeo->id, 'id'),
            ],
            'departement' => ['required', 'string', 'max:25'],
            'province' => ['required', 'string', 'max:25'],
            'district' => ['required', 'string', 'max:25'],
            'region' => ['nullable', 'string', 'max:10'],
            'zone' => ['nullable', 'string', 'max:6'],
            'zip_code' => ['nullable', 'string', 'max:10'],
        ]);

        $ubigeo->update($data);

        return back()->with('success', 'Ubigeo actualizado.');
    }

    public function destroy(Ubigeo $ubigeo)
    {
        $ubigeo->delete();

        return back()->with('success', 'Ubigeo eliminado.');
    }
}