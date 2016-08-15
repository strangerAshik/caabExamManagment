@extends('core.layout.layoutExamine')
@section('content')
<div class="row">
	<div class="col-md-12">
{!!Form::open(array('url'=>'updatePaymentDetails','method'=>'post','class'=>'form-horizontal','data-toggle'=>'validator','role'=>'form','files'=>'true'))!!}
	
	{!!Form::hidden('id',$payment->id)!!}
	<div class="form-group">
	    <label for="exampleInputEmail1" class="col-sm-3 control-label">Fee Type</label>
	    <div class="col-sm-4">
	    <select name="fee_type" placeholder=""class="form-control">
		  <option value="">Select Fee Type..</option>
		  <option <?php if($payment->fee_type=='CASH') echo"selected=''";?>value="CASH">CASH</option>
		  <option <?php if($payment->fee_type=='DD') echo"selected=''";?> value="DD">DD</option>
		  <option <?php if($payment->fee_type=='TT') echo"selected=''";?> value="TT">TT</option>
		</select>
		</div>

	</div>
	
	
	<div class="form-group">
	    <label for="exampleInputEmail1" class="col-sm-3 control-label">Document Number</label>
	    <div class="col-sm-4">
	    <input name="doc_number" value="{{$payment->doc_number}}" type="text" class="form-control" id="date" placeholder=" ">
		</div>
	</div>
	<div class="form-group">
	    <label for="exampleInputEmail1" class="col-sm-3 control-label">Bank</label>
	    <div class="col-sm-4">
	    <input name="bank" value="{{$payment->bank}}" type="text" class="form-control" id="date" placeholder=" ">
		</div>
	</div>
	<div class="form-group">
	    <label for="exampleInputEmail1" class="col-sm-3 control-label">Branch</label>
	    <div class="col-sm-4">
	    <input name="branch" value="{{$payment->branch}}" type="text" class="form-control" id="date" placeholder=" ">
		</div>
	</div>
	<div class="form-group">
	    <label for="exampleInputEmail1" class="col-sm-3 control-label">Account Name</label>
	    <div class="col-sm-4">
	    <input name="account_name" value="{{$payment->account_name}}" type="text" class="form-control" id="date" placeholder=" ">
		</div>
	</div>
	
	<div class="form-group">
	    <label for="" class="col-sm-3 control-label">Uploaded  Document </label>
	    <div class="col-sm-4">
	     <?php $images=App\AdminModel::getDocuments('exam_payments', $payment->id) ?>
                                            @if($images)
                                                @foreach($images as $img)
                                                 
                                                
                                                 <a target="_blink" href="{{asset('public/documents/'.$img->calling_id)}}">{{$img->doc_name}}</a> 
                                                 <a style="color: red" onclick="return confirm('Wanna Delete?');" href="{{url('deleteBack/documents/'.$img->id)}}">[Delete]</a>,
                                                 
                                                 @endforeach
                                            @else 
                                                No doc 
                                            @endif   
		</div>
	</div>
	<div class="form-group">
	    <label for="" class="col-sm-3 control-label">Upload  Document </label>
	    <div class="col-sm-4">
	    <input name="bank_doc[]" multiple="true" type="file" class="">
		</div>
	</div>
	

	   <div class="form-group">
	        <label class="control-label col-md-1"></label>
	        <div class="text-right col-md-8">
	            <div id="button1idGroup" class="btn-group pull-right" role="group" aria-label="">
	                <button type="reset" id="button1id" name="button1id" class="btn btn-default" aria-label="Cancel">Cancel</button>
	                <button type="submit" id="button2id" name="button2id" class="btn btn-success" aria-label="Cancel">Apply</button>
	            </div>

	        </div>
	    </div>
{!!Form::close()!!}}


	</div>
</div>

@stop