@extends('core.layout.layoutExamine')
@section('content')
	 <div class="row">
 			<!--Examine Result Archive-->
                <div class="col-md-12">
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
                                			<th>Subjects</th>
                                			<th>Exam Date</th>
                                			<th>Total Mark</th>
                                			<th>Obtained Mark</th>
                                			<th>Height Mark</th>
                                		</tr>
                                	</thead>
                                 
                                    <tbody>
                                    <?php $num=0;?>
                                    @foreach($infos as $info)
                                       <tr>
	                                       	<td>{{++$num}}</td>
											<td>{{$info->licence_type}}</td>
											<td>{{$info->subject}}</td>
	                                      	<td>{{$info->exam_date}}</td>
	                                      	<td>{{$info->total_question}}</td>
	                                      	<td>{{$info->correct_ans}}</td>
	                                      	<td>
                                            <?php $highestMarks=App\ExaminerModel::higestMarksofExam($info->exam_id)?>
                                            {{$highestMarks}}
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
                <!-- /.col-lg-12 -->
		</div>
<!-- /.row -->

@stop