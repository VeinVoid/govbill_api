<?php

namespace App\Http\Controllers;

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
    public function store(Request $request)
    {
        $user = DB::table('user')
            ->where('token', $request->input('token'))
            ->value('id_user');


        $validatedData = $request->validate([
            'id_user' => 'nullable',
            'nama_penerima' => 'required',
            'no_hp' => 'required',
            'label_alamat' => 'required',
            'alamat_lengkap' => 'required',
            'catatan' => 'nullable',
        ]);

        $validatedData['id_user'] = $user;

        $alamat = Alamat::create($validatedData);

        return $this->storeResponse($alamat);
    }


    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $user = DB::table('user')
            ->where('token', $request->input('token'))
            ->value('id_user');

        $alamat = Alamat::where('id_user', $user)->get();

        return $this->showResponse($alamat);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Alamat $alamat)
    {
        $validatedData = $request->validate([
            'id_user' => 'nullable',
            'nama_penerima' => 'nullable',
            'no_hp' => 'nullable',
            'label_alamat' => 'nullable',
            'alamat_lengkap' => 'nullable',
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
