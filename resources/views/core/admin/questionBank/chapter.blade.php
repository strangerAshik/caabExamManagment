@extends('core.layout.layoutAdminTable')
@section('content')

   <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>License Type: {{App\AdminModel::getLicTypName($licId)}} | Subject: {{App\AdminModel::getSubjectName($subId)}} | Chapter:  {{App\AdminModel::getChapterName($chapId)}}</b>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        <form action="{{url('massDelete')}}" method="POST">
                           {!! csrf_field() !!}
                                     <input type="hidden" name="tableName" value="question_bank">
                                    <input type="submit" style="background: red; color: #FFF; font-weight: bold"  onclick="return confirm('Wanna Delete All Selected Data?')" value="Delete Selected Row(s)">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Question</th>
                                            <th>Option-1</th>
                                            <th>Option-2</th>
                                            <th>Option-3</th>
                                            <th>Option-4</th>
                                            <th>Answerer</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $num=0;?>
                                    @foreach($questions as $info)
                                        <tr class="odd gradeX">
                                            <td>
                                            <input  name="checkbox[]" type="checkbox" value="{{$info->id}}"> {{++$num}} 
                                            </td>
                                            <td>{{$info->question}}</td>
                                            <td>{{$info->option_1}}</td>
                                            <td>{{$info->option_2}}</td>
                                            <td>{{$info->option_3}}</td>
                                            <td>{{$info->option_4}}</td>
                                            <td>
                                            @if($info->option_right=='1')
                                            Option-1
                                            @elseif($info->option_right=='2')
                                            Option-2
                                            @elseif($info->option_right=='3')
                                            Option-3
                                            @elseif($info->option_right=='4')
                                            Option-4
                                            @else
                                            Not Provided
                                            @endif
                                            
                                            </td>
                                           
                                            <td class="text-center"><a href="{{url('questionBank/singleQuestion/'.$info->id)}}"><span class="label label-success">View</span></a></td>                                           
                                        </tr>
                                    @endforeach
                                        
                                       
                                    </tbody>
                                </table>
                            </div>
                        </form>
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