@extends('core.layout.layoutExamine')
@section('content')
<div class="row">
	<div class="col-md-12">
	
	{!!Form::open(array('url'=>'saveProfessionalInfos','method'=>'post','class'=>'form-horizontal','data-toggle'=>'validator','role'=>'form','files'=>'true'))!!}
                     {!! csrf_field() !!}
           {!!Form::hidden('user_id', Auth::user()->id)!!}
      <div class="form-group">
            <label for="exampleInputEmail1" class="col-md-3 control-label">Date of First training Flight</label>
            <div class="col-sm-4">
               <div class="input-group">
                  <div class="input-group-addon glyphicon glyphicon-calendar"></div>
                  <input name="first_training_date" type='text' class="form-control dateExam" placeholder="DD/MM/YYYY"/>
               </div>
            </div>
         </div>
	  <div class="form-group">	   
	    <label for="Licence" class="col-md-3 control-label">Defense Personnel</label>
	    <div class="col-md-4">
	      <select required="" name="defense_personnel" placeholder=""class="form-control" >
		  <option value="">Select ..</option>
		  <option value="Yes">Yes</option>
		  <option value="No">No</option>
		 
		</select>
	    </div>    
	  </div>
	  <div class="form-group">	   
	    <label for="Licence" class="col-md-3 control-label">Defense Category</label>
	    <div class="col-md-4">
	      <select required="" name="defence_category" placeholder=""class="form-control">
		  <option value="">Select ..</option>
		  <option value="Army">Army</option>
		  <option value="Navy">Navy</option>
		  <option value="Airforce">Airforce</option>
		 
		</select>
	    </div>    
	  </div>
	  <div class="form-group">	   
	    <label for="Licence" class="col-md-3 control-label">Whether Having SPL or Not</label>
	    <div class="col-md-4">
	      <select required="" name="having_spl_or_not" placeholder=""class="form-control">
		   <option value="">Select ..</option>
		  <option value="Yes">Yes</option>
		  <option value="No">No</option>
		 
		</select>
	    </div>    
	  </div>
	   <div class="form-group">
            <label for="exampleInputEmail1" class="col-md-3 control-label">Date of issue of SPL</label>
            <div class="col-sm-4">
               <div class="input-group">
                  <div class="input-group-addon glyphicon glyphicon-calendar"></div>
                  <input name="date_of_issue_of_spl" type='text' class="form-control dateExam" placeholder="DD/MM/YYYY"/>
               </div>
            </div>
        </div>

	  <div class="form-group">	   
	    <label for="Licence" class="col-md-3 control-label">Whether Having Higher Category Pilot License?</label>
	    <div class="col-md-4">
	      <select required="" name="higher_category_pilot_license" placeholder=""class="form-control">
		   <option value="">Select ..</option>
		  <option value="Yes">Yes</option>
		  <option value="No">No</option>
		 
		</select>
	    </div>    
	  </div>
	  <div class="form-group">	   
	    <label for="Licence" class="col-md-3 control-label">License Category</label>
	    <div class="col-md-4">
	      <select required="" name="license_category" placeholder=""class="form-control">
		   <option value="">Select ..</option>
		  <option value="PPL">PPL</option>
		  <option value="CPL">CPL</option>
		  <option value="ATPL">ATPL</option>
		 
		</select>
	    </div>    
	  </div>
	  <div class="form-group">	   
	   <label for="" class="col-md-3 control-label">License Number</label>
		    <div class="col-md-4">
		       <input  type="text" name="license_number" class="form-control"  placeholder=" ">
		    </div>
	  </div>

	   <div class="form-group">
            <label for="exampleInputEmail1" class="col-md-3 control-label">License Validity</label>
            <div class="col-sm-4">
               <div class="input-group">
                  <div class="input-group-addon glyphicon glyphicon-calendar"></div>
                  <input name="license_validity" type='text' class="form-control dateExam" placeholder="DD/MM/YYYY"/>
               </div>
            </div>
        </div>

	  <div class="form-group">	   
	   <label for="" class="col-md-3 control-label">Endorsement of Multi Engine Aircraft</label>
		    <div class="col-md-4">
		       <input  type="text" name="endorsement_of_multi_engine_aircraft" class="form-control"  placeholder=" ">
		    </div>
	  </div>
	  <div class="form-group">	   
	   <label for="" class="col-md-3 control-label">Total Flying Hour</label>
		    <div class="col-md-4">
		       <input  type="text" name="total_flying_hour" class="form-control"  placeholder=" ">
		    </div>
	  </div>
	  <div class="form-group">	   
	   <label for="" class="col-md-3 control-label">Total Flying Hour as Pilot in Command</label>
		    <div class="col-md-4">
		       <input  type="text" name="total_flying_hour_as_pilot_in_command" class="form-control"  placeholder=" ">
		    </div>
	  </div>
	  <div class="form-group">	   
	   <label for="" class="col-md-3 control-label">Flying Training Institute</label>
		    <div class="col-md-4">
		       <input  type="text" name="flying_training_institute" class="form-control"  placeholder=" ">
		    </div>
	  </div>
	  <div class="form-group">	   
	   <label for="" class="col-md-3 control-label">Ground Training Institute</label>
		    <div class="col-md-4">
		       <input  type="text" name="ground_training_institute" class="form-control"  placeholder=" ">
		    </div>
	  </div>

	  <div class="form-group">	   
		   <label for="" class="col-md-3 control-label">Document(s)</label>
			    <div class="col-md-4">			     
	                   <input class="" type="file" name="docs[]" multiple="true" >
			    </div>
	</div>

	  

	  
	   <div class="form-group">
	        <label class="control-label col-md-4"></label>
	        <div class="text-right col-md-3">
	            <div id="button1idGroup" class="btn-group pull-right" role="group" aria-label="">
	                <button type="reset" id="button1id" name="button1id" class="btn btn-default" aria-label="Cancel">Cancel</button>
	                <button type="submit" id="button2id" name="button2id" class="btn btn-success" aria-label="Cancel">Save </button>
	            </div>

	        </div>
	    </div>
	{!!Form::close()!!}
</div>
</div>

@stop