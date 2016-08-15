@extends('core.layout.layoutExamine')
@section('content')
<div class="row">
	<div class="col-md-12">
	
	{!!Form::open(array('url'=>'examine/personalInfo/updateAccademicInfos','method'=>'post','class'=>'form-horizontal','data-toggle'=>'validator','role'=>'form','files'=>'true'))!!}
                     {!! csrf_field() !!}
           
      
	{!!Form::hidden('id',$infos->id)!!}
	  <div class="form-group">	   
	   <label for="" class="col-md-3 control-label">Degree Name</label>
		    <div class="col-md-4">
		       <input  type="text" name="degree_name" value="{{$infos->degree_name}}" class="form-control"  placeholder=" ">
		    </div>
	  </div>
	  <div class="form-group">
            <label for="exampleInputEmail1" class="col-md-3 control-label">Session Start Date</label>
            <div class="col-sm-4">
               <div class="input-group">
                  <div class="input-group-addon glyphicon glyphicon-calendar"></div>
                  <input name="start_date" value="{{$infos->start_date}}" type='text' class="form-control dateExam" placeholder="DD/MM/YYYY"/>
               </div>
            </div>
         </div>
         <div class="form-group">
            <label for="exampleInputEmail1" class="col-md-3 control-label">Session End Date</label>
            <div class="col-sm-4">
               <div class="input-group">
                  <div class="input-group-addon glyphicon glyphicon-calendar"></div>
                  <input name="end_date" value="{{$infos->end_date}}" type='text' class="form-control dateExam" placeholder="DD/MM/YYYY"/>
               </div>
            </div>
         </div>
	  <div class="form-group">	   
	   <label for="" class="col-md-3 control-label">Institute</label>
		    <div class="col-md-4">
		       <input  type="text" name="institute" value="{{$infos->institute}}"  class="form-control"  placeholder=" ">
		    </div>
	  </div>
	  <div class="form-group">	   
	   <label for="" class="col-md-3 control-label">Subject</label>
		    <div class="col-md-4">
		       <input  type="text" name="subject" value="{{$infos->subject}}" class="form-control"  placeholder=" ">
		    </div>
	  </div>
	  <div class="form-group">	   
	   <label for="" class="col-md-3 control-label">Result</label>
		    <div class="col-md-4">
		       <input  type="text" name="result" value="{{$infos->result}}" class="form-control"  placeholder=" ">
		    </div>
	  </div>

	  <div class="form-group">	   
	   <label for="" class="col-md-3 control-label">Existing Document(s) </label>
		    <div class="col-md-4">
		       <?php $images=App\AdminModel::getDocuments('academic_infos', $infos->id) ?>
                @if($images)
                    @foreach($images as $img)
                     <a  href="{{asset('public/documents/'.$img->calling_id)}}" alt="Examine Photo" >{{$img->doc_name}}</a>
                     	<a  style="color: red" onclick="return confirm('Wanna Delete?');" href="{{url('deleteBack/documents/'.$img->id)}}">[Delete]</a>
                    
                     @endforeach
                @else 
                    No Document 
                @endif
		    </div>
	  </div>

	<div class="form-group">	   
		   <label for="" class="col-md-3 control-label">Document(s)</label>
			    <div class="col-md-4">			     
	                   <input class="" type="file" name="docs[]" multiple="true" >
			    </div>
	</div>

	  

	  
	   <div class="form-group">
	        <label class="control-label col-md-4"></label>
	        <div class="text-right col-md-3">
	            <div id="button1idGroup" class="btn-group pull-right" role="group" aria-label="">
	                <button type="reset" id="button1id" name="button1id" class="btn btn-default" aria-label="Cancel">Cancel</button>
	                <button type="submit" id="button2id" name="button2id" class="btn btn-success" aria-label="Cancel">Update </button>
	            </div>

	        </div>
	    </div>
	{!!Form::close()!!}
</div>
</div>

@stop