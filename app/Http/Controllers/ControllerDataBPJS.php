<?php

namespace App\Http\Controllers;

use App\Models\DataBPJS;
use Illuminate\Http\Request;

class ControllerDataBPJS extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataBPJSList = DataBPJS::all();
        return response()->json($dataBPJSList, 200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'no_va' => 'required',
        ]);

        $dataBPJS = DataBPJS::create($validatedData);

        return response()->json($dataBPJS, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $dataBPJS = DataBPJS::findOrFail($id);
        return response()->json($dataBPJS, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'no_va' => 'required',
            'nama_peserta' => 'required',
        ]);

        $dataBPJS = DataBPJS::findOrFail($id);
        $dataBPJS->update($validatedData);

        return response()->json($dataBPJS, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $dataBPJS = DataBPJS::findOrFail($id);
        $dataBPJS->delete();

        return response()->json(null, 204);
    }
}
