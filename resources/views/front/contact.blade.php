@extends('front.layout.layout')
@section('content')
    <div class="row"><!--Container row-->

        <div class="span12 contact"><!--Begin page content column-->

            <h2 class="title-bg">Contact Us</h2>
          
         @if (session('messageSend'))
            <div class="alert alert-success">
                {{session('messageSend')}}
            </div>
        @endif

            <form action="{{url('sendEmail')}}" id="contact-form" method="GET">

                <div class="input-prepend">
                    <span class="add-on"><i class="icon-user"></i></span>
                    <input name="name" class="span4" id="prependedInput"  type="text" placeholder="Name">
                </div>
                <div class="input-prepend">
                    <span class="add-on"><i class="icon-envelope"></i></span>
                    <input required="required" name="email" class="span4" id="prependedInput"  type="email" placeholder="Email Address">
                </div>
                <div class="input-prepend">
                    <span class="add-on"><i class="icon-edit"></i></span>
                    <input name="subject" class="span4" id="prependedInput"  type="text" placeholder="Subject">
                </div>
                <textarea name="message" class="span6" required="required"></textarea>
                <div class="row">
                    <div class="span2">
                        <input type="submit" class="btn btn-inverse" value="Send Message">
                    </div>
                </div>
            </form>

        </div> <!--End page content column-->

        <!-- Sidebar
        ================================================== --> 
        <div style="display: none" class="span4 sidebar page-sidebar"><!-- Begin sidebar column -->
            <h5 class="title-bg">Our Location</h5>
            <address>
            <strong>Piccolo</strong><br>
            123 Main St, Suite 600<br>
            San Francisco, CA 94107<br>
            <abbr title="Phone">P:</abbr> (123) 456-7890
            </address>
             
            <address>
            <strong>Jimmy Doe</strong><br>
            <a href="mailto:#">first.last@gmail.com</a>
            </address>

            

        </div><!-- End sidebar column -->

    </div><!-- End container row -->


@stop
 