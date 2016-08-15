<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use Validator;
use Redirect;
use Session;
class FrontController extends Controller
{

	public function home(){
		$welcome=DB::table('contents')->where('category_id','4')->where('unique_key','welcome')->first();
        $upcomingExam=DB::table('exam_shedules')
                ->Join('licence_types','exam_shedules.licence_type','=','licence_types.id')
                ->Join('subjects','exam_shedules.subject','=','subjects.id')
                ->where('exam_shedules.exam_date','>=',date('Y-m-d'))
                ->select(
                    'exam_shedules.id',
                    'exam_shedules.exam_date',
                    'exam_shedules.title',
                    'exam_shedules.start_time',
                    'exam_shedules.end_time',
                    'exam_shedules.total_sit',
                    'licence_types.licence_type',
                    'subjects.subject'
                    )
                ->get();
        //getting mother id
         $motherId=DB::table('contents')    	
    	->where('category_id','7')
    	->where('unique_key','home_slider')
    	->orderBy('id','desc')
    	->value('id');
    	$slider=DB::table('documents')
    			->where('mother_id',$motherId)
    			->where('table_name','contents')
    			->get();

		return view('front.home',['upcomingExam'=>$upcomingExam,'welcome'=>$welcome,'slider'=>$slider]);
	}
	public function about(){
		$about=DB::table('contents')->where('category_id','2')->where('unique_key','about')->orderBy('id','desc')->first();
		$mission=DB::table('contents')->where('category_id','5')->where('unique_key','mission')->orderBy('id','desc')->first();
		$vission=DB::table('contents')->where('category_id','6')->where('unique_key','vission')->orderBy('id','desc')->first();
		return view('front.about',['about'=>$about,'mission'=>$mission,'vission'=>$vission]);
	}
    public function postRegister(Request $request){
     	

     		//rule
    		$rule=[
	    		'name' => 'required|max:255',
	            'email' => 'required|email|max:255|unique:users',
	            'password' => 'required|confirmed|min:6',
    		];
    		//validate
    		 $validator = Validator::make($request->all(),$rule);
	         if ($validator->fails()) 
	       	 {
	         	return back()
	         		  ->withErrors($validator)
                        ->withInput();;
	       	 }
	        else
	        {
		     		//user table
		     		DB::table('users')->insert(array(
		     				'title'=>$request->input('title'),
		     				'name'=>$request->input('name'),
		     				'email'=>$request->input('email'),
		     				'role_id'=>'2',
                            'active'=>'1',
		     				'reg_status'=>'0',
		     				'password'=>bcrypt($request->input('password'))

		     			));
		     		//get the user_id
		     		$user_id=DB::table('users')->where('email',$request->input('email'))->first();
		     		//personal information tabel
		     		DB::table('personal_infos')->insert(array(
		     				'user_id'=>$user_id->id,
		     				'father_name'=>$request->input('father_name'),
		     				'mother_name'=>$request->input('mother_name'),
		     				'date_of_birth'=>$request->input('date_of_birth'),
		     				'nationality'=>$request->input('nationality'),
		     				'passport_no'=>$request->input('passport_no'),
		     				'validity_date'=>$request->input('validity_date'),
		     				'parmanent_address'=>$request->input('parmanent_address'),
		     				'mailing_address'=>$request->input('mailing_address'),
		     				'gender'=>$request->input('gender'),
		     				'created_at'=>date('Y-m-d H:i:s'),
		     				'updated_at'=>date('Y-m-d H:i:s')
		     			));
		     		
		     		//$user_id='10';
		     		//photo upload
		     		
				    if($files = $request->hasFile('photo'))
				    {
				        $files = $request->file('photo');
				        $destinationPath = 'public/documents';
				        foreach ($files as $file) {
				             $orginalName=$file->getClientOriginalName();
				             $filename =$orginalName.'-'.time().'.'.$file->getClientOriginalExtension();
				             $upload_success = $file->move($destinationPath, $filename);
				             //insert in document table
				             DB::table('documents')->insert(array(
				                    'table_name'=>'users',
				                    'mother_id'=>$user_id->id,
				                    'calling_id'=>$filename,
				                    'doc_type'=>'img',
				                    'doc_name'=>$orginalName,
				                ));
				        }		       
		   			 }
		   	return back()->with('message','You are successfully Registered & Please Wait for Approval');
			}
		}
	public function authenticate(Request $request)
    {	
    	$email=$request->input('email');
    	$password=$request->input('password');

        if (Auth::attempt(['email' => $email, 'password' => $password,'active'=>1,'reg_status'=>1])) {
            // Authentication passed...
            //$role=DB::table('users')->where('email',$email)->first();
            //unplag access 
            DB::table('users')->where('id',Auth::user()->id)->update(array('active'=>'0'));
            
            if(Auth::user()->role_id=="2"){            
             return redirect()->intended('examine/dashboard');
            }

           	 return redirect()->intended('admin/dashboard');
        }
        else{
        	return back()->with('loginError','These credentials do not match our records or You are not allow now to login.');
        }
    }
    public function customlogout(){
       
    if(!Session::get('ExamTime')){
    DB::table('users')->where('id',Auth::user()->id)->update(array('active'=>'1'));

    Auth::logout();        
    Session::flush();
    return Redirect::to('/');}
    return back()->with('message','Now You Are Not Allow to Logout!!');

    }

    public function addContent(){
    	$categories=DB::table('categories')->lists('category','id');
    	return view('core.front.addContent',['categories'=>$categories]);
    }
    public function allContent(){
    	$allContent=DB::table('categories')
    				->Join('contents','contents.category_id','=','categories.id')
    				->get();
    	return view('core.front.allContent',['allContent'=>$allContent]);
    }
    public function allCategory(){
    	$allCategories=DB::table('categories')->get();
    	return view('core.front.category',['allCategories'=>$allCategories]);
    }
    public function singleContent($id){
    	$content=DB::table('categories')
    	->Join('contents','categories.id','=','contents.category_id')
    	->where('contents.id',$id)->first();
    	$images=DB::table('documents')
    	->where('mother_id',$id)
    	->where('table_name','contents')
    	->where('doc_type','img')
    	->get();
   		 $pdfs=DB::table('documents')
   		 ->where('mother_id',$id)
   		 ->where('table_name','contents')
   		 ->where('doc_type','pdf')
   		 ->get();
    	return view('core.front.singleContent',['contents'=>$content,'images'=>$images,'pdfs'=>$pdfs]);
    }
    public function editSingleContent($id){
    	$content=DB::table('categories')
    	->Join('contents','categories.id','=','contents.category_id')
    	->where('contents.id',$id)->first();
    	$images=DB::table('documents')
    	->where('mother_id',$id)
    	->where('table_name','contents')
    	->where('doc_type','img')
    	->get();
   		 $pdfs=DB::table('documents')
   		 ->where('mother_id',$id)
   		 ->where('table_name','contents')
   		 ->where('doc_type','pdf')
   		 ->get();
   		 $categories=DB::table('categories')->lists('category','id');

    	return view('core.front.editSingleContent',[
    		'contents'=>$content,
    		'images'=>$images,
    		'pdfs'=>$pdfs,
    		'categories'=>$categories,
    		]);
    }
    
    public function saveContent(Request $request){  //content insert  
        $title=$request->input('title');
        $categoryId=$request->input('category_id');
        $uniqueKey=$request->input('unique_key');

         $save=DB::table('contents')->insert(array(
                'title'=>$request->input('title'),
                'subtitle'=>$request->input('subtitle'),
                'category_id'=>$request->input('category_id'),
                'unique_key'=>$request->input('unique_key'),
                'content'=>$request->input('content'),
                'more_content'=>$request->input('more_content'),
                'hyper_link'=>$request->input('hyper_link'),

                'creator'=>'Ashik',
                'updater'=>'Ashik',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ));
        //Get the mother id of content 
         $getMotherId=DB::table('contents')
                    ->where('title',$title)
                    ->where('category_id',$categoryId)
                    ->where('unique_key',$uniqueKey)
                    ->orderBy('id','desc')
                    ->first();
                    
 //image upload 
       
    if($files = $request->hasFile('images')){
        $files = $request->file('images');
        $destinationPath = 'public/uploads';
        foreach ($files as $file) {
             $orginalName=$file->getClientOriginalName();
             $filename =$orginalName.'_'.time().'.'.$file->getClientOriginalExtension();
             $upload_success = $file->move($destinationPath, $filename);
             //insert in document table
             DB::table('documents')->insert(array(
                    'table_name'=>'contents',
                    'mother_id'=>$getMotherId->id,
                    'calling_id'=>$filename,
                    'doc_type'=>'img',
                    'doc_name'=>$orginalName,
                ));
        }
       
        }
 //pdf upload 
       
    if($files = $request->hasFile('pdfs')){
        $files = $request->file('pdfs');
        $destinationPath = 'public/uploads';
        foreach ($files as $file) {
             $orginalName=$file->getClientOriginalName();
             $filename =$orginalName.'_'.time().'.'.$file->getClientOriginalExtension();
             $upload_success = $file->move($destinationPath, $filename);
             //insert in document table
             DB::table('documents')->insert(array(
                    'table_name'=>'contents',
                    'mother_id'=>$getMotherId->id,
                    'calling_id'=>$filename,
                    'doc_type'=>'pdf',
                    'doc_name'=>$orginalName,
                ));
        }

    }

     return back()->withInput()->with('message','Content Saved');

    
    }
       public function updateContent(Request $request){
        //content insert  
        
        $id=$request->input('id');
        DB::table('contents')
                ->where('id',$id)
                ->update(array(
                'title'=>$request->input('title'),
                'subtitle'=>$request->input('subtitle'),
                'category_id'=>$request->input('category_id'),
                'unique_key'=>$request->input('unique_key'),
                'content'=>$request->input('content'),
                'more_content'=>$request->input('more_content'),
                'hyper_link'=>$request->input('hyper_link'),

                'updater'=>Auth::user()->id,
                'updated_at'=>date('Y-m-d H:i:s')
            ));
                    
 //image upload 
       
    if($files = $request->hasFile('images')){
        $files = $request->file('images');
        $destinationPath = 'public/uploads';
        foreach ($files as $file) {
             $orginalName=$file->getClientOriginalName();
             $filename =$orginalName.'-'.time().'.'.$file->getClientOriginalExtension();
             $upload_success = $file->move($destinationPath, $filename);
             //insert in document table
             DB::table('documents')->insert(array(
                    'table_name'=>'contents',
                    'mother_id'=>$id,
                    'calling_id'=>$filename,
                    'doc_type'=>'img',
                    'doc_name'=>$orginalName,
                ));
        }
       
        }
 //pdf upload 
       
    if($files = $request->hasFile('pdfs')){
        $files = $request->file('pdfs');
        $destinationPath = 'public/uploads';
        foreach ($files as $file) {
             $orginalName=$file->getClientOriginalName();
             $filename =$orginalName.'-'.time().'.'.$file->getClientOriginalExtension();
             $upload_success = $file->move($destinationPath, $filename);
             //insert in document table
             DB::table('documents')->insert(array(
                    'table_name'=>'contents',
                    'mother_id'=>$id,
                    'calling_id'=>$filename,
                    'doc_type'=>'pdf',
                    'doc_name'=>$orginalName,
                ));
        }

    }   
      

   
        return back()->withInput()->with('message','Content Updated');
    }

    public function saveCategory(Request $request ){
        DB::table('categories')->insert(array(
            'category'=>request('category'),

            'creator'=>Auth::user()->id,
            'updater'=>Auth::user()->id,
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s')
            
            ));
        return back()->with('message','Category Saved');
    }
    public function updateCategory(Request $request ){
    	$id=$request->input('id');
        DB::table('categories')
        	->where('id',$id)
        	->update(array(
            'category'=>request('category'),

           
            'updater'=>Auth::user()->id,
            
            'updated_at'=>date('Y-m-d H:i:s')
            
            ));
        return back()->with('message','Category Updated');
    }
   //contact 

}
