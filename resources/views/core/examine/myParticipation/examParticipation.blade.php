@extends('core.layout.layoutExamine')
@section('content')
 <div class="row">
 			<!--Academic Info-->
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Examination List</b>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                	<thead>
                                		<tr>
                                            <th> #</th>
                                			<th>Exam Date</th>
                                			<th>Licence Type</th>
                                			<th>Subject</th>
                                            <th>Start Time</th>
                                            <th>Status</th>
                                            <th>Payment</th>
                                			
                                		</tr>
                                	</thead>
                                 
                                    <tbody>
                                    <?php $num=0 ;?>
                                    @foreach($infos as $info)
                                       <tr>
                                           <td>{{++$num}}</td>
                                           <td>{{$info->exam_date}}</td>
                                           <td>{{$info->licence_type}}</td>
                                           <td>{{$info->subject}}</td>
                                           <td>{{$info->start_time}}</td>
                                           <td>{{$info->status}}</td>
                                           <td><a href="{{url('examine/myParticipation/paymentDetails/'.$info->exam_id.'/'.Auth::user()->id)}}">View</a></td>
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