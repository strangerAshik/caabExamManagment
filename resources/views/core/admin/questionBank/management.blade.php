@extends('core.layout.layoutAdminTable')
@section('content')

 <div class="row">
 

                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Upload Questions Using Excel File</b> 
                            <span class="pull-right">Download Sheet Structure <a target="_blink" href="{{asset('public/uploads/excel/question_batch_upload_example.xls')}}">[Download]</a></span>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                           {!!Form::open(array('url'=>'postQuestion','method'=>'post','class'=>'form-horizontal','data-toggle'=>'validator','role'=>'form','files'=>'true'))!!}
                     {!! csrf_field() !!}
                      <div class="form-group">
                       
                        <label for="Licence" class="col-md-2 control-label"></label>
                        <div class="col-md-5">
                            <input type="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"  name="file">
                        </div>
                       <div class="text-right col-md-3">
                            <div id="button1idGroup" class="btn-group pull-right" role="group" aria-label="">
                                <button type="reset" id="button1id" name="button1id" class="btn btn-default" aria-label="Cancel">Cancel</button>
                                <button type="submit" id="button2id" name="button2id" class="btn btn-success" aria-label="Cancel">Upload</button>
                            </div>

                        </div> 
                      
                      </div>

                    </form>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Licence Types</b>

        <a href="#" class="pull-right"><span class="label label-primary" data-toggle="modal" data-target="#licenceType">New Licence Type</span></a>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Licence Id</th>
                                            <th>Licence Type</th>
                                            <th>Download Questions</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $num=0;?>
                                    @foreach($licenceTypes as $info)
										<tr>
                                            <td>{{++$num}}</td>
											<td>{{$info->id}}</td>
                                            <td>{{$info->licence_type}}</td>
											<td><a href="{{url('downloadQuestion/licence_type/'.$info->id)}}">Download</a></td>
											<td><a href="#" data-toggle="modal" data-target="#licenceTypeEdit{{$info->id}}">Edit</a></td>
											<td><a onclick="return confirm('Wanna Delete?')" href="{{url('deleteBack/licence_types/'.$info->id)}}">Delete</a></td>
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
                
                <!-- /.col-lg-6 -->
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Subjects</b>
                            <a href="#" class="pull-right"><span class="label label-primary" data-toggle="modal" data-target="#subject">New Subject</span></a>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example1">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Licence Type</th>
                                            <th>Subject Id</th>
                                            <th>Subject</th>
                                            <th>Download Questions</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $num=0;?>
                                    @foreach($subjects as $info)
										<tr>
											<td>{{++$num}}</td>
											<td>{{$info->licence_type}}</td>
                                            <td>{{$info->id}}</td>
											<td>{{$info->subject}}</td>
                                            <td><a href="{{url('downloadQuestion/subject/'.$info->id)}}">Download</a></td>
											<td><a href="#" data-toggle="modal" data-target="#subjectEdit{{$info->id}}">Edit</a></td>
											<td><a onclick="return confirm('Wanna Delete?')" href="{{url('deleteBack/subjects/'.$info->id)}}">Delete</a></td>
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
                <!-- /.col-lg-6 -->
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Chapters</b>
                            <a href="#" class="pull-right"><span class="label label-primary" data-toggle="modal" data-target="#chapter">New Chapter</span></a>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example2">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Licence Type</th>
                                            <th>Subject</th>
                                            <th>Chapter Id</th>
                                            <th>Chapter</th>
                                            <th>QN(Exam)</th>
                                            <th>Download</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $num=0;?>
                                    @foreach($chapters as $info)
										<tr>
											<td>{{++$num}}</td>
											<td>{{$info->licence_type}}</td>
											<td>{{$info->subject}}</td>
                                            <td>{{$info->id}}</td>
                                            <td>{{$info->chapter}}</td>
                                            <td>{{$info->question_number}}</td>
											<td><a href="{{url('downloadQuestion/chapter/'.$info->id)}}">Download</a></td>
											<td><a href="#" data-toggle="modal" data-target="#chapterEdit{{$info->id}}">Edit</a></td>
											<td><a onclick="return confirm('Wanna Delete?')" href="{{url('deleteBack/chapters/'.$info->id)}}">Delete</a></td>
                                            
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
                <!-- /.col-lg-6 -->
</div>
<!-- /.row -->
@include('core.admin.questionBank.editForm')
@yield('licenceTypeEdit')
@yield('subjectEdit')
@yield('chapterEdit')

@include('core.admin.questionBank.entryForm')
@yield('licenceType')
@yield('subject')
@yield('chapter')
@stop