<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource as PR;
use Illuminate\Support\Facades\Validator as Validator;
use Illuminate\Support\Str;

class PostController extends StateController
{
    public function __construct()
    {
        $this->middleware(\App\Http\Middleware\OwnerMiddleware::class)->only(["update","destroy"]);
    }
    
    public function index()
    {
        return $this->sendResponse("Posts Reterived Correctly!", PR::collection(Post::all()->load(["author","comments"])));
    }


    public function own()
    {
        return $this->sendResponse("Posts Reterived Correctly!", PR::collection(Post::with(["author","comments"])->where("user_id", "=", auth()->user()->id)->get()));
    }

    public function userPosts($id)
    {
        if(!User::find($id))
        {
            return $this->sendResponse("User Not Found!", [],false,404);
        }
        return $this->sendResponse("User Posts Reterived Correctly!", PR::collection(Post::with(["author","comments"])->where("user_id", "=", $id)->get()));
    }
    
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            "title" => "required|min:6|max:100",
            "img" => "required|image|mimes:jpg,png",
            "body" => "required|min:3",
        ]);

        if ($validation->fails()) {
            return $this->sendResponse("Errors!", $validation->errors(), false, 404);
        }

        $attibutese = $request->all();
        $attibutese['user_id'] = auth()->user()->id;
        $attibutese['slug'] = Str::slug($attibutese['title'], "-");
        $attibutese['img']=$request->img->store("imgs");
        $post = Post::create($attibutese);
        return $this->sendResponse("Post Created Successfully!", new PR($post));
    }

    public function show($id)
    {
        $post = Post::find($id);
        return $this->sendResponse("Post Reterived Successfully!", new PR($post));
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $validation = Validator::make($request->all(), [
            "title" => "required|min:6|max:100",
            "img" => "sometimes|required|image|mimes:jpg,png",
            "body" => "required|min:3",
        ]);

        if ($validation->fails()) {
            return $this->sendResponse("Error in Data!", $validation->errors(), false, 404);
        }

        $post->title= $request->title;
        $post->body= $request->body;
        $post->img = ($request->img) ? $request->img->store("imgs") : $post->img;
        $post->slug=Str::slug($post->title, "-");
        $post->save();
        return $this->sendResponse("Post Updated Successfully!", new PR($post));
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return  $this->sendResponse("Post Deleted Successfully!", new PR($post));
    }
}
