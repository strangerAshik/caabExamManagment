@extends('core.layout.layoutExamine')
@section('content')
<div class="row">
	<div class="col-md-12">
{!!Form::open(array('url'=>'saveBankInfo','method'=>'post','class'=>'form-horizontal','data-toggle'=>'validator','role'=>'form','files'=>'true'))!!}
	
	{!!Form::hidden('exam_id',$examId)!!}
	<div class="form-group">
	    <label for="exampleInputEmail1" class="col-sm-3 control-label">Fee Type</label>
	    <div class="col-sm-4">
	    <select name="fee_type" placeholder=""class="form-control">
		  <option value="">Select Fee Type..</option>
		  <option value="CASH">CASH</option>
		  <option value="DD">DD</option>
		  <option value="TT">TT</option>
		</select>
		</div>

	</div>
	
	
	<div class="form-group">
	    <label for="exampleInputEmail1" class="col-sm-3 control-label">Document Number</label>
	    <div class="col-sm-4">
	    <input name="doc_number" type="text" class="form-control" id="date" placeholder=" ">
		</div>
	</div>
	<div class="form-group">
	    <label for="exampleInputEmail1" class="col-sm-3 control-label">Bank</label>
	    <div class="col-sm-4">
	    <input name="bank" type="text" class="form-control" id="date" placeholder=" ">
		</div>
	</div>
	<div class="form-group">
	    <label for="exampleInputEmail1" class="col-sm-3 control-label">Branch</label>
	    <div class="col-sm-4">
	    <input name="branch" type="text" class="form-control" id="date" placeholder=" ">
		</div>
	</div>
	<div class="form-group">
	    <label for="exampleInputEmail1" class="col-sm-3 control-label">Account Name</label>
	    <div class="col-sm-4">
	    <input name="account_name" type="text" class="form-control" id="date" placeholder=" ">
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