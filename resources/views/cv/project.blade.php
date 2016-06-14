@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Add project</h3>
    
    <div class="row">
        <div class="col-md-6 insertform">
            <form action="" method="POST" role="form" method="POST" action="{{ route('cv.addProject') }}">
                {!! csrf_field() !!}

                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    <label for="title" class="control-label">Project Title</label>
                    <input type="text" class="form-control" id="" name="title" value="{{ old('title') }}">
                    @if($errors->has('title'))
                        <span class="help-block">{{ $errors->first('title') }}</span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                    <label for="description" class="control-label">Description</label>
                    <textarea type="text" class="form-control" id="" name="description" rows="3">{{ old('description') }}</textarea>
                    @if($errors->has('description'))
                        <span class="help-block">{{ $errors->first('description') }}</span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                    <label for="url" class="control-label">Project Url</label>
                    <input type="text" class="form-control" id="" name="url" value="{{ old('url') }}">
                    @if($errors->has('url'))
                        <span class="help-block">{{ $errors->first('url') }}</span>
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