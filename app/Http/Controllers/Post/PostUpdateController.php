<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class PostUpdateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @OA\Patch(
     *      path = "/api/posts/{id}",
     *      summary = "Update an existing post",
     *      tags={"Post"},
     *      security={ {"sanctum": {} }},
     *
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="ID of post to update",
     *          required=true,
     *
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *
     *      @OA\RequestBody(
     *
     *          @OA\MediaType(
     *              mediaType="application/json",
     *
     *              @OA\Schema(
     *
     *                  @OA\Property(
     *                      property="title",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="description",
     *                      type="string"
     *                  ),
     *                  example={"title": "Test post", "description": "Test description"}
     *              )
     *          )
     *      ),
     *
     *      @OA\Response(
     *          response = 500,
     *          description = "Internal server error"
     *      ),
     *      @OA\Response(
     *          response = 200,
     *          description = "Update an existing post",
     *
     *          @OA\JsonContent(
     *
     *              @OA\Schema(
     *
     *                  @OA\Property(
     *                      property="id",
     *                      type="string",
     *                  ),
     *                  @OA\Property(
     *                      property="title",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="description",
     *                      type="string"
     *                  ),
     *              ),
     *
     *              @OA\Examples(
     *                  example = "Update an existing post",
     *                  value = {
     *                      "id": 1,
     *                      "title": "Test post",
     *                      "description": "Test description"
     *                  },
     *                  summary = "Update an existing post"
     *              )
     *          )
     *      )
     * )
     */
    public function __invoke(string $id, Request $request)
    {
        try {
            $post = Post::findOrFail($id);

            if ($request->has('title')) {
                $post->title = $request->title;
            }

            if ($request->has('description')) {
                $post->description = $request->description;
            }

            $post->save();

            return new PostResource($post);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
