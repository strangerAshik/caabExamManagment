@extends('front.layout.layout')
@section('content')
    <div class="row"><!--Container row-->

        <div class="span8 contact"><!--Begin page content column-->

            <h2 class="title-bg">{{$about->title}}</h2>
           
             <p><?php echo $about->content;?></p>


        </div> <!--End page content column-->

        <!-- Sidebar
        ================================================== --> 
        <div class="span4 sidebar page-sidebar"><!-- Begin sidebar column -->
            <h5 class="title-bg">{{$mission->title}}</h5>
            <p>
                <?php echo $mission->content ;?>
            </p>
            <h5 class="title-bg">{{$vission->title}}</h5>
            <p>
                <?php echo $vission->content ;?>
            </p>
        </div><!-- End sidebar column -->

    </div><!-- End container row -->


@stop
 