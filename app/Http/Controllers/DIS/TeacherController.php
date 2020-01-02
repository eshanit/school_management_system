<?php

namespace App\Http\Controllers\DIS;

use DB;
use App\School;
use App\Teacher;
use App\TeacherClass;
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
        $teachers = Teacher::all();

        $schools = School::all();

        $male_teachers = Teacher::where('gender_id',1)->count();

        $female_teachers = Teacher::where('gender_id',2)->count();

        if(count($teachers)!=0){

            $perc_male_teachers = round(100*$male_teachers/($teachers->count()),2);

            $perc_female_teachers = round(100*$female_teachers/($teachers->count()),2);
    
        }else{

            $perc_male_teachers = 0;

            $perc_female_teachers = 0;
    
        }
      
        ///

        $school_levels = DB::table('school_level')->get();

        foreach($school_levels as $school_level){

            $schoollevelname[$school_level->id] = $school_level->level;

        }

        ///

        $genders = DB::table('gender')->get();

        foreach($genders as $gender){

            $gendername[$gender->id]  = $gender->gender;

        }

        ///


        $school_teachers = School::join('teachers','teachers.school_id','=','schools.id')
                  ->join('users','teachers.user_id','=','users.id')              
                  ->select(
                      'teachers.id',
                      'schools.schoolname',
                      'schools.school_level',
                      'teachers.gender_id',
                      'users.name',
                      'users.email',
                      'teachers.address',
                      'teachers.phonenumber',
                      'teachers.date_started',
                      'teachers.activestatus_id',
                      'teachers.allocatestatus_id'
                      )
                  ->get();

                  ///
                  if($school_teachers->count()!=0){

                        
                  foreach($school_teachers as $school_teacher){

                    $school_teacher_level[] = $schoollevelname[$school_teacher->school_level];

                    $school_teacher_gender_level[$gendername[$school_teacher->gender_id]][] = $schoollevelname[$school_teacher->school_level];

                    $school_teacher_gender_level_count[$gendername[$school_teacher->gender_id]] = array_count_values($school_teacher_gender_level[$gendername[$school_teacher->gender_id]]);

                  }

                  $school_teacher_level_count = array_count_values($school_teacher_level);


                  }else{

                    $school_teacher_level[] = NULL;

                    $school_teacher_gender_level = NULL;

                    $school_teacher_gender_level_count = NULL;

                    ///

                    $school_teacher_level_count = NULL;

                  }

                  //dd($school_teacher_level_count );
                  //dd($school_teacher_gender_level_count);

                  ///
                  
                  $teacher_classes = TeacherClass::join('school_classes','teacher_classes.schoolclass_id','=','school_classes.id')
                  ->join('school_grades','school_classes.grade_id','=','school_grades.id')
                  ->join('school_sub_classes','school_classes.subclass_id','=','school_sub_classes.id')
                  ->select('teacher_classes.schoolclass_id','teacher_classes.teacher_id','teacher_classes.year','school_grades.grade','school_sub_classes.subclasses')
                  ->get();
                  
                  if($teacher_classes->count() != NULL ){

                    foreach($teacher_classes as $teacher_class){

                        $teacherclass[$teacher_class->teacher_id] = $teacher_class->schoolclass_id;
    
                      }

                  }else{

                    $teacherclass = NULL;

                  }

                

                  //  dd($teacherclass);
                 
//dd($school_teacher_level_count);

//dd($school_teacher_gender_level_count);

        $viewData = compact(
            'teachers',
            'schools',
            'male_teachers',
            'female_teachers',
            'perc_male_teachers',
            'perc_female_teachers',
            'school_teachers',
            'school_teacher_gender_level_count',
            'school_teacher_level_count',
            'teacherclass'
        );

        

if(session('success_message')){

    Alert::success('Success', session('success_message'));

}elseif(session('warning_message')){

Alert::warning('Operation Failed', session('warning_message'));

}elseif(session('error_message')){

Alert::error('Registration Failed', session('error_message'));

}


        return view('dis.teacher_dashboard',$viewData);

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
