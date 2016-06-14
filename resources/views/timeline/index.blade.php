@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row">
			<div class="col-md-8 addPost">
				<form action="{{route('post.add')}}" method="POST" role="form">
					<p class="apost text-center">
						<img src="{{asset('images/Forma-3.png')}}">
						<span>Post</span>
					</p>
					{!! csrf_field() !!}
					<div class="form-group{{ $errors->has('post') ? ' has-error' : '' }}">
						<textarea placeholder="what's up {{ Auth::user()->firstname }} ?" name="post" class="form-control" row="2"></textarea>
						@if($errors->has('post'))
                            <span class="help-block">{{ $errors->first('post') }}</span>
                        @endif
					</div>
				
					<button type="submit" class="btn btn-default">Post</button>
				</form>
				
			</div>
		</div>
		<div class="row">
			<div class="col-md-8">
			<hr>
				@if(!$posts->count())
					<p>There's nothing in your timeline yet</p>
				@else
					@include('partials.postblock')
				@endif
			</div>
		</div>
</div>
@endsection