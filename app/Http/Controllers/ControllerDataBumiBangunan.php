<?php

namespace App\Http\Controllers;

use App\Models\DataBumiBangunan;
use Illuminate\Http\Request;

class ControllerDataBumiBangunan extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataBumiBangunanList = DataBumiBangunan::all();
        return response()->json($dataBumiBangunanList, 200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nop' => 'required',
            'nama_pemilik' => 'required',
            'provinsi' => 'required',
            'kota' => 'required',
        ]);

        $dataBumiBangunan = DataBumiBangunan::create($validatedData);

        return response()->json($dataBumiBangunan, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $dataBumiBangunan = DataBumiBangunan::findOrFail($id);
        return response()->json($dataBumiBangunan, 200);
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

        $dataBumiBangunan = DataBumiBangunan::findOrFail($id);
        $dataBumiBangunan->update($validatedData);

        return response()->json($dataBumiBangunan, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $dataBumiBangunan = DataBumiBangunan::findOrFail($id);
        $dataBumiBangunan->delete();

        return response()->json(null, 204);
    }
}


