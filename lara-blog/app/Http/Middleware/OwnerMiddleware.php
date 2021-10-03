<?php

namespace App\Http\Middleware;

use App\Models\Post;
use Closure;
use Illuminate\Http\Request;

class OwnerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $post = Post::find($request->route("post"));
        if (!$post) {
            return response()->json("Post Does'nt Exists", 404);
        }

        if ($post->user_id != auth()->user()->id) {
            return response()->json("Not Authorized!", 404);
        }
        return $next($request);
    }
}
