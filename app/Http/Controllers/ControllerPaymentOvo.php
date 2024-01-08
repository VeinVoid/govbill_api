<?php

namespace App\Http\Controllers;

use App\Models\PaymentOvo;
use Illuminate\Http\Request;

class ControllerPaymentOvo extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paymentOvoList = PaymentOvo::all();
        return response()->json($paymentOvoList, 200);
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

        $paymentOvo = PaymentOvo::create($validatedData);

        return response()->json($paymentOvo, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(PaymentOvo $paymentOvo)
    {
        return response()->json($paymentOvo, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PaymentOvo $paymentOvo)
    {
        $validatedData = $request->validate([
            'nama' => 'null',
            'no_hp' => 'null',
            'nominal' => 'null',
        ]);

        $paymentOvo->update($validatedData);

        return response()->json($paymentOvo, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaymentOvo $paymentOvo)
    {
        $paymentOvo->delete();

        return response()->json(null, 204);
    }
}
