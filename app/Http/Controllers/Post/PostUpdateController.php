<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use App\Models\Post;

class PostUpdateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(string $id, Request $request)
    {
        try {
            $post = Post::findOrFail($id);

            if($request->has('title')) {
                $post->title = $request->title;
            }

            if($request->has('description')) {
                $post->description = $request->description;
            }

            $post->save();

            return new PostResource($post);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
