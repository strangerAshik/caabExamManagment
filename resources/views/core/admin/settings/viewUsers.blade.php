@extends('core.layout.layoutAdminTable')
@section('content')

   <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>All Users</b>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Name</th>
                                            <th>Email</th>               
                                            <th>Role</th>
                                            <th>Login Status</th>
                                            <th>Reg Status</th>
                                            <th>Delete</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $num=0;?>
                                    @foreach($users as $info)
                                        <tr>
                                            <td>{{++$num}}</td>
                                            <td>{{$info->title}}</td>
                                            <td>{{$info->name}}</td>
                                            <td>{{$info->email}}</td>
                                            <td>{{$info->role}}</td>
                                            <td>
                                            @if($info->active=='0')
                                            Logged In
                                            @else
                                            Not Logged In
                                            @endif
                                            </td>
                                            <td>
                                            @if($info->reg_status=='1')
                                            Active
                                            @else
                                            Inactive
                                            @endif
                                            </td>
                                            <td><a href="{{url('deleteBack/users/'.$info->id)}}" onclick="return confirm('Wanna Delete?')">Delete</a></td>
                                            <td><a href="{{url('setting/editUser/'.$info->id)}}">Edit</a></td>
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