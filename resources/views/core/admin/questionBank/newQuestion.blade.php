@extends('core.layout.layoutAdmin')
@section('content')
<div class="row">
	<div class="col-md-12">
	
	{!!Form::open(array('url'=>'questionBank/postNewQuestion','method'=>'post','class'=>'form-horizontal','data-toggle'=>'validator','role'=>'form','files'=>'true'))!!}
                     {!! csrf_field() !!}
	  <div class="form-group">
	   
	    <label for="Licence" class="col-sm-2 control-label">Licence Type</label>
	    <div class="col-sm-2">
	      <select required="" name="licence_type" placeholder=""class="form-control" value="{{old('licence_type')}}">
		  <option value="">Select Licence Type..</option>
		  @foreach($licenceTypes as $info)
		  <option value="{{$info->id}}">{{$info->licence_type}}</option>
		  @endforeach
		</select>
		
		<a href="#"><span class="label label-primary" data-toggle="modal" data-target="#licenceType">New Licence Type</span></a>
		

	    </div>

	    <label for="inputEmail3" class="col-sm-2 control-label">Subject</label>
	    <div class="col-sm-2">
	      <select  required="" name="subject" placeholder=""class="form-control">
		  <option value="">Select Subject..</option>
		@foreach($subjects as $info)
		  <option value="{{$info->id}}">{{$info->subject.' ( '.$info->licence_type.' ) '}}</option>
		@endforeach
		  
		</select>
		<a href="#"><span class="label label-primary" data-toggle="modal" data-target="#subject">New Subject</span></a>
	    </div>
	    
	    <label for="inputEmail3" class="col-sm-2 control-label">Chapter</label>
	    <div class="col-sm-2">
	      <select  required="" name="chapter" placeholder=""class="form-control">
		  <option value="">Select Chapter..</option>
		  @foreach($chapters as $info)
		  <option value="{{$info->id}}" >{{$info->chapter.'( '.$info->licence_type . ' / '.$info->subject.' ) ' }}</option>
		  @endforeach
		</select>
		<a href="#"><span class="label label-primary" data-toggle="modal" data-target="#chapter">New Chapter</span></a>
	    </div>
	    
	  </div>
	  

	  

	  <div class="form-group">

	    <label for="inputEmail3" class="col-sm-2 control-label">Question</label>
	    <div class="col-sm-6">
	    	<textarea  required="true" name="question" class="form-control" rows="3" cols="5"  value="old('question')"></textarea>
	      
	    </div>

	    <label for="inputEmail3" class="col-sm-2 control-label">Difficulty Level</label>
	    <div class="col-sm-2">
	      <select  required="true" name="difficulty_level" placeholder=""class="form-control" value="{{old('difficulty_level')}}">
		  <option value="">Select..</option>
		  <option value="1">Low</option>
		  <option selected="" value="2">Medium</option>
		  <option value="3">High</option>
		</select>
	    </div>
	   
	  </div>

	  <div class="form-group">
		   <label for="inputEmail3" class="col-sm-2 control-label">Option-1</label>
		    <div class="col-sm-4">
		       <input required="" type="text"name="option_1" value="{{old('option_1')}}" class="form-control"  placeholder=" ">
		    </div>

		   <label for="inputEmail3" class="col-sm-2 control-label">Option-2</label>
		    <div class="col-sm-4">
		       <input required="" type="text"name="option_2" class="form-control"  placeholder=" ">
		    </div>
	  </div>

	  <div class="form-group">
		   <label for="inputEmail3" class="col-sm-2 control-label">Option-3</label>
		    <div class="col-sm-4">
		       <input required="" type="text"name="option_3" class="form-control"  placeholder=" ">
		    </div>

		   <label for="inputEmail3" class="col-sm-2 control-label">Option-4</label>
		    <div class="col-sm-4">
		       <input required="" type="text"name="option_4" class="form-control"  placeholder=" ">
		    </div>
	  </div>

	  <div class="form-group">
		   <label for="inputEmail3" class="col-sm-2 control-label">Right Answer</label>
		    <div class="col-sm-4">
		       <select required="" name="option_right" placeholder=""class="form-control">
				  <option value="">Select Answer..</option>
				  <option value="1">Option-1</option>
				  <option value="2">Option-2</option>
				  <option value="3">Option-3</option>
				  <option value="4">Option-4</option>
				</select>
		    </div>
		   <label for="inputEmail3" class="col-sm-2 control-label">Image</label>
		    <div class="col-sm-4">
		       <img id="blah"  width="100" height="100" />
                   <input  type="file" name="photo[]" multiple="true" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
		    </div>

		   
	  </div>
	  


	  <div class="form-group">
	  <label for="inputEmail3" class="col-sm-2 control-label">Note</label>
		    <div class="col-sm-10">
		 <textarea name="note" class="form-control" rows="3"></textarea>
		    </div>
	    
	   
	  </div>
	
	  
	   <div class="form-group">
	        <label class="control-label col-md-4"></label>
	        <div class="text-right col-md-8">
	            <div id="button1idGroup" class="btn-group pull-right" role="group" aria-label="">
	                <button type="reset" id="button1id" name="button1id" class="btn btn-default" aria-label="Cancel">Cancel</button>
	                <button type="submit" id="button2id" name="button2id" class="btn btn-success" aria-label="Cancel">Save Question</button>
	            </div>

	        </div>
	    </div>
	</form>
</div>
</div>

@include('core.admin.questionBank.entryForm')
@yield('licenceType')
@yield('subject')
@yield('chapter')

@stop