<?php

namespace App\Http\Controllers\Students;

use Auth;
use DB;
use App\School;
use Carbon\Carbon;
use App\Student;
use App\StudentClass;
use App\SchoolClass;
use App\StudentAttendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttendanceController extends Controller
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function student_attendance($term_id,$schoolclass_id)
    {
        $school_id = Auth::user()->school_id;

        $schools = School::where('id','=',$school_id)->get();

        foreach($schools as $school){

            $school_name = $school->schoolname;

            $school_level = $school->school_level;

        
        }

        $currentyear = carbon::now('Africa/Harare')->year;


        $class_students = StudentClass::join('students','student_classes.student_id','=','students.id')
        ->where('schoolclass_id',$schoolclass_id)
        ->where('year',$currentyear)
        ->select('students.id','students.firstname','students.middlename','students.lastname')
        ->get();

        ///

        $classes = SchoolClass::join('school_grades','school_grades.id','=','school_classes.grade_id')
                    ->join('school_sub_classes','school_sub_classes.id','=','school_classes.subclass_id')
                    ->where('school_classes.id',$schoolclass_id)
                    ->get();

        foreach($classes as $class){

                $classname = $class->grade.''.$class->subclasses;

                }

///

        $veiwData = compact(
            'term_id',
            'currentyear',
            'schoolclass_id',
            'class_students',
            'classname',
            'school_name',
            'school_id'
        );

        return view('teachers.attendancedashboard',$veiwData);


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
        $currentyear = carbon::now('Africa/Harare')->year;


           //validating
           $validatedData = $request->validate([
            'school_id'=>'required',
            'term_id'=>'required',
            'studentclass_id'=>'required',
            'dateofattendance' => 'required',
        ]);

        $school_id = Auth::user()->school_id;

        $schools = School::where('id','=',$school_id)->get();

        foreach($schools as $school){

            $school_name = $school->schoolname;

            $school_level = $school->school_level;

        
        }

        $schoolclass_id = $request->input('studentclass_id');

//$schoolid       = $request->input('school_id');

        $termid         = $request->input('term_id');

        $date           = $request->input('dateofattendance');

    

        $class_students = StudentClass::join('students','student_classes.student_id','=','students.id')
        ->where('schoolclass_id',$schoolclass_id)
        ->where('year',$currentyear)
        ->select('students.id','students.firstname','students.middlename','students.lastname')
        ->get();

        foreach($class_students as $class_student){

            $i = 0;
            
                $class_student_id[] = $class_student->id;
            
            }

                 
        for($i = 0; $i < count($class_students); $i++){

            $schoolid[$i]        =  $school_id;

            $student_id[$i]       = $class_student_id[$i];

            $class_id[$i]         = $schoolclass_id;

            $attendance_date[$i]  = $date;

            $current_year[$i]      = $currentyear;

            $term_id[$i]          = $termid;

            $create_id[$i]             = Auth::user()->id;

            //paper 1

       
            $student_attendance[$i] = $request->input("attendance_$student_id[$i]");


        }

        ////
        for($i = 0; $i < count($student_id);$i++){

            $datax = array(
    
                'school_id'=> $schoolid[$i],
                'student_id'=> $student_id[$i],
                'schoolclass_id'=> $class_id[$i],
                'date' => $attendance_date[$i],
                'year' => $current_year[$i],
                'term' => $term_id[$i],
                'attendance' => $student_attendance[$i],
                'activestatus_id'=>1,
                'create_id'=>$create_id[$i]
            );
    
            $data1[]= $datax;
    
        }
    
        
            ///insert data 

            $datacheck = StudentAttendance::where('date',$attendance_date[0])->count();

           // dd($data1);

            if($datacheck == 0 || $datacheck == NUll){

                DB::table('student_attendances')->insert(
                    $data1
                );

                return redirect()->route('teacher.index') -> withSuccessMessage("Attendance successifully added to class");

            }else{

                return redirect()->back()->withErrorMessage("Attendance already recorded for date $date for this claass");;

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
        

        $school_idx = Student::where('id',$id)->pluck('school_id');
        

        $school_id = $school_idx[0];

     

        $schools = School::where('id','=',$school_id)->get();

        foreach($schools as $school){

            $school_name = $school->schoolname;

            //$school_level = $school->school_level;
        }

        //
        $currentyear = carbon::now('Africa/Harare')->year;

        $student_id  = $id;

        $student_attendances = StudentAttendance::join('students','students.id','=','student_attendances.student_id')
                                                ->where('student_id',$student_id)->get();


                                                

       $student_absent_days = StudentAttendance::join('students','students.id','=','student_attendances.student_id')
                                                ->where('student_id',$student_id)
                                                ->where('student_attendances.attendance','=',0)
                                                ->count();

       $student_present_days = StudentAttendance::join('students','students.id','=','student_attendances.student_id')
                                                ->where('student_id',$student_id)
                                                ->where('student_attendances.attendance','=',1)
                                                ->count();



        if($student_attendances->count() != 0){

            if($student_attendances->count() != 0){
                                                                              
                $student_absent_rate  = round(100*$student_absent_days/($student_attendances->count()),2);
                                                    
                $student_present_rate  = round(100*$student_present_days/($student_attendances->count()),2);
                                                    
                    }else{
                                                    
                        $student_absent_rate  = 0;
                                                    
                        $student_present_rate  = 0;

                        }
                                                                              //
                        $student_namex = $student_attendances->pluck('firstname');

                        $student_middlenamex = $student_attendances->pluck('middlename');

                        $student_lastnamex = $student_attendances->pluck('lastname');
                                                    
                        $student_name = $student_namex[0].' '.$student_middlenamex[0].' '.$student_lastnamex[0];
                                                            
                        $viewData = compact(
                                            'student_name',
                                            'student_attendances',
                                            'student_absent_days',
                                            'student_present_days',
                                            'student_absent_rate',
                                            'student_present_rate',
                                            'school_name',
                                            'school_id'
                                            );
                                                    
                                            return view('students.student_attendance',$viewData);
                                                             
                                                }else{
                                                
                                            return redirect()->back()->withWarningMessage('No Attendance data for this Student!');
                                                
                        }


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