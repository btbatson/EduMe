<div class="list-group">
  <a href="{{ route('course.show', ['id' => $course->id]) }}" class="list-group-item {{ url()->current() == route('course.show', ['id' => $course->id]) ? 'active' : '' }}">Introduction</a>

  <a href="{{ route('course.getDiscussion', ['id' => $course->id]) }}" class="list-group-item {{ url()->current() == route('course.getDiscussion', ['id' => $course->id]) ? 'active' : '' }}">Discussion</a>
  @foreach($course->videos as $video)
	<a href="{{ route('course.getVideo', ['id' => $course->id, 'video' => $video->id]) }}" class="list-group-item {{ url()->current() == route('course.getVideo', ['id' => $course->id, 'video' => $video->id]) ? 'active' : '' }}">{{$video->title}}</a>
  @endforeach
</div>