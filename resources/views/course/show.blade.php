@extends('layouts.app')

@section('content')

<section id="course">
    <div class="container">
        <h3>{{ $course->title }}
            @if($course->owner->id === Auth::user()->id)
                <a href="{{route('course.addVideo', [ 'id' => $course->id ])}}" class="btn btn-primary"><h5>Add Video</h5></a>
            @elseif(!Auth::user()->isAttend($course))
                <a href="{{route('course.getJoin', [ 'id' => $course->id ])}}" class="btn btn-primary"><h5>Join</h5></a>
            @endif
        </h3>
        <div class="col-md-3">
            <div class="sidebar course">
                @include('course.sidebar')
            </div>
        </div>
        <div class="col-md-9">
            <div class="row r1">
                <div class="col-md-offset-1 col-md-10">
                    <img src="{{ asset($course->thumbnail)}}" style="width:100%;" alt="">
                </div>
            </div>

            <p class="bold">Description: </p>
            <p class="light">{{ $course->description }}</p>

            <p class="bold">Requirement: </p>
            <p class="light">{{ $course->requirement }}</p>
            <p class="bold">Skills: </p>
            <ul>
                @foreach($course->skills as $skill)
                    <li>{{ $skill->skill }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</section>
@endsection