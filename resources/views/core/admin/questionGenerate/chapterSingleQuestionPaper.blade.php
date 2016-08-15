@extends('core.layout.layoutAdmin')
@section('content')
<!--Question -->
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Licence Type: {{$disInfos->licence_type}} | Subject: {{$disInfos->subject}} | Chapter: {{$disInfos->chapter}}</b> <a href="#addQuestionNew"><span style="padding: 5px;" class="pull-right label label-primary"> Add Question </span></a>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        <?php $num=0;?>
                       @foreach($questions as $info)
                        <div class="col-md-12">
	                        <label>{{++$num}}) {{$info->question}} </label> 
	                        <span style="color:green"> Subject: {{$info->subject}} | Chater: {{$info->chapter}} | DL:{{$info->difficulty_level_id}}</span><br> 
	                        <span class="label label-danger"><a onclick="return confirm('Wanna Remove?');" href="{{url('deleteBack/question_stors/'.$info->id)}}"> Remove</a></span>
	                        <div class="col-md-offset-1">
	                        	 <div class="radio">
	                        	 
	                        	  @if($info->image)
                                               <img style="max-height:250px; max-width:400px" class="img-thumbnail img-responsive" src="{{asset('public/documents/'.$info->image)}}" alt="Examine Photo" />
                                 @endif

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
<!--Available Questions -->
<div class="row" >
	<div class="col-md-12">
		<div class="panel panel-default" id="addQuestionNew">
                        <div class="panel-heading">
                             <b>Licence Type: {{$disInfos->licence_type}} | Subject: {{$disInfos->subject}} | Chapter: {{$disInfos->chapter}}</b>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        @foreach($allQuestions as $info)
                        <div class="col-md-12">
	                        <label>{{++$num}}) {{$info->question}} </label> 
	                        <span style="color:green"> Subject: {{$info->subject}} | Chater: {{$info->chapter}} | DL:{{$info->difficulty_level}}</span><br> 
	                        <span class="label label-success"><a onclick="return confirm('Wanna Add?');" href='{{url('addQuestion/'.$info->id.'/'.$questionGeneratorId.'/'.$examId)}}'> Add</a></span>

	                        <div class="col-md-offset-1">
	                        	<div class="radio">
	                        	 @if($info->image)
                                               <img style="max-height:250px; max-width:400px" class="img-thumbnail img-responsive" src="{{asset('public/documents/'.$info->image)}}" alt="Examine Photo" />
                                 @endif

								  <label>
								    <input type="radio" name="{{$info->id}}" id="optionsRadios1" value="1" >
								    {{$info->option_1}}
								  </label>
								</div>
								
		                        <div class="radio">
								  <label>
								    <input type="radio" name="{{$info->id}}" id="optionsRadios1" value="2" >
								    {{$info->option_2}}
								  </label>
								</div>
		                        <div class="radio">
								  <label>
								    <input type="radio" name="{{$info->id}}" id="optionsRadios1" value="3" >
								    {{$info->option_3}}
								  </label>
								</div>
								 <div class="radio">
								  <label>
								    <input type="radio" name="{{$info->id}}" id="optionsRadios1" value="4" >
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