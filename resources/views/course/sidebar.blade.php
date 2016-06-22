<div class="sidebar course">
	<ul>
		<li class="{{ url()->current() == route('course.show', ['id' => $course->id]) ? 'active' : '' }}"><a href="{{ route('course.show', ['id' => $course->id]) }}">Introduction</a></li>

		<li class="{{ url()->current() == route('course.getDiscussion', ['id' => $course->id]) ? 'active' : '' }}"><a href="{{ route('course.getDiscussion', ['id' => $course->id]) }}">Discussion</a></li>
		@foreach($course->videos as $video)
		<li class="{{ url()->current() == route('course.getVideo', ['id' => $course->id, 'video' => $video->id]) ? 'active' : '' }}"><a href="{{ route('course.getVideo', ['id' => $course->id, 'video' => $video->id]) }}">{{$video->title}}</a></li>
		@endforeach
	</ul>
</div>