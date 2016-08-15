@section('academicData')
 <div class="row">
 			<!--Academic Info-->
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Academic Informations</b>
                            <a class="pull-right" href="{{url('examine/personalInfo/newAccdemicInfos')}}">New</a>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                	<thead>
                                		<tr>
                                            <th> #</th>
                                            <th> Degree</th>
                                			<th>Session</th>
                                			<th>Institute</th>
                                			<th>Subjects</th>
                                            <th>Result</th>
                                            <th>Documents</th>
                                            <th>Delete</th>
                                			<th>Edit</th>
                                		</tr>
                                	</thead>
                                 
                                    <tbody>
                                    <form action="{{url('massDelete')}}" method="POST">
                                     {!! csrf_field() !!}
                                     <input type="hidden" name="tableName" value="academic_infos">
                                    <input type="submit" style="background: red; color: #FFF; font-weight: bold"  onclick="return confirm('Wanna Delete All Selected Data?')" value="Delete Selected Row(s)">
                                    @foreach($infos as $info)
                                       <tr>
                                            <td><input name="checkbox[]" type="checkbox" value="{{$info->id}}"></td>
                                            <td>{{$info->degree_name}}</td>
	                                       	<td>{{$info->start_date}} to {{$info->end_date}}</td>
											<td>{{$info->institute}}</td>
											<td>{{$info->subject}}</td>
                                            <td>{{$info->result}}</td>
                                            <td>
                                                <?php $images=App\AdminModel::getDocuments('academic_infos', $info->id) ?>
                                                @if($images)
                                                <ul>
                                                    @foreach($images as $img)
                                                    <li>
                                                     <a  href="{{asset('public/documents/'.$img->calling_id)}}" alt="Examine Photo" >{{$img->doc_name}}</a>
                                                        <a  style="color: red" onclick="return confirm('Wanna Delete?');" href="{{url('deleteBack/documents/'.$img->id)}}">[Delete]</a> </li>
                                                    
                                                     @endforeach
                                                    </ul>
                                                @else 
                                                    No Document 
                                                @endif
                                            </td>
                                            <td><a onclick="return confirm('Wanna Delete')" href="{{url('deleteBack/academic_infos/'.$info->id)}}">Delete</a></td>
	                                      	<td><a href="{{url('examine/personalInfo/editAccademicInfos/'.$info->id)}}">Edit</a></td>
                                       </tr>
                                    @endforeach
                                    </form>
                                       
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