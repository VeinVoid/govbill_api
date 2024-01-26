<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlamatRequest;
use App\Models\Alamat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ControllerAlamat extends Controller
{
    use ResponseController;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alamatList = Alamat::all();
        return $this->storeResponse($alamatList);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(AlamatRequest $request)
    {
        $validatedData = $request->validated();
    
        $response = auth()->user()->alamat()->create($validatedData);

        return $this->storeResponse($response);
    }


    /**
     * Display the specified resource.
     */
    public function showAll()
    {
        $alamat = auth()->user()->alamat()->get();

        return response()->json([
            'data' => $alamat,
        ], 200);
    }

    public function show($id)
    {
        $alamat = auth()->user()->alamat()->find($id);

        return response()->json([
            'data' => $alamat,
        ], 200);
    }

    public function update(AlamatRequest $request, $id)
    {
        $validatedData = $request->validated();

        $alamat = auth()->user()->alamat()->find($id);

        $alamat->update($validatedData);

        return $this->updateResponse($alamat);
    }

    public function destroy($id)
    {
        $alamat = auth()->user()->alamat()->find($id);

        $alamat->delete();

        return response()->json([
            'message' => 'Data berhasil dihapus'
        ], 200);
    }
}
