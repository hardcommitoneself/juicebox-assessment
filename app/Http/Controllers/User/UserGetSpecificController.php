<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class UserGetSpecificController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @OA\Get(
     *      path = "/api/users/{id}",
     *      summary = "Get a specific user with their posts",
     *      tags={"User"},
     *      security={ {"sanctum": {} }},
     *
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="ID of user to fetch",
     *          required=true,
     *
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *
     *      @OA\Response(
     *          response = 500,
     *          description = "Internal server error"
     *      ),
     *      @OA\Response(
     *          response = 200,
     *          description = "Get a specific user with their posts",
     *
     *          @OA\JsonContent(
     *
     *              @OA\Schema(
     *
     *                  @OA\Property(
     *                      property="data",
     *                      type="array",
     *
     *                      @OA\Items(ref="#/components/schemas/Post")
     *                  )
     *              ),
     *
     *              @OA\Examples(
     *                  example = "Get a specific user with their posts",
     *                  value = {
     *                      "data": {
     *                          "id": 1,
     *                          "name": "John Doe",
     *                          "email": "john@test.com",
     *                          "created_at": "2024-09-25T04:23:01.000000Z",
     *                          "posts": {}
     *                      },
     *                  },
     *                  summary = "Get a specific user with their posts"
     *              )
     *          )
     *      )
     * )
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
