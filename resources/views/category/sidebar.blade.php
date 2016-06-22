<div class="sidebar">
	<ul>
	@foreach($categories as $category)
		<li class="{{ url()->current() == route('course.category', ['id' => $category->id]) ? 'active' : '' }}"><a href="{{route('course.category', ['id' => $category->id])}}">{{$category->name}}</a></li>
	@endforeach
	</ul>
</div>