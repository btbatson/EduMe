<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\Model\User;
use App\Model\Post;
use App\Model\Comment;
use App\Model\Course;

class PostsCourseController extends Controller
{
    public function postAddPost(Request $request, $id)
    {
        $this->validate($request, [
            'post' => 'required|max:1000'
            ]);

        $course = Course::find($id);
        if(!Auth::user()->isAttend($course) and !$course->isOwner(Auth::user()))
        {
            return redirect()->route('home');
        }
        $post = $course->posts()->create([
            'content' => $request->input('post')
            ]);

        Auth::user()->posts()->save($post);

        return redirect()->back()->with('info', 'Your post has been added');
    }

    public function postComment(Request $request, $id, $postId)
    {
        $this->validate($request, [
            "comment-{$postId}" => 'required|max:1000'
            ],[
            'required' => 'The comment body is required.'
            ]);

        $post = Post::find($postId);
        $course = Course::find($id);

        if(!$post)
        {
            abort(404);
        }

        if(!Auth::user()->isAttend($course) and !$course->isOwner(Auth::user()))
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

    public function getLikePost($id, $postId)
    {
        $post = Post::find($postId);
        $course = Course::find($id);

        if(!$post)
        {
            abort(404);
        }
        
        if(!Auth::user()->isAttend($course) and !$course->isOwner(Auth::user()))
        {
            return redirect()->route('home');
        }

        if(Auth::user()->hasLikedPost($post))
        {
            return redirect()->back();
        }

        $like = $post->likes()->create([]);
        Auth::user()->likes()->save($like);

        return redirect()->back();
    }

    public function getLikeComment($id, $CommentId)
    {
        $comment = Comment::find($CommentId);
        $course = Course::find($id);

        if(!$comment)
        {
            abort(404);
        }

        if(!Auth::user()->isAttend($course) and !$course->isOwner(Auth::user()))
        {
            return redirect()->route('home');
        }

        if(Auth::user()->hasLikedComment($comment))
        {
            return redirect()->back();
        }

        $like = $comment->likes()->create([]);
        Auth::user()->likes()->save($like);

        return redirect()->back();
    }
}
