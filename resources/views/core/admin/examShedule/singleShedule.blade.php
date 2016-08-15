@extends('core.layout.layoutAdminTable')
@section('content')

   <div class="row">
                <div class="col-lg-12">
                @if($details)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <b>Exam Details</b>
                        
                           <div class="pull-right">
                            <a class="label label-danger  " href="{{url('deleteBack/exam_shedules/'.$details->id)}}" onclick=" return confirm('Wanna Delete?')"><span class="glyphicon glyphicon-trash"></span> Delete</a> &nbsp|&nbsp
                             <a class="label label-primary " href="{{url('examShedule/editShedule/'.$details->id)}}"><span class="glyphicon glyphicon-pencil"></span> Edit </a> 
                           </div>

                            

                            </span>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper table-responsive">
                                <table class="table  table-bordered table-hover" id="">
                                   
                                    <tbody>
                                        <tr >
                                               <th class="col-md-3">Title</th>
                                               <td>{{$details->title}} </td>                     
                                        </tr>
                                        <tr >
                                               <th>Licence Type</th>
                                               <td>{{$details->licence_name}}</td>                     
                                        </tr>
                                        <tr >
                                               <th>Subject</th>
                                                <td>{{$details->sub_name}}</td>                     
                                        </tr>
                                        <tr >
                                               <th>Exam Date</th>
                                                <td>{{$details->exam_date}}</td>                     
                                        </tr>
                                        <tr >
                                               <th>Start Time</th>
                                                <td>{{$details->start_time}}</td>                     
                                        </tr>
                                        <tr >
                                               <th>End Time</th>
                                                <td>{{$details->end_time}}</td>                     
                                        </tr>
                                        <tr >
                                               <th>Total Question</th>
                                                <td>{{$details->total_question}}</td>                     
                                        </tr>
                                        <tr >
                                               <th>Total Sit</th>
                                                <td>{{$details->total_sit}}</td>                     
                                        </tr>
                                        <tr >
                                               <th>Note</th>
                                                <td><?php echo $details->note;?></td>                     
                                        </tr>
                                       
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    @else
                    Exam Does not exist....
                    @endif

                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-12">
                
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <b>Approved Examine List</b>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper table-responsive">
                                <table class="table  table-bordered table-hover" id="">
                                   <thead>
                                   <tr>
                                       <th>#</th>
                                       <th>Title</th>
                                       <th>Name</th>
                                       <th>Payment</th>
                                    </tr>
                                   </thead>
                                   <tbody>
                                   <?php $num=0;?>
                                   @foreach($examiners as $info)
                                   <tr>
                                       <td>{{++$num}}</td>
                                       <td>{{$info->title}}</td>
                                       <td>{{$info->name}}</td>
                                       <td><a href="{{url('examineAdminstration/pendingExamineDetails/'.$info->user_id.'/'.$info->exam_id)}}">Details</a></td>
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