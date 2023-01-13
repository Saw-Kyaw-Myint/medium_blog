<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $comment = new Comment();

        $comment->comment = trim($request->comment);

        $comment->user()->associate($request->user());
        $post = Post::find($request->post_id);

        $post->comments()->save($comment);

        return back();
    }

    public function replyStore(Request $request)
    {
        $reply = new Comment();

        $reply->comment = trim($request->get('comment'));

        $reply->user()->associate($request->user());

        $reply->parent_id = $request->get('comment_id');

        $post = Post::find($request->get('post_id'));

        $post->comments()->save($reply);
        return back();
    }

    public function updateComment(Request $request, $id)
    {
        $post = new Post();
        if($request->parent_id){
            $postid = $post->findOrFail($request->post_id);
             $postid->parents()->where('id', '=', $request->comment_id)->update(['comment' => $request->comment]);
            return back();
        }
        $postid = $post->findOrFail($request->post_id);
         $postid->comments()->where('id', '=', $request->comment_id)->update(['comment' => $request->comment]);
        return back();
    }

    //delete comment
    public function delete($id)
    {
        Comment::where('id', $id)->delete();
        return back();
    }
}
