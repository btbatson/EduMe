@extends('layouts.app')

@section('content')
<section id="cv">
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
							<li role="presentation"><a href="{{ route('profile.index', ['username' => $user->username ? $user->username : $user->id ]) }}">Timeline</a></li>
							<li role="presentation" class="active"><a href="{{ route('profile.cv', ['username' => $user->username ? $user->username : $user->id ]) }}">CV</a></li>
							<li role="presentation"><a href="#">Friends</a></li>
						</ul>
					</div>

				</div>
			</div>
			
			<div class="col-md-3">
				@if(Auth::user()->hasFriendRequestPinding($user))
				<button type="button" class="btn btn-green">Waiting for {{ $user->getName() }} to accept your request.</button>
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
		<div class="col-md-9 cv">
			<div class="row">
				<div class="col-md-12">
					<h2>Education
					@if($user->id === Auth::user()->id)
				        <a href="{{route('cv.addEducation')}}" class="btn btn-default"><h5>Add Education</h5></a>
			        @endif
			        </h2>
			        @foreach($educations as $e)
					<div class="item">
						<p>{{ $e->school_name }}</p>
						<p>{{ $e->start_date->format('Y-m-d') }} - {{ (bool)$e->end_date ? $e->end_date->format('Y-m-d') : 'still studying' }}</p>
						<p class="description">{{ $e->description}}</p>
					</div>
					@endforeach
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<h2>Experience
					@if($user->id === Auth::user()->id)
				        <a href="{{route('cv.addExperience')}}" class="btn btn-default"><h5>Add Experience</h5></a>
			        @endif
			        </h2>
			        @foreach($experiences as $e)
					<div class="item">
						<p>{{ $e->title }} <span>at</span> {{ $e->company_name }}</p>
						<p>{{ $e->start_date->format('Y-m-d') }} - {{ (bool)$e->end_date ? $e->end_date->format('Y-m-d') : 'still working' }}</p>
						<p class="description">{{ $e->description}}</p>
					</div>
					@endforeach
				</div>
			</div>


			<div class="row">
				<div class="col-md-12">
					<h2>Projects
					@if($user->id === Auth::user()->id)
				        <a href="{{route('cv.addProject')}}" class="btn btn-default"><h5>Add Project</h5></a>
			        @endif
			        </h2>
			        @foreach($projects as $e)
					<div class="item">
						@if((bool)$e->url)
						  	<a href="{{$e->url}}">
						@endif
						<p>{{ $e->title }}</p>
						@if((bool)$e->url)
						  	</a>
						@endif
						<p class="description">{{ $e->description}}</p>
					</div>
					@endforeach
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<h2>Skills
					@if($user->id === Auth::user()->id)
				        <a href="{{route('cv.addSkill')}}" class="btn btn-default"><h5>Add Skill</h5></a>
			        @endif
			        </h2>
					<ul>
						@foreach($skills as $e)
						<li>{{ $e->skill }}</li>
						@endforeach
					</ul>

				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<h2>Interests
					@if($user->id === Auth::user()->id)
				        <a href="{{route('cv.addInterest')}}" class="btn btn-default"><h5>Add Interest</h5></a>
			        @endif
			        </h2>
					<ul>
						@foreach($interests as $e)
						<li>{{ $e->interest }}</li>
						@endforeach
					</ul>

				</div>
			</div>

		</div>
		<div class="col-md-3">

		</div>
	</div>
</section>
@endsection