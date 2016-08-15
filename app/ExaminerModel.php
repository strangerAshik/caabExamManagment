<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class ExaminerModel extends Model
{
    static function doIApply($examId,$userId){
    	return DB::table('exam_payments')
    		->where('exam_id',$examId)
    		->where('user_id',Auth::user()->id)
    		->count();

    }
    static function examineApplyStatus($examId,$userId){
    	return DB::table('exam_payments')
    		->where('exam_id',$examId)
    		->where('user_id',Auth::user()->id)
    		->value('status');

    }
    static function occupiedSit($examId){
    	return DB::table('exam_payments')
    		->where('exam_id',$examId)
    		->where('status','2')
    		->count();

    }
    static function pendignSit($examId){
    	return DB::table('exam_payments')
    		->where('exam_id',$examId)
    		->where('status','1')
    		->count();

    }
    static function previousResult($userId,$examId,$questionId){
        return  DB::table('exam_ans')
                ->where('user_id',$userId)
                ->where('exam_id',$examId)
                ->where('question_id',$questionId)
                ->orderBy('id','desc')
                ->value('ans_id');
    } 
    static function orginalAns($questionId){
        return  DB::table('question_stors')               
                ->where('question_id',$questionId)
                ->orderBy('id','desc')
                ->value('option_right');
    } 
    static function saveResult($examId,$totalQuestion,$correctAns){
        $count=DB::table('exam_results')
                ->where('exam_id',$examId)
                ->where('user_id',Auth::user()->id)
                ->count();
        if($count==0){
            DB::table('exam_results')->insert(
            array(
                    'exam_id'=>$examId,
                    'user_id'=>Auth::user()->id,
                    'total_question'=>$totalQuestion,
                    'correct_ans'=>$correctAns,
                )
            );   
        }
        

                      
                
    } 
    static function higestMarksofExam($examId){
        return DB::table('exam_results')->where('exam_id',$examId)->max('correct_ans');
    }
    static function isBlock($userId,$examId){
        $have=DB::table('exam_examinee_block')->where('user_id',$userId)->where('exam_id',$examId)->count();
        if($have) return true;
        return false;
    }
    static function activeStatus($userId){
        return DB::table('users')->where('id',$userId)->value('active');
    }
    static function hasExamUserToday($userId){

       return $todayExam=DB::table('exam_shedules')
                ->JOIN('exam_payments','exam_shedules.id','=','exam_payments.exam_id')
                ->where('exam_shedules.exam_date',date('Y-m-d'))
                ->where('exam_payments.user_id',$userId)
                ->where('exam_payments.status',2)
                ->select('exam_shedules.*')
                ->first();
       

    }
}
