@extends('core.layout.layoutAdminTable')
@section('content')

<div class="row">
        <div class="col-md-12">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <b>Exam Archive</b>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Subject</th>
                                            <th>Start Date</th>
                                            <th>Total Sit</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $num=0;?>
                                    @foreach($upcamingExams as $info)
                                      <tr>
                                        <td>{{++$num}}</td>
                                        <td>{{$info->title}}</td>
                                        <td>{{$info->licence_name}}</td>
                                        <td>{{$info->sub_name}}</td>
                                        <td>{{$info->exam_date}}</td>
                                        <td class="center">{{$info->total_sit}}</td>
                                        <td class="center"><a href="{{url('examShedule/singleShedule/'.$info->id)}}">view</a></td>
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