<?php

namespace App\Http\Controllers\Teachers;

use DB;
use Auth;
use App\School;
use Carbon\Carbon;
use App\Teacher;
use App\Subject;
use App\ClassSubject;
use App\TeacherClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class SubjectClassController extends Controller
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
//
        $currentyear = carbon::now('Africa/Harare')->year;

        $subjects = Subject::where('school_id',$school_id)->get();

        $teacher_idx = Teacher::where('user_id',Auth::user()->id)->pluck('id');

        $teacher_id  = $teacher_idx[0];

        $schoolclass_idx = TeacherClass::where('teacher_id',$teacher_id)->pluck('schoolclass_id');

        $schoolclass_id = $schoolclass_idx[0];

///
$teacher_classes = TeacherClass::join('school_classes','teacher_classes.schoolclass_id','=','school_classes.id')
->join('school_grades','school_classes.grade_id','=','school_grades.id')
->join('school_sub_classes','school_classes.subclass_id','=','school_sub_classes.id')
->where('teacher_classes.teacher_id',$teacher_id)
->where('teacher_classes.year',$currentyear)
->get();

//dd($teacher_classes);
///

if(session('success_message')){

    Alert::success('Success', session('success_message'));

}elseif(session('warning_message')){

Alert::warning('Edit Failed', session('warning_message'));

}elseif(session('error_message')){

Alert::error('Registration Failed', session('error_message'));

}

///
        $viewData = compact(
            'subjects',
            'teacher_id',
            'schoolclass_id',
            'school_name',
            'school_id'
        );

        return view('teachers.subjectallocate',$viewData);



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
        //
        $subjects = Subject::all();

        $schoolclass_id = $request->input('schoolclass_id');

        foreach($subjects as $subject){

            $subject_idx[$subject->id] = $request->input("subject_$subject->id");

            if($subject_idx[$subject->id] != NULL){

                $subject_idy[$subject->id] = $subject_idx[$subject->id];
            }

        }

     $currentyear = carbon::now('Africa/Harare')->year;

     $subject_id = array_values($subject_idy);

        //dd($subject_id);

        for($i=0; $i < count($subject_id); $i++){

            $datax = array(
                'school_id'=> $school_id,
                'schoolclass_id'=> $schoolclass_id,
                'subject_id' => $subject_id[$i],
                'year' => $currentyear,
                'create_id'=>Auth::user()->id
            );

            $data[]= $datax;

            $duplicatecheck = ClassSubject::where('schoolclass_id',$schoolclass_id)
                                       ->where('subject_id',$subject_id[$i])
                                       ->where('year',$currentyear)
                                       ->count();  
                                       
                                       //dd($duplicatecheck);

        }

if($duplicatecheck == 0){

    $insertsubjects = DB::table('class_subjects')->insert(
        $data
    );

    return redirect()->route('teacher.index') -> withSuccessMessage("Subjects successifully added to class");


}else{

    return redirect()->back() -> withErrorMessage("Some or all of the subjects you selected have already been allocated for this claass");
 
}
        
//dd($data);


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
         //validating
         $validatedData = $request->validate([
            'schoolclass_id' => 'required|max:50',
            'subject_id' => 'required|max:50',
        ]);

//
$school_id = Auth::user()->school_id;

$schools = School::where('id','=',$school_id)->get();

foreach($schools as $school){

    $school_name = $school->schoolname;

    $school_level = $school->school_level;


}

//
        $oldsubject_id = $id;

        $schoolclass_id = $request->input('schoolclass_id');

        $newsubject_id  = $request->input('subject_id');

        $currentyear = carbon::now('Africa/Harare')->year;

        $duplicatecheck = ClassSubject::where('schoolclass_id',$schoolclass_id)
                                      ->where('subject_id',$newsubject_id)
                                      ->where('year',$currentyear)
                                      ->count();

        

        if($duplicatecheck >= 1){

            return redirect()->back() -> withWarningMessage("Subjects alreaady added to class");



        }else{

            $current_idx = ClassSubject::where('schoolclass_id',$schoolclass_id)
                                        ->where('subject_id',$id)
                                        ->where('year',$currentyear)
                                        ->pluck('id');

            $current_id = $current_idx[0];

            //input into students table
   $class_subject = new ClassSubject();

   $school_class_id                  = $schoolclass_id;
   $new_subject_id                   = $newsubject_id;  
   $current_year                     = $currentyear;
   $subject_update_id                = Auth::user()->id;
   $subject_updated_at               = carbon::now('Africa/Harare');

   $class_subject = ClassSubject::find($current_id);
   
   $class_subject -> update(
       [
           'schoolclass_id' => $school_class_id,
           'subject_id'     => $new_subject_id ,
           'year'           => $current_year,
           'update_id'      => $subject_update_id,
           'updated_at'     => $subject_updated_at
       ]
   );

   return redirect()-> back() -> withSuccessMessage("Subject successifully adited to class");

    }

}

   /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {

      //Softdelete
      DB::table('class_subjects')->where('subject_id', '=', $id)
      ->delete();

     return redirect()->back();
   
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