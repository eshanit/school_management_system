<?php

namespace App\Http\Controllers\Students;

use Auth;
use App\School;
use Carbon\Carbon;
use App\SchoolClass;
use App\StudentClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentsClassController extends Controller
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

         //validating
         $validatedData = $request->validate([
            'schoolgrade_id'=>'required',
            'schoolclass_id'=>'required',
        ]);

        $school_id = Auth::user()->school_id;

        $schoollevel_id = School::where('id','=',$school_id)->pluck('school_level');

        $schools = School::where('id','=',$school_id)->get();

        foreach($schools as $school){

            $school_name = $school->schoolname;

            $school_level = $school->school_level;

        
        }
       

        $student_id     = $request->input('student_id');
        //dd($student_id);
        $schoolgrade_id = $request->input('schoolgrade_id');
        $schoolclass_id = $request->input('schoolclass_id');

        //dd($student_id);

        //select class

        $schoolclasses = SchoolClass::where([
            ['grade_id', '=', $schoolgrade_id],
            ['subclass_id', '=', $schoolclass_id],
            ['school_id','=', $school_id]
            ])->get();

        $schoolclassessarray = json_decode(json_encode($schoolclasses), true);

        $gradeclass_id = $schoolclassessarray[0]['id'];
        

        //insert into class table
        $student_class = new StudentClass();

       // dd($school_id);

        $student_class->student_id             = $student_id;
        $student_class->schoolclass_id         = $gradeclass_id;
        $student_class->school_id              = $school_id;
        $student_class->year                   = carbon::now('Africa/Harare')->year;
        $student_class->create_id              = Auth::user()->id;
        $student_class->created_at             = carbon::now('Africa/Harare');
        $student_class->save();



        return redirect()->route('home') -> withSuccessMessage("Student Class Successfully Added");



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
        $school_id = Auth::user()->school_id;

        $schools = School::where('id','=',$school_id)->get();

        foreach($schools as $school){

            $school_name = $school->schoolname;

            $school_level = $school->school_level;

        
        }
        
            //validating
            $validatedData = $request->validate([
                'schoolgrade_id'=>'required',
                'schoolclass_id'=>'required',
            ]);
    

   //input into students table
   $studentclass = new StudentClass();

   $student_schoolgrade_id           = $request -> input('schoolgrade_id');  
   $student_schoolclass_id           = $request -> input('schoolclass_id');
   $student_update_id                = Auth::user()->id;
   $student_updated_at               = carbon::now('Africa/Harare');

   //find the school class id

    $school_grade_classes = SchoolClass::where('grade_id',$student_schoolgrade_id)
                                       ->where('subclass_id',$student_schoolclass_id)
                                       ->get();


                                 foreach($school_grade_classes as $school_grade_class){

                                        $schoolclass_id =  $school_grade_class -> id;
                                 
                                     }

if(isset($schoolclass_id)){

  
 
    ///
 
    $studentclass = StudentClass::where('student_id',$id);
    $studentclass -> update(
        [
            'schoolclass_id' => $schoolclass_id,
            'update_id' => $student_update_id,
            'updated_at' => $student_updated_at
        ]
    );
 
    
    return redirect()->route('home') -> withSuccessMessage("Student Class Successfully changed");
 
}else{

    return redirect()->route('home') -> withWarningMessage("Student Class not changed, could not find class");
 

}
    
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