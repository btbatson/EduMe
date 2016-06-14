@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Update profile</h3>
    
    <div class="row">
        <div class="col-md-6 insertform">
            <form action="" method="POST" role="form" method="POST" enctype="multipart/form-data" action="{{ route('profile.edit') }}">
                {!! csrf_field() !!}
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                            <label for="firstname" class="control-label">Firstname</label>
                            <input type="text" class="form-control" id="" name="firstname" value="{{ old('firstname') ?: Auth::user()->firstname }}">
                            @if($errors->has('firstname'))
                                <span class="help-block">{{ $errors->first('firstname') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                            <label for="lastname" class="control-label">Lasttname</label>
                            <input type="text" class="form-control" id="" name="lastname" value="{{ old('lastname') ?: Auth::user()->lastname }}">
                            @if($errors->has('lastname'))
                                <span class="help-block">{{ $errors->first('lastname') }}</span>
                            @endif
                        </div>
                    </div>

                </div>

                <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                    <label for="username" class="control-label">Username</label>
                    <input type="text" class="form-control" id="" name="username" value="{{ old('username') ?: Auth::user()->username }}">
                    @if($errors->has('username'))
                        <span class="help-block">{{ $errors->first('username') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-offset-4 col-md-4">
                            <img src="{{Auth::user()->profile_pic}}" style="width: 100%;" alt="">
                        </div>
                    </div>
                </div>

                <div class="form-group{{ $errors->has('profile_pic') ? ' has-error' : '' }}">
                    <label for="profile_pic" class="control-label">Profile Picture</label>
                    <input type="file" class="form-control" id="" name="profile_pic" value="">
                    @if($errors->has('profile_pic'))
                        <span class="help-block">{{ $errors->first('profile_pic') }}</span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="control-label">email</label>
                    <input type="text" class="form-control" id="" name="email" value="{{ old('email') ?: Auth::user()->email }}">
                    @if($errors->has('email'))
                        <span class="help-block">{{ $errors->first('email') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            
            </form>
        </div>
    </div>
</div>
@endsection