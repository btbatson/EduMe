<div class="list-group">
	@foreach($categories as $category)
		<a href="{{route('course.category', ['id' => $category->id])}}" class="list-group-item {{ url()->current() == route('course.category', ['id' => $category->id]) ? 'active' : '' }}">{{$category->name}}</a>
	@endforeach
</div>