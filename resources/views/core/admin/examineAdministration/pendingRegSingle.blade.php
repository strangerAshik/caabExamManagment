@extends('core.layout.layoutAdmin')
@section('content')

   <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Pending Registration Request</b>
                            <div class="pull-right">
                            @if($singleRegister)
                                @if($singleRegister->reg_status!=1)
                                <a  onclick="return confirm('Wanna Active Him?')" href="{{url('userActive/'.$singleRegister->id)}}">Active</a>
                                @else 
                                <a href="{{url('userInactive/'.$singleRegister->id)}}">Inactive</a>
                                @endif
                            @endif
                            </div>

                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="">
                                   
                                    <tbody>
                                    <?php $num=0;?>
                                        @if($singleRegister)
                                        <tr>
                                            <th  colspan="2">
                                                <?php $images=App\AdminModel::getDocuments('users', $singleRegister->id) ?>
                                            @if($images)
                                                @foreach($images as $img)
                                                 <img style="height: 100px" class="img-thumbnail img-responsive pull-right" src="{{asset('public/documents/'.$img->calling_id)}}" alt="Examine Photo" />
                                                 <?php break;?>
                                                 @endforeach
                                            @else 
                                                No Photo 
                                            @endif
                                            </th>
                                            
                                        </tr>
                                        <tr><th class="col-md-3">Title </th><td>{{$singleRegister->title}}</td></tr>
                                        <tr><th>Full Name</th><td>{{$singleRegister->name}}</td></tr>
                                        <tr><th>Father Name</th><td>{{$singleRegister->father_name}}</td></tr>
                                        <tr><th>Mother Name</th><td>{{$singleRegister->mother_name}}</td></tr>
                                        <tr><th>Date of Birth</th><td>{{$singleRegister->date_of_birth}}</td></tr>
                                        <tr><th>Email</th><td>{{$singleRegister->email}}</td></tr>
                                        <tr><th>Nationality</th><td>{{$singleRegister->nationality}}</td></tr>
                                        <tr><th>Passport No</th><td>{{$singleRegister->passport_no}}</td></tr>
                                        <tr><th>Passport Validity Date</th><td>{{$singleRegister->validity_date}}</td></tr>
                                        <tr><th>Permanent Address</th><td>
                                        {{ $singleRegister->parmanent_address}}</td></tr>
                                        <tr><th>Mailing Address</th><td>
                                        {{ $singleRegister->mailing_address}}</td></tr>
                                        <tr><th>Gender</th><td>
                                        {{ $singleRegister->gender}}</td></tr>
                                        @else
                                        <tr>
                                            <td colspan="2">No Data Available</td>
                                        </tr>
                                        @endif

                                        
                                        
                                   
                                        
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
             
            <!--Academic Info-->
            @if($academicInfos)
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Academic Informations</b>
                          
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th> Degree</th>
                                            <th>Session</th>
                                            <th>Institute</th>
                                            <th>Subjects</th>
                                            <th>Result</th>
                                        </tr>
                                    </thead>
                                 
                                    <tbody>
                                    @foreach($academicInfos as $info)
                                       <tr>
                                            <td>{{$info->degree_name}}</td>
                                            <td>{{$info->start_date}} to {{$info->end_date}}</td>
                                            <td>{{$info->institute}}</td>
                                            <td>{{$info->subject}}</td>
                                            <td>{{$info->result}}</td>
                                           
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
            @endif
                <!-- /.col-lg-12 -->   
            <!--Professional Info-->
            @if($infos)
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Professional Informations</b>
                          
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
            @endif
            <!--Examine Result Archive-->
            @if($results)
            <!--Examine Result Archive-->
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Result Archive</b>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>License Type</th>
                                            <th>Subjects</th>
                                            <th>Exam Date</th>
                                            <th>Total Mark</th>
                                            <th>Obtained Mark</th>
                                            <th>Height Mark</th>
                                        </tr>
                                    </thead>
                                 
                                    <tbody>
                                    <?php $num=0;?>
                                    @foreach($results as $info)
                                       <tr>
                                            <td>{{++$num}}</td>
                                            <td>{{$info->licence_type}}</td>
                                            <td>{{$info->subject}}</td>
                                            <td>{{$info->exam_date}}</td>
                                            <td>{{$info->total_question}}</td>
                                            <td>{{$info->correct_ans}}</td>
                                            <td>
                                            <?php $highestMarks=App\ExaminerModel::higestMarksofExam($info->exam_id)?>
                                            {{$highestMarks}}
                                            </td>
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
            @endif
            </div>
            <!-- /.row -->

@stop