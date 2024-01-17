<?php

namespace App\Http\Controllers;

use App\Models\DataPBB;
use Illuminate\Http\Request;

class ControllerDataPBB extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataPBBList = DataPBB::all();
        return response()->json($dataPBBList, 200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nop' => 'required|unique:data_pbbs',
            'kota_kabupaten' => 'required',
        ]);

        $dataPBB = DataPBB::create($validatedData);

        return response()->json($dataPBB, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $dataPBB = DataPBB::findOrFail($id);
        return response()->json($dataPBB, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nop' => 'required',
            'nama_pemilik' => 'required',
            'provinsi' => 'required',
            'kota' => 'required',
        ]);

        $dataPBB = DataPBB::findOrFail($id);
        $dataPBB->update($validatedData);

        return response()->json($dataPBB, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $dataPBB = DataPBB::findOrFail($id);
        $dataPBB->delete();

        return response()->json(null, 204);
    }
}


