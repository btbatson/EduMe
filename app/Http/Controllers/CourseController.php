<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Model\Skill;
use App\Model\Category;
use App\Model\Course;
use App\Model\Video;
use Auth;
use Image;
use Youtube;

class CourseController extends Controller
{

    public function index()
    {
        $courses = Course::all();
        $categories = Category::all();

        return view('course.index')
            ->with('courses', $courses)
            ->with('categories', $categories);
    }

    public function getCategory($id)
    {
        $category = Category::find($id);

        $categories = Category::all();

        $courses = $category->courses;

        return view('course.index')
            ->with('courses', $courses)
            ->with('categories', $categories);
    }

    public function getAddCourse()
    {
        $skillslist = Skill::lists('skill');
        $categories = Category::all();

        return view('course.create')
            ->with('skillslist', $skillslist)
            ->with('categories', $categories);
    }

    public function postAddCourse(Request $request)
    {
        $this->validate($request, [
            'category' => 'required',
            'title' => 'required|max:255',
            'thumbnail' => 'required|image',
            'description' => 'required',
            'requirement' => 'required',
            'skills' => 'required'
        ]);

        $image = $request->file('thumbnail');
        $filename  = time() . '.' . $image->getClientOriginalExtension();

        $path = public_path('uploads/' . $filename);
        $img = Image::make($image->getRealPath())->save($path);

        $course = new Course;
        $course->category_id = $request->input('category');
        $course->title = $request->input('title');

        $course->thumbnail = 'uploads/' . $filename;
        $course->description = $request->input('description');
        $course->requirement = $request->input('requirement');

        $course->save();
        $skills_ids;
        foreach ($request->input('skills') as $skill) {
            $skill = Skill::firstOrCreate(["skill" => $skill]);
            $skills_ids [] = $skill->id;
        }

        Auth::user()->courses()->save($course);
        $course->skills()->attach($skills_ids);
        
        return redirect()
            ->route('course.show', ['id' => $course->id])
            ->with('info', 'Course has been created');
    }

    public function getCourse($id)
    {
        $course = Course::find($id);

        return view('course.show')->with('course', $course);
    }

    public function getAddVideo($id)
    {
        $course = Course::find($id);

        if(Auth::user()->id !== $course->user->id)
            return redirect()->back();

        return view('video.create')->with('id', $id);
    }

    public function postAddVideo(Request $request, $id)
    {
        $course = Course::find($id);

        if(Auth::user()->id !== $course->user->id)
            return redirect()->back();

        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required',
            'video' => 'required',
        ]);

        $params = [
            'title' => $request->input('title'),
        ];

        $video_id = Youtube::upload($request->file('video'));

        $video = new Video;
        $video->title = $request->input('title');
        $video->description = $request->input('description');
        $video->url = $video_id;

        $video->save();

        $course->videos()->save($video);

        return redirect()
            ->route('course.show', ['id' => $id])
            ->with('info', 'Video has been uploaded');
    }

    public function getVideo($id, $video)
    {
        $course = Course::find($id);
        $video = Video::find($video);

        return view('video.index')->with('video', $video)->with('course', $course);
    }

    public function getDiscussion($id)
    {
        $course = Course::find($id);

        $posts = $course->posts;

        return view('course.discussion')
            ->with('course', $course)
            ->with('posts', $posts);
    }

    public function getJoin($id)
    {
        $course = Course::find($id);

        $course->users()->attach(Auth::user()->id);

        return redirect()->route('course.getDiscussion', ['id' => $course->id]);

    }
}
