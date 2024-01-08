<?php

namespace App\Http\Controllers;

use App\Models\PaymentGopay;
use Illuminate\Http\Request;

class ControllerPaymentGopay extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paymentGopayList = PaymentGopay::all();
        return response()->json($paymentGopayList, 200);
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

        $paymentGopay = PaymentGopay::create($validatedData);

        return response()->json($paymentGopay, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(PaymentGopay $paymentGopay)
    {
        return response()->json($paymentGopay, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PaymentGopay $paymentGopay)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'no_hp' => 'required',
            'nominal' => 'required',
        ]);

        $paymentGopay->update($validatedData);

        return response()->json($paymentGopay, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaymentGopay $paymentGopay)
    {
        $paymentGopay->delete();

        return response()->json(null, 204);
    }
}
