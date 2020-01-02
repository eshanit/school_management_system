<?php

namespace App\Http\Controllers\Admin;

use DB;
use Auth;
use App\User;
use App\Role;
use App\School;
use App\Subject;
use App\SchoolClass;
use App\SchoolGrade;
use App\SchoolSubClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Users

        $school_id = Auth::user()->school_id;

        $schools = School::where('id','=',$school_id)->get();

        foreach($schools as $school){

            $school_name = $school->schoolname;

            $school_level = $school->school_level;

        
        }



        $users = User::where('school_id','=',$school_id)
                       ->get();

        $roles = Role::all();

        $levels = DB::table('level')
                    ->where('schoollevel_id','=',$school_level)
                    ->get();


        
        $userRoles = Auth::user()->roles->pluck('rolename');

        
        $user_roles = DB::table('users')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'role_user.role_id','=', 'roles.id')
            ->where('users.school_id','=',$school_id)
        ->get();

        /***** Classes ****/
        $schoolgradeclasses = DB::table('school_classes')
            ->join('school_grades','school_grades.id','=','school_classes.grade_id')
            ->join('school_sub_classes','school_sub_classes.id','=','school_classes.subclass_id')
            ->where('school_classes.school_id','=',$school_id)
            ->select('school_classes.id','school_grades.grade','school_sub_classes.subclasses')
            ->get();

       

       ///

       $subjects  = Subject::where('school_id','=',$school_id)
                             ->get();



       ///

        $viewData = compact(
            'roles',
            'users',
            'levels',
            'schools',
            'subjects',
            'user_roles',
            'schoolgradeclasses',
            'school_name',
            'school_id'
        );

        
        if(session('success_message')){

            Alert::success('Success', session('success_message'));

    }elseif(session('warning_message')){

        Alert::warning('Edit Failed', session('warning_message'));

}elseif(session('error_message')){

    Alert::error('Registration Failed', session('error_message'));

}


        return view('admin.home',$viewData);

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
    }
}