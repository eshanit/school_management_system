<?php

namespace App\Http\Controllers\Management;


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
use App\TeacherClass;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;

class ManagementController extends Controller
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


        $currentyear = carbon::now('Africa/Harare')->year;

        $genders = DB::table('gender')->get();




//get student info
        $students = DB::table('students')
        ->leftjoin('guardians', function ($join) {
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

                $student_class_gender_count[$students_school_class->schoolclass_id] = array_count_values($student_class_gender[$students_school_class->schoolclass_id]);

                $student_class_gender_total[$students_school_class->schoolclass_id] = count($student_class_gender[$students_school_class->schoolclass_id]);
                
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

        $teacherclass_teacher_id[$teacherclass_class_id[$teacherclass_id[$i]]] = $teacherclassdata[$i]['teacher_id'];

        $teachername[$teacherclass_class_id[$teacherclass_id[$i]]] = $teacherclassdata[$i]['name'];

      }


//dd($schoolgradeclasses);
       
//

        $malestudents = Student::where('school_id',$school_id)
                                ->where('gender_id',1)
                                ->get();

        $femalestudents = Student::where('school_id',$school_id)
                                   ->where('gender_id',2)
                                   ->get();


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

return view('management.home',$viewData);

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
