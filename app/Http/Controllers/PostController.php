<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\Model\User;
use App\Model\Post;
use App\Model\Comment;

class PostController extends Controller
{
    
    public function postAddPost(Request $request)
    {
        $this->validate($request, [
            'post' => 'required|max:1000'
            ]);

        $post = Auth::user()->postType()->create([
            'content' => $request->input('post')
            ]);
        Auth::user()->posts()->save($post);

        return redirect()->route('home')->with('info', 'Your post has been added');
    }

    public function postComment(Request $request, $postId)
    {
        $this->validate($request, [
            "comment-{$postId}" => 'required|max:1000'
            ],[
            'required' => 'The comment body is required.'
            ]);

        $post = Post::find($postId);

        if(!$post)
        {
            abort(404);
        }

        if(!Auth::user()->isFriendWith($post->user) and Auth::user()->id !== $post->user->id)
        {
            return redirect()->route('home');
        }

        $comment = new Comment;

        $comment->content = $request->input("comment-{$postId}");
        $comment->user_id = Auth::user()->id;
        $comment->post_id = $post->id;
        $comment->save();

        return redirect()->back();
    }

    public function getLikePost($postId)
    {
        $post = Post::find($postId);

        if(!$post)
        {
            abort(404);
        }

        if(!Auth::user()->isFriendWith($post->user) and Auth::user()->id !== $post->user->id)
        {
            return redirect()->route('home');
        }

        if(Auth::user()->hasLikedPost($post))
        {
            $like = Auth::user()->getLikedPost($post);
            $like->delete();
            return redirect()->back();
        }

        $like = $post->likes()->create([]);
        Auth::user()->likes()->save($like);

        return redirect()->back();
    }

    public function getLikeComment($CommentId)
    {
        $comment = Comment::find($CommentId);

        if(!$comment)
        {
            abort(404);
        }

        if(!Auth::user()->isFriendWith($comment->user) and Auth::user()->id !== $comment->user->id)
        {
            return redirect()->route('home');
        }

        if(Auth::user()->hasLikedComment($comment))
        {
            $like = Auth::user()->getLikedComment($comment);
            $like->delete();
            return redirect()->back();
        }

        $like = $comment->likes()->create([]);
        Auth::user()->likes()->save($like);

        return redirect()->back();
    }
}
