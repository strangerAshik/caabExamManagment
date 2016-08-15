<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\AdminModel;
use DB;
use Auth;
use View;
use Validator;

class AdminController extends Controller
{
     public function __construct()
      {
        $privileges=AdminModel::privilegedSections(Auth::user()->role_id);
        View::share('privileges', $privileges);
      }
    /****************************common functions*****************/
    //public function getQuestionNumber(){return 'hr';}
    protected function licences(){
        return $licenceTypes=DB::table('licence_types')->get();
    }
    protected function subjects(){
        return $subjects=DB::table('subjects')
                ->Join('licence_types','subjects.licence_type_id','=','licence_types.id' )
                ->orderBy('subjects.licence_type_id')
                ->select('subjects.id','licence_types.id as licence_type_id','subjects.subject','licence_types.licence_type')                
                ->get();
    }
    protected function chapters(){
       return $chapters=DB::table('chapters')
                    ->Join('subjects','subjects.id','=','chapters.subject_id')
                    ->Join('licence_types','licence_types.id','=','chapters.licence_type_id')
                    ->select('chapters.*','subjects.id as subject_id','subjects.subject','licence_types.id as licence_type_id','licence_types.licence_type')
                    ->orderBy('chapters.subject_id')
                    ->get();
    }
    public function deleteBack($table,$id){
         DB::table($table)->where('id',$id)->delete();
         return back()->with('message','Data Deleted...');
    }
    public function massDelete(Request $request){
        $tableName=$request->input('tableName');
        $ids=$request->input('checkbox');

        DB::table($tableName)->whereIn('id',$ids)->delete();

        return back()->with('message','All the rows are deleted!!');
    }
    /**********************End Common Function ****************/
    public function dashboard(){
        $pendingReg=DB::table('users')->where('reg_status','0')->count();
        $pendingExm=DB::table('exam_payments')
                    ->Join('exam_shedules','exam_payments.exam_id','=','exam_shedules.id')
                        ->where('exam_payments.status','1')->count();
        $todayExam=AdminModel::toDayExam();
        return view('core.admin.dashboard',['pendingReg'=>$pendingReg,'pendingExm'=>$pendingExm,'todayExam'=>$todayExam]);
    }
    public function pendingReg(){
    	$pendingReg=DB::table('personal_infos')
    			->Join('users','users.id','=','personal_infos.user_id')
    			//->Join('documents','users.id','=','documents.mother_id')
    			->where('users.reg_status','!=',1)
    			->get();
    	return view('core.admin.examineAdministration.pendingReg',['pendingReg'=>$pendingReg]);
    }
    public function singleRegister($id){
        //personal infos
    	$singleRegister=DB::table('personal_infos')
    			->Join('users','users.id','=','personal_infos.user_id')
    			//->Join('documents','users.id','=','documents.mother_id')
    			//->where('users.active','!=',1)
    			->where('users.id','=',$id)
    			->first();
        //academic infos
        $academicInfos=DB::table('academic_infos')->where('user_id',$id)->get();
        //professional info
        $infos=DB::table('professional_details')->where('user_id',$id)->first();
        //result
         $results=DB::table('exam_shedules')
            ->Join('exam_results','exam_shedules.id','=','exam_results.exam_id')
            ->Join('licence_types','exam_shedules.licence_type','=','licence_types.id')
            ->Join('subjects','exam_shedules.subject','=','subjects.id')
            ->where('exam_results.user_id',$id)
            ->get();
    	return view('core.admin.examineAdministration.pendingRegSingle',['singleRegister'=>$singleRegister,'academicInfos'=>$academicInfos,'infos'=>$infos,'results'=>$results]);
    }
    public function userActive($id){
        $active=DB::table('users')
                ->where('id',$id)
                ->update(array(
                        'reg_status'=>1,
                    ));
         return back()->with('message','User Activated!');
    }
    public function userInactive($id){
    	$active=DB::table('users')
    			->where('id',$id)
    			->update(array(
    					'reg_status'=>0,
    				));
    	 return back()->with('message','User Inactivated!');
    }
   // public function userInactive($id){}
    public function examineList(){
    	$examineList=DB::table('personal_infos')
    			->Join('users','users.id','=','personal_infos.user_id')
    			->get();
    	return view('core.admin.examineAdministration.examineList',['examineList'=>$examineList]);
    }
//Question Bank   
    //new question
    public function newQuestion(){
    	$licenceTypes=$this->licences();
    	$subjects=$this->subjects();
        $chapters=$this->chapters();
    	
    	return view('core.admin.questionBank.newQuestion',['licenceTypes'=>$licenceTypes,'subjects'=>$subjects,'chapters'=>$chapters]);
    }
    //post question
    public function postNewQuestion(Request $request){
        //return 'hello';
        //save details
        $createdAt=date('Y-m-d H:i:s');
        DB::table('question_bank')->insert(array(
                'licence_type'=>$request->input('licence_type'),
                'subject'=>$request->input('subject'),
                'chapter'=>$request->input('chapter'),
                'question'=>$request->input('question'),
                'difficulty_level'=>$request->input('difficulty_level'),
                'option_1'=>$request->input('option_1'),
                'option_2'=>$request->input('option_2'),
                'option_3'=>$request->input('option_3'),
                'option_4'=>$request->input('option_4'),
                'option_right'=>$request->input('option_right'),
                'note'=>$request->input('note'),

                'creator'=>Auth::user()->name,
                'updater'=>Auth::user()->name,
                'created_at'=>$createdAt,
                'updated_at'=>date('Y-m-d H:i:s'),
            ));
        //get mother id
        $motherId=DB::table('question_bank')
            ->where('created_at',$createdAt)
            ->where('question',$request->input('question'))
            ->value('id');
        //upload image
        $tableName='question_bank'  ;
        $fieldName='photo'  ;       
        $motherId=$motherId ;
        $docType='img';

       $callingName=AdminModel::docsUpload($request,$tableName,$motherId,$fieldName,$docType);
       //Update image name at row
       if($callingName){
       DB::table('question_bank')->where('id',$motherId)->update(array('image'=>$callingName));
       }
        
         return back()->withInput()->with('message','Question Saved..');
    }
     //update question
    public function updateQuestion(Request $request){
    	$id=$request->input('id');
    	//save details
    	
    	DB::table('question_bank')
        ->where('id',$id)
        ->update(array(
    			'licence_type'=>$request->input('licence_type'),
    			'subject'=>$request->input('subject'),
    			'chapter'=>$request->input('chapter'),
    			'question'=>$request->input('question'),
    			'difficulty_level'=>$request->input('difficulty_level'),
    			'option_1'=>$request->input('option_1'),
    			'option_2'=>$request->input('option_2'),
    			'option_3'=>$request->input('option_3'),
    			'option_4'=>$request->input('option_4'),
    			'option_right'=>$request->input('option_right'),
    			'note'=>$request->input('note'),

    			
    			'updater'=>Auth::user()->name,
    			
    			'updated_at'=>date('Y-m-d H:i:s'),
    		));
    	//get mother id
    	$motherId=$id;
    	//upload image
    	$tableName='question_bank'	;
    	$fieldName='photo'	;    	
    	$motherId=$motherId	;
    	$docType='img';

    	$callingName=AdminModel::docsUpload($request,$tableName,$motherId,$fieldName,$docType);

         //Update image name at row
        if($callingName){
       DB::table('question_bank')->where('id',$motherId)->update(array('image'=>$callingName));
   }
    	
    	 return back()->withInput()->with('message','Question Updated..');
    }
    public function editQuestion($id){
        $licenceTypes=$this->licences();
        $subjects=$this->subjects();
        $chapters=$this->chapters();
        $question=DB::table('question_bank')
                        ->where('id',$id)
                        ->first();

        return view('core.admin.questionBank.editQuestion',['licenceTypes'=>$licenceTypes,'subjects'=>$subjects,'chapters'=>$chapters,'question'=>$question]);
    }

    public function postLicenceType(Request $request){
        DB::table('licence_types')->insert(array(
                'licence_type'=>$request->input('licence_type'),

                'creator'=>Auth::user()->name,
                'updater'=>Auth::user()->name,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ));
        return back()->with('message','Licence Type Saved...........');

    }
    public function updateLicenceType(Request $request){
        $id=$request->input('id');
    	DB::table('licence_types')
        ->where('id',$id)
        ->update(
            array(
    			'licence_type'=>$request->input('licence_type'),
    			'updater'=>Auth::user()->name,
    			'updated_at'=>date('Y-m-d H:i:s'),
    		));
    	return back()->with('message','Licence Type Updated...........');

    }
    public function postSubject(Request $request){
        DB::table('subjects')->insert(array(
                'licence_type_id'=>$request->input('licence_type_id'),
                'subject'=>$request->input('subject'),

                'creator'=>Auth::user()->name,
                'updater'=>Auth::user()->name,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ));
        return back()->with('message','Subject Saved...........');

    }
    public function updateSubject(Request $request){
        $id=$request->input('id');
    	DB::table('subjects')
        ->where('id',$id)
        ->update(array(
    			'licence_type_id'=>$request->input('licence_type_id'),
    			'subject'=>$request->input('subject'),

    			'updater'=>Auth::user()->name,
    			'updated_at'=>date('Y-m-d H:i:s'),
    		));
    	return back()->with('message','Subject Updated...........');

    }
    public function postChapter(Request $request){
        DB::table('chapters')->insert(array(
                'licence_type_id'=>$request->input('licence_type_id'),
                'subject_id'=>$request->input('subject_id'),
                'chapter'=>$request->input('chapter'),
                'question_number'=>$request->input('question_number'),

                'creator'=>Auth::user()->name,
                'updater'=>Auth::user()->name,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ));
        return back()->with('message','Chapter Saved...........');

    }
    public function updateChapter(Request $request){
        $id=$request->input('id');
    	DB::table('chapters')
        ->where('id',$id)
        ->update(array(
    			'licence_type_id'=>$request->input('licence_type_id'),
    			'subject_id'=>$request->input('subject_id'),
                'chapter'=>$request->input('chapter'),
    			'question_number'=>$request->input('question_number'),

    			'updater'=>Auth::user()->name,
    			'updated_at'=>date('Y-m-d H:i:s'),
    		));
    	return back()->with('message','Chapter Updated...........');

    }

    public function questionRoom(){
    	$licTypes=DB::table('licence_types')->get();
    	return view('core.admin.questionBank.questionRoom',['licTypes'=>$licTypes]);
    }
    public function chapterQuestion($licId,$subId,$chapId){
    	$questions=DB::table('question_bank')
    	->where('licence_type',$licId)
    	->where('subject',$subId)
    	->where('chapter',$chapId)
    	->get();
    	return view('core.admin.questionBank.chapter',compact('questions','licId','subId','chapId'));
    }
    public function singleQuestion($id){

    	$question=DB::table('question_bank')
    			->Join('licence_types','licence_types.id','=','question_bank.licence_type')
    			->Join('subjects','subjects.id','=','question_bank.subject')
    			->Join('chapters','chapters.id','=','question_bank.chapter')
    			->where('question_bank.id',$id)
    			->select(
    					'question_bank.*',
    					
    					'licence_types.licence_type',
    					'subjects.subject',
    					'chapters.chapter'
    					)
    			->first();

    	return view('core.admin.questionBank.singleQuestion',['details'=>$question]); 
    }
    //management of licence type, subject, & chapter
    public function management(){

        $licenceTypes=$this->licences();
        $subjects=$this->subjects();
        $chapters=$this->chapters();

        return view('core.admin.questionBank.management',[
            'licenceTypes'=>$licenceTypes,
            'subjects'=>$subjects,
            'chapters'=>$chapters
            ]); 
    }
/***********************Exam Shedule****************************/
public function newExam(){
    $licenceTypes=$this->licences();
    $subjects=$this->subjects();
    return view('core.admin.examShedule.newExam',['licenceTypes'=>$licenceTypes,'subjects'=>$subjects]);
}
public function saveShedule(Request $request){
//return '0';
    DB::table('exam_shedules')->insert(array(
            'title'=>$request->input('title'),
            'licence_type'=>$request->input('licence_type'),
            'subject'=>$request->input('subject'),
            'exam_date'=>$request->input('exam_date'),
            'start_time'=>$request->input('start_time'),
            'end_time'=>$request->input('end_time'),
            'total_question'=>$request->input('total_question'),
            'total_sit'=>$request->input('total_sit'),
            'note'=>$request->input('note'),

            'creator'=>Auth::user()->name,
            'updater'=>Auth::user()->name,
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s')

        ));
    return back()->with('message','Exam Shedule Saved.........');
}
public function updateShedule(Request $request){
//return '0';
    $id=$request->input('id');
    DB::table('exam_shedules')
            ->where('id',$id)
            ->update(array(
            'title'=>$request->input('title'),
            'licence_type'=>$request->input('licence_type'),
            'subject'=>$request->input('subject'),
            'exam_date'=>$request->input('exam_date'),
            'start_time'=>$request->input('start_time'),
            'end_time'=>$request->input('end_time'),
            'total_question'=>$request->input('total_question'),
            'total_sit'=>$request->input('total_sit'),
            'note'=>$request->input('note'),

            
            'updater'=>Auth::user()->name,
            
            'updated_at'=>date('Y-m-d H:i:s')

        ));
    return back()->with('message','Exam Shedule Updated.........');
}
public function upcomingExam(){
//return date('d F Y');
    $upcamingExams=DB::table('exam_shedules')
    ->join('licence_types','licence_types.id','=','exam_shedules.licence_type')
    ->join('subjects','subjects.id','=','exam_shedules.subject')
    ->where('exam_shedules.exam_date','>=',date('Y-m-d'))
    ->select('exam_shedules.*','licence_types.licence_type as licence_name','subjects.subject as sub_name')       
    ->get();
    return view('core.admin.examShedule.upcomingExam',['upcamingExams'=>$upcamingExams]);
}
public function archive(){
//return date('d F Y');
    $upcamingExams=DB::table('exam_shedules')
    ->join('licence_types','licence_types.id','=','exam_shedules.licence_type')
    ->join('subjects','subjects.id','=','exam_shedules.subject')
    ->where('exam_shedules.exam_date','<',date('Y-m-d'))  
    ->select('exam_shedules.*','licence_types.licence_type as licence_name','subjects.subject as sub_name')     
    ->get();
    return view('core.admin.examShedule.archive',['upcamingExams'=>$upcamingExams]);
}
public function singleShedule($id){
    $singleExam=DB::table('exam_shedules')    
    ->join('licence_types','licence_types.id','=','exam_shedules.licence_type')
    ->join('subjects','subjects.id','=','exam_shedules.subject')
    ->where('exam_shedules.id',$id) 
    ->select('exam_shedules.*','licence_types.licence_type as licence_name','subjects.subject as sub_name')   
    ->first();

    $examiners=DB::table('users')
                ->Join('exam_payments','users.id','=','exam_payments.user_id')
                ->where('exam_payments.exam_id',$id)
                ->where('exam_payments.status',2)
                ->get();
    return view('core.admin.examShedule.singleShedule',['details'=>$singleExam,'examiners'=>$examiners]);
}
public function editShedule($id){
    $licenceTypes=$this->licences();
    $subjects=$this->subjects();

    $details=DB::table('exam_shedules')    
    ->where('exam_shedules.id',$id)   
    ->first();

    return view('core.admin.examShedule.editShedule',['details'=>$details,
        'licenceTypes'=>$licenceTypes,
        'subjects'=>$subjects
        ]);
}



/****Question Generate*****/
public function questionGenerate(){

    $exam=DB::table('exam_shedules')->where('exam_date','>',date('Y-m-d'))
    ->select('title','id')
    ->get();
    return view('core.admin.questionGenerate.newQuestionSetup',['exam'=>$exam]);
}
public function newQuestionSetup2(Request $request){

   $examId=$request->input('exam');
   $subjectId=DB::table('exam_shedules')->where('id',$examId)->value('subject');
   $chapters=DB::table('exam_shedules')
                ->Join('chapters','chapters.subject_id','=','exam_shedules.subject')
                ->where('exam_shedules.id',$examId)
                ->get();
    //enlisted question
    $listedQustion=DB::table('chapters')
                ->Join('question_generators','chapters.id','=','question_generators.chapter_id')
               // ->Join('difficulty_levels','difficulty_levels.name','=','question_generators.difficulty_level')
                ->where('question_generators.exam_id',$examId)->orderBy('question_generators.id','desc')->get();


    return view('core.admin.questionGenerate.newQuestionSetup2',['chapters'=>$chapters,'examId'=>$examId,'subjectId'=>$subjectId,'listedQustion'=>$listedQustion]);
}
public function saveQuestionPaperPart(Request $request){
    
    $chapterId=$request->input('chapter_id');
    $avoidLast=$request->input('avoid_last');
    $questionNo=$request->input('question_no');
    $examId=$request->input('exam_id');
    $diffLevel=$request->input('difficulty_level');

      //get questions avoiding last x exam
         //step 1: get all the question of this chapter
            $questions=DB::table('question_bank')
                        ->where('chapter',$chapterId)
                        ->where('difficulty_level',$diffLevel)
                        ->lists('id');
         
         //Step 2: get the question id of last x exam
            $lastQuestion=DB::table('question_stors')->whereBetween('exam_id', [$examId-$avoidLast, $examId])->lists('question_id');
         // Step 3 =Step 1- Step 2
           
            $questions=array_diff($questions,$lastQuestion);
            $size=count($questions);
    if($size<$questionNo){

        return back()->with('error','Sufficient Questions are not found...');
    }
    else{

        if($questionNo>0)
            $questionNo=$questionNo;
        else 
             $questionNo=DB::table('chapters')->where('id',$chapterId)->value('question_number');
        

    //save primary data
   $saveData=DB::table('question_generators')->insert(array(
            'exam_id'=>$examId,
            'chapter_id'=>$chapterId,
            'difficulty_level'=>$diffLevel,
            'question_no'=>$questionNo,
            'avoid_last'=>$avoidLast,

            'creator'=>Auth::user()->name,
            'updater'=>Auth::user()->name,
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s')

        ));
    //get question_generators id
    $questionGeneratorId=DB::table('question_generators')
                    ->where('exam_id',$request->input('exam_id'))
                    ->where('chapter_id',$chapterId)
                    ->where('difficulty_level',$request->input('difficulty_level'))
                    ->where('question_no',$request->input('question_no'))
                    ->where('avoid_last',$request->input('avoid_last'))
                    ->orderBy('id','desc')
                    ->first();
  
         //shuffle step 3 and select number of question
           
         shuffle($questions);

         $sliceResult=array_slice($questions,0,$questionNo);
         //store the question to question_store  
         foreach ($sliceResult as $key) {
                    $copy=DB::table('question_bank')->where('id',$key)->first();
                    $peast=DB::table('question_stors')->insert(array(
                                    'exam_id'=>$examId,
                                    'question_generator_id'=>$questionGeneratorId->id,
                                    'licence_type_id'=>$copy->licence_type,
                                    'subject_id'=>$copy->subject,
                                    'difficulty_level_id'=>$copy->difficulty_level,
                                    'question_id'=>$copy->id,
                                    'question'=>$copy->question,
                                    'chapter_id'=>$copy->chapter,
                                    'option_1'=>$copy->option_1,
                                    'option_2'=>$copy->option_2,
                                    'option_3'=>$copy->option_3,
                                    'option_4'=>$copy->option_4,
                                    'option_right'=>$copy->option_right,
                                    'note'=>$copy->note,
                                    'image'=>$copy->image,
                        ));
                 } 
         return back()->with('message','Questions are added..');
     }
}

public function autoQuestionPaperGenerate($subjectId,$examId){
   // return 'Hello';
    //chaptert lis of this subject
     $subjectId;
    $chapters=DB::table('chapters')->where('subject_id',$subjectId)->get();
    $avoidLast=2;
    $examId=$examId;
    $diffLevel=2;
    foreach ($chapters as $chapter) { //loop start
        //get how many question select defaultly
          $questionNo=DB::table('chapters')->where('id',$chapter->id)->value('question_number');

          //get questions avoiding last x exam
         //step 1: get all the question of this chapter
            $questions=DB::table('question_bank')
                        ->where('chapter',$chapter->id)
                        ->where('difficulty_level',$diffLevel)
                        ->lists('id');         
         //Step 2: get the question id of last x exam
            $lastQuestion=DB::table('question_stors')->whereBetween('exam_id', [$examId-$avoidLast, $examId])->lists('question_id');
         // Step 3 =Step 1- Step 2           
            $questions=array_diff($questions,$lastQuestion);
            $size=count($questions);



            

            //save primary data
               $saveData=DB::table('question_generators')->insert(array(
                        'exam_id'=>$examId,
                        'chapter_id'=>$chapter->id,
                        'difficulty_level'=>$diffLevel,
                        'question_no'=>$questionNo,
                        'avoid_last'=>$avoidLast,

                        'creator'=>Auth::user()->name,
                        'updater'=>Auth::user()->name,
                        'created_at'=>date('Y-m-d H:i:s'),
                        'updated_at'=>date('Y-m-d H:i:s')

                    ));

            //get question_generators id
                $questionGeneratorId=DB::table('question_generators')
                                ->where('exam_id',$examId)
                                ->where('chapter_id',$chapter->id)
                                ->where('difficulty_level',$diffLevel)
                                ->where('question_no',$questionNo)
                                ->where('avoid_last',$avoidLast)
                                ->orderBy('id','desc')
                                ->first();
              
            //shuffle step 3 and select number of question
                       
                     shuffle($questions);

                     $sliceResult=array_slice($questions,0,$questionNo);
                     //store the question to question_store  
                     foreach ($sliceResult as $key) {
                                $copy=DB::table('question_bank')->where('id',$key)->first();
                                $peast=DB::table('question_stors')->insert(array(
                                                'exam_id'=>$examId,
                                                'question_generator_id'=>$questionGeneratorId->id,
                                                'licence_type_id'=>$copy->licence_type,
                                                'subject_id'=>$copy->subject,
                                                'difficulty_level_id'=>$copy->difficulty_level,
                                                'question_id'=>$copy->id,
                                                'question'=>$copy->question,
                                                'chapter_id'=>$copy->chapter,
                                                'option_1'=>$copy->option_1,
                                                'option_2'=>$copy->option_2,
                                                'option_3'=>$copy->option_3,
                                                'option_4'=>$copy->option_4,
                                                'option_right'=>$copy->option_right,
                                                'note'=>$copy->note,
                                                'image'=>$copy->image,
                                    ));
                             } 
                   
            
  

  } 
    
    return back()->with('message','Question Generated!!');  

    
     

}
public function chapterSingleQuestionPaper($questionGeneratorId,$examId){
    //question set for QP 
      $questions=DB::table('question_stors')
                    ->Join('licence_types','question_stors.licence_type_id','=','licence_types.id')
                    ->Join('subjects','question_stors.subject_id','=','subjects.id')
                    ->Join('chapters','question_stors.chapter_id','=','chapters.id')
                    ->where('question_stors.question_generator_id',$questionGeneratorId)
                    ->select(
                             'question_stors.id','question_stors.question',
                             'question_stors.option_1','question_stors.option_2',
                             'question_stors.option_3','question_stors.option_4','question_stors.image',
                             'question_stors.difficulty_level_id','question_stors.question_id',
                             'licence_types.licence_type','subjects.subject','chapters.chapter'
                             )
                    ->get();
    //display Information
      $disInfos=DB::table('question_stors')
                    ->Join('licence_types','question_stors.licence_type_id','=','licence_types.id')
                    ->Join('subjects','question_stors.subject_id','=','subjects.id')
                    ->Join('chapters','question_stors.chapter_id','=','chapters.id')
                    ->where('question_stors.question_generator_id',$questionGeneratorId)
                    ->first();
    //get chapter ID
     $chapterId=$disInfos->chapter_id;
     //all the question of chapter
      $allQuestions=DB::table('question_bank')
                    ->where('chapter',$chapterId)
                    ->get();

      return view('core.admin.questionGenerate.chapterSingleQuestionPaper',[
        'questions'=>$questions,
        'disInfos'=>$disInfos,
        'allQuestions'=>$allQuestions,
        'questionGeneratorId'=>$questionGeneratorId,
        'examId'=>$examId,
        ]);
}

public function addQuestion($qId,$qGeneId,$examId){
     $copy=DB::table('question_bank')->where('id',$qId)->first();
     $peast=DB::table('question_stors')->insert(array(
                                    'exam_id'=>$examId,
                                    'question_generator_id'=>$qGeneId,

                                    'licence_type_id'=>$copy->licence_type,
                                    'subject_id'=>$copy->subject,
                                    'difficulty_level_id'=>$copy->difficulty_level,
                                    'question_id'=>$copy->id,
                                    'question'=>$copy->question,
                                    'chapter_id'=>$copy->chapter,
                                    'option_1'=>$copy->option_1,
                                    'option_2'=>$copy->option_2,
                                    'option_3'=>$copy->option_3,
                                    'option_4'=>$copy->option_4,
                                    'option_right'=>$copy->option_right,
                                    'note'=>$copy->note,
                                    'image'=>$copy->image,
                        ));

     return back();
}
public function removeChapter($qGId){
    //remove from question_generator table
    DB::table('question_generators')->where('id',$qGId)->delete();

    //remove all questions for question_stors
    DB::table('question_stors')->where('question_generator_id',$qGId)->delete();
    return back()->with('message','Removed Successfully.....');
}
public function singleQuestionPaper($examId){

    $examInfo=DB::table('exam_shedules')
    ->Join('licence_types','licence_types.id','=','exam_shedules.licence_type')
    ->Join('subjects','subjects.id','=','exam_shedules.subject')
    ->where('exam_shedules.id',$examId)    
    ->first();
    //enlisted questions
    $enlistedQuestion=DB::table('chapters')
        ->Join('question_generators','chapters.id','=','question_generators.chapter_id')
        ->where('question_generators.exam_id',$examId)
        ->get();
    //questions
    $allQuestions=DB::table('chapters')
        ->Join('question_stors','chapters.id','=','question_stors.chapter_id')
        ->Join('subjects','subjects.id','=','question_stors.subject_id')
        ->where('question_stors.exam_id',$examId)->get();

    //chapter
       $chapters=DB::table('exam_shedules')
                ->Join('chapters','chapters.subject_id','=','exam_shedules.subject')
                ->where('exam_shedules.id',$examId)
                ->get();


    return view('core.admin.questionGenerate.singleQuestionPaper',
        ['examInfo'=>$examInfo,'enlistedQuestion'=>$enlistedQuestion,'allQuestions'=>$allQuestions,'examId'=>$examId,'chapters'=>$chapters
        ]
        );
}
public function questionArchive(){

    $examArchive=DB::table('exam_shedules')
                ->Join('licence_types','exam_shedules.licence_type','=','licence_types.id')
                ->Join('subjects','exam_shedules.subject','=','subjects.id')
                ->where('exam_shedules.exam_date','<',date('Y-m-d'))
                ->select(
                    'exam_shedules.id',
                    'exam_shedules.exam_date',
                    'exam_shedules.title',
                    'licence_types.licence_type',
                    'subjects.subject'
                    )
                ->get();
    return view('core.admin.questionGenerate.questionArchive',
            ['examArchive'=>$examArchive,'page'=>'archive']
        );
}
public function upcomingExamQuestions(){

    $examArchive=DB::table('exam_shedules')
                ->Join('licence_types','exam_shedules.licence_type','=','licence_types.id')
                ->Join('subjects','exam_shedules.subject','=','subjects.id')
                ->where('exam_shedules.exam_date','>=',date('Y-m-d'))
                ->select(
                    'exam_shedules.id',
                    'exam_shedules.exam_date',
                    'exam_shedules.title',
                    'licence_types.licence_type',
                    'subjects.subject'
                    )
                ->get();
    return view('core.admin.questionGenerate.questionArchive',
            ['examArchive'=>$examArchive,'page'=>'upcoming']
        );
}

/******Examine Admistration******/
public function pendingExm(){

   $infos= DB::table('exam_payments')
        ->Join('users','exam_payments.user_id','=','users.id')
        ->Join('exam_shedules','exam_payments.exam_id','=','exam_shedules.id')
        ->Join('licence_types','licence_types.id','=','exam_shedules.licence_type')
        ->Join('subjects','subjects.id','=','exam_shedules.subject')
        ->where('exam_payments.status','=','1')
        ->get();

     return view('core.admin.examineAdministration.pendingExm',['infos'=>$infos]);
}
public function pendingExamineDetails($userId,$examId){

    $payment=DB::table('exam_payments')
            ->where('user_id',$userId)
            ->where('exam_id',$examId)
            ->first();

    return view('core.admin.examineAdministration.pendingExamineDetails',['payment'=>$payment]);
}
public function examSitApprove($userId,$examId){
    DB::table('exam_payments')
        ->where('user_id',$userId)
        ->where('exam_id',$examId)
        ->update(array(
            'status'=>2,
            ));
    return redirect('examineAdminstration/pendingExm')->with('message','Applicant approved for sitting on exam..');
}
public function examSitSuspend($userId,$examId){
    DB::table('exam_payments')
        ->where('user_id',$userId)
        ->where('exam_id',$examId)
        ->update(array(
            'status'=>1,
            ));
    return back()->with('message','Applicant Suspended .....');
}
//setting

public function adminSetting(){
    return view('core.admin.settings.adminSetting');
}

public function addUser(){
    $roles=DB::table('roles')->select('id','role')->get();
    return view('core.admin.settings.addUser',compact('roles'));
}
public function editUser($id){
    $roles=DB::table('roles')->select('id','role')->get();
    $user=DB::table('users')->where('id',$id)->first();
    return view('core.admin.settings.editUser',compact('user','roles'));
}
public function viewUsers(){
    $users=DB::table('users')
                ->JOIN('roles','users.role_id','=','roles.id')
                ->select('users.*','roles.role')
                ->get();
    return view('core.admin.settings.viewUsers',compact('users'));
}
public function updateUser(Request $request){

        $rule=[
        'name' => 'required|max:255',
        'email' => 'required|email|max:255',
        ];
            //validate
             $validator = Validator::make($request->all(),$rule);
             if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
             }
            else
            {
                    $id=$request->input('id');
                   //user table
                    DB::table('users')->where('id',$id)->update(array(
                            'title'=>$request->input('title'),
                            'name'=>$request->input('name'),
                            'email'=>$request->input('email'),
                            'role_id'=>$request->input('role'),
                            'active'=>$request->input('active'),
                        ));            
                     return back()->withInput()->with('message','User Update!');
            }
            
        }
public function updateUserPassword(Request $request){
        

            //rule
            $rule=[
                'password' => 'required|confirmed|min:6',
            ];
            //validate
             $validator = Validator::make($request->all(),$rule);
             if ($validator->fails()) 
             {
                return back()
                      ->withErrors($validator)
                        ->withInput();
             }
            else
            {
                     $id=$request->input('id');
                    DB::table('users')->where('id',$id)->update(array(
                            
                            'password'=>bcrypt($request->input('password'))

                        ));            
                     return back()->withInput()->with('message','Password Updated!');
            }
           
            
        }
public function saveUser(Request $request){
        

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
                        ->withInput();
             }
            else
            {
                    //user table
                    DB::table('users')->insert(array(
                            'title'=>$request->input('title'),
                            'name'=>$request->input('name'),
                            'email'=>$request->input('email'),
                            'role_id'=>$request->input('role'),
                            'active'=>'1',
                            'reg_status'=>'1',
                            'password'=>bcrypt($request->input('password'))

                        ));            
                     return back()->withInput()->with('message','New User Created!');
            }
           
            
        }

public function addRole(){
    $sections=DB::table('sections')->select('name','id')->get();
    return view('core.admin.settings.addRole',compact('sections'));
}
public function viewRoles(){
    $allRoles=DB::table('roles')->get();
    return view('core.admin.settings.viewRoles',compact('allRoles'));
}
public function editRole($id){
    $sections=DB::table('sections')->select('name','id')->get();
    $roleDetails=DB::table('roles')->where('id',$id)->first();
    return view('core.admin.settings.editRole',compact('roleDetails','sections'));
}

public function saveRole( Request $request){
    $privilege=serialize($request->input('privilege')) ;

    DB::table('roles')->insert(array(
            'role'=>$request->input('role'),
            'description'=>$request->input('description'),
            'privilege'=>$privilege,
            'creator'=>Auth::user()->name,
            'updater'=>Auth::user()->name,
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s')

        ));
   return back()->withInput()->with('message','Role Added!!');
}
public function updateRole( Request $request){
    $id=$request->input('id');
    $privilege=serialize($request->input('privilege')) ;

    DB::table('roles')->where('id',$id)->update(array(
            'role'=>$request->input('role'),
            'description'=>$request->input('description'),
            'privilege'=>$privilege,
            
            'updater'=>Auth::user()->name,
            
            'updated_at'=>date('Y-m-d H:i:s')

        ));
   return back()->withInput()->with('message','Role Updated!!');
}

public function addSection(){
    return view('core.admin.settings.addSection');
}
public function viewSections(){
    $allSections=DB::table('sections')->get();
    return view('core.admin.settings.viewSections',compact('allSections'));
}
public function editSection($id){
    $sections=DB::table('sections')->where('id',$id)->first();
    return view('core.admin.settings.editSection',compact('sections'));
}
public function saveSection(Request $request){
    DB::table('sections')->insert(array(
                                    'name'=>$request->input('name'),
                                    'description'=>$request->input('description'),
                                    'created_at'=>date('Y-m-d H:i:s'),
                                    'updated_at'=>date('Y-m-d H:i:s'),
                        ));
    
     return back()->withInput()->with('message',"Section saved!! can view" );
}
public function updateSection(Request $request){
    $id=$request->input('id');
    DB::table('sections')->where('id',$id)->update(array(
                                    'name'=>$request->input('name'),
                                    'description'=>$request->input('description'),
                                    
                                    'updated_at'=>date('Y-m-d H:i:s'),
                        ));

     return back()->withInput()->with('message',"Section updated!!");
}
//result
public function resultArchive(){
    $exams=DB::table('exam_shedules')
            ->Join('licence_types','exam_shedules.licence_type','=','licence_types.id')
            ->Join('subjects','exam_shedules.subject','=','subjects.id')
            ->select('exam_shedules.*','licence_types.licence_type','subjects.subject')
            ->get();
    return view('core.admin.result.resultArchive',['exams'=>$exams]);
}

public function singleExamResult($examId){
    $infos=DB::table('users')
            ->Join('exam_results','exam_results.user_id','=','users.id')
            ->Join('personal_infos','personal_infos.user_id','=','users.id')
            ->select('users.id','users.name','personal_infos.passport_no','exam_results.total_question','exam_results.correct_ans')
            
            ->where('exam_results.exam_id',$examId)
            ->get();

    return view('core.admin.result.singleExamResult',['infos'=>$infos,'examId'=>$examId]);
}

public function changeBlockStatus($state,$userId,$examId){
    if($state=='0'){
        DB::table('exam_examinee_block')->where('user_id',$userId)->where('exam_id',$examId)->delete();
        return back()->with('message','Examinee Removed From Blocked List');
    }
    if($state=='1'){
        DB::table('exam_examinee_block')->insert(array(
               'user_id'=>$userId,
               'exam_id'=>$examId,
            ));
        return back()->with('message','Examinee Marked as Blocked');
    }

}






























}

