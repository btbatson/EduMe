<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use App\Model\Post;
use App\Model\User;
use App\Model\Comment;
use App\Model\Education;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    
    public function getPost(Request $request)
    {
        if(!$request->has('user_id'))
        {
            return $this->errorMissingAttribute();
        }

        $user = User::find($request->input('user_id'));

        if(!$user)
        {
            return response()->json([
            'success' => 'false',
            'message' => "This user doesn't exist"
            ], 200);
        }

        $posts = Post::where(function($quary) use($user){
            return $quary->where('user_id', $user->id)
            ->orWhereIn('user_id', $user->friends()->lists('id'));
        })->orderBy('created_at', 'desc')->with('user')->with('comments')->get();

        $posts_arr = null;
        foreach ($posts as $post) {
            $posts_arr []= [
                'id' => $post->id,
                'content' => $post->content,
                'created_at' => $post->created_at,
                'name' => $post->user->getName(),
                'profile_pic' => $post->user->profile_pic,
            ];
        }
        // return response()->json([
        //     'success' => 'true',
        //     'posts' => $posts,
        //     ], 200);
        //     
        return response()->json($posts_arr
            , 200)->header('Cache-Control', 'public');
    }

    public function getProfile(Request $request)
    {
        if(!$request->has('user_id') or !$request->has('view_id'))
        {
            return $this->errorMissingAttribute();
        }

        $user = User::find($request->input('user_id'));
        $view = User::find($request->input('view_id'));

        if(!$user)
        {
            return response()->json([
            'success' => 'false',
            'message' => "This user doesn't exist"
            ], 200);
        }

        if(!$view)
        {
            return response()->json([
            'success' => 'false',
            'message' => "This user doesn't exist"
            ], 200);
        }


        $posts = $view->posts()->get();

        $isFriend = $user->isFriendWith($view);

        return response()->json([
            'success' => 'true',
            'user' => $view,
            'posts' => $posts,
            'isFriend' => $isFriend,
        ], 200)->header('Cache-Control', 'public');
    }

    public function getMyProfile(Request $request)
    {
        if(!$request->has('user_id'))
        {
            return $this->errorMissingAttribute();
        }

        $user = User::find($request->input('user_id'));

        if(!$user)
        {
            return response()->json([
            'success' => 'false',
            'message' => "This user doesn't exist"
            ], 200);
        }

        $posts = $user->posts()->get();

        return response()->json([
            'success' => 'true',
            'posts' => $posts,
        ], 200)->header('Cache-Control', 'public');
    }

    public function addPost(Request $request)
    {
        if(!$request->has('user_id') or !$request->has('post'))
        {
            return $this->errorMissingAttribute();
        }

        $user = User::find($request->input('user_id'));

        if(!$user)
        {
            return response()->json([
            'success' => 'false',
            'message' => "This user doesn't exist"
            ], 200);
        }

        $post = $user->postType()->create([
            'content' => $request->input('post')
            ]);
        $user->posts()->save($post);

        return response()->json([
            'success' => 'true',
            'post' => $post,
        ], 200)->header('Cache-Control', 'public');

    }

    public function addComment(Request $request)
    {
        if(!$request->has('user_id') or !$request->has('post_id') or 
            !$request->has('comment'))
        {
            return $this->errorMissingAttribute();
        }

        $user = User::find($request->input('user_id'));

        if(!$user)
        {
            return response()->json([
            'success' => 'false',
            'message' => "This user doesn't exist"
            ], 200);
        }

        $post = Post::find($request->input('post_id'));

        if(!$post)
        {
            return response()->json([
            'success' => 'false',
            'message' => "This post doesn't exist"
            ], 200);
        }

        if(!$user->isFriendWith($post->user) and 
            $user->id !== $post->user->id)
        {
            return response()->json([
            'success' => 'false',
            'message' => "You can't add this comment"
            ], 200);
        }

        $comment = new Comment;

        $comment->content = $request->input("comment");
        $comment->user_id = $user->id;
        $comment->post_id = $post->id;
        $comment->save();

        return response()->json([
            'success' => 'true',
            'comment' => $comment,
        ], 200)->header('Cache-Control', 'public');

    }

    public function getCv(Request $request)
    {
        if(!$request->has('user_id'))
        {
            return $this->errorMissingAttribute();
        }

        $user = User::find($request->input('user_id'));

        if(!$user)
        {
            return response()->json([
            'success' => 'false',
            'message' => "This user doesn't exist"
            ], 200);
        }

        $educations = $user->educations()->orderBy('start_date', 'ASC')->get();

        $experiences = $user->experiences()->orderBy('start_date', 'ASC')->get();

        $skills = $user->skills()->get();

        $interests = $user->interests()->get();

        $projects = $user->projects()->get();
        
        return response()->json([
            'success' => 'true',
            'user' => $user,
            'educations' => $educations,
            'experiences' => $experiences,
            'skills' => $skills,
            'interests' => $interests,
            'projects' => $projects,
        ], 200)->header('Cache-Control', 'public');
    }

    public function getMyCourses(Request $request)
    {
        if(!$request->has('user_id'))
        {
            return $this->errorMissingAttribute();
        }

        $user = User::find($request->input('user_id'));

        if(!$user)
        {
            return response()->json([
            'success' => 'false',
            'message' => "This user doesn't exist"
            ], 200);
        }

        $courses = $user->joinCourses()->get();
        $data = null;
        foreach ($courses as $course) {
            $data [] = [
             "id" => $course->id,
              "category_id" => $course->category_id,
              "user_id" => $course->user_id,
              "title" => $course->title,
              "thumbnail" => asset($course->thumbnail),
              "description" => $course->description,
              "requirement" => $course->requirement,
              "project_title" => $course->project_title,
              "project_description" => $course->project_description,
              "inestructor_name" => $course->owner->getName(),
              'inestructor_profile_pic' =>  $course->owner->profile_pic
            ];
        }

        // return response()->json([
        //     'success' => 'true',
        //     'myCourses' => $courses,
        // ], 200)->header('Cache-Control', 'public');
        // 
        return response()->json($data, 200)->header('Cache-Control', 'public');
    }

    public function getOnePost(Request $request)
    {
        if(!$request->has('post_id'))
        {
            return $this->errorMissingAttribute();
        }

        $post = Post::with('comments')->find($request->input('post_id'));

        if(!$post)
        {
            return response()->json([
            'success' => 'false',
            'message' => "This post doesn't exist"
            ], 200);
        }

        // return response()->json([
        //     'success' => 'true',
        //     'post' => $post,
        // ], 200)->header('Cache-Control', 'public');
        // 
        return response()->json($post, 200)->header('Cache-Control', 'public');


    }
}
