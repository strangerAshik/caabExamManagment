@section('category')
 <!-- Category Modal -->
  <div class="modal fade" id="addCategory" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">New Category</h4>
        </div>
        <div class="modal-body">
           <form class="form-horizontal" role="form" method="POST" action="{{url('frontManagement/saveCategory')}}">
           {!! csrf_field() !!}
                  <div class="form-group">
                    <label  class="col-sm-2 control-label"
                              for="inputEmail3">Category</label>
                    <div class="col-sm-10">
                        <input type="text" name="category" class="form-control" 
                        id="" placeholder=""/>
                    </div>
                  </div>
                 
                 <div id="button1idGroup" class="btn-group pull-right" role="group" aria-label="">
                  <button type="button" id="button1id" name="button1id" class="btn btn-default " aria-label="Cancel" data-dismiss="modal">Cancel</button>
                  <button type="submit" id="button2id" name="button2id" class="btn btn-primary " aria-label="Cancel">Save</button>
                  </div>
             
                  
                 
                  
                </form>
        </div>
        <div class="modal-footer">
          
        </div>
      </div>
    </div>
  </div>
@stop