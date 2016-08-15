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

    <!-- Bootstrap Core CSS -->
    <link href="{{asset('public/coreAsset/bower_components/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!--Tree View-->
    <link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-combined.min.css" rel="stylesheet">



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
<?php 
$roleId=Auth::user()->role_id;
$privileges=App\AdminModel::privilegedSections($roleId);
//$privileges=unserialize($privileges);
?>

     @if($roleId==2)
      {{dd('You\'r not allowed here!')}}
     @endif
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
            @yield('content')
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="{{asset('public/coreAsset/bower_components/jquery/dist/jquery.min.js')}}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{asset('public/coreAsset/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{asset('public/coreAsset/bower_components/metisMenu/dist/metisMenu.min.js')}}"></script>

    <!-- Morris Charts JavaScript -->
    <script src="{{asset('public/coreAsset/bower_components/raphael/raphael-min.js')}}"></script>
    <script src="{{asset('public/coreAsset/bower_components/morrisjs/morris.min.js')}}"></script>
   

    <!-- Custom Theme JavaScript -->
    <script src="{{asset('public/coreAsset/dist/js/sb-admin-2.js')}}"></script>
    <!--Tree- View-->
    <script type="text/javascript">
    $(function() {
  $('.tree li:has(ul)').addClass('parent_li').find(' > span').attr('title', 'Collapse this branch');
  $('.tree li.parent_li > span').on('click', function(e) {
    var children = $(this).parent('li.parent_li').find(' > ul > li');
    if (children.is(":visible")) {
      children.hide('fast');
      $(this).attr('title', 'Expand this branch').find(' > i').addClass('icon-plus-sign').removeClass('icon-minus-sign');
    } else {
      children.show('fast');
      $(this).attr('title', 'Collapse this branch').find(' > i').addClass('icon-minus-sign').removeClass('icon-plus-sign');
    }
    e.stopPropagation();
  });
});

</script>



</body>

</html>
