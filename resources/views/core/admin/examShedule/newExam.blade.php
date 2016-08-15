

@extends('core.layout.layoutAdmin')
@section('content')
<div class="row">
   <div class="col-md-12">
     
        {!!Form::open(array('url'=>'examShedule/saveShedule','method'=>'post','class'=>'form-horizontal','data-toggle'=>'validator','role'=>'form','files'=>'true'))!!}
          {!! csrf_field() !!}
         <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Title</label>
            <div class="col-sm-5">
               <input type="text" name="title" class="form-control"  placeholder=" ">
            </div>
         </div>
         <div class="form-group">
            <label for="exampleInputEmail1" class="col-sm-2 control-label">Licence Type</label>
            <div class="col-sm-4">
               <select placeholder="" name="licence_type" class="form-control">
                   <option value="">Select Licence Type..</option>
                    @foreach($licenceTypes as $info)
                    <option value="{{$info->id}}">{{$info->licence_type}}</option>
                    @endforeach
               </select>
            </div>
         </div>
         <div class="form-group">
            <label for="exampleInputEmail1" class="col-sm-2 control-label">Subject</label>
            <div class="col-sm-4">
               <select placeholder="" name="subject" class="form-control">
                   <option value="">Select Subject..</option>
                     @foreach($subjects as $info)
                       <option value="{{$info->id}}">{{$info->subject.' ( '.$info->licence_type.' ) '}}</option>
                     @endforeach
               </select>
            </div>
         </div>
         <div class="form-group">
            <label for="exampleInputEmail1" class="col-sm-2 control-label">Exam Date</label>
            <div class="col-sm-4">
               <div class="input-group">
                  <div class="input-group-addon glyphicon glyphicon-calendar"></div>
                  <input name="exam_date" type='text' class="form-control dateExam" placeholder="DD/MM/YYYY"/>
               </div>
            </div>
         </div>
         <div class="form-group">
            <label for="exampleInputEmail1" class="col-sm-2 control-label">Start Time</label>
            <div class="col-sm-4">
               <div class="input-group">
                  <div class="input-group-addon glyphicon glyphicon-time"></div>
                  <input name="start_time" type='text' class="form-control timeExam" placeholder=""/>
               </div>
            </div>
         </div>
         <div class="form-group">
            <label for="exampleInputEmail1" class="col-sm-2 control-label">End Time</label>
            <div class="col-sm-4">
               <div class="input-group">
                  <div class="input-group-addon glyphicon glyphicon-time"></div>
                  <input name="end_time" type='text' class="form-control timeExam" placeholder=""/>
               </div>
            </div>
         </div>
         <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Total Question</label>
            <div class="col-sm-4">
               <input name="total_question" type="number" min="0" set="1" name="" class="form-control"  placeholder="">
            </div>
         </div>
         <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Total Sit</label>
            <div class="col-sm-4">
               <input name="total_sit" type="number" min="0" set="1" name="" class="form-control"  placeholder="">
            </div>
         </div>
         <div class="form-group">
            <label for="exampleInputEmail1" class="col-sm-2 control-label">Note</label>
            <div class="col-sm-6">
               <textarea name="note" class="form-control" rows="3"></textarea>
            </div>
         </div>
         <div class="form-group">
            <label class="control-label col-md-1"></label>
            <div class="text-right col-md-8">
               <div id="button1idGroup" class="btn-group pull-right" role="group" aria-label="">
                  <button type="reset" id="button1id" name="button1id" class="btn btn-default" aria-label="Cancel">Cancel</button>
                  <button type="submit" id="button2id" name="button2id" class="btn btn-success" aria-label="Cancel">Save </button>
               </div>
            </div>
         </div>
     {!!Form::close()!!}
   </div>
</div>
@stop

