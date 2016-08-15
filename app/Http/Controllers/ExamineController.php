<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;
use Auth;
use Hash;
use Validator;
use App\AdminModel;
use Session;
use App\ExaminerModel;
use View;


class ExamineController extends Controller
{
     public function __construct()
      {
        $privileges=AdminModel::privilegedSections(Auth::user()->role_id);
        View::share('privileges', $privileges);
      }
    
    public function dashboard(){

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
        //warning 
        $academic=DB::table('academic_infos')->where('user_id',Auth::user()->id)->count();
        $personal=DB::table('personal_infos')->where('user_id',Auth::user()->id)->count();
        $professional=DB::table('professional_details')->where('user_id',Auth::user()->id)->count();
        $signal=0;
        if($academic>0 && $personal>0 && $professional>0){
            $signal=1;
        }
        $toDayExam= ExaminerModel::hasExamUserToday(Auth::user()->id);
        return view('core.examine.dashboard',['upcomingExam'=>$upcomingExam,'signal'=>$signal,'toDayExam'=>$toDayExam]);
    }
    public function apply($examId){
        return view('core.examine.apply',['examId'=>$examId]);
    }
    public function saveBankInfo(Request $request){
        //save docs
        DB::table('exam_payments')->insert(array(
                    'exam_id'=>$request->input('exam_id'),
                    'user_id'=>Auth::user()->id,
                    'fee_type'=>$request->input('fee_type'),
                    'doc_number'=>$request->input('doc_number'),
                    'bank'=>$request->input('bank'),
                    'branch'=>$request->input('branch'),
                    'account_name'=>$request->input('account_name'),
                    'status'=>'1',

                    'creator'=>Auth::user()->name,
                    'updater'=>Auth::user()->name,
                    'created_at'=>date('Y-m-d H:i:s'),
                    'updated_at'=>date('Y-m-d H:i:s'),
            ));

        //upload docs
         //mother id
            $motherId=DB::table('exam_payments')
                        ->where('exam_id',$request->input('exam_id'))
                        ->where('user_id',Auth::user()->id)
                        ->value('id');
         //upload image
            $tableName='exam_payments'  ;
            $fieldName='bank_doc'  ;       
            $motherId=$motherId ;
            $docType='img/pdf';

            AdminModel::docsUpload($request,$tableName,$motherId,$fieldName,$docType);

        return back()->with('message','Successfully Applied, Waiting for Approval...');
    }
    public function updatePaymentDetails(Request $request){
        //
        $id=$request->input('id');
                DB::table('exam_payments')
                ->where('id',$id)
                ->update(array(
                    
                    'fee_type'=>$request->input('fee_type'),
                    'doc_number'=>$request->input('doc_number'),
                    'bank'=>$request->input('bank'),
                    'branch'=>$request->input('branch'),
                    'account_name'=>$request->input('account_name'),
                    
                    
                    'updater'=>Auth::user()->name,
                    
                    'updated_at'=>date('Y-m-d H:i:s'),
            ));

        //upload docs
         //mother id
            $motherId=$id;
         //upload image
            $tableName='exam_payments'  ;
            $fieldName='bank_doc'  ;       
            $motherId=$motherId ;
            $docType='img/pdf';

            AdminModel::docsUpload($request,$tableName,$motherId,$fieldName,$docType);

        return back()->with('message','Payment Details Successfully Updated.....');
    }
    public function professional(){
        $professionalInfo=DB::table('professional_details')
                ->where('user_id',Auth::user()->id)
                ->first();
                 
           //       $output = ' ';
           //       $output ="<table class='table' bordered='2'>  
           //           <tr>  
           //                <th style='width:250px'>Id</th>  
           //                <th>First Name</th>  
           //                <th>Last Name</th>  
           //           </tr>  
           //      </table>
           //  ";

           // header("Content-Type: application/xls");   
           // header("Content-Disposition: attachment; filename=hello.xls");  
           // echo $output;  

        return view('core.examine.personalInfo.professional',['infos'=>$professionalInfo]);
    }
    public function addProfessional(){

        return view('core.examine.personalInfo.addProfessionalInfo');
    }
    public function editProfessional(){
       $infos=DB::table('professional_details')
                ->where('user_id',Auth::user()->id)
                ->first();
        return view('core.examine.personalInfo.editProfessionalInfo',['infos'=>$infos]);
    }
    public function saveProfessionalInfos(Request $request){
        $createdAt=date('Y-m-d H:i:s');
        DB::table('professional_details')->insert(array(
                    'user_id'=>Auth::user()->id,
                    'first_training_date'=>$request->input('first_training_date'),
                    'defense_personnel'=>$request->input('defense_personnel'),
                    'defence_category'=>$request->input('defence_category'),
                    'having_spl_or_not'=>$request->input('having_spl_or_not'),
                    'date_of_issue_of_spl'=>$request->input('date_of_issue_of_spl'),
                    'higher_category_pilot_license'=>$request->input('higher_category_pilot_license'),
                    'license_category'=>$request->input('license_category'),
                    'license_number'=>$request->input('license_number'),
                    'license_validity'=>$request->input('license_validity'),
                    'endorsement_of_multi_engine_aircraft'=>$request->input('endorsement_of_multi_engine_aircraft'),
                    'total_flying_hour'=>$request->input('total_flying_hour'),
                    'total_flying_hour_as_pilot_in_command'=>$request->input('total_flying_hour_as_pilot_in_command'),
                    'flying_training_institute'=>$request->input('flying_training_institute'),
                    'ground_training_institute'=>$request->input('ground_training_institute'),


                    'creator'=>Auth::user()->name,
                    'updater'=>Auth::user()->name,
                    'created_at'=>$createdAt,
                    'updated_at'=>date('Y-m-d H:i:s'),
            ));

         $motherId=DB::table('professional_details')->where('created_at',$createdAt)
                    ->where('user_id',Auth::user()->id)->value('id');
         $tableName ='professional_details';

         if($request->hasFile('docs'))
            {
                 $files = $request->file('docs');
                $destinationPath = 'public/documents';
                foreach ($files as $file) {
                      $orginalName=$file->getClientOriginalName();
                     $filename =$orginalName.'-'.time().'.'.$file->getClientOriginalExtension();
                     $upload_success = $file->move($destinationPath, $filename);
                     //insert in document table
                     DB::table('documents')->insert(array(
                            'table_name'=>$tableName,
                            'mother_id'=>$motherId,
                            'calling_id'=>$filename,
                            'doc_type'=>'img/pdf',
                            'doc_name'=>$orginalName,
                        ));
                }              
             }

        return redirect('examine/personalInfo/professional/'.Auth::user()->id)->with('message','Professional Information is saved..');
    }
    public function updateProfessionalInfos(Request $request){
        DB::table('professional_details')
        ->where('user_id',Auth::user()->id)
        ->update(array(
                    'user_id'=>Auth::user()->id,
                    'first_training_date'=>$request->input('first_training_date'),
                    'defense_personnel'=>$request->input('defense_personnel'),
                    'defence_category'=>$request->input('defence_category'),
                    'having_spl_or_not'=>$request->input('having_spl_or_not'),
                    'date_of_issue_of_spl'=>$request->input('date_of_issue_of_spl'),
                    'higher_category_pilot_license'=>$request->input('higher_category_pilot_license'),
                    'license_category'=>$request->input('license_category'),
                    'license_number'=>$request->input('license_number'),
                    'license_validity'=>$request->input('license_validity'),
                    'endorsement_of_multi_engine_aircraft'=>$request->input('endorsement_of_multi_engine_aircraft'),
                    'total_flying_hour'=>$request->input('total_flying_hour'),
                    'total_flying_hour_as_pilot_in_command'=>$request->input('total_flying_hour_as_pilot_in_command'),
                    'flying_training_institute'=>$request->input('flying_training_institute'),
                    'ground_training_institute'=>$request->input('ground_training_institute'),

                    'updater'=>Auth::user()->name,
                    'updated_at'=>date('Y-m-d H:i:s'),
            ));
        return redirect('examine/personalInfo/professional/'.Auth::user()->id)->with('message','Professional Information is updated..');
    }
    public function personal(){
        $infos=DB::table('personal_infos')
                ->Join('users','users.id','=','personal_infos.user_id')
                ->where('personal_infos.user_id',Auth::user()->id)->first();

        return view('core.examine.personalInfo.personal',['infos'=>$infos]);
    }
    public function editPersonalInfos(){
       
        $infos=DB::table('personal_infos')
                ->Join('users','users.id','=','personal_infos.user_id')
                ->where('personal_infos.user_id',Auth::user()->id)->first();

        return view('core.examine.personalInfo.editPersonalInfos',['infos'=>$infos]);
    }
    public function updatePersonalInfos(Request $request){
       
        //rule
            $rule=[
                'name' => 'required|max:255',
               // 'email' => 'required|email|max:255|unique:users',
               // 'password' => 'required|confirmed|min:6',
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
                    DB::table('users')
                    ->where('id',Auth::user()->id)
                    ->update(array(
                            'title'=>$request->input('title'),
                            'name'=>$request->input('name'),
                            //'email'=>$request->input('email'),
                            //'role_id'=>'1',
                            //'active'=>'0',
                            // 'password'=>bcrypt($request->input('password'))

                        ));
                    //get the user_id
                    $user_id=Auth::user()->id;
                    //personal information tabel
                    DB::table('personal_infos')
                    ->where('user_id',Auth::user()->id)
                    ->update(array(
                            'user_id'=>$user_id,
                            'father_name'=>$request->input('father_name'),
                            'mother_name'=>$request->input('mother_name'),
                            'date_of_birth'=>$request->input('date_of_birth'),
                            'nationality'=>$request->input('nationality'),
                            'passport_no'=>$request->input('passport_no'),
                            'validity_date'=>$request->input('validity_date'),
                            'parmanent_address'=>$request->input('parmanent_address'),
                            'mailing_address'=>$request->input('mailing_address'),
                            'gender'=>$request->input('gender'),
                           

                            'updated_at'=>date('Y-m-d H:i:s')
                        ));
                    
                    //$user_id='10';
                    //photo upload
                    //return $files = $request->file('photo');
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
                                    'mother_id'=>$user_id,
                                    'calling_id'=>$filename,
                                    'doc_type'=>'img',
                                    'doc_name'=>$orginalName,
                                ));
                        }              
                     }

        return redirect('examine/personalInfo/personal/'.Auth::user()->id);
    }
    }

    public function academic(){
        $infos=DB::table('academic_infos')->where('user_id',Auth::user()->id)
                            ->orderBy('end_date','desc')->get();
       return view('core.examine.personalInfo.academic',['infos'=>$infos]);
    }
   
    public function newAccdemicInfos(){

        return view('core.examine.personalInfo.addAccademicInfos');
    }
    public function saveAccademicInfos(Request $request){
        $createdAt=date('Y-m-d H:i:s');
        DB::table('academic_infos')->insert(array(
                    'user_id'=>Auth::user()->id,
                    'degree_name'=>$request->input('degree_name'),
                    'start_date'=>$request->input('start_date'),
                    'end_date'=>$request->input('end_date'),
                    'institute'=>$request->input('institute'),
                    'subject'=>$request->input('subject'),
                    'result'=>$request->input('result'),

                    'creator'=>Auth::user()->name,
                    'updater'=>Auth::user()->name,
                    'created_at'=>$createdAt,
                    'updated_at'=>date('Y-m-d H:i:s'),
            ));


         $motherId=DB::table('academic_infos')->where('created_at',$createdAt)
                    ->where('user_id',Auth::user()->id)->value('id');
         $tableName ='academic_infos';

         if($request->hasFile('docs'))
            {
                 $files = $request->file('docs');
                $destinationPath = 'public/documents';
                foreach ($files as $file) {
                      $orginalName=$file->getClientOriginalName();
                     $filename =$orginalName.'-'.time().'.'.$file->getClientOriginalExtension();
                     $upload_success = $file->move($destinationPath, $filename);
                     //insert in document table
                     DB::table('documents')->insert(array(
                            'table_name'=>$tableName,
                            'mother_id'=>$motherId,
                            'calling_id'=>$filename,
                            'doc_type'=>'img/pdf',
                            'doc_name'=>$orginalName,
                        ));
                }              
             }


        return back()->with('message','Academic Information Saved...');
    }
    public function updateAccademicInfos(Request $request){
        $id=$request->input('id');
        DB::table('academic_infos')
        ->where('id',$id)
        ->update(array(
                    'user_id'=>Auth::user()->id,
                    'degree_name'=>$request->input('degree_name'),
                    'start_date'=>$request->input('start_date'),
                    'end_date'=>$request->input('end_date'),
                    'institute'=>$request->input('institute'),
                    'subject'=>$request->input('subject'),
                    'result'=>$request->input('result'),

                    
                    'updater'=>Auth::user()->name,                    
                    'updated_at'=>date('Y-m-d H:i:s'),
            ));


         $motherId=$id;
         $tableName ='academic_infos';

         if($request->hasFile('docs'))
            {
                 $files = $request->file('docs');
                $destinationPath = 'public/documents';
                foreach ($files as $file) {
                      $orginalName=$file->getClientOriginalName();
                     $filename =$orginalName.'-'.time().'.'.$file->getClientOriginalExtension();
                     $upload_success = $file->move($destinationPath, $filename);
                     //insert in document table
                     DB::table('documents')->insert(array(
                            'table_name'=>$tableName,
                            'mother_id'=>$motherId,
                            'calling_id'=>$filename,
                            'doc_type'=>'img/pdf',
                            'doc_name'=>$orginalName,
                        ));
                }              
             }


        return back()->with('message','Academic Information updated...');
    }
     public function editAccademicInfos($id){
        $infos=DB::table('academic_infos')
        ->where('id',$id)->first();        
       return view('core.examine.personalInfo.editAccademicInfos',['infos'=>$infos]);
    }
    //upcoming 
    public function examParticipation(){

        $infos=DB::table('exam_payments')
                ->Join('exam_shedules','exam_payments.exam_id','=','exam_shedules.id')
                ->Join('licence_types','licence_types.id','=','exam_shedules.licence_type')
                ->Join('subjects','subjects.id','=','exam_shedules.subject')
                ->where('exam_payments.user_id',Auth::user()->id)
                ->where('exam_shedules.exam_date','>=',date('Y-m-d'))
                ->select('exam_payments.*','exam_shedules.exam_date','exam_shedules.start_time','licence_types.licence_type','subjects.subject')
                ->get();
        return view('core.examine.myParticipation.examParticipation',['infos'=>$infos]);
    }
    public function myParticipationArchive(){

        $infos=DB::table('exam_payments')
                ->Join('exam_shedules','exam_payments.exam_id','=','exam_shedules.id')
                ->Join('licence_types','licence_types.id','=','exam_shedules.licence_type')
                ->Join('subjects','subjects.id','=','exam_shedules.subject')
                ->where('exam_payments.user_id',Auth::user()->id)
                ->where('exam_shedules.exam_date','<',date('Y-m-d'))
                ->select('exam_payments.*','exam_shedules.exam_date','exam_shedules.start_time','licence_types.licence_type','subjects.subject')
                ->get();
        return view('core.examine.myParticipation.examParticipation',['infos'=>$infos]);
    }
    public function paymentDetails($examId,$userId){

      $payment=DB::table('exam_shedules')
                ->Join('exam_payments','exam_payments.exam_id','=','exam_shedules.id')
            ->where('user_id',$userId)
            ->where('exam_id',$examId)
            ->first();

        return view('core.examine.myParticipation.paymentDetails',['payment'=>$payment]);
    }
    public function editPaymentDetails($userId,$examId){

      $payment=DB::table('exam_payments')
            ->where('user_id',$userId)
            ->where('exam_id',$examId)
            ->first();

        return view('core.examine.myParticipation.editPaymentDetails',['payment'=>$payment]);
    }
    public function todayExam(){
        $exams=DB::table('exam_shedules')
               ->Join('exam_payments','exam_shedules.id','=','exam_payments.exam_id')
               ->Join('licence_types','exam_shedules.licence_type','=','licence_types.id') 
               ->Join('subjects','exam_shedules.subject','=','subjects.id') 
        ->where('exam_shedules.exam_date','=',date('Y-m-d'))
        ->where('exam_payments.user_id','=',Auth::user()->id)
        ->where('exam_payments.status','=',2)
        ->select('exam_shedules.*','licence_types.licence_type','subjects.subject')
        ->get();

        return view('core.examRoom.todayExam',['exams'=>$exams]);
    }
    public function exam($examId){
        $questions=DB::table('question_stors')->where('exam_id',$examId)->get();

        $examTime=DB::table('exam_shedules')
            ->JOIN('licence_types','licence_types.id','=','exam_shedules.licence_type')
            ->JOIN('subjects','subjects.id','=','exam_shedules.subject')
            ->where('exam_shedules.id',$examId)
            ->orderBy('exam_shedules.id','desc')
            ->select('licence_types.licence_type as lictype','subjects.subject as sub', 'exam_shedules.*')
            ->first();

        //chech whether today & time now
        if($examTime->exam_date==date('Y-m-d')&&$examTime->start_time<=date('H:i:s'))
           { $start=1;
            Session::put('ExamTime',1);
            //Session::forget('ExamTime');
        }
        else 
            $start=0;
        $elapsedTime=strtotime($examTime->end_time)-strtotime(date('H:i:s'));
        return view('core.examRoom.exam',['questions'=>$questions,'elapsedTime'=>$elapsedTime,'start'=>$start,'examId'=>$examId,'examTime'=>$examTime]);
    }
    public function saveAnswer(Request $request){
        $questionId=$request->input('question_id');
        $ans=$request->input('ans');
        $examId=$request->input('exam_id');

        $isBlock=DB::table('exam_examinee_block')->where('exam_id',$examId)->where('user_id',Auth::user()->id)->count();
        if(!$isBlock){
        
        DB::table('exam_ans')->insert(array(
            'user_id'=>Auth::user()->id,
            'exam_id'=>$examId,
            'question_id'=>$questionId,
            'ans_id'=>$ans,

            'creator'=>Auth::user()->name,
            'updater'=>Auth::user()->name,
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
            ));
        return '1';
    }else return '0';


    }
    public function result($examId){

        DB::table('exam_examinee_block')->insert(array(
                'exam_id'=>$examId,
                'user_id'=>Auth::user()->id,
            ));
         $questions=DB::table('question_stors')->where('exam_id',$examId)->get();
         Session::forget('ExamTime');
        
        return view('core.examRoom.result',['questions'=>$questions,'examId'=>$examId]);
    }

    public function resultArchive(){
        $infos=DB::table('exam_shedules')
            ->Join('exam_results','exam_shedules.id','=','exam_results.exam_id')
            ->Join('licence_types','exam_shedules.licence_type','=','licence_types.id')
            ->Join('subjects','exam_shedules.subject','=','subjects.id')
            ->where('exam_results.user_id',Auth::user()->id)
            ->get();
        return view('core.examine.result.examineResultArchive',['infos'=>$infos]);
    }

    public function examineSetting(){
        return view('core.examine.settings.examineSetting');
    }


}
