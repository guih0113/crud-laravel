<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index() : JsonResponse {
        $users = User::orderBy('id', 'desc')->paginate(2);

        return response()->json([
            'status' => true,
            'users' => $users,
        ], 200);
    }

    public function show(User $user) : JsonResponse {
        return response()->json([
            'status' => true,
            'user' => $user,
        ], 200);
    }

    public function store(UserRequest $request) : JsonResponse {
        DB::beginTransaction();

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Usuário cadastrado com sucesso!',
                'user' => $user,
            ], 201);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'Failed to create user',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}