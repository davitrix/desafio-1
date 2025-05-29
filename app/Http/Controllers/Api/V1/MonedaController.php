<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Moneda\StoreRequest;
use App\Http\Requests\Moneda\UpdateRequest;
use App\Models\Moneda;
use Illuminate\Http\Request;

class MonedaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $monedas = Moneda::all();
        return response()->json($monedas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $moneda = Moneda::create($request->all());
        return response()->json($moneda, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $moneda = Moneda::findOrFail($id);
        return response()->json($moneda);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $moneda = Moneda::findOrFail($id);
        $moneda->update($request->all());
        return response()->json($moneda);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $moneda = Moneda::findOrFail($id);
        $moneda->delete();
        return response()->json(null, 204);
    }
}
