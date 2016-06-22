@extends('layouts.app')

@section('content')
<section id="courses">
    <div class="container">
        <div class="col-md-3">
            @include('category.sidebar')
        </div>
        <div class="col-md-9">
            <div class="row">
            @foreach($courses as $course)
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <a href="{{ route('course.show', ['id' => $course->id]) }}">
                            <img src="{{ asset($course->thumbnail) }}" alt="">
                        </a>
                        <div class="caption">
                            <h3><a href="{{ route('course.show', ['id' => $course->id]) }}">{{$course->title}}</a></h3>
                                <p>{{$course->description}}</p>
                                <p class="instructor">Instructor: <a href="{{ route('profile.index', ['username' => $course->owner->username ? $course->owner->username : $course->owner->id ]) }}"><img src="{{ $course->owner->getAvatarUrl() }}" alt=""></a></p>
                                <div class="star-rating">
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star-o"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection