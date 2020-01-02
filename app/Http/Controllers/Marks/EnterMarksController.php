<?php

namespace App\Http\Controllers\Marks;

use DB;
use Auth;
use App\School;
use App\User;
use App\Subject;
use App\Student;
use Carbon\Carbon;
use App\MarkSchedule;
use App\StudentClass;
use App\TeacherClass;
use App\ClassSubject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EnterMarksController extends Controller
{

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show_enter(Request $request)
    {
        //
        $validatedData = $request->validate([
            'term_id'=>'required',
            'subject_id'=>'required',
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
        $currentyear = carbon::now('Africa/Harare')->year;
        //
        $term_id            = $request->input('term_id');
        $subject_id         = $request->input('subject_id');
        $schoolclass_id     = $request->input('schoolclass_id');
        
        ///
  //
  $subject_papersx = Subject::where('id',$subject_id)->pluck('papers');

  //dd($subject_id);
    
//dd($subject_papersx);

  $subject_papers  = $subject_papersx[0];


  ///
  
  $subject_namesx = Subject::where('id',$subject_id)->pluck('name');
  
  $subject_name = $subject_namesx[0];
  
  ///
  
  $subject_codex = Subject::where('id',$subject_id)->pluck('code');
  
  $subject_code = $subject_codex[0];
  
  
           
  
          $teacher_idx = TeacherClass::where('schoolclass_id',$schoolclass_id)->pluck('teacher_id');
  
          $teacher_id = $teacher_idx[0];

        ///

/*check if marks have already been entered by:

        1. Check if any marks at all have been entered 



*/
/*
$marks = MarkSchedule::where('term_id',$term_id)
                             ->where('subject_id',$subject_id)
                             ->where('studentclass_id',$schoolclass_id)
                             ->where('year',$currentyear)
                             ->get();
*/
                             $marks = MarkSchedule::join('students','students.id','=','mark_schedules.student_id')
                             ->where('studentclass_id',$schoolclass_id)
                             ->where('subject_id',$subject_id)
                             ->where('year',$currentyear)
                             ->where('term_id',$term_id)
                             ->get();
                 


                    //dd($subjects);
        
         // select students in same class

         $class_students = StudentClass::join('students','student_classes.student_id','=','students.id')
                                        ->where('schoolclass_id',$schoolclass_id)
                                        ->where('year',$currentyear)
                                        ->get();


                                        //dd($class_students);

$class_students_count = $class_students->count();

$checkanymarks = $marks->count();

if($checkanymarks != 0 && ($class_students_count == $checkanymarks)){

    //all marks for this period has been entered

    
 return redirect()->back()->withWarningMessage("All marks for this period have already been enterd,please use the view marks button if u want to edit them.");


}elseif($checkanymarks != 0 && ($class_students_count > $checkanymarks) ){

 //some students have no marks

 ///check number of papers

$subject_papersx = Subject::where('id',$subject_id)->pluck('papers');

$num_subject_papers  = $subject_papersx[0];

////

      
if($num_subject_papers == 2){

            
    $marksarray = json_decode(json_encode($marks), true);

    for($i = 0; $i < count($marksarray); $i++){

        $marks_id[$i] = $marksarray[$i]['id'];

        $marks_student_id[$marks_id[$i]] = $marksarray[$i]['student_id'];


       
            $maxpos_p1[$marks_student_id[$marks_id[$i]]]     = $marksarray[$i]['maxmarks_paper_1'];

            $maxpos_p2[$marks_student_id[$marks_id[$i]]]     = $marksarray[$i]['maxmarks_paper_2'];

            $maxpos_p1[$marks_student_id[$marks_id[$i]]]     = "-";

            $maxpos_p2[$marks_student_id[$marks_id[$i]]]     = "-";
      
            $paper_1_marks[$marks_student_id[$marks_id[$i]]] = $marksarray[$i]['marks_paper_1'];

            $paper_2_marks[$marks_student_id[$marks_id[$i]]] = $marksarray[$i]['marks_paper_2'];
            
            $paper_3_marks[$marks_student_id[$marks_id[$i]]] = "-";

            $paper_4_marks[$marks_student_id[$marks_id[$i]]] = "-";

            $test_date[$marks_student_id[$marks_id[$i]]]   = $marksarray[$i]['exam_date'];


       
    }     


 }elseif($num_subject_papers == 3){

     
    $marksarray = json_decode(json_encode($marks), true);

    for($i = 0; $i < count($marksarray); $i++){

        $marks_id[$i] = $marksarray[$i]['id'];

        $marks_student_id[$marks_id[$i]] = $marksarray[$i]['student_id'];


       
            $maxpos_p1[$marks_student_id[$marks_id[$i]]]     = $marksarray[$i]['maxmarks_paper_1'];

            $maxpos_p2[$marks_student_id[$marks_id[$i]]]     = $marksarray[$i]['maxmarks_paper_2'];
      
            $maxpos_p3[$marks_student_id[$marks_id[$i]]]     = $marksarray[$i]['maxmarks_paper_3'];

            $maxpos_p4[$marks_student_id[$marks_id[$i]]]     = "-";

            //

            $paper_1_marks[$marks_student_id[$marks_id[$i]]] = $marksarray[$i]['marks_paper_1'];

            $paper_2_marks[$marks_student_id[$marks_id[$i]]] = $marksarray[$i]['marks_paper_2'];

            $paper_3_marks[$marks_student_id[$marks_id[$i]]] = $marksarray[$i]['marks_paper_3'];

            $paper_4_marks[$marks_student_id[$marks_id[$i]]] = "-";


            $test_date[$marks_student_id[$marks_id[$i]]]   = $marksarray[$i]['exam_date'];

    }

    
 }elseif($num_subject_papers == 4){


     $marksarray = json_decode(json_encode($marks), true);

     for($i = 0; $i < count($marksarray); $i++){

         $marks_id[$i] = $marksarray[$i]['id'];

         $marks_student_id[$marks_id[$i]] = $marksarray[$i]['student_id'];

        
             $maxpos_p1[$marks_student_id[$marks_id[$i]]]     = $marksarray[$i]['maxmarks_paper_1'];

             $maxpos_p2[$marks_student_id[$marks_id[$i]]]     = $marksarray[$i]['maxmarks_paper_2'];
       
             $maxpos_p3[$marks_student_id[$marks_id[$i]]]     = $marksarray[$i]['maxmarks_paper_3'];

             $maxpos_p4[$marks_student_id[$marks_id[$i]]]     = $marksarray[$i]['maxmarks_paper_4'];
             //

             $paper_1_marks[$marks_student_id[$marks_id[$i]]] = $marksarray[$i]['marks_paper_1'];

             $paper_2_marks[$marks_student_id[$marks_id[$i]]] = $marksarray[$i]['marks_paper_2'];

             $paper_3_marks[$marks_student_id[$marks_id[$i]]] = $marksarray[$i]['marks_paper_3'];

             $paper_4_marks[$marks_student_id[$marks_id[$i]]] = $marksarray[$i]['marks_paper_4'];

             $test_date[$marks_student_id[$marks_id[$i]]]   = $marksarray[$i]['exam_date'];


 };

}
 

 $viewData = compact(
    'marks',
    //'students',
    'teacher_id',
    'term_id',
    'subject_id',
    'test_date',
    'subject_papers',
    'subject_name',
    'subject_code',
    'schoolclass_id',
    'currentyear',
    'class_students',
    'marks_student_id',
    'marks_id',
    'maxpos_p1',
    'maxpos_p2',
    'maxpos_p3',
    'maxpos_p4',
    'paper_1_marks',
    'paper_2_marks',
    'paper_3_marks',
    'paper_4_marks',
    'school_name',
    'school_id'
    //'rankedAggregates'
    );
 
    
    return view('marks.partialenter',$viewData);




////


}elseif($checkanymarks == 0){



        $viewData = compact(
            'currentyear',
            'term_id',
            'subject_papers',
            'subject_name',
            'subject_code',
            'subject_id',
            'class_students',
            'schoolclass_id',
            'teacher_id',
            'school_name'
        );

        return view('marks.enter',$viewData);

}


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
        $school_id = Auth::user()->school_id;

        $schools = School::where('id','=',$school_id)->get();

        foreach($schools as $school){

            $school_name = $school->schoolname;

            $school_level = $school->school_level;

        
        }

        $currentyear = carbon::now('Africa/Harare')->year;

        $num_subject_papers = $request->input('subject_papers');

       

        if($num_subject_papers == 2){

             //validating
           $validatedData = $request->validate([
            'studentclass_id'=>'required',
            'teacher_id'=>'required',
            'subject_id'=>'required',
            'testdate'=>'required',
            'term_id'=>'required',
            'subject_papers'=>'required',
            'max_marks_p1'=>'required',
            'max_marks_p2'=>'required',
        ]);


        //


        //

        $teacherid            = $request->input('teacher_id');
        $subjectid            = $request->input('subject_id');
        $studentclassid       = $request->input('studentclass_id');
        $testdate             = $request->input('testdate');
        $termid               = $request->input('term_id');
        $mxmksp1               = $request->input('max_marks_p1');   //maximum possible marks for paper 1
        $mxmksp2               = $request->input('max_marks_p2');   //maximum possible marks for paper 2

        //

       /* $class_students = StudentClass::join('students','student_classes.student_id','=','students.id')
        ->where('schoolclass_id',$schoolclass_id)
        ->where('year',$currentyear)
        ->get();
     
        $class_students = Student::join('student_classes','students.id','=','student_classes.student_id')
        //->join('student_classes','school_classes.id','=','student_classes.schoolclass_id')
        //->join('school_sub_classes','school_classes.subclass_id','=','school_sub_classes.id')
        //->where('student_classes.id',$studentclassid )
        //->where('student_classes.year',$currentyear)
        ->get();
      

        $checkduplication = MarkSchedule::where('teacher_id',$teacherid)
                                         ->where('subject_id',$subjectid)
                                         ->where('testdate',$testdate)
                                         ->where('year',$current_year)
                                         ->where('studentclass_id',$studentclassid)
                                         ->get();

        dd($checkduplication);
  */
        $class_students = DB::table('students')
            ->join('student_classes', 'student_classes.student_id', '=', 'students.id')
            ->join('school_classes', 'school_classes.id','=', 'student_classes.schoolclass_id')
            ->join('school_grades', 'school_grades.id', '=' , 'school_classes.grade_id')
            ->join('school_sub_classes', 'school_sub_classes.id', '=' , 'school_classes.subclass_id')
            ->where('school_classes.id','=',$studentclassid)
            ->where('student_classes.year','=',$currentyear)
            ->select('students.id','students.firstname','students.lastname','school_grades.grade','school_sub_classes.subclasses','school_classes.grade_id','school_classes.subclass_id')
        ->get();

//dd($class_students);



foreach($class_students as $class_student){

$i = 0;

    $class_student_id[] = $class_student->id;

}

//dd($class_student_id);
            
        for($i = 0; $i < count($class_students); $i++){


            $student_id[$i]       = $class_student_id[$i];

            $teacher_id[$i]       = $teacherid;

            $class_id[$i]         = $studentclassid;

            $subject_id[$i]       = $subjectid;

            $examdate[$i]         = $testdate;

            $current_year[$i]      = $currentyear;

            $term_id[$i]          = $termid;

            $create_id[$i]             = Auth::user()->id;

            //paper 1

            $maxpossible_p1[$i]   = $mxmksp1;

            $student_marks_p1[$i] = $request->input("paper_1_$student_id[$i]");

            //paper 2

            $maxpossible_p2[$i]   = $mxmksp2;

            $student_marks_p2[$i] = $request->input("paper_2_$student_id[$i]");

        }

        
    for($i = 0; $i < count($student_id);$i++){

        if($student_marks_p1[$i] != NULL || $student_marks_p2[$i] != NULL ){

        $datax = array(
            'school_id' => $school_id,
            'student_id'=> $student_id[$i],
            'studentclass_id'=> $class_id[$i],
            'teacher_id' => $teacher_id[$i],
            'subject_id' => $subject_id[$i],
            'exam_date' => $examdate[$i],
            'year' => $current_year[$i],
            'term_id' => $term_id[$i],
            'maxmarks_paper_1' => $maxpossible_p1[$i],
            'maxmarks_paper_2' => $maxpossible_p2[$i],
            'marks_paper_1' => $student_marks_p1[$i],
            'marks_paper_2' => $student_marks_p2[$i],
            'create_id'=>$create_id[$i]
        );

        $data1[]= $datax;

    }

    }

            ///insert data 

            $paper1marks = DB::table('mark_schedules')->insert(
                $data1
            );

    
     
           /////show marks entered

           $marks = MarkSchedule::join('students','students.id','=','mark_schedules.student_id')
                                ->where('studentclass_id',$studentclassid)
                                ->where('subject_id',$subjectid)
                                ->where('year',$currentyear)
                                ->where('term_id',$termid)
                                ->get();

      
            ///
           // dd($marks);
          
            $marksarray = json_decode(json_encode($marks), true);

            for($i = 0; $i < count($marksarray); $i++){

                $marks_id[$i] = $marksarray[$i]['id'];

                $marks_student_id[$marks_id[$i]] = $marksarray[$i]['student_id'];


               
                    $maxpos_p1[$marks_id[$i]]     = $marksarray[$i]['maxmarks_paper_1'];

                    $maxpos_p2[$marks_id[$i]]     = $marksarray[$i]['maxmarks_paper_2'];
              
                    $paper_1_marks[$marks_id[$i]] = $marksarray[$i]['marks_paper_1'];

                    $paper_2_marks[$marks_id[$i]] = $marksarray[$i]['marks_paper_2'];

                    ////calculations

                    $percentage_p1[$marks_id[$i]]  = round(100*$paper_1_marks[$marks_id[$i]]/$maxpos_p1[$marks_id[$i]],2);

                    $percentage_p2[$marks_id[$i]]  = round(100*$paper_2_marks[$marks_id[$i]]/$maxpos_p2[$marks_id[$i]],2);

                    $aggregatepercentage[$marks_id[$i]] = round(0.5*($percentage_p1[$marks_id[$i]]+$percentage_p2[$marks_id[$i]]),2);
                    
            

            }

             /// subject rankings

             $x = $aggregatepercentage; arsort($x); 
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

 //$schoolclasses = SchoolClass::join('school_grades');
 
 /*
 $schoolclasses = SchoolClass::join('school_grades','school_classes.grade_id','=','school_grades.id')
 ->join('school_sub_classes','school_classes.subclass_id','=','school_sub_classes.id')
 ->get();
*/


$selectedsubjectx = Subject::where('id',$subjectid)->pluck('name');

$selectedsubject = $selectedsubjectx[0];

$subject_id = $subject_id[0];

$viewData = compact(
    'marks',
    //'students',
    //'subjects',
    'subject_id',
    'termid',
    'testdate',
    'selectedsubject',
    'currentyear',
    'percentage_p1',
    'percentage_p2',
    'num_subject_papers',
    'aggregatepercentage',
    'rankedAggregates',
    'school_name'
);

return view('marks.viewjustentered',$viewData);


        }elseif($num_subject_papers == 3){

            //dd($currentyear);
             //validating
           $validatedData = $request->validate([
            'studentclass_id'=>'required',
            'teacher_id'=>'required',
            'subject_id'=>'required',
            'testdate'=>'required',
            'term_id'=>'required',
            'subject_papers'=>'required',
            'max_marks_p1'=>'required',
            'max_marks_p2'=>'required',
            'max_marks_p3'=>'required',
        ]);


        //


        //

        $teacherid            = $request->input('teacher_id');
        $subjectid            = $request->input('subject_id');
        $studentclassid       = $request->input('studentclass_id');
        $testdate             = $request->input('testdate');
        $termid               = $request->input('term_id');
        $mxmksp1               = $request->input('max_marks_p1');   //maximum possible marks for paper 1
        $mxmksp2               = $request->input('max_marks_p2');   //maximum possible marks for paper 2
        $mxmksp3               = $request->input('max_marks_p3');   //maximum possible marks for paper 3

        //

       /* $class_students = StudentClass::join('students','student_classes.student_id','=','students.id')
        ->where('schoolclass_id',$schoolclass_id)
        ->where('year',$currentyear)
        ->get();
     
        $class_students = Student::join('student_classes','students.id','=','student_classes.student_id')
        //->join('student_classes','school_classes.id','=','student_classes.schoolclass_id')
        //->join('school_sub_classes','school_classes.subclass_id','=','school_sub_classes.id')
        //->where('student_classes.id',$studentclassid )
        //->where('student_classes.year',$currentyear)
        ->get();
      

        $checkduplication = MarkSchedule::where('teacher_id',$teacherid)
                                         ->where('subject_id',$subjectid)
                                         ->where('testdate',$testdate)
                                         ->where('year',$current_year)
                                         ->where('studentclass_id',$studentclassid)
                                         ->get();

        dd($checkduplication);
  */
        $class_students = DB::table('students')
            ->join('student_classes', 'student_classes.student_id', '=', 'students.id')
            ->join('school_classes', 'school_classes.id','=', 'student_classes.schoolclass_id')
            ->join('school_grades', 'school_grades.id', '=' , 'school_classes.grade_id')
            ->join('school_sub_classes', 'school_sub_classes.id', '=' , 'school_classes.subclass_id')
            ->where('school_classes.id','=',$studentclassid)
            ->where('student_classes.year','=',$currentyear)
            ->select('students.id','students.firstname','students.lastname','school_grades.grade','school_sub_classes.subclasses','school_classes.grade_id','school_classes.subclass_id')
        ->get();

//dd($class_students);



foreach($class_students as $class_student){

$i = 0;

    $class_student_id[] = $class_student->id;

}

//dd($class_student_id);
            
        for($i = 0; $i < count($class_students); $i++){


            $student_id[$i]       = $class_student_id[$i];

            $teacher_id[$i]       = $teacherid;

            $class_id[$i]         = $studentclassid;

            $subject_id[$i]       = $subjectid;

            $examdate[$i]         = $testdate;

            $current_year[$i]      = $currentyear;

            $term_id[$i]          = $termid;

            $create_id[$i]             = Auth::user()->id;

            //paper 1

            $maxpossible_p1[$i]   = $mxmksp1;

            $student_marks_p1[$i] = $request->input("paper_1_$student_id[$i]");

            //paper 2

            $maxpossible_p2[$i]   = $mxmksp2;

            $student_marks_p2[$i] = $request->input("paper_2_$student_id[$i]");

            //paper 3

            $maxpossible_p3[$i]   = $mxmksp3;

            $student_marks_p3[$i] = $request->input("paper_3_$student_id[$i]");

        }

        
    for($i = 0; $i < count($student_id);$i++){
 
if($student_marks_p1[$i] != NULL || $student_marks_p2[$i] != NULL || $student_marks_p3[$i] != NULL  ){

    $datax = array(

        'school_id'=>$school_id,
        'student_id'=> $student_id[$i],
        'studentclass_id'=> $class_id[$i],
        'teacher_id' => $teacher_id[$i],
        'subject_id' => $subject_id[$i],
        'exam_date' => $examdate[$i],
        'year' => $current_year[$i],
        'term_id' => $term_id[$i],
        'maxmarks_paper_1' => $maxpossible_p1[$i],
        'maxmarks_paper_2' => $maxpossible_p2[$i],
        'maxmarks_paper_3' => $maxpossible_p3[$i],
        'marks_paper_1' => $student_marks_p1[$i],
        'marks_paper_2' => $student_marks_p2[$i],
        'marks_paper_3' => $student_marks_p3[$i],
        'create_id'=>$create_id[$i]
    );

    $data1[]= $datax;

}

}
        



//dd($data1);
            ///insert data 

            $paper1marks = DB::table('mark_schedules')->insert(
                $data1
            );

    
     
           /////show marks entered

           $marks = MarkSchedule::join('students','students.id','=','mark_schedules.student_id')
                                ->where('studentclass_id',$studentclassid)
                                ->where('subject_id',$subjectid)
                                ->where('year',$currentyear)
                                ->where('term_id',$termid)
                                ->get();

      
            ///
           // dd($marks);
          
            $marksarray = json_decode(json_encode($marks), true);

            for($i = 0; $i < count($marksarray); $i++){

                $marks_id[$i] = $marksarray[$i]['id'];

                $marks_student_id[$marks_id[$i]] = $marksarray[$i]['student_id'];


               
                    $maxpos_p1[$marks_id[$i]]     = $marksarray[$i]['maxmarks_paper_1'];

                    $maxpos_p2[$marks_id[$i]]     = $marksarray[$i]['maxmarks_paper_2'];

                    $maxpos_p3[$marks_id[$i]]     = $marksarray[$i]['maxmarks_paper_3'];
              
                    $paper_1_marks[$marks_id[$i]] = $marksarray[$i]['marks_paper_1'];

                    $paper_2_marks[$marks_id[$i]] = $marksarray[$i]['marks_paper_2'];

                    $paper_3_marks[$marks_id[$i]] = $marksarray[$i]['marks_paper_3'];

                    ////calculations

                    $percentage_p1[$marks_id[$i]]  = round(100*$paper_1_marks[$marks_id[$i]]/$maxpos_p1[$marks_id[$i]],2);

                    $percentage_p2[$marks_id[$i]]  = round(100*$paper_2_marks[$marks_id[$i]]/$maxpos_p2[$marks_id[$i]],2);

                    $percentage_p3[$marks_id[$i]]  = round(100*$paper_3_marks[$marks_id[$i]]/$maxpos_p3[$marks_id[$i]],2);

                    $aggregatepercentage[$marks_id[$i]] = round(0.333*($percentage_p1[$marks_id[$i]]+$percentage_p2[$marks_id[$i]]+$percentage_p3[$marks_id[$i]]),2);
                    
            

            }

             /// subject rankings

             $x = $aggregatepercentage; arsort($x); 
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

 //$schoolclasses = SchoolClass::join('school_grades');
 
 /*
 $schoolclasses = SchoolClass::join('school_grades','school_classes.grade_id','=','school_grades.id')
 ->join('school_sub_classes','school_classes.subclass_id','=','school_sub_classes.id')
 ->get();
*/


$selectedsubjectx = Subject::where('id',$subjectid)->pluck('name');

$selectedsubject = $selectedsubjectx[0];

$subject_id = $subject_id[0];

$viewData = compact(
    'marks',
    //'students',
    //'subjects',
    'subject_id',
    'termid',
    'testdate',
    'selectedsubject',
    'currentyear',
    'percentage_p1',
    'percentage_p2',
    'percentage_p3',
    'num_subject_papers',
    'aggregatepercentage',
    'rankedAggregates',
    'school_name'
);

return view('marks.viewjustentered',$viewData);


        }elseif($num_subject_papers == 4){

 //validating
 $validatedData = $request->validate([
    'studentclass_id'=>'required',
    'teacher_id'=>'required',
    'subject_id'=>'required',
    'testdate'=>'required',
    'term_id'=>'required',
    'subject_papers'=>'required',
    'max_marks_p1'=>'required',
    'max_marks_p2'=>'required',
    'max_marks_p3'=>'required',
    'max_marks_p4'=>'required',
    
]);


//


//

$teacherid            = $request->input('teacher_id');
$subjectid            = $request->input('subject_id');
$studentclassid       = $request->input('studentclass_id');
$testdate             = $request->input('testdate');
$termid               = $request->input('term_id');
$mxmksp1               = $request->input('max_marks_p1');   //maximum possible marks for paper 1
$mxmksp2               = $request->input('max_marks_p2');   //maximum possible marks for paper 2
$mxmksp3               = $request->input('max_marks_p3');   //maximum possible marks for paper 3
$mxmksp4               = $request->input('max_marks_p4');   //maximum possible marks for paper 4

//

/* $class_students = StudentClass::join('students','student_classes.student_id','=','students.id')
->where('schoolclass_id',$schoolclass_id)
->where('year',$currentyear)
->get();

$class_students = Student::join('student_classes','students.id','=','student_classes.student_id')
//->join('student_classes','school_classes.id','=','student_classes.schoolclass_id')
//->join('school_sub_classes','school_classes.subclass_id','=','school_sub_classes.id')
//->where('student_classes.id',$studentclassid )
//->where('student_classes.year',$currentyear)
->get();


$checkduplication = MarkSchedule::where('teacher_id',$teacherid)
                                 ->where('subject_id',$subjectid)
                                 ->where('testdate',$testdate)
                                 ->where('year',$current_year)
                                 ->where('studentclass_id',$studentclassid)
                                 ->get();

dd($checkduplication);
*/
$class_students = DB::table('students')
    ->join('student_classes', 'student_classes.student_id', '=', 'students.id')
    ->join('school_classes', 'school_classes.id','=', 'student_classes.schoolclass_id')
    ->join('school_grades', 'school_grades.id', '=' , 'school_classes.grade_id')
    ->join('school_sub_classes', 'school_sub_classes.id', '=' , 'school_classes.subclass_id')
    ->where('school_classes.id','=',$studentclassid)
    ->where('student_classes.year','=',$currentyear)
    ->select('students.id','students.firstname','students.lastname','school_grades.grade','school_sub_classes.subclasses','school_classes.grade_id','school_classes.subclass_id')
->get();

//dd($class_students);



foreach($class_students as $class_student){

$i = 0;

$class_student_id[] = $class_student->id;

}

//dd($class_student_id);
    
for($i = 0; $i < count($class_students); $i++){


    $student_id[$i]       = $class_student_id[$i];

    $teacher_id[$i]       = $teacherid;

    $class_id[$i]         = $studentclassid;

    $subject_id[$i]       = $subjectid;

    $examdate[$i]         = $testdate;

    $current_year[$i]      = $currentyear;

    $term_id[$i]          = $termid;

    $create_id[$i]             = Auth::user()->id;

    //paper 1

    $maxpossible_p1[$i]   = $mxmksp1;

    $student_marks_p1[$i] = $request->input("paper_1_$student_id[$i]");

    //paper 2

    $maxpossible_p2[$i]   = $mxmksp2;

    $student_marks_p2[$i] = $request->input("paper_2_$student_id[$i]");

    //paper 3

    $maxpossible_p3[$i]   = $mxmksp3;

    $student_marks_p3[$i] = $request->input("paper_3_$student_id[$i]");

    //paper 4

    $maxpossible_p4[$i]   = $mxmksp4;

    $student_marks_p4[$i] = $request->input("paper_4_$student_id[$i]");


}


for($i = 0; $i < count($student_id);$i++){

    if($student_marks_p1[$i] != NULL || $student_marks_p2[$i] != NULL || $student_marks_p3[$i] != NULL || $student_marks_p4[$i] != NULL  ){


$datax = array(
    'school_id'=>$school_id,
    'student_id'=> $student_id[$i],
    'studentclass_id'=> $class_id[$i],
    'teacher_id' => $teacher_id[$i],
    'subject_id' => $subject_id[$i],
    'exam_date' => $examdate[$i],
    'year' => $current_year[$i],
    'term_id' => $term_id[$i],
    'maxmarks_paper_1' => $maxpossible_p1[$i],
    'maxmarks_paper_2' => $maxpossible_p2[$i],
    'maxmarks_paper_3' => $maxpossible_p3[$i],
    'maxmarks_paper_4' => $maxpossible_p4[$i],
    'marks_paper_1' => $student_marks_p1[$i],
    'marks_paper_2' => $student_marks_p2[$i],
    'marks_paper_3' => $student_marks_p3[$i],
    'marks_paper_4' => $student_marks_p4[$i],
    'create_id'=>$create_id[$i]
);

$data1[]= $datax;

}

}

    ///insert data 

    $paper1marks = DB::table('mark_schedules')->insert(
        $data1
    );



   /////show marks entered

   $marks = MarkSchedule::join('students','students.id','=','mark_schedules.student_id')
                        ->where('studentclass_id',$studentclassid)
                        ->where('subject_id',$subjectid)
                        ->where('year',$currentyear)
                        ->where('term_id',$termid)
                        ->get();


    ///
   // dd($marks);
  
    $marksarray = json_decode(json_encode($marks), true);

    for($i = 0; $i < count($marksarray); $i++){

        $marks_id[$i] = $marksarray[$i]['id'];

        $marks_student_id[$marks_id[$i]] = $marksarray[$i]['student_id'];


       
            $maxpos_p1[$marks_id[$i]]     = $marksarray[$i]['maxmarks_paper_1'];

            $maxpos_p2[$marks_id[$i]]     = $marksarray[$i]['maxmarks_paper_2'];

            $maxpos_p3[$marks_id[$i]]     = $marksarray[$i]['maxmarks_paper_3'];

            $maxpos_p4[$marks_id[$i]]     = $marksarray[$i]['maxmarks_paper_4'];
      
            $paper_1_marks[$marks_id[$i]] = $marksarray[$i]['marks_paper_1'];

            $paper_2_marks[$marks_id[$i]] = $marksarray[$i]['marks_paper_2'];

            $paper_3_marks[$marks_id[$i]] = $marksarray[$i]['marks_paper_3'];

            $paper_4_marks[$marks_id[$i]] = $marksarray[$i]['marks_paper_4'];

            ////calculations

            $percentage_p1[$marks_id[$i]]  = round(100*$paper_1_marks[$marks_id[$i]]/$maxpos_p1[$marks_id[$i]],2);

            $percentage_p2[$marks_id[$i]]  = round(100*$paper_2_marks[$marks_id[$i]]/$maxpos_p2[$marks_id[$i]],2);

            $percentage_p3[$marks_id[$i]]  = round(100*$paper_3_marks[$marks_id[$i]]/$maxpos_p3[$marks_id[$i]],2);

            $percentage_p4[$marks_id[$i]]  = round(100*$paper_4_marks[$marks_id[$i]]/$maxpos_p4[$marks_id[$i]],2);


            $aggregatepercentage[$marks_id[$i]] = round(0.25*($percentage_p1[$marks_id[$i]]+$percentage_p2[$marks_id[$i]] + $percentage_p3[$marks_id[$i]]+$percentage_p4[$marks_id[$i]]),2);
            
    

    }

     /// subject rankings

     $x = $aggregatepercentage; arsort($x); 
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

//$schoolclasses = SchoolClass::join('school_grades');

/*
$schoolclasses = SchoolClass::join('school_grades','school_classes.grade_id','=','school_grades.id')
->join('school_sub_classes','school_classes.subclass_id','=','school_sub_classes.id')
->get();
*/


$selectedsubjectx = Subject::where('id',$subjectid)->pluck('name');

$selectedsubject = $selectedsubjectx[0];

$subject_id = $subject_id[0];

$viewData = compact(
'marks',
//'students',
//'subjects',
'termid',
'subject_id',
'testdate',
'selectedsubject',
'currentyear',
'percentage_p1',
'percentage_p2',
'percentage_p3',
'percentage_p4',
'num_subject_papers',
'aggregatepercentage',
'rankedAggregates',
'school_name'
);

return view('marks.viewjustentered',$viewData);

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