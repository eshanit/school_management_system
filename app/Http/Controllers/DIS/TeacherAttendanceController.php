<?php

namespace App\Http\Controllers\DIS;

use Auth;
use Carbon\Carbon;
use App\School;
use App\Teacher;
use App\TeacherAttendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class TeacherAttendanceController extends Controller
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
        // changes you make here make sure they are the same as Clerk/TeacherController/Index

        $school_id = $id;

        $schools = School::where('id','=',$school_id)->get();

        foreach($schools as $school){

            $school_name = $school->schoolname;

            //$school_level = $school->school_level;
        }

        $teacher_attendances = TeacherAttendance::join('teachers','teachers.id','=','teacher_attendances.teacher_id')
                                                ->join('users','users.id','=','teachers.user_id')
                                                ->where('teachers.school_id','=',$school_id)
                                                ->get();


        $school_teachers = Teacher::join('users','users.id','=','teachers.user_id')
                                    ->where('teachers.school_id','=',$school_id)->get();

//dd($teacher_attendances);

foreach($teacher_attendances as $teacher_attendance){

        $teacher_attendance_statuses[$teacher_attendance->date][$teacher_attendance->name] = $teacher_attendance->attendance;

        $teacher_attendance_notes[$teacher_attendance->date][$teacher_attendance->name] = $teacher_attendance->notes;

}

//dd($teacher_attendance_notes);

//$dates = array_keys($teacher_attendance_statuses);

//dd($dates);

//dd();

if(isset($teacher_attendance_statuses)){


    $viewData = compact(
        'school_id',
        'school_name',
        'school_teachers',
        'teacher_attendances',
        'teacher_attendance_notes',
        'teacher_attendance_statuses'
    );


    return view('clerk.teacher_attendance',$viewData);


}else{

    return redirect()->back()->withWarningMessage("No data for this school");

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
