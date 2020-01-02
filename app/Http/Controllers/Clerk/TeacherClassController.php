<?php

namespace App\Http\Controllers\Clerk;

use DB;
use Auth;
use App\School;
use App\Role;
use App\Teacher;
use App\UserRole;
use Carbon\Carbon;
use App\SchoolClass;
use App\TeacherClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class TeacherClassController extends Controller
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
//validating
$validatedData = $request->validate([
    'user_id' =>'required',
    'gender_id'=> 'required'
    //'schoolgrade_id'=>'required',
    //'schoolclass_id'=>'required',
]);


//add gender to teacher

$data['gender_id'] = $request->input('gender_id');


        /**updating teacher gender**/
        DB::table('teachers')
            ->where('id', $teacher_id)
            ->update($data);


            ////

$user_id     = $request->input('user_id');
$schoolgrade_id = $request->input('schoolgrade_id');
$schoolclass_id = $request->input('schoolclass_id');


//dd($schoolgrade_id);

//dd($student_id);

// insert user into teacher table

$teacher = new Teacher();

$teacher->user_id           = $user_id;
$teacher->create_id         = Auth::user()->id;
$teacher->created_at        = carbon::now('Africa/Harare');
$teacher->activestatus_id    = 1;
$teacher->allocatestatus_id   = 1;
$teacher->save();
//select class



if(isset($schoolgrade_id) && isset($schoolclass_id )){

    $schoolclasses = SchoolClass::where([
        ['grade_id', '=', $schoolgrade_id],
        ['subclass_id', '=', $schoolclass_id],
        ])->get();
    
    $schoolclassessarray = json_decode(json_encode($schoolclasses), true);
    
    $gradeclass_id = $schoolclassessarray[0]['id'];

    ///

$teacher_class = new TeacherClass();

$teacher_class->teacher_id             = $user_id;
$teacher_class->schoolclass_id         = $gradeclass_id;
$teacher_class->year                   = carbon::now('Africa/Harare')->year;
$teacher_class->create_id              = Auth::user()->id;
$teacher_class->created_at             = carbon::now('Africa/Harare');
$teacher_class->save();

$message = "Teacher and class Successfully Added";

}else{
    
    $message = "Teacher added but class could NOT be found";

}






//insert role into user_roles

$teacher_roles = Role::where('role','=','Teacher')->get();

foreach($teacher_roles as $role){

    $teacher_role_id = $role -> id;

}


$user_role = new UserRole();

$user_role->role_id         = $teacher_role_id;
$user_role->user_id         = $user_id;
$user_role->year            = carbon::now('Africa/Harare')->year;
$user_role->create_id       = Auth::user()->id;
$user_role->created_at      = carbon::now('Africa/Harare');
$user_role->save();




return redirect()->route('teachers.index') -> withSuccessMessage($message);



    }



/**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeteacherclass(Request $request,$id)
    {
        //
//validating
$validatedData = $request->validate([
   // 'gender_id' =>'required',
    'schoolgrade_id'=>'required',
    'schoolclass_id'=>'required',
]);

$school_id = Auth::user()->school_id;



$user_id     = $id;
$schoolgrade_id = $request->input('schoolgrade_id');
$schoolclass_id = $request->input('schoolclass_id');

//dd($schoolgrade_id);

if(isset($schoolgrade_id) && isset($schoolclass_id )){

    $schoolclasses = SchoolClass::where([
        ['grade_id', '=', $schoolgrade_id],
        ['subclass_id', '=', $schoolclass_id],
        ])->get();
    
    //$schoolclassessarray = json_decode(json_encode($schoolclasses), true);
    
    foreach($schoolclasses as $schoolclass){

        $gradeclass_id = $schoolclass->id;

    }
    
    //$gradeclass_id = $schoolclassessarray[0]['id'];


    if(isset($gradeclass_id)){

        
$teacher_class = new TeacherClass();

$teacher_class->school_id              = $school_id;  
$teacher_class->teacher_id             = $user_id;
$teacher_class->schoolclass_id         = $gradeclass_id;
$teacher_class->year                   = carbon::now('Africa/Harare')->year;
$teacher_class->create_id              = Auth::user()->id;
$teacher_class->created_at             = carbon::now('Africa/Harare');
$teacher_class->save();




$message = "Teacher-class Successfully Added";

    }else{

$message = "Class could not be found, please try again";

    }



}




return redirect()->route('teachers.index') -> withSuccessMessage($message);



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

         //validating
         $validatedData = $request->validate([
            'schoolgrade_id'=>'required',
            'schoolclass_id'=>'required',
        ]);


//input into students table
$teacherclass = new TeacherClass();

$teacher_schoolgrade_id           = $request -> input('schoolgrade_id');  
$teacher_schoolclass_id           = $request -> input('schoolclass_id');
$teacher_update_id                = Auth::user()->id;
$teacher_updated_at               = carbon::now('Africa/Harare');

//find the school class id

$school_grade_classes = SchoolClass::where('grade_id',$teacher_schoolgrade_id)
                                   ->where('subclass_id',$teacher_schoolclass_id)
                                   ->get();


                             foreach($school_grade_classes as $school_grade_class){

                                    $schoolclass_id =  $school_grade_class -> id;
                             
                                 }

if(isset($schoolclass_id)){



///

$teacherclass = TeacherClass::where('teacher_id',$id);
$teacherclass -> update(
    [
        'schoolclass_id' => $schoolclass_id,
        'update_id' => $teacher_update_id,
        'updated_at' => $teacher_updated_at
    ]
);


return redirect()->route('teachers.index') -> withSuccessMessage("Teacher Class Successfully changed");

}else{

return redirect()->route('teachers.index') -> withWarningMessage("Teacher Class not changed, could not find class");


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

/**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function classreset($id)
    {
        //

        $currentyear = carbon::now('Africa/Harare')->year;

        $teacher_id = $id;


        //step 1, delete teacher from teacher_class table

        $delete_teacher_classes = TeacherClass::where('teacher_id',$id)
                                ->where('year',$currentyear)
                                ->get();

        foreach( $delete_teacher_classes as  $delete_teacher_class){

            $todelete = $delete_teacher_class->id;

        }

        //$delete = TeacherClass::destroy($todelete);

        //step 2, update allocate status to 2 (unallocated) in teachers table

        $teacher_allocate_status = Teacher::where('id',$id)
                                  ->update(['allocatestatus_id' => 2]);


        return redirect()->route('teachers.index') -> withSuccesMessage("Teacher Class resetted");


    }


        /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
    
        $currentyear = carbon::now('Africa/Harare')->year;

        $teacher_id = $id;

        $user_ids = Teacher::find($id)->pluck('user_id');
        
//dd($user_ids);

        foreach($user_ids as $user_idx){

            $user_id = $user_idx;
        }


        // step 1 record is deleted from role_user


        $teacherstoremove = UserRole::where('user_id',$user_id)
                                    ->where('year',$currentyear)
                                    ->get();

        foreach($teacherstoremove as $teachertoremove){

            $toRemove = $teachertoremove->id;
        }

   

        $idToRemove = UserRole::destroy($toRemove);


        // step 2 deleted from teacher class

        $teachers = TeacherClass::where('teacher_id',$id)
                                    ->where('year',$currentyear)
                                    ->get();

//dd($teachers);

        foreach($teachers as $teacher){

            $toRemovex = $teacher->id;
        }
        

        $remove_teacher = TeacherClass::destroy($toRemovex);


        // step 3 delete from teachers

        $teacher_delete = Teacher::destroy($id);
        

        return redirect()->route('teachers.index')->withSuccesMessage("Teacher Deleted");

        


    }


}