@extends('front.layout.layout')
@section('content')
<style type="text/css">
    .formAddonWidth{width:100px!important;}
</style>
    <div class="row"><!--Container row-->

        <div class="span8 contact"><!--Begin page content column-->

            <h2 class="title-bg">Register</h2>
              
                {!!Form::open(array('url'=>'postRegister','method'=>'post','class'=>'form-horizontal','data-toggle'=>'validator','role'=>'form','files'=>'true'))!!}
                     {!! csrf_field() !!}
                  <div class="control-group">
                    <label class="control-label" for="title">Title</label>
                    <div class="controls">
                      <input class="input-xxlarge" type="text" name="title" id="title" placeholder="">
                    </div>
                  </div>

                 
                  <div class="control-group {{ $errors->has('name') ? ' has-error' : '' }}">
                    <label class="control-label" for="Name">Full Name</label>
                    <div class="controls">
                      <input class="input-xxlarge" type="text" name="name" placeholder="" value="{{ old('name') }}">
                       @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                  </div>
                
                  <div class="control-group">
                    <label class="control-label" for="title">Father Name</label>
                    <div class="controls">
                      <input class="input-xxlarge" type="text" name="father_name" placeholder="">
                    </div>
                  </div>

                  <div class="control-group">
                    <label class="control-label" for="title">Mother Name</label>
                    <div class="controls">
                      <input class="input-xxlarge" type="text" name="mother_name" placeholder="">
                    </div>
                  </div>

                  <div class="control-group">
                    <label class="control-label" for="title">Date Of Birth</label>
                    <div class="controls">
                      <input class="input-xxlarge dateExam" type="text" name="date_of_birth"    placeholder="">
                    </div>
                  </div>

                  <div class="control-group {{ $errors->has('email') ? ' has-error' : '' }}">
                    <label class="control-label" for="title">Email</label>
                    <div class="controls">
                      <input class="input-xxlarge" type="email" name="email" placeholder="" value="{{ old('email') }}">
                       @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                    </div>
                  </div>

                  <div class="control-group">
                    <label class="control-label" for="title">Nationality</label>
                    <div class="controls">
                      <input class="input-xxlarge" type="text" name="nationality" placeholder="">
                    </div>
                  </div>

                  <div class="control-group">
                    <label class="control-label" for="title">Passport No</label>
                    <div class="controls">
                      <input class="input-xxlarge" type="text" name="passport_no" placeholder="">
                    </div>
                  </div>

                  <div class="control-group">
                    <label class="control-label" for="title">Passport Validity Date</label>
                    <div class="controls">
                      <input class="input-xxlarge dateExam" name="validity_date" type="text"  placeholder="">
                    </div>
                  </div>

                  <div class="control-group">
                    <label class="control-label" for="title">Permanent Address</label>
                    <div class="controls">                     
                      <textarea class="input-xxlarge" name="parmanent_address"></textarea>
                    </div>
                  </div>

                  <div class="control-group">
                    <label class="control-label" for="title">Mailing Address</label>
                    <div class="controls">
                        <textarea class="input-xxlarge" name="mailing_address"></textarea>
                    </div>
                  </div>

                  <div class="control-group">
                    <label class="control-label" for="title">Gender</label>
                    <div class="controls">
                      <select name="gender" class="span5">
                        <option value="">Select Gender..</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                      </select>
                    </div>
                  </div>
                 


                  <div class="control-group">
                    <label class="control-label" for="title">Photo</label>
                    <div class="controls">
                    <img id="blah" alt="your image" width="100" height="100" />
                   <input class="input-xxlarge" type="file" name="photo[]" multiple="true" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                    </div>
                  </div>


                  <div class="control-group {{ $errors->has('password') ? ' has-error' : '' }}">
                    <label class="control-label" for="title">Password</label>
                    <div class="controls">
                      <input class="input-xxlarge" type="password" name="password" placeholder="" pattern=".{6,}" title="Six or more characters">
                       @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                       @endif
                    </div>
                  </div>
                  <div class="control-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <label class="control-label" for="title">Re-Type Password</label>
                    <div class="controls">
                      <input class="input-xxlarge" type="password" name="password_confirmation" placeholder="" pattern=".{6,}" title="Six or more characters">
                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>
                  </div>
                


                 
                  <div class="control-group">
                    <div class="controls">                     
                      <button type="submit" class="btn btn-inverse">Register</button>
                    </div>
                  </div>
                </form>
           
           


        </div> <!--End page content column-->

        <!-- Sidebar
        ================================================== --> 
        <div class="span4 sidebar page-sidebar"><!-- Begin sidebar column -->
         <span>Registered ? Login <a href="{{url('login')}}">Here</a></span>
            <h5 class="title-bg">Instruction</h5>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla iaculis mattis lorem, quis gravida nunc iaculis ac. Proin tristique tellus in est vulputate luctus fermentum ipsum molestie. Vivamus tincidunt sem eu magna varius elementum. Maecenas felis tellus, fermentum vitae laoreet vitae, volutpat et urna.</p>
        </div><!-- End sidebar column -->

    </div><!-- End container row -->


@endsection
