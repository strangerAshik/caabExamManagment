@section('personalData')
 <div class="row">
  <!--Professional Info-->
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Personal Informations</b>
                            <a class="pull-right" href="{{url('examine/personalInfo/editPersonalInfos')}}">Edit</a>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                 @if($infos)
                                    <tbody>
                                       <tr>
                                       		<th>Title</th><td>{{$infos->title}}</td>
                                       	</tr>
                                       	<tr>
                                       		<th>Full Name</th><td>{{$infos->name}}</td>
                                       	</tr>
                                       	<tr>
                                       		<th>Father Name</th><td>{{$infos->father_name}}</td>
                                       	</tr>
                                       	<tr>
                                       		<th>Mother Name</th><td>{{$infos->mother_name}}</td>
                                       	</tr>
                                       	<tr>
                                       		<th>Date Of Birth</th><td>{{$infos->date_of_birth}}</td>
                                       	</tr>
                                       	
                                       	
                                       	<tr>
                                       		<th>Nationality</th><td>{{$infos->nationality}}</td>
                                       	</tr>
                                       	<tr>
                                       		<th>Passport No.</th><td>{{$infos->passport_no}}</td>
                                       	</tr>
                                       	<tr>
                                       		<th>Passport Validity</th><td>{{$infos->validity_date}}</td>
                                       	</tr>
                                       	<tr>
                                       		<th>Parmanent Address</th><td><?php echo nl2br($infos->parmanent_address);?></td>
                                       	</tr>
                                       	<tr>
                                       		<th>Mailing Address</th><td><?php echo nl2br($infos->mailing_address);?></td>
                                       	</tr>
                                       	<tr>
                                       		<th>Gender</th><td>{{$infos->gender}}</td>
                                       	</tr>
                                       	<tr>
                                       		<th>Photo</th>
                                          <td>
                                              <?php $images=App\AdminModel::getDocuments('users', Auth::user()->id) ?>
                                            @if($images)
                                                @foreach($images as $img)
                                                 <img style="height: 100px" class="img-thumbnail img-responsive " src="{{asset('public/documents/'.$img->calling_id)}}" alt="Examine Photo" />
                                                 <?php break;?>
                                                 @endforeach
                                            @else 
                                                No Photo 
                                            @endif
                                          </td>
                                       </tr>
                                       
                                    </tbody>
                                    @else
                                    <tbody>
                                      <tr>
                                        <td colspan="2">No Data Provided</td>
                                      </tr>
                                    </tbody>
                                    @endif
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