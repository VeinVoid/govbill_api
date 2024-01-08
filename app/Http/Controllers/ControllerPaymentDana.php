<?php

namespace App\Http\Controllers;

use App\Models\PaymentDana;
use Illuminate\Http\Request;

class ControllerPaymentDana extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paymentDanaList = PaymentDana::all();
        return response()->json($paymentDanaList, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'no_hp' => 'required',
            'nominal' => 'required',
        ]);

        $paymentDana = PaymentDana::create($validatedData);

        return response()->json($paymentDana, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(PaymentDana $paymentDana)
    {
        return response()->json($paymentDana, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PaymentDana $paymentDana)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'no_hp' => 'required',
            'nominal' => 'required',
        ]);

        $paymentDana->update($validatedData);

        return response()->json($paymentDana, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaymentDana $paymentDana)
    {
        $paymentDana->delete();

        return response()->json(null, 204);
    }
}
