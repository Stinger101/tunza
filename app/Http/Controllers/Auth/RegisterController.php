<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            //'api_token' => Str::random(80),
        ]);
    }

    public static function apiCreate(Request $request){
      $token=Str::random(80);
      $user=User::create([
          'name' => $request['name'],
          'email' => $request['email'],
          'phone_number'=>$request['phone_number'],
          'password' => Hash::make($request['password']),
          'api_token' => hash('sha256',$token),
      ]);
      if(isset($request["avatar"])){
        $user->avatar_url=$request->file('avatar')->storeAs('avatar/users',$user->id);
        $user->update();
      }
      if(\App\Caregiver::where("email_provided",$request['email'])->count()>0){
        foreach (\App\Caregiver::where("email_provided",$request['email'])->get() as $caregiver) {
          //
            $caregiver->user_id=$user->id;
            $caregiver->is_registered=true;
            $caregiver->update();

        }
        \App\UserRole::create({"user_id"=>$user->id,"role_id"=>2});
      }else{
        \App\UserRole::create({"user_id"=>$user->id,"role_id"=>1});
      }
      $credentials = $request->only('email', 'password');

      if (Auth::attempt($credentials)) {
        return ['token' => $token,"role"=>Auth::user()->userrole->role_id];
      }else{
        return ["error"=>"Could not log in user. Please retry."];
      }
    }
}
