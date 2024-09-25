<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use OpenApi\Annotations as OA;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @OA\Post(
     *      path = "/api/login",
     *      summary = "Login",
     *      tags={"Auth"},
     *
     *      @OA\RequestBody(
     *
     *          @OA\MediaType(
     *              mediaType="application/json",
     *
     *              @OA\Schema(
     *
     *                  @OA\Property(
     *                      property="email",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="password",
     *                      type="string"
     *                  ),
     *                  example={"email": "john@test.com", "password": "password"}
     *              )
     *          )
     *      ),
     *
     *      @OA\Response(
     *          response = 401,
     *          description = "Validation error Or Email & Password does not match with our record."
     *      ),
     *      @OA\Response(
     *          response = 500,
     *          description = "Internal server error"
     *      ),
     *      @OA\Response(
     *          response = 200,
     *          description = "User logged in",
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
     *                  @OA\Property(
     *                      property="token",
     *                      type="string"
     *                  ),
     *              ),
     *
     *              @OA\Examples(
     *                  example = "result",
     *                  value = {"status": true, "message": "User Logged In Successfully", "token": "6|ZtL5S6oXw66EMH3fSpJAJM6Yab38ygdGqHCIwM6Xbc93cc5a"},
     *                  summary = "An result object"
     *              )
     *          )
     *      )
     * )
     */
    public function __invoke(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors(),
                ], 401);
            }

            if (! Auth::attempt($request->only(['email', 'password']))) {
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }

            $user = User::where('email', $request->email)->first();

            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'token' => $user->createToken('API TOKEN')->plainTextToken,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
