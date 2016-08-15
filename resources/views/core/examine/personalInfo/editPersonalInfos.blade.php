@extends('core.layout.layoutExamine')
@section('content')
<div class="row">
	<div class="col-md-12">
	
	{!!Form::open(array('url'=>'examine/personalInfo/updatePersonalInfos','method'=>'post','class'=>'form-horizontal','data-toggle'=>'validator','role'=>'form','files'=>'true'))!!}
                     {!! csrf_field() !!}
           {!!Form::hidden('user_id', Auth::user()->id)!!}
           {!!Form::hidden('old_email', $infos->email)!!}

	  <div class="form-group">	   
	   <label for="" class="col-md-3 control-label">Title</label>
		    <div class="col-md-4">
		       <input  type="text" name="title" value="{{$infos->title}}" class="form-control"  placeholder=" ">
		    </div>
	  </div>
	  <div class="form-group">	   
	   <label for="" class="col-md-3 control-label">Full Name</label>
		    <div class="col-md-4">
		       <input  type="text" name="name" value="{{$infos->name}}" class="form-control"  placeholder=" ">
		    </div>
	  </div>
	  <div class="form-group">	   
	   <label for="" class="col-md-3 control-label">Father Name</label>
		    <div class="col-md-4">
		       <input  type="text" name="father_name" value="{{$infos->father_name}}" class="form-control"  placeholder=" ">
		    </div>
	  </div>
	  <div class="form-group">	   
	   <label for="" class="col-md-3 control-label">Mother Name</label>
		    <div class="col-md-4">
		       <input  type="text" name="father_name" value="{{$infos->mother_name}}" class="form-control"  placeholder=" ">
		    </div>
	  </div>

      <div class="form-group">
            <label for="exampleInputEmail1" class="col-md-3 control-label">Date Of Birth</label>
            <div class="col-sm-4">
               <div class="input-group">
                  <div class="input-group-addon glyphicon glyphicon-calendar"></div>
                  <input name="date_of_birth" value="{{$infos->date_of_birth}}" type='text' class="form-control dateExam" placeholder="DD/MM/YYYY"/>
               </div>
            </div>
       </div>

	  <div class="form-group" style="display: none">	   
	   <label for="" class="col-md-3 control-label">Email</label>
		    <div class="col-md-4">
		       <input  type="text" name="email" value="{{$infos->email}}" class="form-control"  placeholder=" ">
		    </div>
	  </div>
	  <div class="form-group">	   
	   <label for="" class="col-md-3 control-label">Nationality</label>
		    <div class="col-md-4">
		       <input  type="text" name="father_name" value="{{$infos->nationality}}" class="form-control"  placeholder=" ">
		    </div>
	  </div>
	  <div class="form-group">	   
	   <label for="" class="col-md-3 control-label">Passport No</label>
		    <div class="col-md-4">
		       <input  type="text" name="father_name" value="{{$infos->passport_no}}" class="form-control"  placeholder=" ">
		    </div>
	  </div>

      <div class="form-group">
            <label for="exampleInputEmail1" class="col-md-3 control-label">Passport Validity Date</label>
            <div class="col-sm-4">
               <div class="input-group">
                  <div class="input-group-addon glyphicon glyphicon-calendar"></div>
                  <input name="validity_date" value="{{$infos->validity_date}}" type='text' class="form-control dateExam" placeholder="DD/MM/YYYY"/>
               </div>
            </div>
       </div>

       
	  <div class="form-group">	   
	   <label for="" class="col-md-3 control-label">Permanent Address</label>
		    <div class="col-md-4">
		       <input  type="text" name="parmanent_address" value="{{$infos->parmanent_address}}" class="form-control"  placeholder=" ">
		    </div>
	  </div>

	  <div class="form-group">	   
	   <label for="" class="col-md-3 control-label">Mailing Address</label>
		    <div class="col-md-4">
		       <input  type="text" name="mailing_address" value="{{$infos->mailing_address}}" class="form-control"  placeholder=" ">
		    </div>
	  </div>

	  <div class="form-group">	   
	    <label for="Licence" class="col-md-3 control-label">Gender</label>
	    <div class="col-md-4">
	      <select required="" name="gender" placeholder=""class="form-control" >
		  <option value="">Select ..</option>
		  <option <?php if($infos->gender=='Male') echo "selected=''" ;?> value="Male">Male</option>
		  <option <?php if($infos->gender=='Female') echo "selected=''" ;?> value="Female">Female</option>
		  <option <?php if($infos->gender=='Other') echo "selected=''" ;?> value="Other">Other</option>
		 
		</select>
	    </div>    
	  </div>

	  <div class="form-group">	   
	   <label for="" class="col-md-3 control-label">Existing Photo </label>
		    <div class="col-md-4">
		       <?php $images=App\AdminModel::getDocuments('users', $infos->id) ?>
                @if($images)
                    @foreach($images as $img)
                     <img style="height: 100px" class="img-thumbnail img-responsive" src="{{asset('public/documents/'.$img->calling_id)}}" alt="Examine Photo" />
                     	<a  onclick="return confirm('Wanna Delete?');" href="{{url('deleteBack/documents/'.$img->id)}}">Delete</a>
                     <?php break;?>

                     @endforeach
                @else 
                    No Photo 
                @endif
		    </div>
	  </div>

<div class="form-group">	   
	   <label for="" class="col-md-3 control-label">Photo </label>
		    <div class="col-md-4">
		      <img id="blah" alt="your image" width="100" height="100" />
                   <input class="" type="file" accept="image/*" name="photo[]"  onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
		    </div>
	  </div>


	  
	   <div class="form-group">
	        <label class="control-label col-md-4"></label>
	        <div class="text-right col-md-3">
	            <div id="button1idGroup" class="btn-group pull-right" role="group" aria-label="">
	                <button type="reset" id="button1id" name="button1id" class="btn btn-default" aria-label="Cancel">Cancel</button>
	                <button type="submit" id="button2id" name="button2id" class="btn btn-success" aria-label="Cancel">Update </button>
	            </div>

	        </div>
	    </div>
	{!!Form::close()!!}
</div>
</div>

@stop