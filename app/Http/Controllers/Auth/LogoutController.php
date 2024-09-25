<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @OA\Post(
     *      path = "/api/logout",
     *      summary = "Logout",
     *      tags={"Auth"},
     *      security={ {"sanctum": {} }},
     *
     *      @OA\Response(
     *          response = 500,
     *          description = "Internal server error"
     *      ),
     *      @OA\Response(
     *          response = 200,
     *          description = "User logged out",
     *
     *          @OA\JsonContent(
     *
     *              @OA\Schema(
     *
     *                  @OA\Property(
     *                      property="status",
     *                      type="boolean"
     *                  ),
     *                  @OA\Property(
     *                      property="message",
     *                      type="string"
     *                  ),
     *              ),
     *
     *              @OA\Examples(
     *                  example = "result",
     *                  value = {"status": true, "message": "User Logged Out Successfully"},
     *                  summary = "An result object"
     *              )
     *          )
     *      )
     * )
     */
    public function __invoke(Request $request)
    {
        try {
            Auth::guard('sanctum')->user()->tokens()->delete();

            return response()->json([
                'status' => true,
                'message' => 'User Logged Out Successfully',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
