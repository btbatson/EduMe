@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Add education</h3>
    
    <div class="row">
        <div class="col-md-6 insertform">
            <form action="" method="POST" role="form" method="POST" action="{{ route('cv.addEducation') }}">
                {!! csrf_field() !!}

                <div class="form-group{{ $errors->has('school_name') ? ' has-error' : '' }}">
                    <label for="school_name" class="control-label">School name</label>
                    <input type="text" class="form-control" id="" name="school_name" value="{{ old('school_name') }}">
                    @if($errors->has('school_name'))
                        <span class="help-block">{{ $errors->first('school_name') }}</span>
                    @endif
                </div>
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('start_date') ? ' has-error' : '' }}">
                            <label for="start_date" class="control-label">Start date</label>
                            <input type="date" class="form-control" id="" name="start_date" value="{{ old('start_date') }}">
                            @if($errors->has('start_date'))
                                <span class="help-block">{{ $errors->first('start_date') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('end_date') ? ' has-error' : '' }}">
                            <label for="end_date" class="control-label">End date</label>
                            <input type="date" class="form-control" id="" name="end_date" value="{{ old('end_date') }}">
                            @if($errors->has('end_date'))
                                <span class="help-block">{{ $errors->first('end_date') }}</span>
                            @endif
                        </div>
                    </div>

                </div>

                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                    <label for="description" class="control-label">Description</label>
                    <textarea type="text" class="form-control" id="" name="description" rows="3">{{ old('description') }}</textarea>
                    @if($errors->has('description'))
                        <span class="help-block">{{ $errors->first('description') }}</span>
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