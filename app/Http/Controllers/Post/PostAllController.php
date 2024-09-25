<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class PostAllController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @OA\Get(
     *      path = "/api/posts",
     *      summary = "List all posts",
     *      tags={"Post"},
     *      security={ {"sanctum": {} }},
     *
     *      @OA\Response(
     *          response = 500,
     *          description = "Internal server error"
     *      ),
     *      @OA\Response(
     *          response = 200,
     *          description = "List all posts",
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
     *                  ),
     *
     *                  @OA\Property(
     *                      property="links",
     *                      type="object"
     *                  ),
     *                  @OA\Property(
     *                      property="meta",
     *                      type="object"
     *                  ),
     *              ),
     *
     *              @OA\Examples(
     *                  example = "List all posts",
     *                  value = {
     *                      "data": {},
     *                      "links": {},
     *                      "meta": {}
     *                  },
     *                  summary = "List all posts"
     *              )
     *          )
     *      )
     * )
     */
    public function __invoke(Request $request)
    {
        try {
            return PostResource::collection(Post::paginate());
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
