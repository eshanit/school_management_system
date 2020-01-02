<?php

namespace App\Http\Controllers\Admin;

use DB;
use Auth;
use App\User;
use App\Role;
use App\School;
use App\UserRoles;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        $school_id = Auth::user()->school_id;

        $schools = School::where('id','=',$school_id)->get();

        foreach($schools as $school){

            $school_name = $school->schoolname;

            $school_level = $school->school_level;

        
        }

        $genders = DB::table('gender')->get();

        $users = User::where('school_id','=',$school_id)
        ->get();

        $roles = Role::all();
        
        $rolesarray = json_decode(json_encode($roles), true);

        for($i = 0 ;$i < count($rolesarray); $i++){

            $role_id[$i] = $rolesarray[$i]['id'];

            $rolename[$role_id[$i]] = $rolesarray[$i]['rolename'];

        }


        $levels = DB::table('level')
        ->where('schoollevel_id','=',$school_level)
        ->get();


        $roleusers = DB::table('role_user')->get();

        $roleuserarray = json_decode(json_encode($roleusers), true);

        for($i = 0; $i < count($roleuserarray); $i++){

            $roleusers_id[$i] = $roleuserarray[$i]['id'];

            $roleusers_user_id[$roleusers_id[$i]] = $roleuserarray[$i]['user_id'];

            $roleusers_rolename[$roleusers_user_id[$roleusers_id[$i]]] = $rolename[$roleuserarray[$i]['role_id']];


        }
        
        $user_roles = DB::table('users')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'role_user.role_id','=', 'roles.id')
            ->where('users.school_id','=',$school_id)
        ->get();

        //

        $usersarray = json_decode(json_encode($users), true);

        for($i=0; $i < count($usersarray); $i++){

            $user_id[$i] = $usersarray[$i]['id'];

            $user_name[$user_id[$i]] = $usersarray[$i]['name'];

            $user_email[$user_id[$i]] = $usersarray[$i]['email'];


        }

        $userRoles = Auth::user()->roles->pluck('rolename');
        //

        if(session('success_message')){

            Alert::success('Success', session('success_message'));

    }elseif(session('warning_message')){

        Alert::warning('Edit Failed', session('warning_message'));

}elseif(session('error_message')){

    Alert::error('Registration Failed', session('error_message'));

}


        $viewData = compact(
            'user_id',
            'user_name',
            'user_email',
            'roleusers_rolename',
            'users',
            'roles',
            'levels',
            'userRoles',
            'user_roles',
            'genders',
            'school_name',
            'school_id'
        );

        return view('admin.roleuser',$viewData);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

             //validating
             $validatedData = $request->validate([
                'role' => 'required|max:50',
                //'address'=>'required',
            ]);


            $rolename = $request->input('role');

            $checkduplicate = Role::where('rolename',$rolename)->get();

            $checkduplicatecount = $checkduplicate->count();

            if($checkduplicatecount >= 1){


                return redirect()->route('admin.home') -> withErrorMessage("$rolename , is already registered in the system");

            }else{

                
    //input into roles into table
             $role = new Role();

             $role->rolename                = $request->input('role');

             $role->save();

             return redirect()->route('admin.home')->withSuccessMessage("$rolename Successfully Added into database");


            }




    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $role_delete = Role::destroy($id);
        
        return redirect()->back()->withSuccessMessage('Role deleted');


    }
}
