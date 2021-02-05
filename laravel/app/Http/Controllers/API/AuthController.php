<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Validator;
class AuthController extends Controller 
{
 public $successStatus = 200;
  
 public function register(Request $request) {    
 $validator = Validator::make($request->all(), 
              [ 
              'name' => 'required',
              'email' => 'required|email',
              'password' => 'required',  
            //   'c_password' => 'required|same:password', 
             ]);   
        if ($validator->fails()) {          
            return response()->json(['error'=>$validator->errors()], 401);   
        }    
        $input = $request->all();  
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input); 
        $success['token'] =  $user->createToken('AppName')->accessToken;
        $input['api_token'] = $success['token'];

        return response()->json(['success'=>$success], $this->successStatus); 
}
  
   
public function login(){ 
if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
   $user = Auth::user(); 
   $success['token'] =  $user->createToken('AppName')->accessToken; 
   $userID = Auth::id();
//    if (User::where('email', request('email'))->exists()){
//         $userOBJ = user::find($id);
//         $student->save();
//    }
    $userOBj = User::find($userID);
    $userOBj->api_token = $success['token'];
    $userOBj->save();
    // $userOBj->api_token = $success['token'];
    // $userOBJ->save();
    return response()->json(['success' => $success], $this->successStatus); 
  } else{ 
   return response()->json(['error'=>'Unauthorised'], 401); 
   } 
}
  
public function getUser() {
 
 if($user = Auth::user()) {
    return response()->json(['success' => $user], $this->successStatus); 

    }
 }
} 


// class AuthController extends Controller {

//     public function register(Request $request)
//     {
//         $validatedData = $request->validate([
//             'name' => 'required|max:55',
//             'email' => 'email|required|unique:users',
//             'password' => 'required|confirmed'
//         ]);

//         $validatedData['password'] = bcrypt($request->password);

//         $user = User::create($validatedData);

//         $accessToken = $user->createToken('authToken')->accessToken;

//         return response([ 'user' => $user, 'access_token' => $accessToken]);
     
//     }

//     public function login(Request $request)
//     {
//         $loginData = $request->validate([
//             'email' => 'email|required',
//             'password' => 'required'
//         ]);

//         if (!auth()->attempt($loginData)) {
//             return response(['message' => 'Invalid Credentials']);
//         }

//         $accessToken = auth()->user()->createToken('authToken')->accessToken;

//         return response(['user' => auth()->user(), 'access_token' => $accessToken]);

//     }
// }