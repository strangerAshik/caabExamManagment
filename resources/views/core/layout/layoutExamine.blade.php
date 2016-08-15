<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Examiner | An Exam Management Excellence</title>
    <!--Pro-->    

     <!--Date Picker-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/dateTime/jquery.datetimepicker.css')}}"/>

    <!-- Bootstrap Core CSS -->
    <link href="{{asset('public/coreAsset/bower_components/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
  


    <!-- MetisMenu CSS -->
    <link href="{{asset('public/coreAsset/bower_components/metisMenu/dist/metisMenu.min.css')}}" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="{{asset('public/coreAsset/dist/css/timeline.css')}}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{asset('public/coreAsset/dist/css/sb-admin-2.css')}}" rel="stylesheet">


    <!-- Custom Fonts -->
    <link href="{{asset('public/coreAsset/bower_components/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

   
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        @include('core.component.navigation')
        @yield('navigation')

        <div id="page-wrapper"> 
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><!-- Dashboard --></h1>
            </div>
        <!-- /.col-lg-12 -->
        </div>
<!-- /.row -->    
   @if (count($errors) > 0)
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif
     @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
     @endif
     @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
     @endif      
            @yield('content')
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="{{asset('public/coreAsset/bower_components/jquery/dist/jquery.min.js')}}"></script>
     <!--DatePicker-->
    <script src="{{asset('public/dateTime/jquery.datetimepicker.full.js')}}"></script>
    <script type="text/javascript">
        $.datetimepicker.setLocale('en');

        //Exam
        $('.timeExam').datetimepicker({
          datepicker:false,
          format:'H:i'
        });

        $('.dateExam').datetimepicker({
         timepicker:false,
         format:'d F Y'

        });
        //End Exam
    </script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{asset('public/coreAsset/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{asset('public/coreAsset/bower_components/metisMenu/dist/metisMenu.min.js')}}"></script>

    <!-- Morris Charts JavaScript -->
    <script src="{{asset('public/coreAsset/bower_components/raphael/raphael-min.js')}}"></script>
    <script src="{{asset('public/coreAsset/bower_components/morrisjs/morris.min.js')}}"></script>
   

    <!-- Custom Theme JavaScript -->
    <script src="{{asset('public/coreAsset/dist/js/sb-admin-2.js')}}"></script>
   


</body>

</html>
