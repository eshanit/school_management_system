<?php

namespace App\Http\Controllers\Teachers;

use DB;
use Auth;
use App\School;
use App\Teacher;
use App\Subject;
use Carbon\Carbon;
use App\SchoolClass;
use App\TeacherClass;
use App\ClassSubject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class TeachersController extends Controller
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

        $genders = DB::table('gender')->get();

        $currentyear = carbon::now('Africa/Harare')->year;

        $allsubjects = Subject::all();
      

        $teacher_idx = Teacher::where('user_id',Auth::user()->id)->get();

        if($teacher_idx->count() > 0){
   
            $teacher_idy = $teacher_idx->pluck('id');

            if(isset($teacher_idy)){

                $teacher_id   = $teacher_idy[0];

                $currentclasses = TeacherClass::where('teacher_id',$teacher_id)
                                            ->join('school_classes','teacher_classes.schoolclass_id','=','school_classes.id')
                                            ->join('school_grades','school_classes.grade_id','=','school_grades.id')
                                            ->join('school_sub_classes','school_classes.subclass_id','=','school_sub_classes.id')
                                            ->where('year',$currentyear)
                                            ->get();


                ///

                $currentclasses_count = $currentclasses->count();


                $past_classes = TeacherClass::where('teacher_id',$teacher_id)
                                ->where('year','<',$currentyear)
                                ->get();


                $pastclasses_count = $past_classes->count();

                ///
            }else{

                $currentclasses_count = 0;

                $pastclasses_count = 0;

            }
        
        }else{

            
            $currentclasses_count = 0;

            $pastclasses_count = 0;

            $teacher_id = NULL;
        }


        if(session('success_message')){

            Alert::success('Success', session('success_message'));
        
        }elseif(session('warning_message')){
        
        Alert::warning('Operation Failed', session('warning_message'));
        
        }elseif(session('error_message')){
        
        Alert::error('Registration Failed', session('error_message'));
        
        }

//dd($currentclasses);
if(!isset($currentclasses)){

    $currentclasses=NULL;

    $pastclasses_count = 0;

    $currentclasses_count = 0;

    $allocation_status = 0;
            
}

        $viewData = compact(
            'teacher_id',
            'currentclasses',
            'pastclasses_count',
            'currentclasses_count',
            'school_name',
            'school_id'
        );


        return view('teachers.home',$viewData);

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
