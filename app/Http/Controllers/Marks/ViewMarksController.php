<?php

namespace App\Http\Controllers\Marks;

use DB;
use Auth;
use App\School;
use App\MarkSchedule;
use App\Teacher;
use App\Subject;
use App\ClassSubject;
use App\TeacherClass;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;


class VieWMarksController extends Controller
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

        $terms = DB::table('terms')->get();

        $user_id = Auth::user()->id;

        $teacher_idx = Teacher::where('user_id',$user_id)->pluck('id');

        $teacher_id = $teacher_idx[0];


        /// check school level
        
        $schoolclass_idx = TeacherClass::where('teacher_id',$teacher_id)->pluck('schoolclass_id');

        $schoolclass_id  = $schoolclass_idx[0];

        $school_level_id = DB::table('school_classes')
                           ->where('id',$schoolclass_id)
                           ->pluck('level_id');


        ///
     /*   $subjects = Subject::join('subjectlevel','subjects.id','=','subjectlevel.subject_id')
        ->where('subjectlevel.level_id',$school_level_id[0])
        ->get();
    */

        $subjects = ClassSubject::join('subjects','subjects.id','=','class_subjects.subject_id')
        ->where('class_subjects.year',$currentyear)
         ->where('class_subjects.schoolclass_id',$schoolclass_id)
       ->get();


//dd($teacher_id);


if(session('success_message')){

    Alert::success('Success', session('success_message'));

}elseif(session('warning_message')){

Alert::warning('Operation Failed', session('warning_message'));

}elseif(session('error_message')){

Alert::error('Registration Failed', session('error_message'));

}



        $viewData = compact(
            'terms',
            'subjects',
            'currentyear',
            'teacher_id',
            'school_name'
        );
    
        return view('marks.viewentered', $viewData);


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

    public function show($id){

 //
 $school_id = Auth::user()->school_id;

 $schools = School::where('id','=',$school_id)->get();

 foreach($schools as $school){

     $school_name = $school->schoolname;

     $school_level = $school->school_level;

 
 }
 //
 $currentyear = carbon::now('Africa/Harare')->year;

 $terms = DB::table('terms')->get();

 ///$user_id = $id;

 ///$teacher_idx = Teacher::where('user_id',$user_id)->pluck('id');

 ///$teacher_id = $teacher_idx[0];


 /// check school level
 
 ///$schoolclass_idx = TeacherClass::where('teacher_id',$teacher_id)->pluck('schoolclass_id');

 $schoolclass_id  = $id;

 $school_level_id = DB::table('school_classes')
                    ->where('id',$schoolclass_id)
                    ->pluck('level_id');
///class teacher

$teacher_idx = TeacherClass::where('schoolclass_id',$schoolclass_id)->pluck('teacher_id');

$teacher_id = $teacher_idx[0]; 

 ///
 $subjects = Subject::join('subjectlevel','subjects.id','=','subjectlevel.subject_id')
 ->where('subjectlevel.level_id',$school_level_id[0])
 ->get();



//dd($teacher_id);

 $viewData = compact(
     'terms',
     'subjects',
     'currentyear',
     'teacher_id',
     'school_name',
     'school_id'
 );

 return view('marks.viewentered', $viewData);

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_view(Request $request ,$id)
    {


           //validating
           $validatedData = $request->validate([
            'term_id'=>'required',
            'subject_id'=>'required'
        ]);
//
$school_id = Auth::user()->school_id;

$schools = School::where('id','=',$school_id)->get();

foreach($schools as $school){

    $school_name = $school->schoolname;

    $school_level = $school->school_level;


}

//
$terms = DB::table('terms')->get();

        //
            $term_id        = $request->input('term_id');

            $subject_id     = $request->input('subject_id');

            $termid = $term_id;

           

        //
        $currentyear = $currentyear = carbon::now('Africa/Harare')->year;
        //
        $teacher_id = $id;

        //select class_id

        $schoolclass_idx = TeacherClass::where('teacher_id',$teacher_id)->pluck('schoolclass_id');

        $schoolclass_id  = $schoolclass_idx[0];

        //dd($schoolclass_id);
        //;

        //dd($subject_id);

        if($subject_id == 0){ //for all subjects

           
           /////show marks entered

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

           
            if($marks->count() == 0){

                
                return redirect()-> back() ->withWarningMessage("No data for this period");


            }else{

              ///
          foreach($marks as $mark){

            $subjectsx[] = $mark->subject_id;

          }
          ///
            $subjects = array_values(array_unique($subjectsx));
    

          $marksarray = json_decode(json_encode($marks), true);
          

          for($i = 0; $i < count($marksarray); $i++){
           
           $marks_id[$i] = $marksarray[$i]['id'];



           $subjects_id[$marks_id[$i]]   = $marksarray[$i]['subject_id'];

           $test_date[$marks_id[$i]]   = $marksarray[$i]['exam_date'];

           ///

           $maxpos_p1[$marks_id[$i]]     = $marksarray[$i]['maxmarks_paper_1'];

           $maxpos_p2[$marks_id[$i]]     = $marksarray[$i]['maxmarks_paper_2'];

           $maxpos_p3[$marks_id[$i]]     = $marksarray[$i]['maxmarks_paper_3'];

           $maxpos_p4[$marks_id[$i]]     = $marksarray[$i]['maxmarks_paper_4'];

           ///

           $paper_1_marks[$marks_id[$i]] = $marksarray[$i]['marks_paper_1'];

           $paper_2_marks[$marks_id[$i]] = $marksarray[$i]['marks_paper_2'];

           $paper_3_marks[$marks_id[$i]] = $marksarray[$i]['marks_paper_3'];

           $paper_4_marks[$marks_id[$i]] = $marksarray[$i]['marks_paper_4'];

            ///

            $num_papers[$marks_id[$i]]  = $marksarray[$i]['papers'];

           ///
           $percentage_p1[$marks_id[$i]]  = round(100*$paper_1_marks[$marks_id[$i]]/$maxpos_p1[$marks_id[$i]],2);

           $percentage_p2[$marks_id[$i]]  = round(100*$paper_2_marks[$marks_id[$i]]/$maxpos_p2[$marks_id[$i]],2);


           if($paper_3_marks[$marks_id[$i]] != NULL){

            $percentage_p3[$marks_id[$i]]  = round(100*$paper_3_marks[$marks_id[$i]]/$maxpos_p3[$marks_id[$i]],2);

           }else{

            $percentage_p3[$marks_id[$i]]  = "-";

           }

           if($paper_4_marks[$marks_id[$i]] != NULL){

            $percentage_p4[$marks_id[$i]]  = round(100*$paper_4_marks[$marks_id[$i]]/$maxpos_p4[$marks_id[$i]],2);

           }else{

            $percentage_p4[$marks_id[$i]]  = "-";

           }

           ///
           if($num_papers[$marks_id[$i]] == 2){

            $aggregatepercentage[$marks_id[$i]] = round(0.5*($percentage_p1[$marks_id[$i]]+$percentage_p2[$marks_id[$i]]),2);

           }elseif($num_papers[$marks_id[$i]] == 3){

            $aggregatepercentage[$marks_id[$i]] = round(0.333*($percentage_p1[$marks_id[$i]]+$percentage_p2[$marks_id[$i]]+$percentage_p3[$marks_id[$i]]),2);

           }elseif($num_papers[$marks_id[$i]] == 4){

            $aggregatepercentage[$marks_id[$i]] = round(0.25*($percentage_p1[$marks_id[$i]]+$percentage_p2[$marks_id[$i]]+$percentage_p3[$marks_id[$i]]+$percentage_p4[$marks_id[$i]]),2);

           }
           

          }

          //dd($aggregatepercentage);

          
          $testdate    = $marksarray[0]['exam_date'];
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
         

         

         $selectedsubject = "All";

$viewData = compact(
 'marks',
 //'students',
 //'subjects',
 'termid',
 'testdate',
 'selectedsubject',
 'currentyear',
 'percentage_p1',
 'percentage_p2',
 'percentage_p3',
 'percentage_p4',
 'aggregatepercentage',
 'rankedAggregates',
 'school_name',
 'school_id'
);



return view('marks.viewallentered',$viewData);
                

            }
        
 


        }else{

             ///check number of papers

             $subject_papersx = Subject::where('id',$subject_id)->pluck('papers');

             $num_subject_papers  = $subject_papersx[0];

            $marks = MarkSchedule::join('students','students.id','=','mark_schedules.student_id')
            ->where('studentclass_id',$schoolclass_id)
            ->where('subject_id',$subject_id)
            ->where('year',$currentyear)
            ->where('term_id',$term_id)
            ->get();


           if($marks->count() == 0){

                
            return redirect()-> back() ->withWarningMessage("No data for this period");


        }else{

               
        if($num_subject_papers == 2){

            
            $marksarray = json_decode(json_encode($marks), true);
 
            for($i = 0; $i < count($marksarray); $i++){
 
                $marks_id[$i] = $marksarray[$i]['id'];
 
                $marks_student_id[$marks_id[$i]] = $marksarray[$i]['student_id'];
 
 
               
                    $maxpos_p1[$marks_id[$i]]     = $marksarray[$i]['maxmarks_paper_1'];
 
                    $maxpos_p2[$marks_id[$i]]     = $marksarray[$i]['maxmarks_paper_2'];
 
                    $maxpos_p3[$marks_id[$i]]     = "-";
 
                    $maxpos_p4[$marks_id[$i]]     = "-";
              
                    $paper_1_marks[$marks_id[$i]] = $marksarray[$i]['marks_paper_1'];
 
                    $paper_2_marks[$marks_id[$i]] = $marksarray[$i]['marks_paper_2'];
                    
                    $paper_3_marks[$marks_id[$i]] = "-";
 
                    $paper_4_marks[$marks_id[$i]] = "-";
 
                    $test_date[$marks_id[$i]]   = $marksarray[$i]['exam_date'];
 
 
                    ////calculations
 
                    $percentage_p1[$marks_id[$i]]  = round(100*$paper_1_marks[$marks_id[$i]]/$maxpos_p1[$marks_id[$i]],2);
 
                    $percentage_p2[$marks_id[$i]]  = round(100*$paper_2_marks[$marks_id[$i]]/$maxpos_p2[$marks_id[$i]],2);
 
                    $percentage_p3[$marks_id[$i]]  = "-";
 
                    $percentage_p4[$marks_id[$i]]  = "-";
 
 
                    $aggregatepercentage[$marks_id[$i]] = round(0.5*($percentage_p1[$marks_id[$i]]+$percentage_p2[$marks_id[$i]]),2);
            }     
 
 
         }elseif($num_subject_papers == 3){
 
             
            $marksarray = json_decode(json_encode($marks), true);
 
            for($i = 0; $i < count($marksarray); $i++){
 
                $marks_id[$i] = $marksarray[$i]['id'];
 
                $marks_student_id[$marks_id[$i]] = $marksarray[$i]['student_id'];
 
 
               
                    $maxpos_p1[$marks_id[$i]]     = $marksarray[$i]['maxmarks_paper_1'];
 
                    $maxpos_p2[$marks_id[$i]]     = $marksarray[$i]['maxmarks_paper_2'];
              
                    $maxpos_p3[$marks_id[$i]]     = $marksarray[$i]['maxmarks_paper_3'];
 
                    $maxpos_p4[$marks_id[$i]]     = "-";
 
                    //
 
                    $paper_1_marks[$marks_id[$i]] = $marksarray[$i]['marks_paper_1'];
 
                    $paper_2_marks[$marks_id[$i]] = $marksarray[$i]['marks_paper_2'];
 
                    $paper_3_marks[$marks_id[$i]] = $marksarray[$i]['marks_paper_3'];
 
                    $paper_4_marks[$marks_id[$i]] = "-";
 
 
                    $test_date[$marks_id[$i]]   = $marksarray[$i]['exam_date'];
 
 
                    ////calculations
 
                    $percentage_p1[$marks_id[$i]]  = round(100*$paper_1_marks[$marks_id[$i]]/$maxpos_p1[$marks_id[$i]],2);
 
                    $percentage_p2[$marks_id[$i]]  = round(100*$paper_2_marks[$marks_id[$i]]/$maxpos_p2[$marks_id[$i]],2);
 
                    $percentage_p3[$marks_id[$i]]  = round(100*$paper_3_marks[$marks_id[$i]]/$maxpos_p3[$marks_id[$i]],2);
 
                    $percentage_p4[$marks_id[$i]]  = "-";
 
 
                    $aggregatepercentage[$marks_id[$i]] = round(0.333*($percentage_p1[$marks_id[$i]]+$percentage_p2[$marks_id[$i]]+$percentage_p3[$marks_id[$i]]),2);
            }
 
            
            
         }elseif($num_subject_papers == 4){
 
 
             $marksarray = json_decode(json_encode($marks), true);
 
             for($i = 0; $i < count($marksarray); $i++){
  
                 $marks_id[$i] = $marksarray[$i]['id'];
  
                 $marks_student_id[$marks_id[$i]] = $marksarray[$i]['student_id'];
  
  
                
                     $maxpos_p1[$marks_id[$i]]     = $marksarray[$i]['maxmarks_paper_1'];
  
                     $maxpos_p2[$marks_id[$i]]     = $marksarray[$i]['maxmarks_paper_2'];
               
                     $maxpos_p3[$marks_id[$i]]     = $marksarray[$i]['maxmarks_paper_3'];
  
                     $maxpos_p4[$marks_id[$i]]     = $marksarray[$i]['maxmarks_paper_4'];
                     //
  
                     $paper_1_marks[$marks_id[$i]] = $marksarray[$i]['marks_paper_1'];
  
                     $paper_2_marks[$marks_id[$i]] = $marksarray[$i]['marks_paper_2'];
 
                     $paper_3_marks[$marks_id[$i]] = $marksarray[$i]['marks_paper_3'];
  
                     $paper_4_marks[$marks_id[$i]] = $marksarray[$i]['marks_paper_4'];
  
  
                     $test_date[$marks_id[$i]]   = $marksarray[$i]['exam_date'];
  
  
                     ////calculations
  
                     $percentage_p1[$marks_id[$i]]  = round(100*$paper_1_marks[$marks_id[$i]]/$maxpos_p1[$marks_id[$i]],2);
  
                     $percentage_p2[$marks_id[$i]]  = round(100*$paper_2_marks[$marks_id[$i]]/$maxpos_p2[$marks_id[$i]],2);
  
                     $percentage_p3[$marks_id[$i]]  = round(100*$paper_3_marks[$marks_id[$i]]/$maxpos_p3[$marks_id[$i]],2);
  
                     $percentage_p4[$marks_id[$i]]  = round(100*$paper_4_marks[$marks_id[$i]]/$maxpos_p4[$marks_id[$i]],2);
  
                     $aggregatepercentage[$marks_id[$i]] = round(0.25*($percentage_p1[$marks_id[$i]]+$percentage_p2[$marks_id[$i]]+$percentage_p3[$marks_id[$i]]+$percentage_p4[$marks_id[$i]]),2);
 
 
         };
 
        }
 
         $testdate    = $marksarray[0]['exam_date'];
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
 
        $selectedsubjectx = Subject::where('id',$subject_id)->pluck('name');
 
        $selectedsubject = $selectedsubjectx[0];
 
        
   
 $viewData = compact(
 'marks',
 //'students',
 //'subjects',
 'termid',
 'subject_id',
 'testdate',
 'selectedsubject',
 'currentyear',
 'marks_id',
 'marks_student_id',
 'percentage_p1',
 'percentage_p2',
 'percentage_p3',
 'percentage_p4',
 'num_subject_papers',
 'aggregatepercentage',
 'rankedAggregates',
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




 return view('marks.viewjustentered',$viewData);
 

        }
        

     }
           ///    
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
        $school_id = Auth::user()->school_id;

        $schools = School::where('id','=',$school_id)->get();

        foreach($schools as $school){

            $school_name = $school->schoolname;

            $school_level = $school->school_level;

        
        }
        
        $num_papers = $request->input('subject_paper_numbers');

        $markschedule = new MarkSchedule();

//dd($num_papers);
         //validating

        if($num_papers == 2){

            $validatedData = $request->validate([
                'paper_1' => 'required',
                'paper_2' => 'required',
            ]);
    
        $paper_1_marks = $request -> input('paper_1');
        $paper_2_marks = $request -> input('paper_2');
        $student_marks_update_id       = Auth::user()->id;
        $student_marks_updated_at      = carbon::now('Africa/Harare');
        
        $markschedule = MarkSchedule::find($id);
        $markschedule -> update(
            [
                    'marks_paper_1' => $paper_1_marks,
                    'marks_paper_2' => $paper_2_marks,
                    'update_id'     => $student_marks_update_id,
                    'updated_at'    => $student_marks_updated_at
            ]
        );

            
    
        }elseif($num_papers == 3){

            $validatedData = $request->validate([
                'paper_1' => 'required',
                'paper_2' => 'required',
                'paper_3' => 'required',
            ]);

             
        $paper_1_marks = $request -> input('paper_1');
        $paper_2_marks = $request -> input('paper_2');
        $paper_3_marks = $request -> input('paper_3');
        $student_marks_update_id       = Auth::user()->id;
        $student_marks_updated_at      = carbon::now('Africa/Harare');

        $markschedule = MarkSchedule::find($id);
        $markschedule -> update(
            [
                    'marks_paper_1' => $paper_1_marks,
                    'marks_paper_2' => $paper_2_marks,
                    'marks_paper_3' => $paper_3_marks,
                    'update_id'     => $student_marks_update_id,
                    'updated_at'    => $student_marks_updated_at
            ]
        );

        }elseif($num_papers == 4){

            $validatedData = $request->validate([
                'paper_1' => 'required',
                'paper_2' => 'required',
                'paper_3' => 'required',
            ]);

             
        $paper_1_marks = $request -> input('paper_1');
        $paper_2_marks = $request -> input('paper_2');
        $paper_3_marks = $request -> input('paper_3');
        $paper_4_marks = $request -> input('paper_4');
        $student_marks_update_id       = Auth::user()->id;
        $student_marks_updated_at      = carbon::now('Africa/Harare');

        $markschedule = MarkSchedule::find($id);
        $markschedule -> update(
            [
                    'marks_paper_1' => $paper_1_marks,
                    'marks_paper_2' => $paper_2_marks,
                    'marks_paper_3' => $paper_3_marks,
                    'marks_paper_4' => $paper_4_marks,
                    'update_id'     => $student_marks_update_id,
                    'updated_at'    => $student_marks_updated_at
            ]
        );
            
        }
            

       
    return redirect()->route('teachermarksview.index')->withSuccessMessage("Marks Successfully Updated");
         



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