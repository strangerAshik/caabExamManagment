@extends('core.layout.layoutAdminTable')
@section('content')

   <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Result Archive</b>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>License Type</th>
                                            <th>Subject</th>
                                            <th>Exam Date</th>
                                            <th>Total Sit</th>
                                            <th>Occupied</th>
                                            <th>Result</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $num=0;?>
                                    @foreach($exams as $info)
                                        <tr class="odd gradeX">
                                            <td>{{++$num}}</td>
                                            <td>{{$info->licence_type}}</td>
                                            <td>{{$info->subject}}</td>
                                            <td>{{$info->exam_date}}</td>
                                            <td>{{$info->total_sit}}</td>
                                            <td>
                                            <?php $occupiedSit=App\ExaminerModel::occupiedSit($info->id);?>
                                            {{$occupiedSit}}
                                            </td>
                                            <td class="text-center"><a href="{{url('result/singleExamResult/'.$info->id)}}"><span class="label label-success">View</span></td>
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