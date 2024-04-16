<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class StatusesController extends Controller
{
    /**
     * @throws ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'body' => 'required|min:4',
        ]);

        Status::create([
            'body' => request('body'),
            'user_id' => Auth::user()->getAuthIdentifier(),
        ]);

        return response()->json([
            'body' => request('body'),
        ]);
    }
}
