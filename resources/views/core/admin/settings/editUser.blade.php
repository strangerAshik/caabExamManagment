 @extends('core.layout.layoutAdmin')
@section('content')

  <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Edit User</b>                           
                        </div>
                        
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                          
                              {!!Form::open(array('url'=>'setting/updateUser','method'=>'post','class'=>'form-horizontal','data-toggle'=>'validator','role'=>'form','files'=>'true'))!!}
                                {!! csrf_field() !!}
                                <input name="id" value="{{$user->id}}" type="hidden">
                              <div class="form-group">
                                <label for="" class="col-md-3 control-label">Title</label>
                                <div class="col-md-8">
                                   <input name="title" value="{{$user->title}}" type="text" class="form-control"  placeholder="">
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="" class="col-md-3 control-label">Name</label>
                                <div class="col-md-8">
                                   <input name="name" value="{{$user->name}}" type="text" class="form-control"  placeholder="">
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="" class="col-md-3 control-label">Email</label>
                                <div class="col-md-8">
                                   <input name="email" value="{{$user->email}}" required="" type="email" class="form-control"  placeholder="">
                                </div>
                              </div>

                              <div class="form-group">
                                <label for="" class="col-md-3 control-label">Role</label>
                                <div class="col-md-8">
                                  <select class="form-control" name='role' required="" >
                                      <option value="">Select Role...</option>
                                       @foreach($roles as $info)
                                        <option @if($user->role_id==$info->id) selected="" @endif value="{{$info->id}}">{{$info->role}}</option>
                                        @endforeach
                                               
                                   </select>
                                </div>
                              </div>

                              <div class="form-group">
                                <label for="" class="col-md-3 control-label">Status</label>
                                <div class="col-md-8">
                                  <select class="form-control" name='active' required="" >
                                      <option value="">Select Status...</option>
                                      
                                      <option @if($user->active=='1') selected="" @endif value="1">Active</option>
                                      <option @if($user->active=='0') selected="" @endif value="0">Inactive</option>
                                       
                                               
                                   </select>
                                </div>
                              </div>

                             
                             
                              
                               <div class="form-group">
                                <label class="control-label col-md-6"></label>
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
                            <b>Reset Password</b>                           
                        </div>
                        
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                          
                              {!!Form::open(array('url'=>'setting/updateUserPassword','method'=>'post','class'=>'form-horizontal','data-toggle'=>'validator','role'=>'form','files'=>'true'))!!}
                                {!! csrf_field() !!}
                              
                               <input name="id" value="{{$user->id}}" type="hidden">

                              <div class="form-group">
                                <label for="" class="col-md-3 control-label">Password</label>
                                <div class="col-md-8">
                                   <input  required="" name="password"  type="password" class="form-control"  pattern=".{6,}" title="Six or more characters">

                                </div>
                              </div>
                              <div class="form-group">
                                <label for="" class="col-md-3 control-label">Confirm Password</label>
                                <div class="col-md-8">
                                   <input required=""  name="password_confirmation" type="password" class="form-control"  placeholder="" pattern=".{6,}" title="Six or more characters">
                                </div>
                              </div>
                             
                             
                              
                               <div class="form-group">
                                <label class="control-label col-md-6"></label>
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
