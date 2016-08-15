@extends('core.layout.layoutAdminTable')
@section('content')

   <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Single Content</b>
                        <div  class="pull-right">
                            <a href="{{url('frontManagement/editSingleContent/'.$contents->id)}}">Edit</a> | 
                            <a  href="{{url('deleteBack/contents/'.$contents->id)}}">Delete</a>
                        </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="">
                                    
                                   <tbody>
                        <tr>
                            <th>Title</th>
                            <td>{{$contents->title}}</td>
                        </tr>
                        @if($contents->subtitle)
                        <tr>
                            <th>Subtitle</th>
                            <td>{{$contents->subtitle}}</td>
                        </tr>
                        @endif
                        <tr>
                            <th>Category</th>
                            <td>{{$contents->category}}</td>
                        </tr>
                        @if($contents->unique_key)
                        <tr>
                            <th>Unique Key</th>
                            <td>{{$contents->unique_key}}</td>
                        </tr>
                        @endif
                        @if($contents->content)
                        <tr>
                            <th>Content</th>
                            <td><?php echo $contents->content;?></td>
                        </tr>
                        @endif
                        @if($contents->more_content)
                        <tr>
                            <th>More Content</th>
                            <td><?php echo $contents->more_content;?></td>
                        </tr>
                        @endif
                        @if($contents->hyper_link)
                        <tr>
                            <th>Hyper Link</th>
                            <td>{{$contents->hyper_link}}</td>
                        </tr>
                        @endif
                        @if($images)
                        <tr>
                            <th>Images</th>
                            <td>
                                @foreach($images as $image)
                                    <span><img class="img-thumbnail" height="200" width="200"src="{{asset('public/uploads/'.$image->calling_id)}}"></span>
                                @endforeach
                            </td>
                        </tr>
                        @endif
                        @if($pdfs)
                        <tr>
                            <th>PDFs</th>
                            <td>
                                @foreach($pdfs as $pdf)
                                    <span><a href="{{asset('public/uploads/'.$pdf->calling_id)}}">{{$pdf->doc_name}}</a></span>,
                                @endforeach
                            </td>
                        </tr>
                        @endif                      
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

@stop