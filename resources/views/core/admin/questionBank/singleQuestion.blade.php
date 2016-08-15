@extends('core.layout.layoutAdminTable')
@section('content')

   <div class="row">
                <div class="col-lg-12">
                @if($details)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>License Type: {{$details->licence_type}} | Subject: {{$details->subject}} | Chapter: {{$details->chapter}}</b>
                            <span class='pull-right'>

                        
                            <a class="label label-primary" href="{{url('questionBank/editQuestion/'.$details->id)}}"><span class="glyphicon glyphicon-pencil"></span> Edit</a> 

                            |

                            <a class="label label-danger" href="{{url('deleteBack/question_bank/'.$details->id)}}" onclick=" return confirm('Wanna Delete?')"><span class="glyphicon glyphicon-trash"></span> Delete</a>

                            </span>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper table-responsive">
                                <table class="table  table-bordered table-hover" id="">
                                   
                                    <tbody>
                                        <tr >
                                               <th class="col-md-3">Question</th>
                                               <td>{{$details->question}} </td>                     
                                        </tr>
                                        <tr >
                                               <th>Option-1</th>
                                               <td>{{$details->option_1}}</td>                     
                                        </tr>
                                        <tr >
                                               <th>Option-2</th>
                                                <td>{{$details->option_2}}</td>                     
                                        </tr>
                                        <tr >
                                               <th>Option-3</th>
                                                <td>{{$details->option_3}}</td>                     
                                        </tr>
                                        <tr >
                                               <th>Option-4</th>
                                                <td>{{$details->option_4}}</td>                     
                                        </tr>
                                        <tr >
                                               <th>Correct Answer</th>
                                                <td>
                                                    @if($details->option_right=='1')
                                                    Option-1
                                                    @elseif($details->option_right=='2')
                                                    Option-2
                                                    @elseif($details->option_right=='3')
                                                    Option-3
                                                    @elseif($details->option_right=='4')
                                                    Option-4
                                                    @else
                                                    Not Provided
                                                    @endif
                                                </td>                     
                                        </tr>
                                        <tr >
                                               <th>Note</th>
                                                <td>{{$details->note}}</td>                     
                                        </tr>
                                        <tr >
                                               <th>Photo</th>
                                               <td>
                                               @if($details->image)
                                               <img style="height: auto" class="img-thumbnail img-responsive" height="300" width="400" src="{{asset('public/documents/'.$details->image)}}" alt="Examine Photo" />
                                               @else
                                                    No Photo
                                               @endif
                                               <div style="display: none">
                                            {{-- <?php $images=App\AdminModel::getDocuments('question_bank', $details->id) ?>
                                            @if($images)
                                                @foreach($images as $img)
                                                 <img style="height: auto" class="img-thumbnail img-responsive" src="{{asset('public/documents/'.$img->calling_id)}}" alt="Examine Photo" />
                                                 <?php break;?>
                                                 @endforeach
                                            @else 
                                                No Photo 
                                            @endif
                                             --}}
                                             </div>

                                               </td>                     
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    @else
                    Question Does not exist....
                    @endif

                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

@stop