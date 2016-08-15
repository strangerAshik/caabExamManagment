 @extends('core.layout.layoutExamine')
@section('content')
  <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Payment Details</b>
                            @if($payment)  
                              @if($payment->exam_date>=date('d F Y'))
                              <a class="pull-right" href="{{url('editPaymentDetails/'.$payment->user_id.'/'.$payment->exam_id)}}">Edit</a>
                              @endif
                            @endif
                          
                        </div>
                        
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <tbody>
                                    @if($payment)
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
                                                No doc 
                                            @endif    
                                           </td>
                                       </tr>
                                    @else
                                    <tr >
                                      <td colspan="2">Payment Info Not Provided Yet</td>
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