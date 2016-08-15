 @extends('core.layout.layoutExamine')
@section('content')
  <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Password Change</b>                           
                        </div>
                        
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                          
                              {!!Form::open(array('url'=>'setting/changePassword','method'=>'post','class'=>'form-horizontal','data-toggle'=>'validator','role'=>'form','files'=>'true'))!!}
                                {!! csrf_field() !!}
                              <div class="form-group">
                                <label for="" class="col-md-2 control-label">Old Password</label>
                                <div class="col-md-4">
                                   <input name="old_password" type="password" name="" class="form-control"  placeholder="">
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="" class="col-sm-2 control-label">New Password</label>
                                <div class="col-sm-4">
                                   <input name="password" type="password" name="" class="form-control"  placeholder="">
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Confirm Password</label>
                                <div class="col-sm-4">
                                   <input name="password_confirmation" type="password" name="" class="form-control"  placeholder="">
                                </div>
                              </div>
                               <div class="form-group">
                                <label class="control-label col-md-1"></label>
                                <div class="text-right col-md-5">
                                   <div id="button1idGroup" class="btn-group pull-right" role="group" aria-label="">
                                      <button type="reset" id="button1id" name="button1id" class="btn btn-default" aria-label="Cancel">Cancel</button>
                                      <button type="submit" id="button2id" name="button2id" class="btn btn-success" aria-label="Cancel">Save </button>
                                   </div>
                                </div>
                             </div>
                              {!!Form::close()!!}
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Change Email</b>                           
                        </div>
                        
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                          
                              {!!Form::open(array('url'=>'setting/changeEmail','method'=>'post','class'=>'form-horizontal','data-toggle'=>'validator','role'=>'form','files'=>'true'))!!}
                                {!! csrf_field() !!}
                              <div class="form-group">
                                <label for="" class="col-md-2 control-label">Old Email</label>
                                <div class="col-md-4">
                                   <input name="old_email" type="email" name="" class="form-control"  placeholder="">
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="" class="col-sm-2 control-label">New Email</label>
                                <div class="col-sm-4">
                                   <input name="new_email" type="email" name="" class="form-control"  placeholder="">
                                </div>
                              </div>
                            
                               <div class="form-group">
                                <label class="control-label col-md-1"></label>
                                <div class="text-right col-md-5">
                                   <div id="button1idGroup" class="btn-group pull-right" role="group" aria-label="">
                                      <button type="reset" id="button1id" name="button1id" class="btn btn-default" aria-label="Cancel">Cancel</button>
                                      <button type="submit" id="button2id" name="button2id" class="btn btn-success" aria-label="Cancel">Save </button>
                                   </div>
                                </div>
                             </div>
                              {!!Form::close()!!}
                         
                        </div>
                    </div>
                </div>
  </div>
@stop
