@extends('core.layout.layoutExamine')
@section('content')
@if($toDayExam)
<div class="row">
                <div class="col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-table fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    
                                    <div>Today Exam</div>
                                </div>
                            </div>
                        </div>
                        <a href="{{url('examRoom/todayExam')}}">
                            <div class="panel-footer">
                                <span class="pull-left">Go For Exam</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
               
    </div>
@endif


	<div class="row">
		<div class="col-md-12">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <b>Upcoming Exam</b>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                         @if($signal!=1)
                        <div class="alert alert-danger" role="alert">
                         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						  </button>
						 
						  <strong>Before Apply Personal, Academic and professional Information is required</strong>
						 
						</div>
						 @endif
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
											<th>License Type</th>
											<th>Subject</th>
											<th>Exam Date</th>
											<th>Start Time</th>
											<th>End Time</th>
											<th>Total Sit</th>
											<th>Occupied Sit</th>
											<th>Pending Sit</th>
											<th>Status</th>
											<th>Action</th>
											
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $num=0;?>
                                    @foreach($upcomingExam as $info)
                                      <tr>
										<td>{{++$num}}</td>
										<td>{{$info->licence_type}}</td>
										<td>{{$info->subject}}</td>
										<td>{{$info->exam_date}}</td>
										<td class="center">{{$info->start_time}}</td>
										<td class="center">{{$info->end_time}}</td>
										
										<td class="center">{{$info->total_sit}}</td>
										<td class="center">
										<?php $occupiedSit=App\ExaminerModel::occupiedSit($info->id);?>
											{{$occupiedSit}}
										</td>
										<td class="center">
										<?php $pendignSit=App\ExaminerModel::pendignSit($info->id);?>
											{{$pendignSit}}
										</td>
										<td class="center">
										<?php $status=App\ExaminerModel::examineApplyStatus($info->id,Auth::user()->id);?>
											@if($status=='1')
											Pending
											@elseif($status=='2')
											 Examine
											@else 
											Not Applied
											@endif
										</td>
										<td>
										<?php $apply=App\ExaminerModel::doIApply($info->id,Auth::user()->id);?>
										@if($apply==0 && $signal==1)
										<a href="{{url('examine/apply/'.$info->id)}}"><span class="label label-success">Apply</span></a>
										@else 
										 <a href="#" disabled ><span class="label label-danger">Apply</span></a>	
										@endif 
										</td>
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
           
               
   

@stop