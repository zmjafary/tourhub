<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request; 
use App\User; 
use App\CompanyUser; 
use App\Date; 
use App\Token; 
use Illuminate\Support\Facades\Auth; 
use Validator;
use Response;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\CompanyUser as CompanyUserResource;

class UserController extends Controller 
{
	public $successStatus = 200;

    public function login(){ 
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
    
            $user = Auth::user();   

            if ($user->status == "Unapproved") {
                return ['status' => FALSE , 'message' => 'Approved Pending!'];
            }
            else{

                $success['token'] =  $user->createToken('SCRASH')->accessToken;

                // $user->token()->updateOrCreate(['user_id' => $user->id],['bearer' => $success['token']]);
                
                $user->tokens()->create(['bearer' => $success['token']]);
                
                return ['status' => TRUE , 'message' => $user->type . ' successfully logged in!', 'token' => $success['token'], 'data' => new UserResource($user)];
            }
        } 
        else{

           $CompanyUser = CompanyUser::where(['email' => request('email'), 'password' => md5(request('password'))])->first();

            if (isset($CompanyUser)) {

               $user = User::find($CompanyUser->user_id);
               $success['token'] =  $user->createToken('SCRASH')->accessToken;
               $user->tokens()->create(['bearer' => $success['token']]);
               return ['status' => TRUE , 'message' => $user->type . ' successfully logged in!', 'token' => $success['token'], 'data' => new CompanyUserResource($user, $CompanyUser)];
            }
            else{
                return ['status' => FALSE , 'message' => 'Email or Password Incorrect!'];
            }
        } 
    }

    public function register(Request $request) 
    { 
        $validator = Validator::make($request->all(), [ 
            'name' => 'required', 
            'type' => 'required', 
            'email' => 'required|email|unique:users', 
            'password' => 'required', 
            'c_password' => 'required|same:password', 
        ]);
    
        if ($validator->fails()) { 

            $errors = $validator->errors()->all();

            $message = "";

            foreach ($errors as $error) {
                $message = $error . " " . $message;
            }

            return ['status' => FALSE , 'message' => $message];
        }

        $input = $request->all(); 
        $input['password'] = bcrypt($input['password']); 
        $user = User::create($input); 
        // $success['token'] =  $user->createToken('SCRASH')->accessToken; 
        // $success['name'] =  $user->name;

        $registered = User::find($user->id);

        if($request->hasFile('display'))
        {
            $allowedfileExtension=['jpg', 'JPG' ,'png', 'PNG'];  

            $file = $request->file('display');

            $filename = $file->getClientOriginalName();

            $newname = str_replace(' ', '', $filename);
                              
            $extension = $file->getClientOriginalExtension();
             
            $check=in_array($extension,$allowedfileExtension);
         
            if($check)                 
            {
                $finalname = time().$newname;

                $file->move('uploads/display', $finalname); 
                 
                $registered->display = 'uploads/display/'. $finalname;
            }
        }          

        if($registered->type == "User"){

            if ($request->filled(['about', 'dob', 'address', 'gender', 'user_id',])) {
                $registered->addProfile($request->all());            
            }
            else{
                return ['status' => FALSE , 'message' => 'Error.. Missing Parameters'];
            }
        }
        
        if($registered->type == "Company"){
            
            if ($request->filled(['description','address'])) {
                $registered->addCompany($request->all());
            }
            else{
                return ['status' => FALSE , 'message' => 'Error.. Missing Parameters'];
            }
        }

        return ['status' => TRUE , 'message' => $registered->type . ' successfully registered!', /* 'token' => $success['token'], */ 'data' => new UserResource($registered)];
    }

    public function getRegistered(Request $request){

        return ['status' => TRUE , 'message' => 'User found!', 'token' => $request->Bearer, 'data' => new UserResource(User::find(Token::where('bearer' , $request->Bearer)->pluck('user_id')->first()))];
    }

    public function updateToken(Request $request){

        $user = Auth::user();

        // $user = User::find(Token::where('bearer' , $request->Bearer)->pluck('user_id')->first());

        $user->fcm_token = $request->fcm_token;

        $user->save();

        return ['status' => TRUE , 'message' => 'Token Updated successfully!', 'data' => new UserResource($user)];
    }
}