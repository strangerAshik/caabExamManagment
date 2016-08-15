@extends('core.layout.layoutAdminTable')
@section('content')

   <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>All Content</b>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Calling Id</th>
                                            <th>Role Name</th>
                                            <th>Description</th>
                                            <th>Privilege Sections </th>               
                                            <th>Delete</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $num=0;?>
                                    @foreach($allRoles as $info)
                                        <tr>
                                            <td>{{++$num }}</td>
                                            <td>{{$info->id}}</td>
                                            <td>{{$info->role}}</td>
                                            <td>{{$info->description}}</td>
                                            <td>
                                            
                                            <?php $sections=App\AdminModel::getPrivilegedSections($info->privilege);?>
                                            <ul>
                                            @foreach($sections as $sec)
                                                <li>{{$sec->name}}</li>
                                            @endforeach
                                            </ul>
                                            </td>
                                            <td><a href="{{url('deleteBack/roles/'.$info->id)}}" onclick="return confirm('Wanna Delete?')">Delete</a></td>
                                            <td><a href="{{url('setting/editRole/'.$info->id)}}">Edit</a></td>
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