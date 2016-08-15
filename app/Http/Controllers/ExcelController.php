<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App;
use DB;
use View;
use AdminModel;

use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
 // public function __construct()
 //      {
 //        $privileges=AdminModel::privilegedSections(Auth::user()->role_id);
 //        View::share('privileges', $privileges);
 //      }
    public function postQuestion(Request $request){
  
    if($request->hasFile('file')){
    	
		
    	Excel::load($request->file('file'), function($reader) {
    	
    	$results = $reader->toObject();
    	
    	foreach ($results as $info) {
    		if($info->licence_type){
    			
    		
    		DB::table('question_bank')->insert(array(
    				'licence_type'=>$info->licence_type,
    				'subject'=>$info->subject,
    				'chapter'=>$info->chapter,
    				'question'=>$info->question,
    				'difficulty_level'=>$info->difficulty_level,
    				'option_1'=>$info->option_1,
    				'option_2'=>$info->option_2,
    				'option_3'=>$info->option_3,
    				'option_4'=>$info->option_4,
    				'option_right'=>$info->option_right,
                    //'note'=>$info->note,
    				//'image'=>$info->image,
    			));
    		}
    	}
    	
    	
		});

		return back()->with('message','Questions Inserted!!');
    	}
    	else{
    		return back()->with('message','No File Provided!!');
    	}
    	
    		
    }
    public function downloadQuestion($column,$id){

     $questions=DB::table('question_bank')->select('licence_type','subject','chapter','question','difficulty_level','option_1','option_2','option_3','option_4','option_right','note','image')->where($column,$id)->get();
        Excel::create('Name', function($excel) use($questions) {

            $excel->sheet('Excel sheet', function($sheet) use($questions) {                

                foreach ($questions as &$question) {
                    $question = (array)$question;
                }

                $sheet->fromArray($questions);
                 $sheet->setWidth(array(
                    'D'=>20,
                    ));

            });
           

        })->export('xlsx');


    }



}
