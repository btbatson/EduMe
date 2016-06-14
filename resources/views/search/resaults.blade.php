@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Your search fore "{{ Request::input('quary') }}"</h3>
    
    @if(!$users->count())
        <p>No resaults found.</p>
    @else
        <div class="row">
            <div class="col-md-12">
                @foreach($users as $user)
                    @include('user.userblock')
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection