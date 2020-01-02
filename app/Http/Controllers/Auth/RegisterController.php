<?php

namespace App\Http\Controllers\Auth;

use Auth;
use DB;
use App\School;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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


    public function showRegistrationForm()
    {

        $schools  = DB::table('schools')->get();

        return view('auth.register',compact('schools'));

    }

    //protected $redirectTo = '/home';

    public function redirectTo(){

    

        $userRoles = Auth::user()->roles->pluck('rolename');

        //dd($userRoles->count());
       
       // if(Auth::user()->post == 'Specialist'){
        if($userRoles->contains('Teacher')){

            return '/teacher';
    
        }elseif($userRoles->contains('Head') || $userRoles->contains('Deputy Head')){

            return '/management';

        }elseif($userRoles->contains('Admin')){

    
            return '/admin';

        }elseif($userRoles->contains('Clerk')){

            return '/home';

        }elseif($userRoles->count() == 0){

            return '/accountcreated';

        }else{

            '/';
        }
        
    
       }
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
            'school_id' =>['required'],
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
            'school_id'=>$data['school_id'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
