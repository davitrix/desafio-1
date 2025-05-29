<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Criptomoneda\StoreRequest;
use App\Http\Requests\Criptomoneda\UpdateRequest;
use App\Models\Criptomoneda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CriptomonedaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $criptomonedas = Criptomoneda::with('monedas')->get();
        return response()->json($criptomonedas, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $criptomoneda = DB::transaction(function () use ($request) {

            $criptomoneda = Criptomoneda::create($request->except('monedas'));

            if ($request->has('monedas')) {

                $monedas = [];
                foreach ($request->input('monedas') as $moneda) {
                    $monedas[$moneda['id']] = ['precio' => $moneda['precio']];
                }

                $criptomoneda->monedas()->attach($monedas);
            }

            return $criptomoneda;
        });

        return response()->json($criptomoneda, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $criptomoneda = Criptomoneda::with('monedas')->findOrFail($id);
        return response()->json($criptomoneda, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $criptomoneda = DB::transaction(function () use ($request, $id) {

            $criptomoneda = Criptomoneda::findOrFail($id);
            $criptomoneda->update($request->except('monedas'));

            if ($request->has('monedas')) {
                $monedas = [];
                foreach ($request->input('monedas') as $moneda) {
                    $monedas[$moneda['id']] = ['precio' => $moneda['precio']];
                }
                $criptomoneda->monedas()->sync($monedas);
            }

            return $criptomoneda;
        });

        $criptomoneda->load('monedas');

        return response()->json($criptomoneda, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $criptomoneda = Criptomoneda::findOrFail($id);
        $criptomoneda->delete();
        return response()->json(null, 204);
    }
}
