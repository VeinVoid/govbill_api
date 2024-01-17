<?php

namespace App\Http\Controllers;

use App\Models\DataSTNK;
use Illuminate\Http\Request;

class ControllerDataSTNK extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataSTNKList = DataSTNK::all();
        return response()->json($dataSTNKList, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nik' => 'required',
            'no_rangka' => 'required',
            'nama_pemilik' => 'required',
            'merk_kendaraan' => 'required',
            'nrkb' => 'required',
            'bulan_tenggat' => 'required'
        ]);

        $dataSTNK = DataSTNK::create($validatedData);

        return response()->json($dataSTNK, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $dataSTNK = DataSTNK::find($id);
        return response()->json($dataSTNK, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'no_rangka' => 'required',
            'nama_pemilik' => 'required',
            'nrkb' => 'required',
        ]);

        $dataSTNK = DataSTNK::findOrFail($id);
        $dataSTNK->update($validatedData);

        return response()->json($dataSTNK, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $dataSTNK = DataSTNK::findOrFail($id);
        $dataSTNK->delete();

        return response()->json(null, 204);
    }
}
