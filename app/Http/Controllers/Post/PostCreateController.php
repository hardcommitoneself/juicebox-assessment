<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use OpenApi\Annotations as OA;

class PostCreateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @OA\Post(
     *      path = "/api/posts",
     *      summary = "Create a new post",
     *      tags={"Post"},
     *      security={ {"sanctum": {} }},
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
     *          response = 401,
     *          description = "Validation error"
     *      ),
     *      @OA\Response(
     *          response = 500,
     *          description = "Internal server error"
     *      ),
     *      @OA\Response(
     *          response = 200,
     *          description = "Create a new post",
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
     *                  example = "A new post created",
     *                  value = {
     *                      "id": 1,
     *                      "title": "Test post",
     *                      "description": "Test description"
     *                  },
     *                  summary = "A new post created"
     *              )
     *          )
     *      )
     * )
     */
    public function __invoke(Request $request)
    {
        try {
            $validatePost = Validator::make($request->all(), [
                'title' => 'required',
                'description' => 'required',
            ]);

            if ($validatePost->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validatePost->errors(),
                ], 401);
            }

            $post = new Post;

            $post->title = $request->title;
            $post->description = $request->description;
            $post->user_id = Auth::user()->id;

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
