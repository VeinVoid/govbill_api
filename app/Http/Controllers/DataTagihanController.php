<?php

namespace App\Http\Controllers;

use App\Http\Requests\DataTagihanRequest;
use App\Models\DataTagihan;
use Illuminate\Http\Request;

class DataTagihanController extends Controller
{
    function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_tagihan' => 'required|string',
            'no_tagihan' => 'required|string',
            'nominal_tagihan' => 'required|integer',
            'waktu_bisa_bayar' => 'required',
            'waktu_tenggat' => 'required',
            'status' => 'required|string',
        ]);

        $response = DataTagihan::create($validated);

        return response()->json([
            'data' => $response,
            'message' => 'Data tagihan berhasil ditambahkan'
        ], 201);
    }
}
