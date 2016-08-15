@extends('core.layout.layoutAdminTable')
@section('content')

  <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            @if($page=='upcoming')
                                 <b>Upcoming Exam Questions</b>
                            @elseif($page=='archive')
                                <b>Question Archive</b>
                            @endif
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Date</th>
                                            <th>Title</th>
                                            <th>License Type</th>
                                            <th>Subject</th>
                                            <th>Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $num=0;?>
                                    @foreach($examArchive as $info)
                                        <tr class="odd gradeX">
                                            <td>{{++$num}}</td>
                                            <td>{{$info->exam_date}}</td>
                                            <td>{{$info->title}}</td>
                                            <td>{{$info->licence_type}}</td>
                                            <td>{{$info->subject}}</td>
                                            <td class="text-center"><a href="{{url('questionGenerate/singleQuestionPaper/'.$info->id)}}"><span class="label label-success">View</span></a></td>
                                           
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