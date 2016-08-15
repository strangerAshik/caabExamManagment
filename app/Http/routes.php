<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::group(['middleware' => ['web']], function () {
Route::post('examRoom/exam/saveAnswer','ExamineController@saveAnswer');
Route::get('questionGenerate/newQuestionSetup2/getQuestionNumber','AdminController@getQuestionNumber');
Route::get('examRoom/result/{examId}','ExamineController@result');
});

/*Route::post('examRoom/exam/saveAnswer',function(Request $request){
    if(Request::ajax()){
        //return    DB::table('question_stors')->get();
          return Response::json(Request::all());
        }
});
/*********************************************************Front Route*****************************************************/
Route::group(['middleware' => ['web']], function () {
    Route::get('/', 'FrontController@home');
    Route::get('contact', function () {
        return view('front.contact');
    });
    Route::get('about','FrontController@about');
    Route::get('sendEmail','CommonController@sendEmail');
    // function () {});
    Route::get('login', function () {
        return view('front.login');
    });
      //logout
    Route::get('customlogout','FrontController@customlogout');
    
    Route::get('register', function () {
        return view('front.register');
    });
    Route::post('postRegister','FrontController@postRegister');

    Route::post('authenticate','FrontController@authenticate');

    Route::get('afterRegistration', function () {
        return view('front.afterRegistration');
    });
});

/*********************************************************Core Route Admin***************************************************/
/***Admin***/
Route::group(['middleware' => ['web','auth']], function () {

    Route::get('admin/dashboard','AdminController@dashboard');
    // function () {  });

    //Exam Schedule
    Route::get('examShedule/newExam', 'AdminController@newExam');
    Route::post('examShedule/saveShedule','AdminController@saveShedule');

    Route::get('examShedule/upcomingExam','AdminController@upcomingExam');
    Route::get('examShedule/singleShedule/{id}','AdminController@singleShedule');
    Route::get('examShedule/editShedule/{id}','AdminController@editShedule');
    Route::post('examShedule/updateShedule','AdminController@updateShedule');
   
    Route::get('examShedule/archive','AdminController@archive');
     //function () {return view('core.admin.examShedule.archive'); });

    //Exam Administration
    Route::get('examineAdminstration/pendingReg', 'AdminController@pendingReg' );
    Route::get('singleRegister/{id}', 'AdminController@singleRegister' );
    Route::get('userActive/{id}', 'AdminController@userActive' );
    Route::get('userInactive/{id}', 'AdminController@userInactive' );
    Route::get('userInactive/{id}', 'AdminController@userInactive' );
    Route::get('examSitApprove/{userId}/{examId}', 'AdminController@examSitApprove' );
    Route::get('examSitSuspend/{userId}/{examId}', 'AdminController@examSitSuspend' );
    //Question Bank    
    Route::post('updateLicenceType', 'AdminController@updateLicenceType' );
    Route::post('updateSubject', 'AdminController@updateSubject' );
    Route::post('updateChapter', 'AdminController@updateChapter' );
    /*
    Route::get('examineAdminstration/pendingReg', function () {
        return view('core.admin.examineAdministration.pendingReg');
    });*/

    Route::get('examineAdminstration/pendingExm','AdminController@pendingExm');
    Route::get('examineAdminstration/pendingExamineDetails/{userId}/{examId}','AdminController@pendingExamineDetails');
    //function () {return view('core.admin.examineAdministration.pendingExm');});

    Route::get('examineAdminstration/examineList','AdminController@examineList');

    //Exam Bank
    Route::get('questionBank/newQuestion','AdminController@newQuestion');
    Route::get('questionBank/editQuestion/{id}','AdminController@editQuestion');
    //save question
   Route::post('questionBank/postNewQuestion','AdminController@postNewQuestion');
   Route::post('questionBank/updateQuestion','AdminController@updateQuestion');
    //save licence type
    Route::post('postLicenceType','AdminController@postLicenceType');
    Route::post('postSubject','AdminController@postSubject');
    Route::post('postChapter','AdminController@postChapter');

    Route::get('questionBank/questionRoom','AdminController@questionRoom');
    Route::get('questionBank/management','AdminController@management');
    //delete back
    Route::get('deleteBack/{table}/{id}','AdminController@deleteBack');
    Route::post('massDelete','AdminController@massDelete');
    

    Route::get('chapterQuestion/{licType}/{sub}/{chapter}','AdminController@chapterQuestion' );
      

    Route::get('questionBank/singleQuestion/{questionId}','AdminController@singleQuestion');
     
    //Question Generate
    Route::get('questionGenerate/newQuestionSetup','AdminController@questionGenerate');


    Route::get('questionGenerate/newQuestionSetup2','AdminController@newQuestionSetup2');
    Route::post('questionGenerate/saveQuestionPaperPart','AdminController@saveQuestionPaperPart');

    Route::get('autoQuestionPaperGenerate/{subId}/{examId}','AdminController@autoQuestionPaperGenerate');
    

    Route::get('questionGenerate/questionArchive','AdminController@questionArchive');
   
    Route::get('questionGenerate/singleQuestionPaper/{examId}','AdminController@singleQuestionPaper');
    Route::get('questionGenerate/upcomingExamQuestions','AdminController@upcomingExamQuestions');
     //function () {});

    Route::get('questionGenerate/chapterSingleQuestionPaper/{id}/{examId}','AdminController@chapterSingleQuestionPaper'); //function () {});
    Route::get('addQuestion/{q_id}/{questionGeneratorId}/{examId}','AdminController@addQuestion'); //function () {});
    Route::get('removeChapter/{qGid}','AdminController@removeChapter'); //function () {});

    //Result 
    Route::get('result/resultArchive','AdminController@resultArchive');
    Route::get('changeBlockStatus/{state}/{userId}/{examId}','AdminController@changeBlockStatus');

     

    Route::get('result/singleExamResult/{examId}','AdminController@singleExamResult');
    //function () {});
    //setting
     Route::get('setting/adminSetting','AdminController@adminSetting');
     //Role
     Route::get('setting/addRole','AdminController@addRole');
     Route::get('setting/editRole/{id}','AdminController@editRole');
     Route::post('setting/saveRole','AdminController@saveRole');
     Route::post('setting/updateRole','AdminController@updateRole');
     Route::get('setting/viewRoles','AdminController@viewRoles');
     //Section
     Route::get('setting/addSection','AdminController@addSection');
     Route::post('setting/saveSection','AdminController@saveSection');
     Route::post('setting/updateSection','AdminController@updateSection');
     Route::get('setting/viewSections','AdminController@viewSections');
     Route::get('setting/editSection/{id}','AdminController@editSection');
     //User
     Route::get('setting/addUser','AdminController@addUser');
     Route::post('setting/saveUser','AdminController@saveUser');
     Route::post('setting/updateUser','AdminController@updateUser');
     Route::post('setting/updateUserPassword','AdminController@updateUserPassword');
     Route::get('setting/viewUsers','AdminController@viewUsers');
     Route::get('setting/editUser/{id}','AdminController@editUser');

  //Excel Upload
     Route::post('postQuestion','ExcelController@postQuestion');
  //Excel Download  
     Route::get('downloadQuestion/{column}/{id}','ExcelController@downloadQuestion');

});

/*********************************************Core Route Examine***************************************************/
Route::group(['middleware' => ['web','auth']], function () {


    Route::get('examine/dashboard','ExamineController@dashboard');
   
    Route::get('examine/apply/{id}','ExamineController@apply');
    Route::post('saveBankInfo','ExamineController@saveBankInfo');

     //function () {});

    //MyParticipation 
    
     Route::get('examine/myParticipation/examParticipation','ExamineController@examParticipation');
     Route::get('examine/myParticipation/myParticipationArchive','ExamineController@myParticipationArchive');
     Route::get('examine/myParticipation/paymentDetails/{examId}/{userId}','ExamineController@paymentDetails');
     Route::get('editPaymentDetails/{userId}/{examId}','ExamineController@editPaymentDetails');
     Route::post('updatePaymentDetails','ExamineController@updatePaymentDetails');
    //Personal

    Route::get('examine/personalInfo/personal/{examineId}','ExamineController@personal');
    Route::get('examine/personalInfo/editPersonalInfos','ExamineController@editPersonalInfos');
    Route::post('examine/personalInfo/updatePersonalInfos','ExamineController@updatePersonalInfos');

  
    Route::get('examine/personalInfo/academic/{examineId}','ExamineController@academic');
    Route::post('examine/personalInfo/updateAccademicInfos','ExamineController@updateAccademicInfos');
    Route::get('examine/personalInfo/newAccdemicInfos','ExamineController@newAccdemicInfos');
    Route::post('examine/personalInfo/saveAccademicInfos','ExamineController@saveAccademicInfos');
    Route::get('examine/personalInfo/editAccademicInfos/{id}','ExamineController@editAccademicInfos');
     
    Route::get('examine/personalInfo/professional/{userId}','ExamineController@professional');
     //function () {});
    Route::get('examine/personalInfo/addProfessional','ExamineController@addProfessional');
    Route::get('examine/personalInfo/editProfessional','ExamineController@editProfessional');
    Route::post('saveProfessionalInfos','ExamineController@saveProfessionalInfos');
    Route::post('updateProfessionalInfos','ExamineController@updateProfessionalInfos');
     //function () {return view('core.examine.personalInfo.professional');});
    Route::get('examine/personalInfo/compView/{examineId}', function () {
      return view('core.examine.personalInfo.compView');
    });

    Route::get('examine/personalInfo/compView/{examineId}', function () {
      return view('core.examine.personalInfo.compView');
    });
    //Result
    Route::get('examine/result/resultArchive','ExamineController@resultArchive');
     

    //Exam Room
    Route::get('examRoom/todayExam','ExamineController@todayExam');
    Route::get('examRoom/exam/{examineId}','ExamineController@exam');
   //Setting 
   
    Route::get('setting/examineSetting','ExamineController@examineSetting');
   
    Route::post('setting/changePassword','CommonController@changePassword');
    Route::post('setting/changeEmail','CommonController@changeEmail');

    //front
     Route::get('frontManagment/addContent','FrontController@addContent');
     Route::get('frontManagment/allContent','FrontController@allContent');
     Route::get('frontManagment/allCategory','FrontController@allCategory');
     Route::get('frontManagment/singleContent/{id}','FrontController@singleContent');
     Route::get('frontManagement/editSingleContent/{id}','FrontController@editSingleContent');
     Route::post('frontManagment/saveContent','FrontController@saveContent');
     Route::post('frontManagement/updateContent','FrontController@updateContent');
     Route::post('frontManagement/saveCategory','FrontController@saveCategory');
     Route::post('frontManagement/updateCategory','FrontController@updateCategory');
});
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');
});
