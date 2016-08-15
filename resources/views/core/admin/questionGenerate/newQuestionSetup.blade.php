
@extends('core.layout.layoutAdmin')
@section('content')
<div class="row">
	<div class="col-md-12">
	
   {!!Form::open(array('url'=>'questionGenerate/newQuestionSetup2','method'=>'get','class'=>'form-horizontal','data-toggle'=>'validator','role'=>'form','files'=>'true'))!!}

	   {!! csrf_field() !!}

	  <div class="form-group">
	   
	    <label for="inputEmail3" class="col-sm-3 control-label">Select from Scheduled Exam</label>
		    <div class="col-sm-4">
		      <select placeholder="" name="exam" class="form-control" required="">
			  <option value="">Select Exam ..</option>
			  @foreach($exam as $info)
			  <option value="{{$info->id}}">{{$info->title}}</option>
           @endforeach
			  </select>	
		    </div>

		     <div class="text-left ">
	            <div id="button1idGroup" class="btn-group" role="group" aria-label="">
	                <button type="reset" id="button1id" name="button1id" class="btn btn-default" aria-label="Cancel">Cancel</button>
	                <button type="submit" id="buttonid" name="" class="btn btn-success" aria-label="Cancel">Save & Next</button>
	            </div>
	        </div>

	    </div>
	
	</form>
    </div>

    <div class="col-md-12" style="display: none">
    <hr>
    	<span class='col-md-offset-6'> OR <b>Use Exam Wizard</b></span>
     <hr>
    </div>
	<div class="col-md-12" style="display: none">
	<form class="form-horizontal" action="newQuestionSetup2">
         <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Title</label>
            <div class="col-sm-5">
               <input type="text"name="" class="form-control"  placeholder=" ">
            </div>
         </div>
         <div class="form-group">
            <label for="exampleInputEmail1" class="col-sm-2 control-label">Licence Type</label>
            <div class="col-sm-4">
               <select placeholder=""class="form-control">
                  <option>Select Licence Type..</option>
                  <option>PPL</option>
                  <option>CPL</option>
                  <option>ATPL</option>
               </select>
            </div>
         </div>
         <div class="form-group">
            <label for="exampleInputEmail1" class="col-sm-2 control-label">Subject</label>
            <div class="col-sm-4">
               <select placeholder=""class="form-control">
                  <option>Select Subject..</option>
                  <option>Option-1</option>
                  <option>Option-2</option>
                  <option>Option-3</option>
               </select>
            </div>
         </div>
         <div class="form-group">
            <label for="exampleInputEmail1" class="col-sm-2 control-label">Exam Date</label>
            <div class="col-sm-4">
               <div class="input-group">
                  <div class="input-group-addon glyphicon glyphicon-calendar"></div>
                  <input type='text' class="form-control dateExam" placeholder="DD/MM/YYYY"/>
               </div>
            </div>
         </div>
         <div class="form-group">
            <label for="exampleInputEmail1" class="col-sm-2 control-label">Start Time</label>
            <div class="col-sm-4">
               <div class="input-group">
                  <div class="input-group-addon glyphicon glyphicon-time"></div>
                  <input type='text' class="form-control timeExam" placeholder=""/>
               </div>
            </div>
         </div>
         <div class="form-group">
            <label for="exampleInputEmail1" class="col-sm-2 control-label">End Time</label>
            <div class="col-sm-4">
               <div class="input-group">
                  <div class="input-group-addon glyphicon glyphicon-time"></div>
                  <input type='text' class="form-control timeExam" placeholder=""/>
               </div>
            </div>
         </div>
         <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Total Question</label>
            <div class="col-sm-4">
               <input type="number" min="0" set="1" name="" class="form-control"  placeholder="">
            </div>
         </div>
         <div class="form-group">
            <label for="exampleInputEmail1" class="col-sm-2 control-label">Note</label>
            <div class="col-sm-6">
               <textarea class="form-control" rows="3"></textarea>
            </div>
         </div>
         <div class="form-group">
            <label class="control-label col-md-1"></label>
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



@stop
