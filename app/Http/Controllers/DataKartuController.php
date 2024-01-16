<?php

namespace App\Http\Controllers;

use App\Models\DataKartu;
use Illuminate\Http\Request;

class DataKartuController extends Controller
{
    function store(Request $request)
    {
        $validated = $request->validate([
            'no_kartu' => 'required|string',
            'jenis_kartu' => 'required|string',
            'bulan_berlaku' => 'required|string',
            'tahun_berlaku' => 'required|string',
            'cvv' => 'required|string',
            'nama_pemilik' => 'required|string',
            'saldo' => 'required|integer',
        ]);

        $response = DataKartu::create($validated);

        return response()->json([
            'data' => $response,
            'message' => 'Data kartu berhasil ditambahkan'
        ], 201);
    }

}
