<?php

namespace App\Http\Controllers\Teachers;

use Auth;
use App\School;
use App\Subject;
use App\MarkSchedule;
use Carbon\Carbon;
use App\Teacher;
use App\SchoolClass;
use App\StudentClass;
use App\TeacherClass;
use App\ClassSubject;
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //id = teacher_id so we need school_id

       
        $school_idy = Teacher::where('id',$id) ->pluck('school_id');

        $school_id = $school_idy[0]; 

//dd($school_id);



        $schools = School::where('id','=',$school_id)->get();

        foreach($schools as $school){

            $school_name = $school->schoolname;

           // $school_level = $school->school_level;

        
        }

        $schoollevel_idx = School::where('id',$school_id)->pluck('school_level');

        $schoollevel_id  = $schoollevel_idx[0];

        ///

        $currentyear = carbon::now('Africa/Harare')->year;

        $allsubjects = Subject::where('school_id','=',$school_id)->get();
      
        $teacher_classes = TeacherClass::join('school_classes','teacher_classes.schoolclass_id','=','school_classes.id')
                                       ->join('school_grades','school_classes.grade_id','=','school_grades.id')
                                       ->join('school_sub_classes','school_classes.subclass_id','=','school_sub_classes.id')
                                       ->where('school_classes.school_id','=',$school_id)
                                       ->where('teacher_classes.teacher_id',$id)
                                       ->where('teacher_classes.year',$currentyear)
                                       ->get();

        foreach($teacher_classes as $teacher_class){

            $schoolclass_id = $teacher_class->schoolclass_id;

            $grade          = $teacher_class->grade;

            $subclass       = $teacher_class->subclasses;

            $level_id       = $teacher_class->level_id;

            $classname      = $grade.''.$subclass;

        }

        //dd($teacher_classes);
        
        // select students in same class

        $class_students = StudentClass::join('students','student_classes.student_id','=','students.id')
                                      ->leftjoin('guardians','student_classes.student_id','=','guardians.id')
                                      ->where('schoolclass_id',$schoolclass_id)
                                      ->where('year',$currentyear)
                                      ->select(
                                          'students.id',
                                          'student_classes.student_id',
                                          'student_classes.schoolclass_id',
                                          'student_classes.year',
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

        $malestudents = StudentClass::join('students','student_classes.student_id','=','students.id')
                                      ->where('schoolclass_id',$schoolclass_id)
                                      ->where('year',$currentyear)
                                      ->where('students.gender_id',1)
                                      ->get();

        
        $femalestudents = StudentClass::join('students','student_classes.student_id','=','students.id')
                                      ->where('schoolclass_id',$schoolclass_id)
                                      ->where('year',$currentyear)
                                      ->where('students.gender_id',2)
                                      ->get();

        ///
        
        if($class_students->count() > 0){

            
            $percentage_male_students = round((100*($malestudents->count())/$class_students->count()),1);
    
            $percentage_female_students = round((100*($femalestudents->count())/$class_students->count()),1);
    
    
            }else{
    
                $percentage_male_students = 0;
    
                $percentage_female_students = 0;
    
            };
    
          ///

          $subjects = ClassSubject::join('subjects','subjects.id','=','class_subjects.subject_id')
                             ->where('class_subjects.year',$currentyear)
                              ->where('class_subjects.schoolclass_id',$schoolclass_id)
                              ->select('class_subjects.id','class_subjects.schoolclass_id','class_subjects.subject_id','class_subjects.year','subjects.code','subjects.name','subjects.papers')
                            ->get();

         //dd($subjects);
           
           ///

        //dd($class_students);

        $viewData = compact(
            'teacher_classes',
            'class_students',
            'malestudents',
            'femalestudents',
            'percentage_male_students',
            'percentage_female_students',
            'classname',
            'schoolclass_id',
            'level_id',
            'currentyear',
            'subjects',
            'allsubjects',
            'school_name',
            'school_id'
        );
        
        if(session('success_message')){

            Alert::success('Success', session('success_message'));
        
        }elseif(session('warning_message')){
        
        Alert::warning('Operation Failed', session('warning_message'));
        
        }elseif(session('error_message')){
        
        Alert::error('Registration Failed', session('error_message'));
        
        }

        return view('teachers.classdashboard', $viewData);

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