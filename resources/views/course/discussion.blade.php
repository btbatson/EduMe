@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Discussion</h3>
    
    <div class="row">
        <div class="col-md-3">
            @include('course.sidebar')
        </div>
        <div class="col-md-8">
        	@if(Auth::user()->isAttend($course) or $course->isOwner(Auth::user()))
        		<form action="{{route('course.post.add', ['id' => $course->id])}}" method="POST" role="form">
					{!! csrf_field() !!}
					<div class="form-group{{ $errors->has('post') ? ' has-error' : '' }}">
						<textarea placeholder="what's up {{ Auth::user()->firstname }} ?" name="post" class="form-control" row="2"></textarea>
						@if($errors->has('post'))
                            <span class="help-block">{{ $errors->first('post') }}</span>
                        @endif
					</div>
				
					<button type="submit" class="btn btn-default">Post</button>
				</form>
				<hr>
				@if(!$posts->count())
					<p>start Discussion Now</p>
				@else
					@include('partials.coursepostblock')
				@endif
        	@else
				<p>please join the course to enter discussion section</p>
        	@endif
            
        </div>
    </div>
</div>
@endsection