@extends('layouts.app')

@section('content')
<section id="timeline">
	<div class="container">
		<div class="col-md-12 cover">
			<div class="col-md-offset-1 col-md-8">
				<div class="media">
					<div class="media-left">
						<a href="{{ route('profile.index', ['username' => $user->username ? $user->username : $user->id ]) }}">
							<img class="media-object avatar" src="{{ $user->getAvatarUrl() }}" alt="">
						</a>
					</div>
					<div class="media-body">
						<h4 class="media-heading">{{ $user->getName() }}</h4>
						<ul class="nav nav-tabs">     
							<li role="presentation" class="active"><a href="{{ route('profile.index', ['username' => $user->username ? $user->username : $user->id ]) }}">Timeline</a></li>
							<li role="presentation"><a href="{{ route('profile.cv', ['username' => $user->username ? $user->username : $user->id ]) }}">CV</a></li>
							<li role="presentation"><a href="#">Friends</a></li>
						</ul>
					</div>

				</div>
			</div>
			<div class="col-md-3">
				@if(Auth::user()->hasFriendRequestPinding($user))
				<button type="button" class="btn btn-green">Pending</button>
				@elseif(Auth::user()->hasFriendRequestReceived($user))
					<a href="{{ route('profile.acceptFriend', ['username' => $user->username ? $user->username : $user->id ])}}" class="btn btn-green">Accept friend request</a>
				@elseif(Auth::user()->isFriendWith($user))
					<form action="{{ route('profile.deleteFriend', ['username' => $user->username ? $user->username : $user->id ])}}" method="POST">
						{!! csrf_field() !!}
						<input type="submit" value="Delete friend" class="btn btn-green">
					</form>
				@elseif(Auth::user()->id !== $user->id)
					<a href="{{ route('profile.addFriend', ['username' => $user->username ? $user->username : $user->id ])}}" class="btn btn-green">Add friend</a>
				@endif
			</div>
		</div>
		<div class="col-md-9">

			@if(!$posts->count())
				<p>{{$user->firstname}} hasn't post anything yet</p>
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