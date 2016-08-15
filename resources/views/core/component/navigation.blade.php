@section('navigation')
<?php 
$roleId=Auth::user()->role_id;
$privileges=App\AdminModel::privilegedSections($roleId);
//$privileges=unserialize($privileges);
?>

<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><span style="color:#D8450B;font-size: 30px;font-family: 'Kaushan Script',cursive;
font-weight: normal;
text-transform: uppercase;">Examiner</span></a>
<span style="line-height: 50px">| An Exam Management Excellence </span>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
           
           
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                       
                        <li><a href="{{url('setting/adminSetting')}}"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        @if(Session::get('ExamTime')!=1)
                        <li><a href="{{url('customlogout')}}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        @endif
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">

                    
                        @if(in_array('11', $privileges))
                        <li>
                            <a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        @endif

                        @if(in_array('1', $privileges))
                        <li>
                            <a href="#"><i class="fa fa-th fa-fw"></i> Front Managment<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{url('frontManagment/addContent')}}">Add Content</a>
                                </li>
                                <li>
                                    <a href="{{url('frontManagment/allContent')}}">All Content</a>
                                </li>
                                <li>
                                    <a href="{{url('frontManagment/allCategory')}}">Category</a>
                                </li>
                               
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        @endif

                        @if(in_array('2', $privileges))
                        <li>
                            <a href="#"><i class="fa fa-th fa-fw"></i> Examine Administration<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{url('examineAdminstration/pendingReg')}}">Pending Registration Request</a>
                                </li>
                                <li>
                                    <a href="{{url('examineAdminstration/pendingExm')}}">Pending Exam Sit Request</a>
                                </li>
                                <li>
                                    <a href="{{url('examineAdminstration/examineList')}}">Examine List</a>
                                </li>
                               
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        @endif
                        
                        @if(in_array('4', $privileges))
                        <li>
                            <a href="#"><i class="fa fa-th fa-fw"></i> Exam Schedule<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{url('examShedule/newExam')}}">New Exam</a>
                                </li>
                                <li>
                                    <a href="{{url('examShedule/upcomingExam')}}">Upcoming Exam</a>
                                </li>
                                <li>
                                    <a href="{{url('examShedule/archive')}}">Exam Archive</a>
                                </li>
                               
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        @endif
                        
                        @if(in_array('5', $privileges))
                        <li>
                            <a href="#"><i class="fa fa-th fa-fw"></i> </i>Question Bank<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{url('questionBank/newQuestion')}}">New Question</a>
                                </li>
                                <li>
                                    <a href="{{url('questionBank/questionRoom')}}">Question Archive</a>
                                </li>
                                <li>
                                    <a href="{{url('questionBank/management')}}">Management</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        @endif

                        @if(in_array('6', $privileges))
                        <li>
                            <a href="#"><i class="fa fa-th fa-fw"></i> Exam Question Generate<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{url('questionGenerate/newQuestionSetup')}}">New Exam Question</a>
                                </li>
                                <li>
                                    <a href="{{url('questionGenerate/upcomingExamQuestions')}}">Upcoming Exam Questions</a>
                                </li>
                                <li>
                                    <a href="{{url('questionGenerate/questionArchive')}}">Exam Question Archive</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        @endif

                        @if(in_array('7', $privileges))
                        <li>
                            <a href="#"><i class="fa fa-th fa-fw"></i> Result<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{url('result/resultArchive')}}">Result Archive</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        @endif

                        @if(in_array('8', $privileges))
                        <li>
                            <a href="#"><i class="fa fa-th fa-fw"></i> Section Management<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="{{url('setting/addSection')}}">Add Section</a></li>
                                <li><a href="{{url('setting/viewSections')}}">View Section</a></li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        @endif

                        @if(in_array('9', $privileges))
                        <li>
                            <a href="#"><i class="fa fa-th fa-fw"></i> Role Management<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="{{url('setting/addRole')}}">Add Role</a></li>
                                <li><a href="{{url('setting/viewRoles')}}">View Roles</a></li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        @endif
                       
                        @if(in_array('10', $privileges))
                        <li>
                            <a href="#"><i class="fa fa-th fa-fw"></i> User Management<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="{{url('setting/addUser')}}">Add User</a></li>
                                <li><a href="{{url('setting/viewUsers')}}">View Users</a></li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        @endif

                        @if(in_array('1', $privileges))
                        <li style="display: none">
                            <a href="#"><i class="fa fa-th fa-fw"></i> Report</a>
                            
                            <!-- /.nav-second-level -->
                        </li>
                        @endif
                        
                        @if(in_array('12', $privileges)  && Session::get('ExamTime')!=1)
                        <li>
                            <a href="{{url('examine/dashboard')}}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        @endif
                        
                        @if(in_array('13', $privileges) && Session::get('ExamTime')!=1)
                        <li>
                            <a href="{{url('#')}}"><i class="fa fa-th fa-fw"></i> Examinee Info. <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{url('examine/personalInfo/personal/'.Auth::user()->id)}}">Personal</a>
                                    <a href="{{url('examine/personalInfo/academic/'.Auth::user()->id)}}">Academic</a>
                                    <a href="{{url('examine/personalInfo/professional/'.Auth::user()->id)}}">Professional</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        @endif
                        
                        @if(in_array('14', $privileges) && Session::get('ExamTime')!=1)
                        <li>
                            <a href="{{url('#')}}"><i class="fa fa-th fa-fw"></i> My Participation <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{url('examine/myParticipation/examParticipation')}}">Upcoming Exam</a>
                                    
                                </li> 
                                <li>
                                    <a href="{{url('examine/myParticipation/myParticipationArchive')}}">Archive</a>
                                    
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        @endif
                       
                        @if(in_array('15', $privileges) && Session::get('ExamTime')!=1)
                        <li>
                            <a href="{{url('/examRoom/todayExam')}}"><i class="fa fa-th fa-fw"></i> Today's Exam</a>
                        </li>
                        @endif
                        <!-- <li>
                            <a href="{{url('examine/examRoom/{examineId}')}}"><i class="fa fa-th fa-fw"></i> Exam Room </a>
                        </li> -->
                        @if(in_array('16', $privileges) && Session::get('ExamTime')!=1)
                        <li>
                            <a href="{{url('#')}}"><i class="fa fa-th fa-fw"></i> Result <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{url('examine/result/resultArchive')}}">Result Archive</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        @endif
                       
                    </ul>

                    <!--Clock-->
                    <div id="clock" class="light">
                        <div class="display">
                            
                            <div class="ampm"></div>
                            <div class="alarm"></div>
                            <div class="digits"></div>
                        </div>
                    </div>
                    <!--End Clock-->

                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
@stop