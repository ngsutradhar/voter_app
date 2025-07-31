<?php

use App\Http\Controllers\StateController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrganisationController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderMasterController;
use App\Http\Controllers\ItemController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get("checkMerchantTransaction/{merchantTransactionId}",[PhonePeController::class,'check_merchantTransactionId']);
Route::post('phonepeTesting',[TransactionController::class,'phonePeTest']);

Route::get('phonepe/{amount}/{merchantId}/{apiKey}/{merchantUserId}/{autoGenerateId}',[PhonePecontroller::class,'phonePe']);
Route::any('phonepe-response',[PhonePeController::class,'response'])->name('response');

Route::post("/feesReceivedOnline/{merchantTransactionId}",[PhonePeController::class, 'save_fees_received_online']);

Route::post("/organisationDemoSave",[OrganisationController::class, 'organisation_Store']); 
Route::get("statesList",[OrganisationController::class, 'all_states_list']);
Route::post("/saveStudent",[OrganisationController::class, 'save_student']);
Route::post("/saveTeacher",[OrganisationController::class, 'save_teacher']);
Route::get("/studentExists/{id}", [StudentController::class, 'get_student_exists_by_id']);
Route::get("/allOrganisation",[OrganisationController::class, 'index']);

Route::get("/deleteInactiveStudent/{id}",[StudentController::class, 'delete_inactive_student_by_id']);
/* Route::get('phonepe/{amount}',[TransactionController::class,'phonePe']);
Route::post('phonepe-response',[TransactionController::class,'response'])->name('response');  */
//get the user if you are authenticated
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("login",[UserController::class,'login']);
Route::get("login",[UserController::class,'authenticationError'])->name('login');

Route::post("register",[UserController::class,'register']);
Route::patch("userUpdate",[UserController::class,'user_update']);
Route::patch("changePassword",[UserController::class,'change_password']);
Route::get("getAllUserList",[UserController::class,'get_all_user_list']);

Route::group(['middleware' => 'auth:sanctum'], function(){
    //All secure URL's
    // Employee API
    Route::get("updateOrderCompleted/{id}",[EmployeeController::class,'update_order_complete']);
    Route::get("getEmployeeOrderServiceCompleted/{org}",[EmployeeController::class,'get_employee_order_service_completed']);

    Route::get("getEmployeeOrderServicePending/{org}/{id}",[EmployeeController::class,'get_employee_order_service_pending']);
    Route::get("getEmployeeAndOrganisation/{id}",[EmployeeController::class,'get_employee_organisation_by_id']);
    Route::get("getAllEmployeeList/{id}",[EmployeeController::class,'index']);
    Route::get("getEmployee/{org}/{id}",[EmployeeController::class,'get_employee_by_id']);
    Route::post("saveEmployee",[EmployeeController::class,'save_employee']);
    Route::post("updateEmployee",[EmployeeController::class,'update_employee']);
    
    Route::get("getCustomer/{org}/{id}",[CustomerController::class,'get_customer_by_id']);
    Route::get("getAllCustomerList/{id}",[CustomerController::class,'index']);
    Route::post("saveCustomer",[CustomerController::class,'save_customer']);
    Route::post("updateCustomer",[CustomerController::class,'update_customer']);
    Route::get("revokeAll",[UserController::class,'revoke_all']);

    Route::post("saveOrder",[OrderMasterController::class,'save_order']);
    Route::patch("/updateOrder/{id}",[OrderMasterController::class, 'update_order']);
    Route::get("/getAllOrder/{id}",[OrderMasterController::class, 'get_all_order']);
    Route::get("/getEmployeeServiceSchedule/{id}",[OrderMasterController::class, 'get_employee_service_schedule']);
    Route::get("/getEmployeeServiceScheduleById/{ordId}/{id}",[OrderMasterController::class, 'get_employee_service_schedule_by_id']);
    Route::get("/getEmployeeServiceScheduleByDate/{ordId}/{date}",[OrderMasterController::class, 'get_employee_service_schedule_by_date']);
    Route::get("/getEmployeeServiceScheduleByDateTime/{ordId}/{date}/{time}",[OrderMasterController::class, 'get_employee_service_schedule_by_date_and_time']);
    Route::get("getAllWorkType/{id}",[OrderMasterController::class,'get_all_worktype']);

    Route::post("saveEquipment",[ItemController::class,'save_equipment']);
    Route::post("updateItem",[ItemController::class,'update_item']);
    Route::post("saveItem",[ItemController::class,'save_item']);
    Route::post("updateItemToService",[ItemController::class,'update_item_to_service']);
    Route::get("getAllItemList/{id}",[ItemController::class,'index']);
    Route::get("getAllItemToServiceList/{id}",[ItemController::class,'get_all_item_to_servce']);
    Route::post("saveItemToService",[ItemController::class,'save_item_to_service']);

    Route::get('/me', function(Request $request) {
        return auth()->user();
    });
    Route::get("user",[UserController::class,'getCurrentUser']);
    Route::get("logout",[UserController::class,'logout']);

    //get all users
    Route::get("users",[UserController::class,'getAllUsers']);
    Route::get("getProfileImage/{orgId}/{ledgerId}",[UserController::class,'get_profile_image_by_id']);
    //Route::post('uploadPicture',[UserController::class,'uploadUserPicture']);
    Route::post('uploadPicture',[UserController::class,'uploadUserPicture_test']);
    Route::post('uploadStudentPicture',[UserController::class,'uploadStudentPicture']);
    // student related API address placed in a group for better readability
    Route::group(array('prefix' => 'students'), function() {
        // এখানে সকলকেই দেখাবে, যাদের কোর্স দেওয়া হয়েছে ও যাদের দেওয়া হয়নি সবাইকেই
      
       
        Route::get("/studentId/{id}/incompleteCourses", [StudentController::class, 'get_incomplete_courses_by_id']);

        //যে সব স্টুডেন্টদের কোর্স দেওয়া হয়েছে তাদের পাওয়ার জন্য, যাদের শেষ হয়ে গেছে তাদেরকেও দেখানো হবে।
        Route::get("/registered/yes", [StudentController::class, 'get_all_course_registered_students']);
        //যে সব স্টুডেন্টের নাম নথিভুক্ত হওয়ার পরেও তাদের কোন কোর্স দেওয়া হয়নি তাদের পাওয়ার জন্য
        Route::get("/registered/no", [StudentController::class, 'get_all_non_course_registered_students']);
        //যে সব স্টুডেন্টের কোর্স বর্তমানে চলছে তাদের দেখার জন্য আমি এটা ব্যবহার করেছি। যাদের শেষ হয়ে গেছে তাদেরকেও দেখানো হবে না।
        Route::get("/registered/current", [StudentController::class, 'get_all_current_course_registered_students']);
        Route::get("/isDeletable/{id}", [StudentController::class, 'is_deletable_student']);

        Route::post("/",[StudentController::class, 'store']);
        Route::post("/store_multiple",[StudentController::class, 'store_multiple']);
        Route::patch("/",[StudentController::class, 'update']);
        Route::delete("/{id}",[StudentController::class, 'delete']);
        Route::get("/deleteInactiveStudent/{id}",[StudentController::class, 'delete_inactive_student_by_id']);

        Route::get("updateStudentInforce/{id}",[StudentController::class, 'update_student_inforce']);
    });



    Route::get("states",[StateController::class, 'index']);
    Route::get("states/{id}",[StateController::class, 'index_by_id']);

    //CourseRegistration
    // nanda gopal api
    //------------for developer Api ------------------------------
    Route::delete("/deleteStudentToCourse/{id}",[OrganisationController::class, 'delete_student_to_course_by_register_id']);
    Route::delete("/deleteTransactionDetails/{id}",[OrganisationController::class, 'delete_transaction_details']);
    Route::delete("/deleteTransaction/{id}",[OrganisationController::class, 'delete_transaction']);

    Route::get("/allFeesReceivedDeveloper",[OrganisationController::class, 'get_all_feeReceived_developer']);
    Route::get("/allFeesChargedDeveloper",[OrganisationController::class, 'get_all_feeCharge_developer']);
    Route::get("/allOrgDetails",[OrganisationController::class, 'all_org_detail_info']);
    Route::get("/allOrgIncome",[OrganisationController::class, 'all_org_total_income']);
    Route::get("/studentCount",[OrganisationController::class, 'count_total_student']);
    Route::get("/organisationCount",[OrganisationController::class, 'get_count_organisation']);
    Route::post("/organisationSave",[OrganisationController::class, 'organisation_Store']);
    Route::patch("/organisationUpdate",[OrganisationController::class, 'organisation_update']);
    Route::get("/getAllorganisation",[OrganisationController::class, 'get_all_organisation_list']);
    Route::get("/getAllstudent",[OrganisationController::class, 'get_all_student_list']);
    Route::get("/getOrganisationById/{id}",[OrganisationController::class, 'get_organisation_by_id']);
    Route::get("/getAllUserTypes",[UserController::class, 'get_all_user_types']);
    //------------- End ----------------------------------------------------
  


    Route::get("logout",[UserController::class,'logout']);


    Route::get("users",[UserController::class,'index']);


    //transactions
    Route::group(array('prefix' => 'transactions'), function() {

    });

});


Route::group(array('prefix' => 'dev'), function() {
    // student related API address placed in a group for better readability
    Route::group(array('prefix' => 'students'), function() {
        // এখানে সকলকেই দেখাবে, যাদের কোর্স দেওয়া হয়েছে ও যাদের দেওয়া হয়নি সবাইকেই
        Route::get("/", [StudentController::class, 'index']);
        Route::get("/studentId/{id}", [StudentController::class, 'get_student_by_id']);

        // কোন একজন student এর কি কি কোর্স আছে তা দেখার জন্য, যে গুলো চলছে বা শেষ হয়ে গেছে সবই
        Route::get("/studentId/{id}/courses", [StudentController::class, 'get_courses_by_id']);
        // কোন একজন student এর কি কি কোর্স শেষ হয়ে গেছে।
        Route::get("/studentId/{id}/completedCourses", [StudentController::class, 'get_completed_courses_by_id']);
        // কোন একজন student এর কি কি কোর্স চলছে।
        Route::get("/studentId/{id}/incompleteCourses", [StudentController::class, 'get_incomplete_courses_by_id']);

        //যে সব স্টুডেন্টদের কোর্স দেওয়া হয়েছে তাদের পাওয়ার জন্য, যাদের শেষ হয়ে গেছে তাদেরকেও দেখানো হবে।
        Route::get("/registered/yes", [StudentController::class, 'get_all_course_registered_students']);
        //যে সব স্টুডেন্টের নাম নথিভুক্ত হওয়ার পরেও তাদের কোন কোর্স দেওয়া হয়নি তাদের পাওয়ার জন্য
        Route::get("/registered/no", [StudentController::class, 'get_all_non_course_registered_students']);
        //যে সব স্টুডেন্টের কোর্স বর্তমানে চলছে তাদের দেখার জন্য আমি এটা ব্যবহার করেছি। যাদের শেষ হয়ে গেছে তাদেরকেও দেখানো হবে না।
        Route::get("/registered/current", [StudentController::class, 'get_all_current_course_registered_students']);
        Route::get("/isDeletable/{id}", [StudentController::class, 'is_deletable_student']);

        /* Route::post("/saveTeacher",[StudentController::class, 'storeTeacher']); */
        Route::post("/",[StudentController::class, 'store']);
        Route::post("/store_multiple",[StudentController::class, 'store_multiple']);
        Route::patch("/",[StudentController::class, 'update']);
        Route::delete("/{id}",[StudentController::class, 'delete']);
    });

    //Organization
    Route::group(array('prefix' => 'organisations'), function() {
        Route::post("/organisationSave",[OrganisationController::class, 'organisationStore']);
    });
    //student_query
    Route::post("studentQuery", [StudentQueryController::class, 'save_query']);

    //course
    Route::get("courses/{id}",[CourseController::class, 'index']);
    //Route::get("courses/{id}",[CourseController::class, 'index_by_id']);
    Route::post("courses",[CourseController::class, 'store']);



    //Fees Modes
    Route::get("feesModeTypes",[FeesModeTypeController::class, 'index']);
    Route::get("feesModeTypes/{id}",[FeesModeTypeController::class, 'index_by_id']);

    //DurationTypes
    Route::get("durationTypes",[DurationTypeController::class, 'index']);
    Route::get("durationTypes/{id}",[DurationTypeController::class, 'indexById']);
    Route::post("durationTypes",[DurationTypeController::class, 'store']);
    Route::patch("durationTypes",[DurationTypeController::class, 'update']);
    Route::delete("durationTypes/{id}",[DurationTypeController::class, 'destroy']);


    Route::get("getMarks",[MarksheetController::class,'index']);
    Route::post("saveMarks",[MarksheetController::class,'store']);
    Route::post("getMarkStudents",[MarksheetController::class,'get_mark_students']);
    Route::get("getSubjectsByCourseId/{id}",[MarksheetController::class,'get_subjects_by_course_id']);
 
    Route::post("/subject", [SubjectController::class, 'saveSubject']);
    Route::get("subjects/{id}",[SubjectController::class, 'index']);
    Route::post("/saveSubjectToCourse", [SubjectController::class, 'save_subject_to_course']);
    Route::get("/subjectToCourse/{id}", [SubjectController::class, 'get_subject_to_course']);
    //CourseRegistration
    Route::post("studentCourseRegistrations",[StudentCourseRegistrationController::class, 'store']);
    Route::post("isStudentToCourseExists",[StudentCourseRegistrationController::class, 'is_student_to_course_exists']);
    Route::get("studentCourseRegistrations",[StudentCourseRegistrationController::class, 'index']);

    Route::delete("studentCourseRegistrations/{id}",[StudentCourseRegistrationController::class, 'destroy']);
    Route::patch("studentCourseRegistrations",[StudentCourseRegistrationController::class, 'update']);


    Route::get("logout",[UserController::class,'logout']);


    Route::get("users",[UserController::class,'index']);



    //transactions
    Route::group(array('prefix' => 'transactions'), function() {
        Route::get("/all",[TransactionController::class, 'get_all_transactions']);
        Route::get("/feesCharged",[TransactionController::class, 'get_all_fees_charged_transactions']);

        Route::get("/dues/studentId/{id}",[TransactionController::class, 'get_total_dues_by_student_id']);

        Route::get("/dues/SCRId/{id}",[TransactionController::class, 'get_student_due_by_student_course_registration_id']);

         //----- Nanda gopal code api -------------
        //Get all Fees charge
      
    });

});

