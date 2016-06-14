@extends('layouts.app')

@section('head')
<link rel='stylesheet' href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
<div class="container">
    <h3>Add Course</h3>
    
    <div class="row">
        <div class="col-md-6 insertform">
            <form role="form" method="POST" action="{{ route('course.addCourse') }}" enctype="multipart/form-data">
                {!! csrf_field() !!}

                <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                    <label for="category" class="control-label">category</label>
                    <select class="form-control" id="category" name="category">
                		@foreach($categories as $category)
							<option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected="selected"' : ''}}>{{ $category->name }}</option>
						@endforeach
					</select>
                    @if($errors->has('category'))
                        <span class="help-block">{{ $errors->first('category') }}</span>
                    @endif
                </div>
                
                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    <label for="title" class="control-label">Title</label>
                    <input type="text" class="form-control" id="" name="title" value="{{ old('title') }}">
                    @if($errors->has('title'))
                        <span class="help-block">{{ $errors->first('title') }}</span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('thumbnail') ? ' has-error' : '' }}">
                    <label for="thumbnail" class="control-label">Thumbnail</label>
                    <input type="file" class="form-control" id="" name="thumbnail" value="{{ old('thumbnail') }}">
                    @if($errors->has('thumbnail'))
                        <span class="help-block">{{ $errors->first('thumbnail') }}</span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                    <label for="description" class="control-label">Description</label>
                    <textarea class="form-control" id="" name="description" rows="3">{{ old('description') }}</textarea>
                    @if($errors->has('description'))
                        <span class="help-block">{{ $errors->first('description') }}</span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('requirement') ? ' has-error' : '' }}">
                    <label for="requirement" class="control-label">Requirement</label>
                    <textarea class="form-control" id="" name="requirement" rows="3">{{ old('requirement') }}</textarea>
                    @if($errors->has('requirement'))
                        <span class="help-block">{{ $errors->first('requirement') }}</span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('skills') ? ' has-error' : '' }}">
                    <label for="skills" class="control-label">Skills</label>
                    <select class="form-control" id="skills" name="skills[]" multiple="multiple">
                    	
                    	@foreach($skillslist as $skill)
					        <option value="{{$skill}}" 
					        @if(old('skills')) 
						        @foreach(old('skills') as $p) 
							        @if($skill == $p)
								        selected="selected"
							        @endif 
						        @endforeach 
					        @endif >{{$skill}}</option>
					    @endforeach
					</select>
                    @if($errors->has('skills'))
                        <span class="help-block">{{ $errors->first('skills') }}</span>
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

@section('footer')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>
<script type="text/javascript">
  $('#skills').select2({
  	tags:true
  });
</script>
@endsection