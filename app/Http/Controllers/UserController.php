<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\DataKartu;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{

    use ResponseController;
    
    public function register(RegisterRequest $request)
    {
        $request->validated();

        if ($request->hasFile('profile_picture')) {
            $image_path = $request->file('profile_picture')->store('profile_picture', 'public');
        } else {
            $image_path = null;
        }

        $userData = [
            'username' => $request->username,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
            'profile_picture' => $image_path,
        ];

        $user = User::create($userData);
        $token = $user->createToken('govbill')->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token
        ], 201);
    }

    public function login(LoginRequest $request) 
    {
        $request->validated();

        $user = User::whereEmail($request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => 'Invalid credentials'
            ], 422);
        }

        $token = $user->createToken('govbill')->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token
        ], 200);
    }

    public function logout() 
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }

    public function show()
    {
        $user = auth()->user();

        return response([
            'user' => $user
        ], 200);
    }

    // /**
    //  * Display a listing of the resource.
    //  */
    // public function index()
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(Request $request)
    // {
    //     if ($request->file('image') != null) {
    //         $dataUser = [
    //             'username' => $request->input('username'),
    //             'email' => $request->input('email'),
    //             'password' => Hash::make($request->input('password')),
    //             'phone_number' => $request->input('phone_number'),
    //             'image' => $this->encode($request->file('image')->getRealPath()),
    //         ];
    //         User::create($dataUser);

    //         return $this->storeResponse($dataUser);
    //     } else {
    //         $dataUser = [
    //             'username' => $request->input('username'),
    //             'email' => $request->input('email'),
    //             'password' => Hash::make($request->input('password')),
    //             'phone_number' => $request->input('phone_number'),
    //         ];
    //         User::create($dataUser);

    //         return $this->storeResponse($dataUser);
    //     }
    // }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(User $user)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, User $user)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(User $user)
    // {
    //     //
    // }


    // public function login(Request $request)
    // {
    //     $cardential = $request->validate([
    //         'username' => 'required',
    //         'password' => 'required',
    //     ]);

    //     $user = User::where('username', $request->input('username'))->firstOrFail();

    //     if (Auth::attempt($cardential)) {
    //         $user->update(['token' => Str::random(60), 'update_at' => now()]);

    //         $responseData = [
    //             'token' => $user->token,
    //         ];

    //         return response()->json($responseData, 200);
    //     } else {
    //         $errorReason = Auth::user() ? 'Invalid Password' : 'User Not Found';
    //         return response()->json(['error' => $errorReason], 401);
    //     }
    // }
}
