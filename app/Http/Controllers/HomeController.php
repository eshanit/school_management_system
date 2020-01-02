<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\School;
use App\Student;
use App\Guardian;
use App\Teacher;
use Carbon\Carbon;
use App\SchoolClass;
use App\SchoolGrade;
use App\SchoolSubClass;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {


        $school_id = Auth::user()->school_id;

        $schools = School::where('id','=',$school_id)->get();

        foreach($schools as $school){

            $school_name = $school->schoolname;

            $school_level = $school->school_level;

        
        }

        $currentyear = carbon::now('Africa/Harare')->year;

        $genders = DB::table('gender')->get();

//get school info

$schools = School::where('id',$school_id)->get();


//get student info
        $students = DB::table('students')
        ->leftjoin('guardians', function ($join) {
            $join->on('guardians.student_id','=','students.id');
        })
        ->where('students.school_id','=',$school_id)
        ->select('students.id',
                 'students.firstname',
                 'students.middlename',
                 'students.lastname',
                 'students.gender_id',
                 'students.dateofbirth',
                 'students.birthnumber',
                 'students.date_enrolled',
                 'students.activestatus_id',
                 'guardians.first_name',
                 'guardians.middle_name',
                 'guardians.last_name',
                 'guardians.idnumber',
                 'guardians.address',
                 'guardians.phonenumber',
                 'guardians.email'
        )
        ->get();

        //dd($students);
//get student classes

        $students_school_classes = DB::table('students')
            ->join('student_classes', 'student_classes.student_id', '=', 'students.id')
            ->join('school_classes', 'school_classes.id','=', 'student_classes.schoolclass_id')
            ->join('school_grades', 'school_grades.id', '=' , 'school_classes.grade_id')
            ->join('school_sub_classes', 'school_sub_classes.id', '=' , 'school_classes.subclass_id')
            ->where('student_classes.year','=',$currentyear)
            ->where('student_classes.school_id','=',$school_id)
            ->select('students.id','students.firstname','students.lastname','students.gender_id','student_classes.schoolclass_id','school_grades.grade','school_sub_classes.subclasses','school_classes.grade_id','school_classes.subclass_id')
        ->get();

        //dd($students_school_classes);

        foreach($students_school_classes as $students_school_class){

                $student_class[$students_school_class->id] = $students_school_class->grade.''.$students_school_class->subclasses;

                $student_class_gender[$students_school_class->schoolclass_id][] = $students_school_class->gender_id;

                $student_class_gender_count[$students_school_class->schoolclass_id] = array_count_values($student_class_gender[$students_school_class->schoolclass_id]);

                $student_class_gender_total[$students_school_class->schoolclass_id] = count($student_class_gender[$students_school_class->schoolclass_id]);
                
        }

    if(!isset($student_class_gender_count)){

        $student_class_gender_count = NULL;

        $student_class_gender_total = NULL;


    }

        
//dd($student_class_gender);
        
if(isset($student_class)){

    $student_class = $student_class;

}else{

    $student_class = NULL;
}

///grades and classes


       $schoolgradeclasses = DB::table('school_classes')
            ->join('school_grades','school_grades.id','=','school_classes.grade_id')
            ->join('school_sub_classes','school_sub_classes.id','=','school_classes.subclass_id')
            ->select('school_classes.id','school_grades.grade','school_sub_classes.subclasses')
            ->where('school_classes.school_id','=',$school_id)
            ->get();





//dd($schoolgradeclasses);
       
//

        $malestudents = Student::where('school_id',$school_id)
                                ->where('gender_id',1);

        $femalestudents = Student::where('school_id',$school_id)
                                   ->where('gender_id',2);


        if($students->count() > 0){

            
        $percentage_male_students = round((100*($malestudents->count())/$students->count()),1);

        $percentage_female_students = round((100*($femalestudents->count())/$students->count()),1);


        }else{

            $percentage_male_students = 0;

            $percentage_female_students = 0;

        };


        /*-----------*/

        $teachers = Teacher::where('school_id','=',$school_id)->get();

        /*-----------*/
        $schoolclasses = SchoolClass::join('school_grades','school_grades.id','=','school_classes.grade_id')
                                    ->join('school_sub_classes','school_sub_classes.id','=','school_classes.subclass_id')
                                    ->where('school_classes.school_id','=',$school_id)
                                    ->get();
                                     
        //dd($schoolclasses);

        /*----------*/

        $schoolgrades = SchoolGrade::where('schoollevel_id','=',$school_level)->get();;

        /*--------*/

        $schoolsubclasses = SchoolSubClass::where('school_id','=',$school_id)->get();


       // dd($students);

      // dd($student_class_gender_total);

        ///

        $viewData = compact(
            'genders',
            'students',
            'teachers',
            'schools',
            'schoolclasses',
            'student_class',
            'schoolgrades',
            'malestudents',
            'school_name',
            'school_id',
            'femalestudents',
            'schoolsubclasses',
            'schoolgradeclasses',
            'students_school_classes',
            'percentage_male_students',
            'percentage_female_students',
            'student_class_gender_count',
            'student_class_gender_total'
        );


        if(session('success_message')){

                Alert::success('Success', session('success_message'));

        }elseif(session('warning_message')){

            Alert::warning('Edit Failed', session('warning_message'));

    }elseif(session('error_message')){

        Alert::error('Registration Failed', session('error_message'));

}

        

        return view('home', $viewData);
    }


    //
    public function loggedin()
    {

        return view('logged');

    }
}