@extends('core.layout.layoutAdminTable')
@section('content')

   <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>All Categories</b>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Category</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $num=0;?>
                                    @foreach($allCategories as $info)
                                    <tr>
                                        <td>{{++$num}}</td>
                                        <td>{{$info->category}} </td>
                                        <td><a href="" data-toggle="modal" data-target="#editCategory{{$info->id}}">Edit</a></td>
                                        <td><a onclick="return confirm('Wanna delete?');" href="{{url('deleteBack/categories/'.$info->id)}}">Delete</td>
                                    </tr>
                                    @endforeach
                                   
                                        
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
 @foreach($allCategories as $info)
<div class="modal fade" id="editCategory{{$info->id}}" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">New Category</h4>
        </div>
        <div class="modal-body">
           <form class="form-horizontal" role="form" method="POST" action="{{url('frontManagement/updateCategory')}}">
                {!!csrf_field()!!}
                {!!Form::hidden('id',$info->id)!!}
                  <div class="form-group">
                    <label  class="col-sm-2 control-label"
                              for="inputEmail3">Category</label>
                    <div class="col-sm-10">
                        <input type="text" name="category" value="{{$info->category}}" class="form-control" 
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
  @endforeach

@stop