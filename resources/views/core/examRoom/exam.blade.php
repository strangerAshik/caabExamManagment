@extends('core.layout.layoutExam')
@section('content')



<!--Question -->


<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Exam Title: {{$examTime->title}} | License Type: {{$examTime->lictype}} | Subject: {{$examTime->sub}}</b>
							@if($start==1)
                            <span class="pull-right" style="margin-bottom:  30px">	
                            	<a  onclick="return confirm('After Submitting you won\'t able to get back Exam. Still Do you want to submit?')"  href="{{url('examRoom/result/'.$examId)}}" class="btn btn-info " >Submit & View Result</a>
                            	
                            </span>
                            @endif
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        @if($start==1)
                        <?php $num=0;?>
                       @foreach($questions as $info)
                       <form action="#" >
                        {!! csrf_field() !!}
                        {!!Form::hidden('exam_id',$info->exam_id,array('id'=>'exam_id'))!!}
                        <div class="col-md-12">
                         <?php $ans=App\ExaminerModel::previousResult(Auth::user()->id,$info->exam_id,$info->question_id) ;?>
                        
	                        <label>{{++$num}}) {{$info->question}}

								
	                        </label>  
	                        <div class="col-md-offset-1">
	                        	 <div class="radio">

	                        	 @if($info->image)
                                               <img style="max-height:250px; max-width:400px" class="img-thumbnail img-responsive" src="{{asset('public/documents/'.$info->image)}}" alt="Examine Photo" />
                                 @endif
								  <label>
								 
								    <input type="radio" name="{{$info->question_id}}" id="hello" class="optionsRadio" value="1"
								     <?php if($ans==1) echo "checked='checked'";?> >
								    {{$info->option_1}}
								  </label>
								</div>
								
		                        <div class="radio">
								  <label>
								    <input type="radio" name="{{$info->question_id}}" class="optionsRadio" value="2"
								     <?php if($ans==2) echo "checked='checked'";?> >
								     {{$info->option_2}}
								  </label>
								</div>
		                        <div class="radio">
								  <label>
								    <input type="radio" name="{{$info->question_id}}" class="optionsRadio" value="3" 
								     <?php if($ans==3) echo "checked='checked'";?>>
								    {{$info->option_3}}
								  </label>
								</div>
								 <div class="radio">
								  <label>
								    <input type="radio" name="{{$info->question_id}}" class="optionsRadio"  value="4"
								     <?php if($ans==4) echo "checked='checked'";?> >
								    {{$info->option_4}}
								  </label>
								</div>
	                        </div>
                        </div>
                        </form>
                       @endforeach
                       @else
						Exam Time is Not Started yet!!
                       @endif

	                       

	                       
                        </div>
		
	</div>
</div>
<!--#################################Clock####################-->	

		<!--<div class="button-holder">
			<a class="alarm-button"></a>
		</div>-->

		<!-- The dialog is hidden with css -->
		<div class="overlay">

			<div id="alarm-dialog">

				<h2>Exam Will Start At 10:00AM</h2>

				

			</div>

		</div>

		<div class="overlay">

			<div id="time-is-up">

				<h2>Time's up!</h2>

				<div class="button-holder">
					<a  target="_blank" href="{{url('examRoom/result/'.$examId)}}" class="button blue">View Result</a>
				</div>

			</div>

		</div>
		

		
		<audio id="alarm-ring" preload>
			<source src="{{asset('public/clock/assets/audio/ticktac.mp3')}}" type="audio/mpeg" />
			<source src="{{asset('public/clock/assets/audio/ticktac.ogg')}}" type="audio/ogg" />
		</audio>

		

@stop