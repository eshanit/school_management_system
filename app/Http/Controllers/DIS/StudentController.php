<?php

namespace App\Http\Controllers\DIS;

use DB;
use App\School;
use App\Student;
use Carbon\Carbon;
use App\StudentClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $currentyear = carbon::now('Africa/Harare')->year;

        $students = Student::all();

        $male_students = Student::where('gender_id',1)->count();

        $female_students = Student::where('gender_id',2)->count();

        if($students->count() > 0){

            $perc_male_students = round(100*$male_students/($students->count()),2);

            $perc_female_students = round(100*$female_students/($students->count()),2);
    
        }else{

            $perc_male_students = NULL;

            $perc_female_students = NULL;    

        }

      
        ////
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


        ////

        $school_students = Student::join('schools','schools.id','=','students.school_id')
                                  ->join('guardians','guardians.student_id','=','students.id')
                                  ->leftjoin('student_classes','student_classes.student_id','=','students.id')
                                  ->leftjoin('school_classes','school_classes.id','=','student_classes.schoolclass_id')
                                  ->leftjoin('school_grades','school_grades.id','=','school_classes.grade_id')
                                  ->leftjoin('school_sub_classes','school_sub_classes.id','=','school_classes.subclass_id')
                                  ->get();


    ///
     
if($school_students->count() != 0){

    foreach($school_students as $school_student){

        $school_student_level[] = $schoollevelname[$school_student->school_level];

        $school_student_gender_level[$gendername[$school_student->gender_id]][] = $schoollevelname[$school_student->school_level];

        $school_student_gender_level_count[$gendername[$school_student->gender_id]] = array_count_values($school_student_gender_level[$gendername[$school_student->gender_id]]);

      }

      $school_student_level_count = array_count_values($school_student_level);


}else{

    $school_student_level[] = NULL;

    $school_student_gender_level = NULL;

    $school_student_gender_level_count = NULL;

    $school_student_level_count = NULL;


}
     
       //dd($school_students);

        $viewData = compact(
            'students',
            'currentyear',
            'school_students',
            'male_students',
            'female_students',
            'perc_male_students',
            'school_student_level_count',
            'school_student_gender_level',
            'school_student_gender_level_count',
            'perc_female_students'
        );

        
if(session('success_message')){

    Alert::success('Success', session('success_message'));

}elseif(session('warning_message')){

Alert::warning('Operation Failed', session('warning_message'));

}elseif(session('error_message')){

Alert::error('Registration Failed', session('error_message'));

}

        return view('dis.student_dashboard',$viewData);        


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
