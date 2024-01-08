<?php

namespace App\Http\Controllers;

use App\Models\DataNIK;
use Illuminate\Http\Request;

class ControllerDataNIK extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataNIKList = DataNIK::all();
        return response()->json($dataNIKList, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'no_nik' => 'required',
            'nama' => 'required',
            'tanggal_lahir' => 'required',
        ]);

        $dataNIK = DataNIK::create($validatedData);

        return response()->json($dataNIK, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $dataNIK = DataNIK::findOrFail($id);
        return response()->json($dataNIK, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'no_nik' => 'required',
            'nama' => 'required',
            'tanggal_lahir' => 'required',
        ]);

        $dataNIK = DataNIK::findOrFail($id);
        $dataNIK->update($validatedData);

        return response()->json($dataNIK, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $dataNIK = DataNIK::findOrFail($id);
        $dataNIK->delete();

        return response()->json(null, 204);
    }
}
