@extends('layouts.app')

@section('content')
<div class="container">
    <h3>{{ $video->title }}
        @if($course->owner->id === Auth::user()->id)
            <!-- <a href="#" class="btn btn-primary"><h5>Edit video</h5></a> -->
        @endif
    </h3>
    
    <div class="row">
        <div class="col-md-3">
            @include('course.sidebar')
        </div>
        <div class="col-md-8 course">
            <div class="text-center">
	            <iframe width="640" height="360" src="https://www.youtube.com/embed/{{$video->url}}?rel=0&amp;showinfo=0&amp;modestbranding=1" frameborder="0" allowfullscreen></iframe>
            </div>
            <h4>Description: </h4>
            <p>{{ $video->description }}</p>
        </div>
    </div>
</div>
@endsection