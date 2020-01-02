<?php

namespace App\Http\Controllers\Admin;

use DB;
use Auth;
use App\User;
use App\UserRole;
use App\School;
use App\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        
        $school_id = Auth::user()->school_id;

        $schools = School::where('id','=',$school_id)->get();

        foreach($schools as $school){

            $school_name = $school->schoolname;

            $school_level = $school->school_level;

        
        }


        $validatedData = $request->validate([
            'gender_id' => 'required',
            'user_id' => 'required|max:50',
            'role_id' => 'required',
        ]);

///


        $data['user_id']        = $request->input('user_id');
        $data['role_id']        = $request->input('role_id');
        $data['year']           = carbon::now('Africa/Harare')->year;
        $data['create_id']      = Auth::user()->id;

        $checkduplicate = DB::table('role_user')->where('user_id',$data['user_id'])
                                                ->where('role_id',$data['role_id'])
                                                ->where('year',$data['year'])
                                                ->count();

        if($checkduplicate >=1){

            return redirect()->route('role.index') -> withErrorMessage("Already registered in the system");

        }else{

            $insertdata = DB::table('role_user')->insert(
                $data
            );

            ///if role == teacher
if($data['role_id'] == 4){

    $checkduplicate = Teacher::where('user_id',$data['user_id'])->count();

    if($checkduplicate == 0 ){

        $teacher = new Teacher();

        $teacher->school_id = $school_id;

        $teacher->user_id = $data['user_id'];

        $teacher->create_id = Auth::user()->id;

        $teacher->activestatus_id = 1;

        $teacher->allocatestatus_id = 1;

        $teacher->save();

        ///

        
        $teacher_id = $teacher->id;


        $datax['gender_id']      = $request->input('gender_id');

///
 /**updating teacher gender**/
            DB::table('teachers')
                ->where('id', $teacher_id)
                ->update($datax);



    }


}
               
            ///

            return redirect()->route('role.index')->withSuccessMessage("Successfully Added into database");



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

        $currentyear = carbon::now('Africa/Harare')->year;

        $user_id = $id;

        //validating
        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        $name               = $request->input('name');
        $password           = $request->input('password');
        $password_repeat    = $request->input('password_repeat');
        $email              = $request->input('email');
        $role_id            = $request ->input('role_id');


        if($password != NULL && $password_repeat != NULL){

            if($password == $password_repeat){

                $user = new User();

                $user = User::find($id);
    
                $user -> update(
                    [
                        'name' => $name,
                        'password' => Hash::make($password),
                        'email' => $email
                    ]
                );


                ///updating role_id

                $data['user_id']   = $user_id;
                $data['role_id']   = $role_id;
                $data['update_id'] = Auth::user()->id;


        /**updating user_roles table**/
        DB::table('role_user')
            ->where('user_id',$id)
            ->where('year',$currentyear)
            ->update($data);



                ///


                return redirect()->back()->withSuccessMessage('User details suceessifully updated');

            }else{

                 
                return redirect()->back()->withWarningMessage('Password Mismatch, password and password-repeat should be the same!');


            }

           
         

        }else{

            
            $user = new User();

            $user = User::find($id);

            $user -> update(
                [
                    'name' => $name,
                    'email' => $email,
                ]
            );

            ///

              ///updating role_id

              $data['user_id']   = $user_id;
              $data['role_id']   = $role_id;
              $data['update_id'] = Auth::user()->id;


      /**updating user_roles table**/
      DB::table('role_user')
          ->where('user_id',$id)
          ->where('year',$currentyear)
          ->update($data);

            ///
            return redirect()->back()->withSuccessMessage('User details suceessifully updated');

        }


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