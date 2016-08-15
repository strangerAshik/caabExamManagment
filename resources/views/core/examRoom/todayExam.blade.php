@extends('core.layout.layoutExamine')
@section('content')

<div class="row">
		<div class="col-md-12">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <b>My Registered Today's Exam</b>
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
                                            <th>Start Time</th>
											<th>End Time</th>
											
											<th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $num=0;?>
                                    @foreach($exams as $info)
                                      <tr>
										<td>{{++$num}}</td>
										<td>{{$info->title}}</td>
										<td>{{$info->licence_type}}</td>
										<td>{{$info->subject}}</td>
										<td>{{$info->exam_date}}</td>
                                        <td class="center">{{$info->start_time}}</td>
										<td class="center">{{$info->end_time}}</td>
										<td class="center"><a href="{{url('examRoom/exam/'.$info->id)}}">Go</a></td>
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