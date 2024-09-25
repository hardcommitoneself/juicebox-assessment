<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostDeleteController extends Controller
{
    /**
     * Handle the incoming request.
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
