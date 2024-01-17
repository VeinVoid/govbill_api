<?php

namespace App\Http\Controllers;

use App\Models\DataPLN;
use Illuminate\Http\Request;

class ControllerDataPLN extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataPLNList = DataPLN::all();
        return response()->json($dataPLNList, 200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_pelanggan' => 'required',
        ]);

        $dataPLN = DataPLN::create($validatedData);

        return response()->json($dataPLN, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $dataPLN = DataPLN::findOrFail($id);
        return response()->json($dataPLN, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'id_pelanggan' => 'required',
            'nama_pelanggan' => 'required',
        ]);

        $dataPLN = DataPLN::findOrFail($id);
        $dataPLN->update($validatedData);

        return response()->json($dataPLN, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $dataPLN = DataPLN::findOrFail($id);
        $dataPLN->delete();

        return response()->json(null, 204);
    }
}
