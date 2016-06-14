@extends('layouts.app')

@section('content')
<div class="container">
    <h3>{{ $course->title }}
        @if($course->owner->id === Auth::user()->id)
            <a href="{{route('course.addVideo', [ 'id' => $course->id ])}}" class="btn btn-primary"><h5>Add Video</h5></a>
        @elseif(!Auth::user()->isAttend($course))
            <a href="{{route('course.getJoin', [ 'id' => $course->id ])}}" class="btn btn-primary"><h5>Join</h5></a>
        @endif
    </h3>
    
    <div class="row">
        <div class="col-md-3">
            @include('course.sidebar')
        </div>
        <div class="col-md-8 course">
            <img src="{{ asset($course->thumbnail)}}" style="
            width: 90%;
            margin: 0 auto;
            display: block;">
            <h4>Description: </h4>
            <p>{{ $course->description }}</p>

            <h4>Requirement: </h4>
            <p>{{ $course->requirement }}</p>
            <h5>Skills: </h5>
            <ul>
            	@foreach($course->skills as $skill)
            		<li>{{ $skill->skill }}</li>
            	@endforeach
            </ul>
        </div>
    </div>
</div>
@endsection