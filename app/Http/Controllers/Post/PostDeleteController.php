<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class PostDeleteController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @OA\Delete(
     *      path = "/api/posts/{id}",
     *      summary = "Delete a post",
     *      tags={"Post"},
     *      security={ {"sanctum": {} }},
     *
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="ID of post to delete",
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
     *          description = "Delete a post",
     *
     *          @OA\JsonContent(
     *
     *              @OA\Schema(
     *
     *                  @OA\Property(
     *                      property="status",
     *                      type="boolean",
     *                  ),
     *                  @OA\Property(
     *                      property="message",
     *                      type="string"
     *                  ),
     *              ),
     *
     *              @OA\Examples(
     *                  example = "Delete a post",
     *                  value = {
     *                      "status": true,
     *                      "message": "Post Deleted Successfully",
     *                  },
     *                  summary = "Delete a post"
     *              )
     *          )
     *      )
     * )
     */
    public function __invoke(string $id)
    {
        try {
            $post = Post::findOrFail($id);

            $post->delete();

            return response()->json([
                'status' => true,
                'message' => 'Post Deleted Successfully',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
