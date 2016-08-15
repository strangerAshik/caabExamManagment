@extends('core.layout.layoutAdminTable')
@section('content')

   <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Result : Exam Title</b>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Full Name</th>
                                            <th>Passport No.</th>
                                            <th>Total Marks</th>
                                            <th>Obtained Marks</th>
                                            <th>Make</th>
                                            
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $num=0;?>
                                    @foreach($infos as $info)
                                        <tr class="odd gradeX">
                                            <td>{{++$num}}</td>
                                            <td>{{$info->name}}</td>
                                            <td>{{$info->passport_no}}</td>
                                            <td>{{$info->total_question}}</td>
                                            <td>{{$info->correct_ans}}</td>
                                            <td>
                                            <?php $blockCheck=App\ExaminerModel::isBlock($info->id,$examId)?>
                                            @if($blockCheck)
                                            <a class="label label-success" href="{{url('changeBlockStatus/0/'.$info->id.'/'.$examId)}}">Unblock</a>
                                            @else
                                            <a class="label label-danger"   href="{{url('changeBlockStatus/1/'.$info->id.'/'.$examId)}}">Block</a>
                                            @endif
                                            </td>
                                            
                                        
                                            <td class="text-center"><a href="{{url('singleRegister/'.$info->id)}}"><span class="label label-success">View</span></td>
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

@stop