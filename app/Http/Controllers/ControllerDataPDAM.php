<?php

namespace App\Http\Controllers;

use App\Models\DataPDAM;
use Illuminate\Http\Request;

class ControllerDataPDAM extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataPDAMList = DataPDAM::all();
        return response()->json($dataPDAMList, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'no_pelanggan' => 'required',
            'nama_pelanggan' => 'required',
            'provinsi' => 'required',
            'kota' => 'required',
        ]);

        $dataPDAM = DataPDAM::create($validatedData);

        return response()->json($dataPDAM, 201);
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $dataPDAM = DataPDAM::findOrFail($id);
        return response()->json($dataPDAM, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'no_pelanggan' => 'required',
            'nama_pelanggan' => 'required',
            'provinsi' => 'required',
            'kota' => 'required',
        ]);

        $dataPDAM = DataPDAM::findOrFail($id);
        $dataPDAM->update($validatedData);

        return response()->json($dataPDAM, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $dataPDAM = DataPDAM::findOrFail($id);
        $dataPDAM->delete();

        return response()->json(null, 204);
    }
}
