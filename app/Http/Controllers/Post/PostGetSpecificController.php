<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class PostGetSpecificController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @OA\Get(
     *      path = "/api/posts/{id}",
     *      summary = "Get a specific post",
     *      tags={"Post"},
     *      security={ {"sanctum": {} }},
     *
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="ID of post to fetch",
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
     *          description = "Get a specific post",
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
     *                  example = "Get a specific post",
     *                  value = {
     *                      "data": {
     *                          "id": 1,
     *                          "title": "Test post",
     *                          "description": "Test description"
     *                      },
     *                  },
     *                  summary = "Get a specific post"
     *              )
     *          )
     *      )
     * )
     */
    public function __invoke(string $id)
    {
        try {
            return new PostResource(Post::findOrFail($id));
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
