<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Comment;

use App\Http\Requests\CreateData;



class CommentController extends Controller
{
    //
    public function store(Request $request, $id)
    {
        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->comment = $request->comment;
        $comment->post_id = $id; 
        $comment->save();
 
        return redirect()->route('posts.show', ['post' => $id]);
    }

}
