<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostCreateController extends Controller
{
    /**
     * Handle the incoming request.
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
                ], 400);
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
