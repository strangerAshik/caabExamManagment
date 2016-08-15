@extends('core.layout.layoutAdminTable')
@section('content')

   <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Pending Exam Sit Request</b>
                        </div>
                        
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Photo</th>
                                            <th>Full Name</th>
                                            <th>Exam Date</th>
                                            <th>License Type</th>
                                            <th>Subject</th>
                                            <th>Total Sit</th>
                                            <th>Occupied Sit</th>
                                          
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $num=0;?>
                                    @foreach($infos as $info)
                                        <tr class="odd gradeX">
                                            <td>{{++$num}}</td>
                                            <td>
                                              <?php $images=App\AdminModel::getDocuments('users', $info->user_id) ?>
                                            @if($images)
                                                @foreach($images as $img)
                                                 <img style="height: 100px" class="img-thumbnail img-responsive" src="{{asset('public/documents/'.$img->calling_id)}}" alt="Examine Photo" />
                                                 <?php break;?>
                                                 @endforeach
                                            @else 
                                                No Photo 
                                            @endif
                                           
                                            </td>
                                            <td>{{$info->name}}</td>
                                            <td>{{$info->exam_date}}</td>
                                            <td>{{$info->licence_type}}</td>
                                            <td>{{$info->subject}}</td>
                                            <td class="text-center">{{$info->total_sit}}</td>
                                            <td class="text-center">
                                                <?php $occupiedSit=App\ExaminerModel::occupiedSit($info->id);?>
                                            {{$occupiedSit}}
                                            </td>
                                            
                                            
                                            <td class="text-center"><a href="{{url('examineAdminstration/pendingExamineDetails/'.$info->user_id.'/'.$info->exam_id)}}"><span class="label label-success">View</span></a></td>
                                           
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