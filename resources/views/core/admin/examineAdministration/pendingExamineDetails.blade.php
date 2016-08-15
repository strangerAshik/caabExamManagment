@extends('core.layout.layoutAdminTable')
@section('content')

   <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Payment Details</b>
                            @if($payment->status==1)
                            <a class="pull-right" href="{{url('examSitApprove/'.$payment->user_id.'/'.$payment->exam_id)}}">Approve</a>
                            @elseif($payment->status==2)
                             <a class="pull-right" href="{{url('examSitSuspend/'.$payment->user_id.'/'.$payment->exam_id)}}">Suspend</a>
                            @endif
                        </div>
                        
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <tbody>
                                       <tr>
                                           <th>Fee Type</th><td>{{$payment->fee_type}}</td>
                                        </tr>
                                        <tr>
                                           <th>Document Number</th><td>{{$payment->doc_number}}</td>
                                        </tr>
                                        <tr>
                                           <th>Bank</th><td>{{$payment->bank}}</td>
                                        </tr>
                                        <tr>
                                           <th>Branch</th><td>{{$payment->branch}}</td>
                                        </tr>
                                        <tr>
                                           <th>Account Name</th><td>{{$payment->account_name}}</td>
                                        </tr>
                                        <tr>
                                           <th>Documents</th>
                                           <td>
                                              <?php $images=App\AdminModel::getDocuments('exam_payments', $payment->id) ?>
                                            @if($images)
                                                @foreach($images as $img)
                                                 
                                                
                                                 <a target="_blink" href="{{asset('public/documents/'.$img->calling_id)}}">{{$img->doc_name}}</a>,
                                                 
                                                 @endforeach
                                            @else 
                                                No Photo 
                                            @endif    
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
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

@stop