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

				<div class="row">
					<div class="col-md-12 addPost">
						<form action="{{route('course.post.add', ['id' => $course->id])}}" method="POST">
						{!! csrf_field() !!}
							<div class="row header">
								<div class="col-xs-6">
								<img src="{{asset('/')}}images/post.png" alt="">
									<p>Post</p>
								</div>
								<div class="vl"></div>
								<div class="col-xs-6">
									<img src="{{asset('/')}}images/video1.png" alt="">
									<p>Video</p>
								</div>

							</div>
							<div class="form-group{{ $errors->has('post') ? ' has-error' : '' }}">
								<textarea placeholder="what's up {{ Auth::user()->firstname }} ?" name="post" class="form-control" rows="4"></textarea>
								@if($errors->has('post'))
		                            <span class="help-block">{{ $errors->first('post') }}</span>
		                        @endif
							</div>
							<button type="submit" class="btn btn-green">Post</button>
						</form>
					</div>
				</div>
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