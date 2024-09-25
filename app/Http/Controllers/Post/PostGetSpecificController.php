<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostGetSpecificController extends Controller
{
    /**
     * Handle the incoming request.
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
