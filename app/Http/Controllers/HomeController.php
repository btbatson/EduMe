<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use App\Model\Post;
use App\Model\Category;
use App\Model\Course;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check())
        {
            $posts = Post::where(function($quary){
                return $quary->where('user_id', Auth::user()->id)
                ->orWhereIn('user_id', Auth::user()->friends()->lists('id'));
            })->orderBy('created_at', 'desc')
            ->get();//paginate(10);

            $chat_members = Auth::user()->friends();

            return view('timeline.index')->with('posts', $posts)
                ->with('chat_members', $chat_members);
        }
        // return view('welcome');
        $courses = Course::all();
        $categories = Category::all();

        return view('course.index')
            ->with('courses', $courses)
            ->with('categories', $categories);
    }
}
