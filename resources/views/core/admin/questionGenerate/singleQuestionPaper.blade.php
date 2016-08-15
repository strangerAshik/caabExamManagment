@extends('core.layout.layoutAdmin')
@section('content')

<!--Basic Info-->
<div class="row">
	<div class="col-md-6">
		 <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Exam Question Details</b>

                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            
                                    <tbody>
                                        <tr class="odd gradeX">
                                           <th >Title</th>   <td>{{$examInfo->title}}</td>
                                        </tr>
                                        <tr class="odd gradeX">
                                           <th>License Type</th><td> {{$examInfo->licence_type}}</td>
                                        </tr>
                                        <tr class="odd gradeX">
                                            <th>Subject</th><td>{{$examInfo->subject}}</td>
                                        </tr>
                                        <tr class="odd gradeX">
                                            <th>Exam Date</th><td>{{$examInfo->exam_date}}</td>
                                        </tr>
                                        <tr class="odd gradeX">
                                            <th>Start Time</th><td>{{$examInfo->start_time}}</td>
                                        </tr>
                                        <tr class="odd gradeX">
                                            <th>End Time</th><td>{{$examInfo->end_time}}</td>
										</tr>
										<tr class="odd gradeX">
                                            <th>Total Question</th>   <td>{{$examInfo->total_question}}</td>                                   
                                        </tr>
										<tr class="odd gradeX">
                                            <th>Note</th>   <td>{{$examInfo->note}}</td>                                   
                                        </tr>
                                            
                                        
                                       
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
	</div>
	<div class="col-md-6">
	 <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Add Question</b>

                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body" style="padding: 0px 30px">
	
   {!!Form::open(array('url'=>'questionGenerate/saveQuestionPaperPart','method'=>'post','class'=>'form-horizontal','data-toggle'=>'validator','role'=>'form','files'=>'true'))!!}

	   {!! csrf_field() !!}
	   {!!Form::hidden('exam_id',$examId)!!}
	  <div class="form-group">

		    <label for="inputEmail3">Chapter</label>
		    
		      <select name="chapter_id" placeholder=""class="form-control">
			  <option value="">Select Chapter..</option>
			  @foreach($chapters as $info)
			  <option value="{{$info->id}}">{{$info->chapter}} <i>[TQ:{{App\AdminModel::numberOfQestions($info->id,'chapter')}}]</i></option>
			  @endforeach
			</select>
		
	  </div>
	  <div class="form-group">

		  <label for="inputEmail3">Difficulty Level</label>
	    
	      <select name="difficulty_level" placeholder=""class="form-control">
		  <option value="">Select Level..</option>
		  <option value="1">Low</option>
		  <option value="2">Medium</option>
		  <option value="3">High</option>
		</select>
		
	  </div>
	    <div class="form-group">
	  	<label for="inputEmail3" >Question Number</label>	    
	     <input type="number" name="question_no"  min="0" step="1" class="form-control" placeholder="Number of Question">		    
	   </div>
	    <div class="form-group">
	   <label for="inputEmail3" >Avoid Last</label>
	    
	    	  <input type="number" name="avoid_last" class="form-control" min="0" max='5' step="1" placeholder=""> 
	      
	    
	    Exam Questions
	   </div>

	   <div class="form-group col-md-12">
	        
	        <div class="text-right ">
	            <div id="button1idGroup" class="btn-group pull-right" role="group" aria-label="">
	                <button type="reset" id="button1id" name="button1id" class="btn btn-default" aria-label="Cancel">Cancel</button>
	                <button type="submit" id="button2id" name="button2id" class="btn btn-success" aria-label="Cancel">Add</button>
	            </div>

	        </div>
	    </div>

	{!!Form::close()!!}
	</div>
	</div>


</div>
	<div class="col-md-12">
	<div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Question Manipulation</b>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Chapter</th>
                                            <th>Difficulty Level</th>
                                            <th>Question Number</th>
                                            <th>Avoid Last</th>
                                            <th>Action</th>
                                            <th>Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $num=0;?>
                                    @foreach($enlistedQuestion as $info)
                                        <tr class="odd gradeX">
                                            <td>{{++$num}}</td>
                                            <td>{{$info->chapter}}</td>
                                            <td>
												@if($info->difficulty_level==1)
                                            	Low
                                            	@elseif($info->difficulty_level==2)
                                            	Medium
                                            	@elseif($info->difficulty_level==3)
                                            	High
                                            	@else
                                            	Undefine
                                            	@endif
                                            </td>
                                            <td>{{$info->question_no}}</td>
                                            <td>{{$info->avoid_last}} Exam Questions</td>
                                            
                                          <td class="text-center"><span class="label label-danger fa fa-trash"><a href="{{url('removeChapter/'.$info->id)}} " onclick="return confirm('Wanna Remove?');">Remove</a></span></td>
                                            <td class="text-center"><a href="{{url('questionGenerate/chapterSingleQuestionPaper/'.$info->id.'/'.$examId)}}"><span class="label label-primary fa fa-eye" > View</span></a></td>

                                           
                                        </tr>
                                    @endforeach
                                       
                                       
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
</div>
</div>

<!--Question -->
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Question Paper</b>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        <?php $num=0;?>
                        @foreach($allQuestions as $info)
                        <div class="col-md-6">
	                        <label>{{++$num}}) {{$info->question}}</label>  <span style="color:green"> Subject-{{$info->subject}} | Chapter-{{$info->chapter}} | DL:{{$info->difficulty_level_id}}</span>
	                        <div class="col-md-offset-1">
	                        	 <div class="radio">
								  <label>
								    <input type="radio" name="{{$info->question_id}}" id="optionsRadios1" value="1" >
								    {{$info->option_1}}
								  </label>
								</div>
								
		                        <div class="radio">
								  <label>
								    <input type="radio" name="{{$info->question_id}}" id="optionsRadios1" value="2" >
								    {{$info->option_2}}
								  </label>
								</div>
		                        <div class="radio">
								  <label>
								    <input type="radio" name="{{$info->question_id}}" id="optionsRadios1" value="3" >
								    {{$info->option_3}}
								  </label>
								</div>
								 <div class="radio">
								  <label>
								    <input type="radio" name="{{$info->question_id}}" id="optionsRadios1" value="4" >
								    {{$info->option_4}}
								  </label>
								</div>
	                        </div>
                        </div>
                        @endforeach

	                       

	                       
                        </div>
		
	</div>
</div>
@stop