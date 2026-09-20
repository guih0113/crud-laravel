<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function index() : JsonResponse {
        $users = User::orderBy('id', 'desc')->paginate(2);

        return response()->json([
            'status' => true,
            'users' => $users,
        ], 200);
    }
}