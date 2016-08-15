@extends('core.layout.layoutAdmin')
@section('content')

<div class="row">

   <div class="col-md-12">
  
      <div class="box box-info">
         <div class="box-header with-border">
            <h3 class="box-title">New Content</h3>
         </div>
         <!-- /.box-header -->
         <!-- form start -->
        
        
         {!!Form::open(array('url'=>'frontManagement/updateContent','method'=>'post','class'=>'form-horizontal','data-toggle'=>'validator','role'=>'form','files'=>'true'))!!}
         <div class="box-body">
            {{Form::hidden('id',$contents->id)}}
            <div class="form-group ">
               <label for="title" class="col-md-2 control-label ">Title</label>
               <div class="col-md-4">
                  <input name="title" value="{{$contents->title}}" class="form-control"  placeholder=" " required="">
               </div>
               <label for="title" class="col-md-2 control-label ">Subtitle</label>
               <div class="col-md-4">
                  <input name="subtitle" value="{{$contents->subtitle}}" class="form-control"  placeholder=" " >
               </div>               
            </div>
            <div class="form-group ">
               <label for="category" class="col-md-2 control-label ">Category</label>
               <div class="col-md-4">
               {!!Form::select('category_id',[' '=>'Select Category..']+$categories,$contents->category_id,array('class'=>'form-control'))!!}
                 <a href="#"> <span class="label label-primary glyphicon glyphicon-plus" class="btn btn-info btn-lg" data-toggle="modal" data-target="#addCategory"> New Category</span></a>
                 
                 
               </div>  
               <label for="category" class="col-md-2 control-label ">Unique Key</label>
               <div class="col-md-4">
                  <input name="unique_key" value="{{$contents->unique_key}}" class="form-control"  placeholder=" " >
               </div>            
            </div>
            <div class="form-group">
               <label for="description" class="col-md-2 control-label">Content</label>
               <div class="col-md-10">
                  <textarea name="content"  class="form-control" rows="5">{{$contents->content}}</textarea>
                  
               </div>
            </div>
            <div class="form-group">
               <label for="description" class="col-md-2 control-label">More Content (Not Recommended )</label>
               <div class="col-md-10">
                  <textarea name="more_content" class="form-control" rows="5">{{$contents->more_content}}</textarea>
                  
               </div>
            </div>

            <div class="form-group ">
               <label for="title" class="col-md-2 control-label ">Hyper Link</label>
               <div class="col-md-10">
                  <input name="hyper_link" value="{{$contents->hyper_link}}" class="form-control"  placeholder=" " >
               </div>
                             
            </div>
            @if($images)
            <div class="form-group" id="img">
               <label for="description" class="col-md-2 control-label">Image(s)</label>
              
               @foreach($images as $image)
                <div class="col-md-2"> 
                           <span class=""><img class="img-thumbnail" height="200" width="200"src="{{asset('public/uploads/'.$image->calling_id)}}"></span>
                          <h5><a onclick=" return confirm('Wanna Delete?')"  style="color:red" href="{{url('deleteBack/documents/'.$image->id)}}"><span class="glyphicon glyphicon-trash"></span> </a>
                          </h5>

               </div>
               @endforeach
               
            </div>
            @endif

            <div class="form-group">
               <label for="description" class="col-md-2 control-label">Add New Images</label>
               <div class="col-md-10"> 
               <input type="file" id="images" name="images[]" multiple  />
            <output id="images_show"></output>
                  
               </div>
            </div>
             @if($pdfs)
            <div class="form-group">
               <label for="description" class="col-md-2 control-label">PDF(s)</label>
               <div class="col-md-10"> 
               @foreach($pdfs as $pdf)
                           <span><a target="_blank" href="{{asset('public/uploads/'.$pdf->calling_id)}}">{{$pdf->doc_name}}</a> <a onclick=" return confirm('Wanna Delete?')"  style="color:red" href="{{url('deleteBack/documents/'.$pdf->id)}}"><span class="glyphicon glyphicon-trash"></span> </a></span>,
               @endforeach
            </div>
            </div>
            @endif
            <div class="form-group">
               <label for="description" class="col-md-2 control-label">Add New PDF</label>
               <div class="col-md-10"> 
               <input type="file" id="pdfs" name="pdfs[]" multiple />
            </div>
            </div>
         </div>
         <!-- /.box-body -->
         <div class="box-footer">
            <div id="button1idGroup" class="btn-group pull-right" role="group" aria-label="">
                  <button type="reset" id="button1id" name="button1id" class="btn btn-default" aria-label="Cancel">Cancel</button>
                  <button type="submit" id="button2id" name="button2id" class="btn btn-primary" aria-label="Cancel">Save</button>
               </div>
         </div>
         <!-- /.box-footer -->
         </form>
      </div>
      <!-- /.box --> 
   </div>
</div>
@include('core.front.entryForm')
@yield('category')


@stop