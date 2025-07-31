<?php

namespace App\Http\Controllers;

use App\Event\UserRegistered;
use App\Http\Resources\LoginResource;
use App\Models\User;
use App\Models\ProfileImage;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\DB;

class UserController extends ApiController
{

    public function index(){
        //        event(new UserRegistered("This is a testing for event"));
        $user = User::all();
        return $this->successResponse($user);
    }
    public function get_profile_image_by_id($orgID,$ledgerId){
        $result = DB::select("select id, ledger_id, organisation_id, image_url from profile_images
        where ledger_id = '$ledgerId' AND organisation_id ='$orgID'");
        return response()->json(['success'=>1,'data'=> $result], 200,[],JSON_NUMERIC_CHECK);
    }

    public function revoke_all(Request $request){
        //revoke all tokens from current user
        $user = request()->user();
        $result = $user->tokens()->delete();
        return $this->successResponse($result);
    }
    public function get_all_user_types(){
        $result = DB::select("select id, user_type_name FROM user_types");
        
        return response()->json(['success'=>1,'data'=> $result], 200,[],JSON_NUMERIC_CHECK);
    }
    public function user_update(Request $request)
    {     
        $user = User::findOrFail($request->input('userId'));
        $user ->user_name = $request->input('user_name');
        $user ->email = $request->input('email');
        $user->password = $request->input('password');
        $user->mobile1 = $request->input('mobile1');
        $user->user_type_id= $request->input('user_type_id');
        $user->organisation_id= $request->input('organisation_id');
        
       $user->save();
        //return $this->successResponse($organisation);
        return response()->json(['success'=>1,'data'=>$user], 200,[],JSON_NUMERIC_CHECK);
    }
    public function change_password(Request $request){
        $user = User::findOrFail($request->input('userId'));
        $user->password = $request->input('password');
        $user->save();
        //return $this->successResponse($organisation);
        return response()->json(['success'=>1,'data'=>$user], 200,[],JSON_NUMERIC_CHECK);
    }
    public function register(Request $request)
    {
        $user = User::create([
            'user_id'    => $request->user_id,
            'password' => $request->password,
            'user_name' => $request->user_name,
            'user_cat_id' => $request->user_cat_id,
            ]);

//        return response()->json(['success'=>1,'data'=>$user], 200,[],JSON_NUMERIC_CHECK);

        $token = $user->createToken('my-app-token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

       // return response($response, 201);
        return response()->json(['success'=>1,'data'=>$response], 200,[],JSON_NUMERIC_CHECK);
    }


    /*
        format of json for login
        {
            "loginId": "arindam",
            "loginPassword": "81dc9bdb52d04dc20036dbd8313ed055"
        }
    */
    function login(Request $request)
    {
        $user= User::where('user_id', $request->userId)->first();
        // print_r($data);
        if (!$user || !Hash::check($request->loginPassword, $user->password)) {
            return response()->json(['success'=>0,'data'=>null, 'message'=>'Credential does not matched'], 200,[],JSON_NUMERIC_CHECK);
        }

        $token = $user->createToken('my-app-token')->plainTextToken;
        $user->setAttribute('token',$token);
        return $this->successResponse(new LoginResource($user));

    }


    function getCurrentUser(Request $request){
        return $request->user();
//        return User::get();

    }
    public function get_all_user_list()
    {
        $result = DB::select("select users.id, 
        users.user_name, 
        users.email,
        users.password, 
        users.remember_token,
        users.mobile1,
        users.mobile2, 
        user_types.user_type_name,
        organisations.organisation_name,
        user_type_id,
        organisation_id 
        FROM users
        inner join user_types ON user_types.id = users.user_type_id
        inner join organisations ON organisations.id = users.organisation_id
        order by users.id desc");
        
        return response()->json(['success'=>1,'data'=> $result], 200,[],JSON_NUMERIC_CHECK);
    }

    function getAllUsers(Request $request){
        return User::get();
    }
	function authenticationError(){
        return $this->errorResponse('Credential does not matched',401);
    }
    function logout(Request $request){
        $result = $request->user()->currentAccessToken()->delete();
        return response()->json(['success'=>$result,'data'=>null, 'message'=>'Token revoked'], 200,[],JSON_NUMERIC_CHECK);
    }
    function uploadUserPicture_test(Request $request){
        //        $input = json_decode($request->getContent(), true);
                    $profile= new ProfileImage();
                    $fileName = $request['filename'];

                    $completeFileName=$request->file('file')->getClientOriginalName();
                    $fileNameOnly=pathinfo($completeFileName,PATHINFO_FILENAME);
                    $extension=$request->file('filename')->getClientOriginalExtension();
                    $compPic=str_replace('','_', $fileNameOnly). '_'. rand(). '_'.time(). '.' . $extension;
                    //$path=$request->file('image')->storeAs('public/file_upload',$compPic);
                    $path = $request->file('filename')->move(public_path("/profile_pic"), $compPic);
                    //return $this->successResponse($request->file('image'));
        
                    $profile->ledger_id=$request->input('ledgerId');
                    $profile->organisation_id=$request->input('organisationId');
                    $profile->image_url=$compPic;
                    
                    $profile->save(); 
                    return $this->successResponse($request->file('file'));
        
               
        //        $fileName = 'test1.jpeg';
        //        return $fileName;
                //first saving picture
        
                //return $fileName;
                //$path = $request->file('file')->move(public_path("/profile_pic"), $fileName);
        //        $photoUrl = url('/entrant_pictures/' . $fileName);
                
        //        return response()->json(['success'=>100,'data'=> $path], 200,[],JSON_NUMERIC_CHECK);
        
            }
    function uploadUserPicture(Request $request){
//        $input = json_decode($request->getContent(), true);
        $fileName = $request['filename'];
//        $fileName = 'test1.jpeg';
//        return $fileName;
        //first saving picture

        //return $fileName;
        $path = $request->file('file')->move(public_path("/profile_pic"), $fileName);
//        $photoUrl = url('/entrant_pictures/' . $fileName);
        return $this->successResponse($request->file('file'));
//        return response()->json(['success'=>100,'data'=> $path], 200,[],JSON_NUMERIC_CHECK);

    }
    function uploadStudentPicture(Request $request){
//        $input = json_decode($request->getContent(), true);


        $fileName = $request['filename'];
//        $fileName = 'test1.jpeg';
//        return $fileName;
        //first saving picture

        //return $fileName;
        $path = $request->file('file')->move(public_path("/student_pictures"), $fileName);
//        $photoUrl = url('/entrant_pictures/' . $fileName);
        return $this->successResponse($request->file('file'));
//        return response()->json(['success'=>100,'data'=> $path], 200,[],JSON_NUMERIC_CHECK);

    }
}
