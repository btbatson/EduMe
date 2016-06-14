@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Add Video</h3>
    
    <div class="row">
        <div class="col-md-6 insertform">
            <form role="form" method="POST" action="{{ route('course.addVideo', [ 'id' => $id]) }}" enctype="multipart/form-data">
                {!! csrf_field() !!}
                
                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    <label for="title" class="control-label">Title</label>
                    <input type="text" class="form-control" id="" name="title" value="{{ old('title') }}">
                    @if($errors->has('title'))
                        <span class="help-block">{{ $errors->first('title') }}</span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                    <label for="description" class="control-label">Description</label>
                    <textarea class="form-control" id="" name="description" rows="3">{{ old('description') }}</textarea>
                    @if($errors->has('description'))
                        <span class="help-block">{{ $errors->first('description') }}</span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('video') ? ' has-error' : '' }}">
                    <label for="video" class="control-label">Video</label>
                    <input type="file" class="form-control" id="" name="video" value="{{ old('video') }}">
                    @if($errors->has('video'))
                        <span class="help-block">{{ $errors->first('video') }}</span>
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