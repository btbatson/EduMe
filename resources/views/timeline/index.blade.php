@extends('layouts.app')

@section('content')
<section id="timeline">
	<div class="container">
		<div class="col-md-9">
			<div class="row">
				<div class="col-md-12 addPost">
					<form action="{{route('post.add')}}" method="POST">
					{!! csrf_field() !!}
						<div class="row header">
							<div class="col-xs-6">
								<img src="{{ asset('/') }}images/post.png" alt="">
								<p>Post</p>
							</div>
							<div class="vl"></div>
							<div class="col-xs-6">
								<img src="{{ asset('/') }}images/video1.png" alt="">
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

			@if(!$posts->count())
				<p>There's nothing in your timeline yet</p>
			@else
				@include('partials.postblock')
			@endif

		</div>
		<div class="col-md-3">
			@include('chat.list')
		</div>
	</div>
</section>
@endsection