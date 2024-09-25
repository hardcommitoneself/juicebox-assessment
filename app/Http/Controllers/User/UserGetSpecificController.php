<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserGetSpecificController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(string $id)
    {
        try {
            return new UserResource(User::findOrFail($id));
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
