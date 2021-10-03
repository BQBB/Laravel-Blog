<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Resources\CommentResource as CR;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends StateController
{
    
    public function index()
    {
        return $this->sendResponse("Comment Reterived Successfully!", CR::collection(auth()->user()->comments));
    }

    public function store(Request $request, $id)
    {
        $post = Post::find($id);
        if (!$post) {
            return response()->json("Post Does'nt Exists", 404);
        }
        $validator = Validator::make($request->all(), ["comment"=>"required|string|min:1|max:255"]);
        if ($validator->fails()) {
            return $this->sendResponse("Faild to comment!", $validator->errors(), false, 404);
        }
        $comment= Comment::create(["text"=>$request->comment,"commentable_id"=>$id,"commentable_type"=>"App\Models\Post","user_id"=>auth()->user()->id]);
        return $this->sendResponse("Comment Published Successfully!", new CR($comment));
    }

    public function storeReplay(Request $request, $id)
    {
        $comment = Comment::find($id);
        if (!$comment) {
            return response()->json("Comment Does'nt Exists", 404);
        }
        $validator = Validator::make($request->all(), ["comment"=>"required|string|min:1|max:255"]);
        if ($validator->fails()) {
            return $this->sendResponse("Faild to comment!", $validator->errors(), false, 404);
        }
        $comment= Comment::create(["text"=>$request->comment,"commentable_id"=>$id,"commentable_type"=>"App\Models\Comment","user_id"=>auth()->user()->id]);
        return $this->sendResponse("Comment Published Successfully!", new CR($comment));
    }

    public function show($id)
    {
        $post = Post::with("comments")->find($id);
        if (!$post) {
            return response()->json("Post Does'nt Exists", 404);
        }
        return $this->sendResponse("Post Comments Reterived Successfully!", CR::collection($post->comments));
    }

    public function showComment($id)
    {
        $comment = Comment::find($id);
        if (!$comment) {
            return response()->json("Comment Does'nt Exists", 404);
        }
        return $this->sendResponse("Comment Reterived Successfully!", new CR($comment));
    }

    public function showReplys($id)
    {
        $comment = Comment::with("replys")->find($id);
        if (!$comment) {
            return response()->json("Post Does'nt Exists", 404);
        }
        return $this->sendResponse("Replys Comments Retrived Successfully!", CR::collection($comment->replys));
    }
   
    public function update(Request $request, $id)
    {
        $comment = Comment::find($id);
        if (!$comment) {
            return response()->json("Comment Does'nt Exists", 404);
        }

        if ($comment->user_id != auth()->user()->id) {
            return response()->json("Not Authorized!", 404);
        }
        $validator = Validator::make($request->all(), ["comment"=>"required|string|min:1|max:255"]);
        if ($validator->fails()) {
            return $this->sendResponse("Faild to Update comment!", $validator->errors(), false, 404);
        }

        $comment->update(["text"=>$request->comment]);
        return $this->sendResponse("Comment Updated Successfully!", new CR($comment));
    }

    public function destroy($comment)
    {
        $comment = Comment::find($comment);
        if (!$comment) {
            return response()->json("Comment Does'nt Exists", 404);
        }

        if ($comment->user_id != auth()->user()->id) {
            return response()->json("Not Authorized!", 404);
        }
        $comment->delete();
        return $this->sendResponse("Comment Deleted Successfully!", new CR($comment));
    }
}
