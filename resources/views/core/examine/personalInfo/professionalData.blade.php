@section('professionalData')
<div class="row">
 			<!--Professional Info-->
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Professional Informations</b>
                            @if(!$infos)
                            <a class="pull-right" href="{{url('examine/personalInfo/addProfessional')}}">Add</a>
                            @else
                            <a  class="pull-right" href="{{url('examine/personalInfo/editProfessional')}}">Update</a>
                            @endif
                        </div>
                        <!-- /.panel-heading -->
                        
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                 @if($infos)
                                    <tbody>
                                    
                                       	<tr>
                                       		<th class="col-md-4">Date of First training Flight</th><td>{{$infos->first_training_date}}</td>
                                       	</tr>
                                       	<tr>
                                       		<th>Defense Personnel</th><td>{{$infos->defense_personnel}}</td>
                                       	</tr>
                                       	<tr>
                                       		<th>Defense Category</th><td>{{$infos->defence_category}}</td>
                                       	</tr>
                                       	<tr>
                                       		<th>Whether Having SPL or Not</th><td>{{$infos->having_spl_or_not}}</td>
                                       	</tr>
                                       	<tr>
                                       		<th>Date of issue of SPL</th><td>{{$infos->date_of_issue_of_spl}}</td>
                                       	</tr>
                                       	<tr>
                                       		<th>Whether Having Higher Category Pilot License?</th><td>{{$infos->higher_category_pilot_license}}</td>
                                       	</tr>
                                       	<tr>
                                       		<th>License Category</th><td>{{$infos->license_category}}</td>
                                       	</tr>
                                       	<tr>
                                       		<th>License Number</th><td>{{$infos->license_number}}</td>
                                       	</tr>
                                       	<tr>
                                       		<th>License Validity</th><td>{{$infos->license_validity}}</td>
                                       	</tr>
                                       	<tr>
                                       		<th>Endorsement of Multi Engine Aircraft</th><td>{{$infos->endorsement_of_multi_engine_aircraft}}</td>
                                       	</tr>
                                       	<tr>
                                       		<th>Total Flying Hour</th><td>{{$infos->total_flying_hour}}</td>
                                       	</tr>
                                       	<tr>
                                       		<th>Total Flying Hour as Pilot in Command</th><td>{{$infos->total_flying_hour_as_pilot_in_command}}</td>
                                       	</tr>
                                       	<tr>
                                       		<th>Flying Training Institute</th><td>{{$infos->flying_training_institute}}</td>
                                       </tr>
                                        <tr>
                                          <th>Ground Training Institute</th><td>{{$infos->ground_training_institute}}</td>
                                       </tr>
                                       	<tr>
                                       		<th>Document(s)</th><td>
                                                <?php $images=App\AdminModel::getDocuments('professional_details', $infos->id) ?>
                                        @if($images)
                                        <ul>
                                            @foreach($images as $img)
                                            <li>
                                             <a target="_blink" href="{{asset('public/documents/'.$img->calling_id)}}" alt="Examine Photo" >{{$img->doc_name}}</a>
                                              <a  style="color: red" onclick="return confirm('Wanna Delete?');" href="{{url('deleteBack/documents/'.$img->id)}}">[Delete]</a>
                                              </li>
                                            
                                             @endforeach
                                             </ul>
                                        @else 
                                            No Document 
                                        @endif
                                          </td>
                                       </tr>
                                       
                                    </tbody>
                                    @else
                                     <tbody>
                                       <tr>
                                         <td colspan="2">No Information Provided Yet!!</td>
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