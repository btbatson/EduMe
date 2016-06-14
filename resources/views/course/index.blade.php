@extends('layouts.app')

@section('content')
<div class="container">
    <h3><a href="{{route('course.addCourse')}}" class="btn btn-primary">Add Course</a></h3>

    <div class="row">
        <div class="col-md-3">
            @include('category.sidebar')
        </div>
        <div class="col-md-8">
            <div class="row">
                @foreach($courses as $course)
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <a href="{{ route('course.show', ['id' => $course->id]) }}"><img src="{{ asset($course->thumbnail) }}" alt="..."></a>
                            <div class="caption">
                                <h3><a href="{{ route('course.show', ['id' => $course->id]) }}">{{$course->title}}</a></h3>
                                <p>{{$course->description}}</p>
                                
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection