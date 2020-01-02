<?php

namespace App\Http\Controllers\Clerk;

use DB;
use Auth;
//use Alert;
use App\User;
use App\School;
use App\Teacher;
use App\UserRole;
use Carbon\Carbon;
use App\SchoolClass;
use App\SchoolGrade;
use App\SchoolSubClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class TeacherController extends Controller
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

        $schoollevel_id = School::where('id','=',$school_id)->pluck('school_level');

        $schools = School::where('id','=',$school_id)->get();

        foreach($schools as $school){

            $school_name = $school->schoolname;

            //$school_level = $school->school_level;

        
        }

        $genders = DB::table('gender')->get();


        $currentyear = carbon::now('Africa/Harare')->year;

        $currentdate = carbon::now('Africa/Harare');

        //

        $teachers = Teacher::where('school_id','=',$school_id)
                             ->get();

        $femaleteachers = Teacher::where('school_id','=',$school_id)
                                  ->where('gender_id',2)->get();

        $maleteachers = Teacher::where('school_id','=',$school_id)
                                 ->where('gender_id',1)->get();

        if($teachers->count() > 0){

            $percentage_male_teachers = round((100*($maleteachers->count())/$teachers->count()),1);

            $percentage_female_teachers = round((100*($femaleteachers->count())/$teachers->count()),1);
    
    
        }else{

            $percentage_male_teachers = 0;

            $percentage_female_teachers = 0;
    
    
        }

      //users : those are to be converted to teachers by clerk

      $users = User::where('school_id','=',$school_id)
                    ->get();

      //$schools = 
      
             $user_teachers = DB::table('users')
             ->join('teachers','teachers.user_id','=','users.id')
             ->where('teachers.school_id','=',$school_id)
             ->select('*')
             ->get();

             //dd($user_teachers);

if($user_teachers->count() > 0){

    foreach($user_teachers as $user_teacher){

        $user_allocated_status[$user_teacher->user_id] = $user_teacher->allocatestatus_id;
    
    }
    
}else{

    $user_allocated_status = NULL;
    
}


///grades and classes


$schoolgradeclasses = DB::table('school_classes')
    ->join('school_grades','school_grades.id','=','school_classes.grade_id')
    ->join('school_sub_classes','school_sub_classes.id','=','school_classes.subclass_id')
    ->where('school_classes.school_id','=',$school_id)
    ->select('*')
    ->get();


//

//get student classes

        $teachers_school_classes = DB::table('teachers')
            ->join('teacher_classes', 'teacher_classes.teacher_id', '=', 'teachers.id')
            ->join('school_classes', 'school_classes.id','=', 'teacher_classes.schoolclass_id')
            ->join('school_grades', 'school_grades.id', '=' , 'school_classes.grade_id')
            ->join('school_sub_classes', 'school_sub_classes.id', '=' , 'school_classes.subclass_id')
            ->join('users','users.id','=','teachers.user_id')
            ->where('teacher_classes.year','=',$currentyear)
            ->where('teachers.school_id','=',$school_id)
            ->select('teachers.id','teachers.activestatus_id','users.name','school_grades.grade','school_sub_classes.subclasses','school_classes.grade_id','school_classes.subclass_id')
        ->get();


///




///
        //dd($teachers_school_classes);

        foreach($teachers_school_classes as $teachers_school_class){

                $teacher_class[$teachers_school_class->id] = $teachers_school_class->grade.''.$teachers_school_class->subclasses;

        }

if(isset($teacher_class)){

    $teacher_class = $teacher_class;

}else{

    $teacher_class = NULL;
}


//

/*-----------*/
$schoolclasses = SchoolClass::all();

/*----------*/

$schoolgrades = SchoolGrade::where('schoollevel_id','=',$schoollevel_id)
                            ->get();

/*--------*/

$schoolsubclasses = SchoolSubClass::where('school_id','=',$school_id)
                            ->get();



        $viewData = compact(
            'users',
            'school_id',
            'currentdate',
            'genders',
            'user_teachers',
            'user_allocated_status',
            'teachers',
            'teacher_class',
            'maleteachers',
            'femaleteachers',
            'teachers_school_classes',
            'schoolgradeclasses',
            'schoolclasses',
            'schoolgrades',
            'schoolsubclasses',
            'percentage_male_teachers',
            'percentage_female_teachers',
            'school_name',
            'school_id'
        );

        //
        if(session('success_message')){

            Alert::success('Success', session('success_message'));

    }elseif(session('warning_message')){

        Alert::warning('Failed', session('warning_message'));

}elseif(session('error_message')){

    Alert::error('Failed', session('error_message'));


}
        //

        return view('teachers', $viewData);
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

        /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {

      //Softdelete
      
    }

}