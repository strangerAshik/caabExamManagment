@extends('core.layout.layoutAdmin')
@section('content')

	<div class="row">
        @if(in_array('18', $privileges))
                <div class="col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-bell fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">{{$pendingReg}}</div>
                                    <div>Pending Registration Request</div>
                                </div>
                            </div>
                        </div>
                        <a href="{{url('examineAdminstration/pendingReg')}}">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                @endif
                @if(in_array('19', $privileges))
                <div class="col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-bell fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">{{$pendingExm}}</div>
                                    <div>Pending Exam Sit Request</div>
                                </div>
                            </div>
                        </div>
                        <a href="{{url('examineAdminstration/pendingExm')}}">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                @endif
    </div>
<!-- /.row -->
@if(in_array('17', $privileges))
@foreach($todayExam as $info)
   <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Exam On Going Control Panel</b>
                            <a  href="{{url('examShedule/editShedule/'.$info->id)}}" class="label label-primary pull-right">Schedule Management</a>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

                            <div class="dataTable_wrapper">
                            <table class="table table-bordered table-hover">
                                <tbody>
                                    <tr><td class="col-md-2">Exam Title</td><td>{{$info->title}}</td></tr>
                                    <tr><td class="col-md-2">License Type</td><td>{{$info->lic_type}}</td></tr>
                                    <tr><td>Subject</td><td>{{$info->sub}}</td></tr>
                                    <tr><td>Date</td><td>{{$info->exam_date}}</td></tr>
                                    <tr><td>Start Time</td><td>{{$info->start_time}}</td></tr>
                                    <tr><td>End Time Time</td><td>{{$info->end_time}}</td></tr>
                                    
                                   
                                </tbody>
                            </table>
                            </div>
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Login Status</th>
                                            <th>Block/ Unblock</th>                    
                                            <th>Examinee Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $approvedExaminee=App\AdminModel::ExamExamineeList($info->id);$num=0;?>
                                    @foreach($approvedExaminee as $examinee)
                                        <tr>
                                            <td id="{{$examinee->id}}">{{++$num}}</td>
                                            <td>{{$examinee->name}}</td>
                                            <td>
                                            <?php $loginStatus=App\AdminModel::loginStatus($examinee->id);?>
                                            @if($loginStatus=='0')
                                               <span class="text-success label label-success"> Logged In</span>
                                            @else 
                                                <span class="text-danger label label-success">Not Logged In</span>
                                            @endif
                                            </td>
                                            <td>
                                                <?php $blockCheck=App\ExaminerModel::isBlock($examinee->id,$info->id)?>
                                            @if($blockCheck)
                                            <a class="label label-success" href="{{url('changeBlockStatus/0/'.$examinee->id.'/'.$info->id.'#'.$examinee->id)}}">Turn to Unblock</a>
                                            @else
                                            <a class="label label-danger"   href="{{url('changeBlockStatus/1/'.$examinee->id.'/'.$info->id.'#'.$examinee->id)}}">Turn to Block</a>
                                            @endif

                                            </td>
                                           
                                            <td><a href="{{url('singleRegister/'.$examinee->id)}}">View</a></td>
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
                <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
@endforeach
@endif
@stop