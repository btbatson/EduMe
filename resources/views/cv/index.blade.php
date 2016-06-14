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
				  <li role="presentation"><a href="{{ route('profile.index', ['username' => $user->username ? $user->username : $user->id ]) }}">Timeline</a></li>
				  <li role="presentation" class="active"><a href="{{ route('profile.cv', ['username' => $user->username ? $user->username : $user->id ]) }}">CV</a></li>
				</ul>
			</div>
		</div>
        <div class="row">
			<div class="col-md-8 cvsection">
				<h1>Education
					@if($user->id === Auth::user()->id)
				        <a href="{{route('cv.addEducation')}}" class="btn btn-default"><h5>Add Education</h5></a>
			        @endif
				</h1>
				@foreach($educations as $e)
					<div class="row">
						<div class="jumbotron">
						  <h4>{{ $e->school_name }}</h4>
						  <h5>{{ $e->start_date->format('Y-m-d') }}</h5>
						  <h5>{{ (bool)$e->end_date ? $e->end_date->format('Y-m-d') : 'still studying' }}</h5>
						  <p>{{ $e->description}}</p>
						</div>
					</div>
				@endforeach
			</div>
		</div>

		<div class="row">
			<div class="col-md-8 cvsection">
				<h1>Experience
					@if($user->id === Auth::user()->id)
				        <a href="{{route('cv.addExperience')}}" class="btn btn-default"><h5>Add Experience</h5></a>
			        @endif
				</h1>
				@foreach($experiences as $e)
					<div class="row">
						<div class="jumbotron">
						  <h3>{{ $e->company_name }}</h3>
						  <h4>{{ $e->title }}</h4>
						  <h5>{{ $e->start_date->format('Y-m-d') }}</h5>
						  <h5>{{ (bool)$e->end_date ? $e->end_date->format('Y-m-d') : 'still working' }}</h5>
						  <p>{{ $e->description}}</p>
						</div>
					</div>
				@endforeach
			</div>
		</div>

		<div class="row">
			<div class="col-md-8 cvsection">
				<h1>Projects
					@if($user->id === Auth::user()->id)
				        <a href="{{route('cv.addProject')}}" class="btn btn-default"><h5>Add Project</h5></a>
			        @endif
				</h1>
				@foreach($projects as $e)
					<div class="row">
						<div class="jumbotron">
						  <h3>{{ $e->title }}</h3>
						  @if((bool)$e->url)
						  	<h5><a href="{{$e->url}}">Visit Project</a></h5>
						  @endif
						  <p>{{ $e->description}}</p>
						</div>
					</div>
				@endforeach
			</div>
		</div>

		<div class="row">
			<div class="col-md-8 cvsection">
				<h1>Skills
					@if($user->id === Auth::user()->id)
				        <a href="{{route('cv.addSkill')}}" class="btn btn-default"><h5>Add Skill</h5></a>
			        @endif
				</h1>
				
				<div class="row">
					<div class="jumbotron">
						@foreach($skills as $e)
						  <span class="label label-default">{{ $e->skill }}</span>
						@endforeach
					</div>
				</div>
				
			</div>
		</div>

		<div class="row">
			<div class="col-md-8 cvsection">
				<h1>Interests
					@if($user->id === Auth::user()->id)
				        <a href="{{route('cv.addInterest')}}" class="btn btn-default"><h5>Add Interest</h5></a>
			        @endif
				</h1>
				
				<div class="row">
					<div class="jumbotron">
						@foreach($interests as $e)
						  <span class="label label-default">{{ $e->interest }}</span>
						@endforeach
					</div>
				</div>
				
			</div>
		</div>
</div>
@endsection