@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Add skill</h3>
    
    <div class="row">
        <div class="col-md-6 insertform">
            <form action="" method="POST" role="form" method="POST" action="{{ route('cv.addSkill') }}">
                {!! csrf_field() !!}

                <div class="form-group{{ $errors->has('skill') ? ' has-error' : '' }}">
                    <label for="skill" class="control-label">Skill</label>
                    <input type="text" class="form-control" id="" name="skill" value="{{ old('skill') }}">
                    @if($errors->has('skill'))
                        <span class="help-block">{{ $errors->first('skill') }}</span>
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