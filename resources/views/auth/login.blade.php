@extends('front.layout.layout')
@section('content')
    <div class="row"><!--Container row-->

        <div class="span8 contact"><!--Begin page content column-->

            <h2 class="title-bg">Login</h2>
           
        @if ($errors->has('email') || $errors->has('password')) 
            <div class="alert alert-worning">
                @if ($errors->has('email'))                       
                        <strong>{{ $errors->first('email') }}</strong><br>               
                @endif
                @if ($errors->has('password'))                        
                        <strong>{{ $errors->first('password') }}</strong><br>             
                @endif      
            </div>
        @endif
    @if (session('loginError'))
        <div class="alert alert-danger">
            {{ session('loginError') }}
        </div>
     @endif

            {!!Form::open(array('url'=>'authenticate','method'=>'post','class'=>'form-horizontal','data-toggle'=>'validator','role'=>'form'))!!}
             {!! csrf_field() !!}
                <div class="input-prepend {{ $errors->has('email') ? ' has-error' : '' }}" >
                    <span class="add-on"><i class="icon-envelope"></i></span>
                    <input class="span4" name="email" id="prependedInput" size="16" type="text" placeholder="email" value="{{ old('email') }}">

                    
                </div>

                <div class="input-prepend {{ $errors->has('password') ? ' has-error' : '' }}">
                    <span class="add-on"><i class="icon-lock"></i></span>
                    <input class="span4" name="password" id="prependedInput" size="16" type="password" placeholder="Email Address">
                    
                    
                </div>
                 <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>
                <div class="row">
                    <div class="span2">
                        <input type="submit" class="btn btn-inverse" value="Login">

                    </div>
                </div>
            </form>
             <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a> | <span>Not Registered ? Register <a href="{{url('register')}}">Here</a></span>


        </div> <!--End page content column-->

        <!-- Sidebar
        ================================================== --> 
        <div class="span4 sidebar page-sidebar"><!-- Begin sidebar column -->
            <h5 class="title-bg">Instruction</h5>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla iaculis mattis lorem, quis gravida nunc iaculis ac. Proin tristique tellus in est vulputate luctus fermentum ipsum molestie. Vivamus tincidunt sem eu magna varius elementum. Maecenas felis tellus, fermentum vitae laoreet vitae, volutpat et urna.</p>
        </div><!-- End sidebar column -->

    </div><!-- End container row -->


@stop
 

