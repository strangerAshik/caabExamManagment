@section('licenceType')

<div class="modal fade" id="licenceType" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Licence Type</h4>
        </div>
        <div class="modal-body">
          
          {!!Form::open(array('url'=>'postLicenceType','method'=>'post','class'=>'form-horizontal','data-toggle'=>'validator','role'=>'form','files'=>'true'))!!}
          {!! csrf_field() !!}
			<div class="form-group">
		   		<label for="inputEmail3" class="col-md-3 control-label">Licence Type</label>
			    <div class="col-sm-9">
			       <input required="" type="text" name="licence_type" class="form-control"  placeholder=" ">
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
@stop
@section('subject')

<div class="modal fade" id="subject" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Subject</h4>
        </div>
        <div class="modal-body">
          {!!Form::open(array('url'=>'postSubject','method'=>'post','class'=>'form-horizontal','data-toggle'=>'validator','role'=>'form','files'=>'true'))!!}
          {!! csrf_field() !!}
				
			<div class="form-group">
		   		<label for="inputEmail3" class="col-md-3 control-label">Licence Type</label>
			    <div class="col-sm-9">
			     <select required="" name="licence_type_id" placeholder=""class="form-control">
				  <option value="">Select Licence type......</option>
				   @foreach($licenceTypes as $info)
				  <option value="{{$info->id}}">{{$info->licence_type}}</option>
				  @endforeach
				</select>
			    </div>
		    </div>
			<div class="form-group">
		   		<label for="inputEmail3" class="col-md-3 control-label">Subject</label>
			    <div class="col-sm-9">
			       <input required="" type="text" name="subject" class="form-control"  placeholder=" ">
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
@stop
@section('chapter')

<div class="modal fade" id="chapter" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Chapte</h4>
        </div>
        <div class="modal-body">
           {!!Form::open(array('url'=>'postChapter','method'=>'post','class'=>'form-horizontal','data-toggle'=>'validator','role'=>'form','files'=>'true'))!!}
          {!! csrf_field() !!}
			
			<div class="form-group">
		   		<label for="inputEmail3" class="col-md-3 control-label">Licence Type</label>
			    <div class="col-sm-9">
			     <select required="" name="licence_type_id" placeholder=""class="form-control">
				  <option value="">Select Licence type......</option>
				  @foreach($licenceTypes as $info)
				  <option value="{{$info->id}}">{{$info->licence_type}}</option>
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
					  <option value="{{$info->id}}">{{$info->subject.' ( '.$info->licence_type.' ) '}}</option>
				   @endforeach
				</select>
			    </div>
		    </div>
			<div class="form-group">
		   		<label for="inputEmail3" class="col-md-3 control-label">Chapter</label>
			    <div class="col-sm-9">
			       <input  type="text" name="chapter" class="form-control"  placeholder=" ">
			    </div>
		    </div>
			<div class="form-group">
		   		<label for="inputEmail3" class="col-md-3 control-label">Question Numebr</label>
			    <div class="col-sm-9">
			       <input required="" type="number" name="question_number" class="form-control"  placeholder=" ">
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
@stop