<?php

namespace App\Http\Controllers\Auth;

use Auth;
use DB;
use App\User;
use App\Role;
use App\UserRole;
use App\School;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = '/home';

    public function redirectTo(){

    

        $userRoles = Auth::user()->roles->pluck('rolename');

      //dd($userRoles);
       
       // if(Auth::user()->post == 'Specialist'){
        if($userRoles->contains('Teacher')){

            return '/teacher';
    
        }elseif($userRoles->contains('Head') || $userRoles->contains('Deputy Head')){

            return '/management';

        }elseif($userRoles->contains('Admin')){

    
            return '/admin';

        }elseif($userRoles->contains('Clerk')){

            return '/home';

        }elseif($userRoles->contains('dis')){

            return '/dis';

        }elseif($userRoles->count() == 0){

            return '/accountcreated';

        }else{

            return '/';
        }
        
    
       }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
