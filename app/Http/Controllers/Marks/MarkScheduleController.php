<?php

namespace App\Http\Controllers\Marks;

use DB;
use Auth;
use App\School;
use App\Student;
use App\SchoolClass;
use App\MarkSchedule;
use App\Teacher;
use App\Subject;
use App\TeacherClass;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;


class MarkScheduleController extends Controller
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
     * view resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function markschedule(Request $request)
    {
        //
        $validatedData = $request->validate([
            'term_id'=>'required',
            'level_id'=>'required',
            'schoolclass_id'=>'required',
        ]);

        //
        $school_id = Auth::user()->school_id;

        $schools = School::where('id','=',$school_id)->get();

        foreach($schools as $school){

            $school_name = $school->schoolname;

            $school_level = $school->school_level;

        
        }
        //
            $term_id    = $request->input('term_id');

            $level_id   = $request->input('level_id');
            
            $schoolclass_id = $request->input('schoolclass_id');

            $currentyear = $currentyear = carbon::now('Africa/Harare')->year;


            //
                $classes = SchoolClass::join('school_grades','school_grades.id','=','school_classes.grade_id')
                                     ->join('school_sub_classes','school_sub_classes.id','=','school_classes.subclass_id')
                                     ->where('school_classes.id',$schoolclass_id)
                                     ->get();

               foreach($classes as $class){

                    $classname = $class->grade.''.$class->subclasses;

               }
            //

                   /////show marks entered
/*
        $marks = MarkSchedule::join('students','students.id','=','mark_schedules.student_id')
                   ->where('studentclass_id',$schoolclass_id)
                   ->where('year',$currentyear)
                   ->where('term_id',$term_id)
                   ->get();

*/

$marks = MarkSchedule::join('students','students.id','=','mark_schedules.student_id')
->join('subjects','subjects.id','=','mark_schedules.subject_id')
->where('studentclass_id',$schoolclass_id)
->where('year',$currentyear)
->where('term_id',$term_id)
->select('mark_schedules.id',
         'mark_schedules.student_id',
         'mark_schedules.subject_id',
         'mark_schedules.maxmarks_paper_1',
         'mark_schedules.maxmarks_paper_2',
         'mark_schedules.maxmarks_paper_3',
         'mark_schedules.maxmarks_paper_4',
         'mark_schedules.marks_paper_1',
         'mark_schedules.marks_paper_2',
         'mark_schedules.marks_paper_3',
         'mark_schedules.marks_paper_4',
         'mark_schedules.exam_date',
         'subjects.name',
         'subjects.papers',
         'students.firstname',
         'students.middlename',
         'students.lastname'
         )
->get();
///


if($marks->count() == 0){

    return redirect()-> back() ->withWarningMessage("No data for this period");

}else{

    
    $marksarray = json_decode(json_encode($marks), true);

    for($i = 0; $i < count($marksarray); $i++){

        $mark_id[$i] = $marksarray[$i]['id'];

        $student_id[$mark_id[$i]] = $marksarray[$i]['student_id'];

        $studentnamex[$mark_id[$i]] = $marksarray[$i]['firstname'].' '.$marksarray[$i]['middlename'].' '.$marksarray[$i]['lastname'];

        $subject_id[$mark_id[$i]] = $marksarray[$i]['subject_id'];

        $subj[$i] = $marksarray[$i]['subject_id'];

       // for($j = 0 ; $j < count())

       $paper_1_marks[$subject_id[$mark_id[$i]]][$student_id[$mark_id[$i]]] = $marksarray[$i]['marks_paper_1'];

       $paper_2_marks[$subject_id[$mark_id[$i]]][$student_id[$mark_id[$i]]] = $marksarray[$i]['marks_paper_2'];

       $paper_3_marks[$subject_id[$mark_id[$i]]][$student_id[$mark_id[$i]]] = $marksarray[$i]['marks_paper_3'];

       $paper_4_marks[$subject_id[$mark_id[$i]]][$student_id[$mark_id[$i]]] = $marksarray[$i]['marks_paper_4'];

       $maxpos_p1[$subject_id[$mark_id[$i]]][$student_id[$mark_id[$i]]]    = $marksarray[$i]['maxmarks_paper_1'];

       $maxpos_p2[$subject_id[$mark_id[$i]]][$student_id[$mark_id[$i]]]     = $marksarray[$i]['maxmarks_paper_2'];

       $maxpos_p3[$subject_id[$mark_id[$i]]][$student_id[$mark_id[$i]]]    = $marksarray[$i]['maxmarks_paper_3'];

       $maxpos_p4[$subject_id[$mark_id[$i]]][$student_id[$mark_id[$i]]]     = $marksarray[$i]['maxmarks_paper_4'];

       ///


       $paper_1_marks_per_student[$student_id[$mark_id[$i]]][$subject_id[$mark_id[$i]]] = $marksarray[$i]['marks_paper_1'];

       $paper_2_marks_per_student[$student_id[$mark_id[$i]]][$subject_id[$mark_id[$i]]] = $marksarray[$i]['marks_paper_2'];

       
       $paper_3_marks_per_student[$student_id[$mark_id[$i]]][$subject_id[$mark_id[$i]]] = $marksarray[$i]['marks_paper_3'];

       $paper_4_marks_per_student[$student_id[$mark_id[$i]]][$subject_id[$mark_id[$i]]] = $marksarray[$i]['marks_paper_4'];


       $total_marks_per_student_per_subject[$student_id[$mark_id[$i]]][$subject_id[$mark_id[$i]]] = 
        $marksarray[$i]['marks_paper_2'] + $marksarray[$i]['marks_paper_1'] + $marksarray[$i]['marks_paper_3'] + $marksarray[$i]['marks_paper_4'];

       $maxpos_p1_per_student[$student_id[$mark_id[$i]]][$subject_id[$mark_id[$i]]]    = $marksarray[$i]['maxmarks_paper_1'];

       $maxpos_p2_per_student[$student_id[$mark_id[$i]]][$subject_id[$mark_id[$i]]]     = $marksarray[$i]['maxmarks_paper_2'];

       $maxpos_p3_per_student[$student_id[$mark_id[$i]]][$subject_id[$mark_id[$i]]]    = $marksarray[$i]['maxmarks_paper_3'];

       $maxpos_p4_per_student[$student_id[$mark_id[$i]]][$subject_id[$mark_id[$i]]]     = $marksarray[$i]['maxmarks_paper_4'];


       $maxpos_total_per_student[$student_id[$mark_id[$i]]][$subject_id[$mark_id[$i]]] = 
       $maxpos_p1_per_student[$student_id[$mark_id[$i]]][$subject_id[$mark_id[$i]]] 
       + $maxpos_p2_per_student[$student_id[$mark_id[$i]]][$subject_id[$mark_id[$i]]]
       + $maxpos_p3_per_student[$student_id[$mark_id[$i]]][$subject_id[$mark_id[$i]]]
       + $maxpos_p4_per_student[$student_id[$mark_id[$i]]][$subject_id[$mark_id[$i]]];

       //
       $percentage_p1[$student_id[$mark_id[$i]]][$subject_id[$mark_id[$i]]]  = round(100*$paper_1_marks_per_student[$student_id[$mark_id[$i]]][$subject_id[$mark_id[$i]]]/$maxpos_p1_per_student[$student_id[$mark_id[$i]]][$subject_id[$mark_id[$i]]],2);

       $percentage_p2[$student_id[$mark_id[$i]]][$subject_id[$mark_id[$i]]]  = round(100*$paper_2_marks_per_student[$student_id[$mark_id[$i]]][$subject_id[$mark_id[$i]]]/$maxpos_p2_per_student[$student_id[$mark_id[$i]]][$subject_id[$mark_id[$i]]],2);
        
       if($maxpos_p3_per_student[$student_id[$mark_id[$i]]][$subject_id[$mark_id[$i]]] != NULL){

        $percentage_p3[$student_id[$mark_id[$i]]][$subject_id[$mark_id[$i]]]  = round(100*$paper_3_marks_per_student[$student_id[$mark_id[$i]]][$subject_id[$mark_id[$i]]]/$maxpos_p3_per_student[$student_id[$mark_id[$i]]][$subject_id[$mark_id[$i]]],2);

       }else{

        $percentage_p3[$student_id[$mark_id[$i]]][$subject_id[$mark_id[$i]]]  = "-";

       }


     
             if($maxpos_p4_per_student[$student_id[$mark_id[$i]]][$subject_id[$mark_id[$i]]] != NULL){

        $percentage_p4[$student_id[$mark_id[$i]]][$subject_id[$mark_id[$i]]]  = round(100*$paper_4_marks_per_student[$student_id[$mark_id[$i]]][$subject_id[$mark_id[$i]]]/$maxpos_p4_per_student[$student_id[$mark_id[$i]]][$subject_id[$mark_id[$i]]],2);

       }else{

        $percentage_p4[$student_id[$mark_id[$i]]][$subject_id[$mark_id[$i]]]  = "-";

       } 

       $total_marks_per_student[$student_id[$mark_id[$i]]] = array_sum($total_marks_per_student_per_subject[$student_id[$mark_id[$i]]]);

    }

    //dd($studentnamex);


    $allstudents = Student::all();

    foreach($allstudents as $allstudent){

        $studentname[$allstudent->id]  = $allstudent->firstname." ".$allstudent->lastname;
    }

    //$studentname = array_values($studentnamex);

    //$student_idx  = array_keys($studentnamex);

    ///class positions

    //dd($studentname);

    $x = $total_marks_per_student; arsort($x); 
    # Initival values
     $rank       = 0; 
    $hiddenrank = 0;
    $hold = null;
    foreach ( $x as $key=>$val ) {
        # Always increade hidden rank
        $hiddenrank += 1;
        # If current value is lower than previous:
        # set new hold, and set rank to hiddenrank.
        if ( is_null($hold) || $val < $hold ) {
            $rank = $hiddenrank; $hold = $val;
        }    
        # Set rank $rank for $in[$key]
        $rankedAggregates[$key] = $rank;
    }  
   
///

//dd($studentname);
//dd($student_id);
//

$subjects = Subject::all();

foreach($subjects as $subject){

$subjectname[$subject->id] = $subject->name;

}



//

    $class_subjects = array_values(array_unique($subj));

    $student_idy = array_keys($total_marks_per_student);

    //dd($class_subjects);

//dd($subjectname);

/*    dd($subjects);

    dd($marks);

    dd($paper_1_marks_per_student);
    
    dd($total_marks_per_student);
*/
//dd($student_idx);

//dd($total_marks_per_student);

$viewData = compact(
    'currentyear',
    'student_id',
    //'student_idx',
    'student_idy',
    'subject_id',
    'maxpos_total_per_student',
    'term_id',
    'studentname',
    'classname',
    'class_subjects',
    'marks',
    'total_marks_per_student_per_subject',
    'total_marks_per_student',
    'rankedAggregates',
    'subjectname',
    'paper_1_marks_per_student',
    'maxpos_p1_per_student',  
    'paper_2_marks_per_student',
    'maxpos_p2_per_student',
    'paper_3_marks_per_student',
    'maxpos_p3_per_student',  
    'paper_4_marks_per_student',
    'maxpos_p4_per_student',
    'school_name',
    'school_id'

);

    return view('marks.term_mark_schedule', $viewData);


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