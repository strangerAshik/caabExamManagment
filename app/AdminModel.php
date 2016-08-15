<?php

namespace App;

use DB;


use Illuminate\Database\Eloquent\Model;

class AdminModel extends Model
{
    static function getDocuments($tableName,$motherId){
    	$docs=DB::table('documents')
    		->where('table_name',$tableName)
    		->where('mother_id',$motherId)
            ->orderBy('id','desc')
    		->get();
    	return $docs;
    }

    //document upload
    static function docsUpload($request,$tableName,$motherId,$fieldName,$docType){
    	 if($files = $request->hasFile($fieldName))
				    {
				        $files = $request->file($fieldName);
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
				                    'doc_type'=>$docType,
				                    'doc_name'=>$orginalName,
				                ));
				        }
                        return 	$filename;	       
		   			 }
                     return '';
    }

    //get all subjects by licence no
    static function getSubjects($id){
    	return DB::table('subjects')
    			->where('licence_type_id',$id)->get();
    }
      //get all chapter by licence no, sub no
    static function getChapters($licId,$subId){
    	return DB::table('chapters')
    			->where('licence_type_id',$licId)
    			->where('subject_id',$subId)
    			->get();
    }
    static function getPrivilegedSections($setions){
        $setions=unserialize($setions);
        return DB::table('sections')->whereIn('id',$setions)->get();
        //return 'Bal';
    }
    static function privilegedSections($roleId){
          $sections=DB::table('roles')->where('id',$roleId)
                ->value('privilege');
        return unserialize($sections);
    }
    static function getLicTypName($licTypId){
        return DB::table('licence_types')->where('id',$licTypId)->value('licence_type');
                
    }
    static function getSubjectName($subId){
        return DB::table('subjects')->where('id',$subId)->value('subject');
                
    }
    static function getChapterName($chapId){
        return DB::table('chapters')->where('id',$chapId)->value('chapter');
                
    }
    static function numberOfQestions($id,$columnName){
        return DB::table('question_bank')->where($columnName,$id)->count();
    }

    static function toDayExam(){
        return DB::table('exam_shedules')
                ->JOIN('licence_types','licence_types.id','=','exam_shedules.licence_type')
                ->JOIN('subjects','subjects.id','=','exam_shedules.subject')
                ->where('exam_shedules.exam_date',date('Y-m-d'))
                ->select('exam_shedules.*','licence_types.licence_type as lic_type','subjects.subject as sub')
                ->get();
    }
    static function ExamExamineeList($examId){
        return DB::table('users')
                ->Join('exam_payments','users.id','=','exam_payments.user_id')
                ->where('exam_payments.exam_id',$examId)
                ->where('exam_payments.status',2)
                ->select('users.*')
                ->get();
    }

    static function loginStatus($userId){
        return DB::table('users')->where('id',$userId)->value('active');
    }
    
}
