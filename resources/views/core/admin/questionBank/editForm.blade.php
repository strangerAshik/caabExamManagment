@section('licenceTypeEdit')
@foreach($licenceTypes as $info)
<div class="modal fade" id="licenceTypeEdit{{$info->id}}" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Update Licence Type</h4>
        </div>
        <div class="modal-body">
          
          {!!Form::open(array('url'=>'updateLicenceType','method'=>'post','class'=>'form-horizontal','data-toggle'=>'validator','role'=>'form','files'=>'true'))!!}
          {!! csrf_field() !!}
          {!!Form::hidden('id',$info->id)!!}
			<div class="form-group">
		   		<label for="inputEmail3" class="col-md-3 control-label">Licence Type</label>
			    <div class="col-sm-9">
			       <input required="" type="text" name="licence_type" value="{{$info->licence_type}}" class="form-control"  placeholder=" ">
			    </div>
		    </div>

		   <div class="form-group">
		        <label class="control-label col-md-4"></label>
		        <div class="text-right col-md-8">
		            <div id="button1idGroup" class="btn-group pull-right" role="group" aria-label="">
		                <button type="reset" id="button1id" name="button1id" class="btn btn-default" aria-label="Cancel">Cancel</button>
		                <button type="submit" id="button2id" name="button2id" class="btn btn-success" aria-label="Cancel">Save</button>
		            </div>

		        </div>
		    </div>

          {!!Form::close()!!}
        </div>
        
      </div>
    </div>
  </div>
</div>
@endforeach
@stop
@section('subjectEdit')
@foreach($subjects as $info)
<div class="modal fade" id="subjectEdit{{$info->id}}" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Update Subject</h4>
        </div>
        <div class="modal-body">
          {!!Form::open(array('url'=>'updateSubject','method'=>'post','class'=>'form-horizontal','data-toggle'=>'validator','role'=>'form','files'=>'true'))!!}
          {!! csrf_field() !!}
          {!!Form::hidden('id',$info->id)!!}
				
			<div class="form-group">
		   		<label for="inputEmail3" class="col-md-3 control-label">Licence Type</label>
			    <div class="col-sm-9">
			     <select required="" name="licence_type_id" placeholder=""class="form-control">
				  <option value="">Select Licence type.....</option>
				  
				  @foreach($licenceTypes as $lice)
				   	@if($info->licence_type_id==$lice->id)
				 	 <option selected="" value="{{$lice->id}}">{{$lice->licence_type}}</option>
				 	@else
					 <option value="{{$lice->id}}">{{$lice->licence_type}}</option>
				 	@endif
				  @endforeach
				</select>
			    </div>
		    </div>
			<div class="form-group">
		   		<label for="inputEmail3" class="col-md-3 control-label">Subject</label>
			    <div class="col-sm-9">
			       <input required="" type="text" name="subject" value="{{$info->subject}}" class="form-control"  placeholder=" ">
			    </div>
		    </div>

		   <div class="form-group">
		        <label class="control-label col-md-4"></label>
		        <div class="text-right col-md-8">
		            <div id="button1idGroup" class="btn-group pull-right" role="group" aria-label="">
		                <button type="reset" id="button1id" name="button1id" class="btn btn-default" aria-label="Cancel">Cancel</button>
		                <button type="submit" id="button2id" name="button2id" class="btn btn-success" aria-label="Cancel">Save</button>
		            </div>

		        </div>
		    </div>

          {!!Form::close()!!}
        </div>
        
      </div>
    </div>
  </div>
</div>
@endforeach
@stop
@section('chapterEdit')
@foreach($chapters as $chap)
<div class="modal fade" id="chapterEdit{{$chap->id}}" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Chapter</h4>
        </div>
        <div class="modal-body">
           {!!Form::open(array('url'=>'updateChapter','method'=>'post','class'=>'form-horizontal','data-toggle'=>'validator','role'=>'form','files'=>'true'))!!}
          {!! csrf_field() !!}
          {!!Form::hidden('id',$chap->id)!!}
			
			<div class="form-group">
		   		<label for="inputEmail3" class="col-md-3 control-label">Licence Type</label>
			    <div class="col-sm-9">
			     <select required="" name="licence_type_id" placeholder=""class="form-control">
				  <option value="">Select Licence type......</option>
				  @foreach($licenceTypes as $info)
				  	@if($info->id==$chap->licence_type_id)
					 <option selected="" value="{{$info->id}}">{{$info->licence_type}}</option>
				  	@else
				  	 <option value="{{$info->id}}">{{$info->licence_type}}</option>
				  	@endif
				  @endforeach
				</select>
			    </div>
		    </div>
			<div class="form-group">
		   		<label for="inputEmail3" class="col-md-3 control-label">Subject</label>
			    <div class="col-sm-9">
			     <select required="" name="subject_id" placeholder=""class="form-control">
				  <option value="">Select Subject ......</option>
				  @foreach($subjects as $info)
					  
					@if($info->id==$chap->subject_id)
					 <option selected="" value="{{$info->id}}">{{$info->subject.' ( '.$info->licence_type.' ) '}}</option>
				  	@else
				  	 <option value="{{$info->id}}">{{$info->subject.' ( '.$info->licence_type.' ) '}}</option>
				  	@endif
				  @endforeach
				</select>
			    </div>
		    </div>
			<div class="form-group">
		   		<label for="inputEmail3" class="col-md-3 control-label">Chapter</label>
			    <div class="col-sm-9">
			       <input required="" type="text" name="chapter" value="{{$chap->chapter}}" class="form-control"  placeholder=" ">
			    </div>
		    </div>
		    <div class="form-group">
		   		<label for="inputEmail3" class="col-md-3 control-label">Question Numebr</label>
			    <div class="col-sm-9">
			       <input type="number" value="{{$chap->question_number}}" name="question_number" class="form-control"  placeholder=" ">
			    </div>
		    </div>


		   <div class="form-group">
		        <label class="control-label col-md-4"></label>
		        <div class="text-right col-md-8">
		            <div id="button1idGroup" class="btn-group pull-right" role="group" aria-label="">
		                <button type="reset" id="button1id" name="button1id" class="btn btn-default" aria-label="Cancel">Cancel</button>
		                <button type="submit" id="button2id" name="button2id" class="btn btn-success" aria-label="Cancel">Save</button>
		            </div>

		        </div>
		    </div>

          {!!Form::close()!!}
        </div>
       
      </div>
    </div>
  </div>
</div>
@endforeach
@stop