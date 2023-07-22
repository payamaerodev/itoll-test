<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function login(): JsonResponse
    {
        return response()->json([
            'message'=>'your token is invalid!'
        ]);
    }
}
