<?php

namespace App\Http\Controllers;

trait ResponseController
{
    public function showResponse($data)
    {
        $responseBody = [
            'status' => 'get success (200)',
            'massage' => 'Enjoy the API',
            'data' => $data,
        ];

        return response()->json($responseBody, 200);
    }

    public function storeResponse($data)
    {
        $responseBody = [
            'status' => 'store success (201)',
            'massage' => 'Data has been store',
            'data' => $data,
        ];

        return response()->json($responseBody, 201);
    }

    public function deleteResponse()
    {
        $responseBody = [
            'status' => 'store success (200)',
            'massage' => 'Data has been deleted',
        ];

        return response()->json($responseBody, 200);
    }

    public function updateResponse($data)
    {
        $responseBody = [
            'status' => 'update success (200)',
            'massage' => 'Data has been updated',
            'data' => $data,
        ];

        return response()->json($responseBody, 200);
    }

    public function notFoundResponse($massage)
    {
        $responseBody = [
            'status' => 'data not found (404)',
            'massage' => $massage,
        ];

        return response()->json($responseBody, 404);
    }

    public function encode($file)
    {
        return base64_encode(file_get_contents($file));
    }
}
