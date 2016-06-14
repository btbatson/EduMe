@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row">
			<div class="col-md-8">
				<div class="post">
					@include('user.userblock')
				</div>
				<hr>
				<ul class="nav nav-tabs">
				  <li role="presentation" class="active"><a href="{{ route('profile.index', ['username' => $user->username ? $user->username : $user->id ]) }}">Timeline</a></li>
				  <li role="presentation"><a href="{{ route('profile.cv', ['username' => $user->username ? $user->username : $user->id ]) }}">CV</a></li>
				</ul>

				@if(!$posts->count())
					<p>{{$user->firstname}} hasn't post anything yet</p>
				@else
					@include('partials.postblock')
				@endif
			</div>
			<div class="col-md-4">
				@if(Auth::user()->hasFriendRequestPinding($user))
					<p>Waiting for {{ $user->getName() }} to accept your request.</p>
				@elseif(Auth::user()->hasFriendRequestReceived($user))
					<a href="{{ route('profile.acceptFriend', ['username' => $user->username ? $user->username : $user->id ])}}" class="btn btn-primary">Accept friend request</a>
				@elseif(Auth::user()->isFriendWith($user))
					<p>You and {{ $user->getName() }} are friends</p>
					<form action="{{ route('profile.deleteFriend', ['username' => $user->username ? $user->username : $user->id ])}}" method="POST">
						{!! csrf_field() !!}
						<input type="submit" value="Delete friend" class="btn btn-primary">
					</form>
				@elseif(Auth::user()->id !== $user->id)
					<a href="{{ route('profile.addFriend', ['username' => $user->username ? $user->username : $user->id ])}}" class="btn btn-primary">Add friend</a>
				@endif
				<a href="{{ route('chat.messages', ['id' => $user->id ])}}" class="btn btn-primary">Send Message</a>


				<h4>{{ $user->firstname }}'s friends.</h4>
				@if(!$user->friends()->count())
					<p>{{ $user->firstname }} has no friends.</p>
				@else
					@foreach($user->friends() as $user)
						@include('user.userblock')
					@endforeach
				@endif

			</div>
		</div>
</div>
@endsection