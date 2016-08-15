@extends('core.layout.layoutExamine')
@section('content')


<!--Question -->

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
		<!-- To get result  -->
					  <?php $num=0;?><?php $totalQuestion=0;$corrAns=0;?>
                       @foreach($questions as $info)
                       <!-- Given Ans -->
                        <?php $ans=App\ExaminerModel::previousResult(Auth::user()->id,$info->exam_id,$info->question_id) ;?>
                       <!-- Orginal Ans -->
                       	<?php $orgAns=App\ExaminerModel::orginalAns($info->question_id) ;?>
                       		<?php ++$totalQuestion;?>
	                        @if($orgAns==$ans)
	                        <?php ++$corrAns; ?>
	                        @endif
                       	@endforeach
        <!--End fo get result  -->
                        <div class="panel-heading">
                            <b>Result | Total Question : {{$totalQuestion}} | Correct Answer : {{$corrAns}}</b>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                       
                        <?php $num=0;?><?php $totalQuestion=0;$corrAns=0;?>
                       @foreach($questions as $info)
                       <!-- Given Ans -->
                        <?php $ans=App\ExaminerModel::previousResult(Auth::user()->id,$info->exam_id,$info->question_id) ;?>
                       <!-- Orginal Ans -->
                       	<?php $orgAns=App\ExaminerModel::orginalAns($info->question_id) ;?>
						
                       <form action="#" >
                        {!! csrf_field() !!}
                        {!!Form::hidden('exam_id',$info->exam_id,array('id'=>'exam_id'))!!}
                        <div class="col-md-6" >
                        
                        
	                        <label>
							<?php ++$totalQuestion;?>
	                        @if($orgAns==$ans)
	                        <?php ++$corrAns; ?>
	                        <i class="fa fa-check-square-o text-success"  style="color: green"></i>
	                        
	                        @else	                        
	                        <i class="fa fa-times text-danger" style="color: red" ></i>
	                        @endif
	                        {{++$num}}) {{$info->question}}</label>  
	                        <div class="col-md-offset-1">
	                        	 <div class="radio">
								  <label>
								 
								    <input type="radio" disabled="" name="{{$info->question_id}}" id="hello" class="optionsRadio" value="1"
								     <?php if($ans==1) echo "checked='checked'";?> >
								    {{$info->option_1}}
								  </label>
								</div>
								
		                        <div class="radio">
								  <label>
								    <input type="radio" disabled="" name="{{$info->question_id}}" class="optionsRadio" value="2"
								     <?php if($ans==2) echo "checked='checked'";?> >
								     {{$info->option_2}}
								  </label>
								</div>
		                        <div class="radio">
								  <label>
								    <input type="radio" disabled="" name="{{$info->question_id}}" class="optionsRadio" value="3" 
								     <?php if($ans==3) echo "checked='checked'";?>>
								    {{$info->option_3}}
								  </label>
								</div>
								 <div class="radio">
								  <label>
								    <input type="radio" disabled="" name="{{$info->question_id}}" class="optionsRadio"  value="4"
								     <?php if($ans==4) echo "checked='checked'";?> >
								    {{$info->option_4}}
								  </label>
								</div>
	                        </div>
                        </div>
                        </form>
                       @endforeach
                     
    				<?php App\ExaminerModel::saveResult($examId,$totalQuestion,$corrAns);?>
	                       

	                       
                        </div>
		
	</div>
</div>

@stop