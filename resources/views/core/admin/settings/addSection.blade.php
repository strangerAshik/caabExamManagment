 @extends('core.layout.layoutAdmin')
@section('content')

  <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Add Section</b>                           
                        </div>
                        
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                          
                              {!!Form::open(array('url'=>'setting/saveSection','method'=>'post','class'=>'form-horizontal','data-toggle'=>'validator','role'=>'form','files'=>'true'))!!}
                                {!! csrf_field() !!}
                              <div class="form-group">
                                <label for="" class="col-md-3 control-label">Section Name</label>
                                <div class="col-md-8">
                                   <input name="name" type="text" class="form-control"  placeholder="">
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="" class="col-md-3 control-label">Description</label>
                                <div class="col-md-8">
                                  <textarea name="description" rows="3" class="form-control"></textarea>
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
