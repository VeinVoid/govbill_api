<?php

namespace App\Http\Controllers;

use App\Models\DataGas;
use Illuminate\Http\Request;

class ControllerDataGas extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataGasList = DataGas::all();
        return response()->json($dataGasList, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'no_pelanggan' => 'required',
            'nama_pelanggan' => 'required',
        ]);

        $dataGas = DataGas::create($validatedData);

        return response()->json($dataGas, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $dataGas = DataGas::findOrFail($id);
        return response()->json($dataGas, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'no_pelanggan' => 'required',
            'nama_pelanggan' => 'required',
        ]);

        $dataGas = DataGas::findOrFail($id);
        $dataGas->update($validatedData);

        return response()->json($dataGas, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $dataGas = DataGas::findOrFail($id);
        $dataGas->delete();

        return response()->json(null, 204);
    }
}
