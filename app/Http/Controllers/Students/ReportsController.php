<?php

namespace App\Http\Controllers\Students;

use Auth;
use App\School;
use App\Subject;
use App\Student;
use App\SchoolClass;
use App\MarkSchedule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class ReportsController extends Controller
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
    public function student_report($year,$term_id,$schoolclass_id,$student_idx)
    {

        $school_idy = Student::where('id',$student_idx)->pluck('school_id');

        $school_id = $school_idy[0];

        $schools = School::where('id','=',$school_id)->get();

        foreach($schools as $school){

            $school_name = $school->schoolname;

            $school_level = $school->school_level;

        
        }

$subjects = Subject::all();

foreach($subjects as $subject){

    $subjectname[$subject->id] = $subject->name;

}

//

$classes = SchoolClass::join('school_grades','school_grades.id','=','school_classes.grade_id')
->join('school_sub_classes','school_sub_classes.id','=','school_classes.subclass_id')
->where('school_classes.id',$schoolclass_id)
->get();

foreach($classes as $class){

$classname = $class->grade.''.$class->subclasses;

}

//

        $marks = MarkSchedule::join('students','students.id','=','mark_schedules.student_id')
        ->where('studentclass_id',$schoolclass_id)
        ->where('year',$year)
        ->where('term_id',$term_id)
        ->where('student_id',$student_idx)
        ->get();

        
if($marks->count() == 0){

    return redirect()-> back() ->withWarningMessage("No data for this period");

}else{


foreach($marks as $mark){

    $studentname = $mark->firstname.' '.$mark->middlename.' '.$mark->lastname;

}



//
$marksarray = json_decode(json_encode($marks), true);

for($i = 0; $i < count($marksarray); $i++){

    $marks_id[$i]                       =  $marksarray[$i]['subject_id'];

    $subjectsdone[$marks_id[$i]]          = $subjectname[$marksarray[$i]['subject_id']];

    $paper_1_marks[$marks_id[$i]]       =  $marksarray[$i]['marks_paper_1'];

    $paper_2_marks[$marks_id[$i]]       =  $marksarray[$i]['marks_paper_2'];

    $max_marks_paper_1[$marks_id[$i]]   =  $marksarray[$i]['maxmarks_paper_1'];

    $max_marks_paper_2[$marks_id[$i]]   =  $marksarray[$i]['maxmarks_paper_2'];

    $total_marks[$marks_id[$i]]         =  $paper_1_marks[$marks_id[$i]] + $paper_2_marks[$marks_id[$i]];

    $total_max_marks[$marks_id[$i]]     =  $max_marks_paper_1[$marks_id[$i]] + $max_marks_paper_2[$marks_id[$i]];

    $aggregate_perc[$marks_id[$i]]      = round(100*$total_marks[$marks_id[$i]]/$total_max_marks[$marks_id[$i]],2);

//grading

if($school_level == 3){

    if($aggregate_perc[$marks_id[$i]] >= 80 ){

        $graded_points[$marks_id[$i]] = 1;

    }elseif($aggregate_perc[$marks_id[$i]] >= 70 && $aggregate_perc[$marks_id[$i]] < 80){

        $graded_points[$marks_id[$i]] = 2;

    }elseif($aggregate_perc[$marks_id[$i]] >= 60 && $aggregate_perc[$marks_id[$i]] < 70){

        $graded_points[$marks_id[$i]] = 3;

    }elseif($aggregate_perc[$marks_id[$i]] >= 50 && $aggregate_perc[$marks_id[$i]] < 60){

        $graded_points[$marks_id[$i]] = 4;

    }elseif($aggregate_perc[$marks_id[$i]] >= 40 && $aggregate_perc[$marks_id[$i]] < 50){

        $graded_points[$marks_id[$i]] = 5;

    }elseif($aggregate_perc[$marks_id[$i]] >= 30 && $aggregate_perc[$marks_id[$i]] < 40){

        $graded_points[$marks_id[$i]] = 6;

    }elseif($aggregate_perc[$marks_id[$i]] >= 20 && $aggregate_perc[$marks_id[$i]] < 30){

        $graded_points[$marks_id[$i]] = 7;

    }elseif($aggregate_perc[$marks_id[$i]] >= 10 && $aggregate_perc[$marks_id[$i]] < 20){

        $graded_points[$marks_id[$i]] = 8;

    }else{

        $graded_points[$marks_id[$i]] = 9;

    }


}else{

    
if($aggregate_perc[$marks_id[$i]] >= 75 ){

    $graded_points[$marks_id[$i]] = "A";

}elseif($aggregate_perc[$marks_id[$i]] >= 60 && $aggregate_perc[$marks_id[$i]] < 75){

    $graded_points[$marks_id[$i]] = "B";

}elseif($aggregate_perc[$marks_id[$i]] >= 50 && $aggregate_perc[$marks_id[$i]] < 60){

    $graded_points[$marks_id[$i]] = "C";

}elseif($aggregate_perc[$marks_id[$i]] >= 45 && $aggregate_perc[$marks_id[$i]] < 50){

    $graded_points[$marks_id[$i]] = "D";

}elseif($aggregate_perc[$marks_id[$i]] >= 30 && $aggregate_perc[$marks_id[$i]] < 45){

    $graded_points[$marks_id[$i]] = "E";

}else{

    $graded_points[$marks_id[$i]] = "U/O";
}

}

    

}

    
$total_points = array_sum($graded_points);
// subject position

          /////show marks entered

          $allmarks = MarkSchedule::join('students','students.id','=','mark_schedules.student_id')
          ->where('studentclass_id',$schoolclass_id)
          ->where('year',$year)
          ->where('term_id',$term_id)
          ->get();

$allmarksarray = json_decode(json_encode($allmarks), true);

for($i = 0; $i < count($allmarksarray); $i++){

   $mark_id[$i] = $allmarksarray[$i]['id'];

   $student_id[$mark_id[$i]] = $allmarksarray[$i]['student_id'];

   //$studentnamex[$mark_id[$i]] = $allmarksarray[$i]['firstname'].' '.$allmarksarray[$i]['middlename'].' '.$allmarksarray[$i]['lastname'];

   $subject_id[$mark_id[$i]] = $allmarksarray[$i]['subject_id'];

   $subj[$i] = $allmarksarray[$i]['subject_id'];

  // for($j = 0 ; $j < count())

  $allpaper_1_marks[$subject_id[$mark_id[$i]]][$student_id[$mark_id[$i]]] = $allmarksarray[$i]['marks_paper_1'];

  $allpaper_2_marks[$subject_id[$mark_id[$i]]][$student_id[$mark_id[$i]]] = $allmarksarray[$i]['marks_paper_2'];

  $allmaxpos_p1[$subject_id[$mark_id[$i]]][$student_id[$mark_id[$i]]]    = $allmarksarray[$i]['maxmarks_paper_1'];

  $allmaxpos_p2[$subject_id[$mark_id[$i]]][$student_id[$mark_id[$i]]]     = $allmarksarray[$i]['maxmarks_paper_2'];

  ///


  $paper_1_marks_per_student[$student_id[$mark_id[$i]]][$subject_id[$mark_id[$i]]] = $allmarksarray[$i]['marks_paper_1'];

  $paper_2_marks_per_student[$student_id[$mark_id[$i]]][$subject_id[$mark_id[$i]]] = $allmarksarray[$i]['marks_paper_2'];

  $total_marks_per_student_per_subject[$student_id[$mark_id[$i]]][$subject_id[$mark_id[$i]]] = $allmarksarray[$i]['marks_paper_2'] + $allmarksarray[$i]['marks_paper_1'];

  $maxpos_p1_per_student[$student_id[$mark_id[$i]]][$subject_id[$mark_id[$i]]]    = $allmarksarray[$i]['maxmarks_paper_1'];

  $maxpos_p2_per_student[$student_id[$mark_id[$i]]][$subject_id[$mark_id[$i]]]     = $allmarksarray[$i]['maxmarks_paper_2'];


  $maxpos_total_per_student[$student_id[$mark_id[$i]]][$subject_id[$mark_id[$i]]] = $maxpos_p1_per_student[$student_id[$mark_id[$i]]][$subject_id[$mark_id[$i]]] + $maxpos_p2_per_student[$student_id[$mark_id[$i]]][$subject_id[$mark_id[$i]]];

  //
  $percentage_p1[$student_id[$mark_id[$i]]][$subject_id[$mark_id[$i]]]  = round(100*$paper_1_marks_per_student[$student_id[$mark_id[$i]]][$subject_id[$mark_id[$i]]]/$maxpos_p1_per_student[$student_id[$mark_id[$i]]][$subject_id[$mark_id[$i]]],2);

  $percentage_p2[$student_id[$mark_id[$i]]][$subject_id[$mark_id[$i]]]  = round(100*$paper_2_marks_per_student[$student_id[$mark_id[$i]]][$subject_id[$mark_id[$i]]]/$maxpos_p2_per_student[$student_id[$mark_id[$i]]][$subject_id[$mark_id[$i]]],2);
   
  $total_marks_per_student[$student_id[$mark_id[$i]]] = array_sum($total_marks_per_student_per_subject[$student_id[$mark_id[$i]]]);


  $t_1[$subject_id[$mark_id[$i]]][$student_id[$mark_id[$i]]] = $total_marks_per_student_per_subject[$student_id[$mark_id[$i]]][$subject_id[$mark_id[$i]]];

  

}

//dd($t_1);

$subject_ids = array_keys($t_1);

for($i = 0 ; $i < count($t_1); $i++){

    $y[$subject_ids[$i]] = $t_1[$subject_ids[$i]]; arsort($y[$subject_ids[$i]]); 
# Initival values
$rank       = 0; 
$hiddenrank = 0;
$hold = null;
foreach ( $y[$subject_ids[$i]] as $key=>$val ) {
   # Always increade hidden rank
   $hiddenrank += 1;
   # If current value is lower than previous:
   # set new hold, and set rank to hiddenrank.
   if ( is_null($hold) || $val < $hold ) {
       $rank = $hiddenrank; $hold = $val;
   }    
   # Set rank $rank for $in[$key]
   $rankedAggregatesSubjects[$subject_ids[$i]][$key] = $rank;
}  


}

//dd($rankedAggregatesSubjects);
//$studentname = array_values($studentnamex);

//$student_idx  = array_keys($studentnamex);

///class positions


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

//dd($rankedAggregates);
//

//dd($marks);

$viewData = compact(
    'marks',
    'studentname',
    'year',
    'term_id',
    'marks_id',
    'paper_1_marks',
    'paper_2_marks',
    'max_marks_paper_1',
    'max_marks_paper_2',
    'total_marks',
    'total_max_marks',
    'aggregate_perc',
    'subjectsdone',
    'total_marks_per_student',
    'rankedAggregatesSubjects',
    'rankedAggregates',
    'classname',
    'total_points',
    'graded_points',
    'student_idx',
    'school_name',
    'school_id'
);

return view('students.reportcard', $viewData);


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