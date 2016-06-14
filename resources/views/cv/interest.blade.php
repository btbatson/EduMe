@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Add interest</h3>
    
    <div class="row">
        <div class="col-md-6 insertform">
            <form action="" method="POST" role="form" method="POST" action="{{ route('cv.addInterest') }}">
                {!! csrf_field() !!}

                <div class="form-group{{ $errors->has('interest') ? ' has-error' : '' }}">
                    <label for="interest" class="control-label">interest</label>
                    <input type="text" class="form-control" id="" name="interest" value="{{ old('interest') }}">
                    @if($errors->has('interest'))
                        <span class="help-block">{{ $errors->first('interest') }}</span>
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