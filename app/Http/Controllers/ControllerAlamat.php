<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use Illuminate\Http\Request;

class ControllerAlamat extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alamatList = Alamat::all();
        return response()->json($alamatList, 200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_user' => 'required',
            'nama_penerima' => 'required',
            'no_hp' => 'required',
            'label_alamat' => 'required',
            'alamat_lengkap' => 'required',
            'catatan' => 'nullable',
        ]);

        $alamat = Alamat::create($validatedData);

        return response()->json($alamat, 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(Alamat $alamat)
    {
        return response()->json($alamat, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Alamat $alamat)
    {
        $validatedData = $request->validate([
            'id_user' => 'required',
            'nama_penerima' => 'required',
            'no_hp' => 'required',
            'label_alamat' => 'required',
            'alamat_lengkap' => 'required',
            'catatan' => 'nullable',
        ]);

        $alamat->update($validatedData);

        return response()->json($alamat, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alamat $alamat)
    {
        $alamat->delete();

        return response()->json(null, 204);
    }
}
