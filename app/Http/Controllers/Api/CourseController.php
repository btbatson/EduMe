<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Course;

class CourseController extends Controller
{
    public function allCourses()
    {
    	$courses = Course::all();
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
     //        'success' => 'true',
     //        'courses' => $data,
     //    ], 200);
     	return response()->json($data, 200)->header('Cache-Control', 'public');
    }

    public function getCourse(Request $request)
    {
    	if(!$request->has('course_id'))
      {
        return $this->errorMissingAttribute();
      }

    	$course = Course::find($request->input('course_id'));
    	$videos = $course->videos;

    	if(!$course)
        {
        	return response()->json([
            'success' => 'false',
            'message' => "This course doesn't exist"
	        ], 200);
        }

        $data = [
         "id" => $course->id,
          "category_id" => $course->category_id,
          "user_id" => $course->user_id,
          "title" => $course->title,
          "thumbnail" => asset($course->thumbnail),
          "description" => $course->description,
          "requirement" => $course->requirement,
          "project_title" => $course->project_title,
          "project_description" => $course->project_description,
          "created_at" => $course->created_at,
          "updated_at" => $course->updated_at,
          "videos" => $videos,
          "inestructor_name" => $course->owner->getName(),
          'inestructor_profile_pic' =>  $course->owner->profile_pic

        ];

    //     return response()->json([
    //         'success' => 'true',
    //         'course' => $data,
  		// ], 200);

  		return response()->json(
            [$data], 200)->header('Cache-Control', 'public');
    }

    public function getvideos(Request $request)
    {
      if(!$request->has('course_id'))
      {
        return $this->errorMissingAttribute();
      }

      $course = Course::find($request->input('course_id'));
      $videos = $course->videos;

      if(!$course)
      {
        return response()->json([
          'success' => 'false',
          'message' => "This course doesn't exist"
        ], 200);
      }

      // return response()->json([
      //  'success' => 'true',
      //  'lecture' => $videos,
      // ], 200)->header('Cache-Control', 'public');
      
      return response()->json($videos, 200)->header('Cache-Control', 'public');

    }
}
