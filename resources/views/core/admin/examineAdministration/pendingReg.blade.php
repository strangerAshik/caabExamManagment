@extends('core.layout.layoutAdminTable')
@section('content')

   <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Pending Registration Request</b>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Photo</th>
                                            <th>Reg. Date</th>
                                            <th>Title</th>
                                            <th>Full Name</th>
                                            <th>Email</th>
                                            <th>Nationality</th>
                                            <th>Passport No</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $num=0;?>
                                    
                                    @foreach($pendingReg as $info)
                                        <tr class="odd gradeX">
                                            <td>{{++$num}}</td>
                                            <td>

                                            <?php $images=App\AdminModel::getDocuments('users', $info->id) ?>
                                            @if($images)
                                                @foreach($images as $img)
                                                 <img style="height: 100px" class="img-thumbnail img-responsive" src="{{asset('public/documents/'.$img->calling_id)}}" alt="Examine Photo" />
                                                 <?php break;?>
                                                 @endforeach
                                            @else 
                                                No Photo 
                                            @endif
                                           
                                            </td>
                                            <td>{{$info->created_at}}</td>
                                            <td>{{$info->title}}</td>
                                            <td>{{$info->name}}</td>
                                            <td>{{$info->email}}</td>
                                            <td>{{$info->nationality}}</td>
                                            <td>{{$info->passport_no}}</td>
                                            <td class="text-center"><a href="{{url('singleRegister/'.$info->id)}}" class="label label-success">View</a></td>
                                           
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