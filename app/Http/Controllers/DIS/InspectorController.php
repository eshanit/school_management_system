<?php

namespace App\Http\Controllers\DIS;

use DB;
use App\TeacherClass;
use App\SchoolClass;
use App\SchoolGrade;
use App\SchoolSubClass;
use App\Teacher;
use App\School;
use App\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class InspectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $schools        = School::join('school_type','school_type.id','=','schools.school_type')
                                ->join('school_status','school_status.id','=','schools.school_status')
                                ->join('school_level','school_level.id','=','schools.school_level')
                                ->select('schools.id','schools.schoolname','school_type.type','school_status.status','school_level.level')
                                ->get();

        //dd($schools);

        $teachers       = Teacher::all();

        $students       = Student::all();

        ///


///

$school_teachers = School::join('teachers','teachers.school_id','=','schools.id')
                  ->get();


$school_students = School::join('students','students.school_id','=','schools.id')
                  ->get();


foreach($school_students as $school_student)
{
   
    $student_id[$school_student->school_id][] = $school_student->id;

    $school_student_gender[$school_student->school_id][] = $school_student->gender_id;

    if(isset($school_student_gender[$school_student->school_id]) || $school_student_gender[$school_student->school_id] != NULL){

        $school_student_gender_count[$school_student->school_id] = array_count_values($school_student_gender[$school_student->school_id]);

    }else{

        $school_student_gender_count[$school_student->school_id] = NULL;

    }

    

}

///

foreach($school_teachers as $school_teacher)
{
   
    $teacher_id[$school_teacher->school_id][] = $school_teacher->id;

    $school_teacher_gender[$school_teacher->school_id][] = $school_teacher->gender_id;

    //dd($school_teacher_gender);

    if(isset($school_teacher_gender[$school_teacher->school_id]) && $school_teacher_gender[$school_teacher->school_id] > 0){

        $school_teacher_gender_count[$school_teacher->school_id] = array_count_values($school_teacher_gender[$school_teacher->school_id]);

    }else{

        $school_teacher_gender_count[$school_teacher->school_id] = NULL;

    }

    

}

///

if(!isset($teacher_id)){

    $teacher_id = NULL;

    $school_teacher_gender = NULL;

    $school_teacher_gender_count = NULL;

}
///
if(!isset($student_id)){

    $student_id = NULL;

    $school_student_gender = NULL;

    $school_student_gender_count = NULL;
    
}

///

$schoolstatuses = DB::table('school_status')->get();

$schooltypes = DB::table('school_type')->get();

$schoollevels = DB::table('school_level')->get();




//dd($school_teacher_gender);

//dd($student_id);

///




        $viewData = compact(
            'teacher_id',
            'school_teacher_gender',
            'school_teacher_gender_count',
            'student_id',
            'school_student_gender',
            'school_student_gender_count',
            'schools',
            'teachers',
            'students',
            'schoolstatuses',
            'schooltypes',
            'schoollevels'
        );

        
        if(session('success_message')){

            Alert::success('Success', session('success_message'));

    }elseif(session('warning_message')){

        Alert::warning('Edit Failed', session('warning_message'));

}elseif(session('error_message')){

    Alert::error('Registration Failed', session('error_message'));

}

        return view('dis.dashboard',$viewData);
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

        $school_id = $id;

        $schools = School::where('id','=',$school_id)->get();

        foreach($schools as $school){

            $school_name = $school->schoolname;

            $school_level = $school->school_level;

        
        }


        $currentyear = carbon::now('Africa/Harare')->year;

        $genders = DB::table('gender')->get();




//get student info
        $students = DB::table('students')
        ->join('guardians', function ($join) {
            $join->on('guardians.student_id','=','students.id');
        })
        ->where('students.school_id','=',$school_id)
        ->get();

        //dd($students);
//get student classes

        $students_school_classes = DB::table('students')
            ->join('student_classes', 'student_classes.student_id', '=', 'students.id')
            ->join('school_classes', 'school_classes.id','=', 'student_classes.schoolclass_id')
            ->join('school_grades', 'school_grades.id', '=' , 'school_classes.grade_id')
            ->join('school_sub_classes', 'school_sub_classes.id', '=' , 'school_classes.subclass_id')
            ->where('student_classes.year','=',$currentyear)
            ->where('students.school_id','=',$school_id)
            ->select('students.id','students.firstname','students.lastname','students.gender_id','student_classes.schoolclass_id','school_grades.grade','school_sub_classes.subclasses','school_classes.grade_id','school_classes.subclass_id')
        ->get();

        //dd($students_school_classes);

        foreach($students_school_classes as $students_school_class){

                $student_class[$students_school_class->id] = $students_school_class->grade.''.$students_school_class->subclasses;

                $student_class_gender[$students_school_class->schoolclass_id][] = $students_school_class->gender_id;


                $student_class_gender_countx[$students_school_class->schoolclass_id] = array_count_values($student_class_gender[$students_school_class->schoolclass_id]);

                $student_class_gender_totalx[$students_school_class->schoolclass_id] = count($student_class_gender[$students_school_class->schoolclass_id]);
                
        }

        if(isset($student_class_gender_countx)){

            $student_class_gender_count = $student_class_gender_countx;

        }else{

            $student_class_gender_count = 0;

        }

        ///

        if(isset($student_class_gender_totalx)){

            $student_class_gender_total = $student_class_gender_totalx;

        }else{

            $student_class_gender_total = 0;

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
            //->join('teacher_classes','school_classes.id','=','teacher_classes.schoolclass_id')
            ->select('school_classes.id','school_grades.grade','school_sub_classes.subclasses')
            ->where('school_classes.school_id','=',$school_id)
            ->get();


//dd($schoolgradeclasses);

      $teacherclass = TeacherClass::join('teachers','teachers.id','=','teacher_classes.teacher_id')
                                    ->join('users','users.id','=','teachers.user_id')
                                    ->where('users.school_id','=',$school_id)
                                    ->get();


      
      $teacherclassdata = json_decode(json_encode($teacherclass), true);

      for($i = 0 ; $i < count($teacherclassdata) ; $i++){

        $teacherclass_id[$i] = $teacherclassdata[$i]['id'];

        $teacherclass_class_id[$teacherclass_id[$i]] = $teacherclassdata[$i]['schoolclass_id'];

        $teacherclass_teacher_idx[$teacherclass_class_id[$teacherclass_id[$i]]] = $teacherclassdata[$i]['teacher_id'];

        $teachernamex[$teacherclass_class_id[$teacherclass_id[$i]]] = $teacherclassdata[$i]['name'];

      }

      if(isset($teacherclass_teacher_idx)){

        $teacherclass_teacher_id = $teacherclass_teacher_idx;

      }else{

        $teacherclass_teacher_id = NULL;

      }


      if(isset($teachernamex)){

        $teachername = $teachernamex;

      }else{

        $teachername = NULL;

      }

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
        $schoolclasses = SchoolClass::where('school_id','=',$school_id)->get();

        /*----------*/

        $schoolgrades = SchoolGrade::where('schoollevel_id','=',$school_level)->get();

        /*--------*/

        $schoolsubclasses = SchoolSubClass::where('school_id','=',$school_id)->get();


       // dd($students);

      // dd($student_class_gender_total);

        ///

        $viewData = compact(
            'genders',
            'students',
            'teachers',
            'schoolclasses',
            'student_class',
            'schoolgrades',
            'malestudents',
            'femalestudents',
            'schoolsubclasses',
            'schoolgradeclasses',
            'students_school_classes',
            'percentage_male_students',
            'percentage_female_students',
            'student_class_gender_count',
            'student_class_gender_total',
            'teacherclass_teacher_id',
            'teachername',
            'school_id',
            'school_name'
        );


        if(session('success_message')){

                Alert::success('Success', session('success_message'));

        }elseif(session('warning_message')){

            Alert::warning('Edit Failed', session('warning_message'));

    }elseif(session('error_message')){

        Alert::error('Registration Failed', session('error_message'));

}

return view('management.home',$viewData);


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
