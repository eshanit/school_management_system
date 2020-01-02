<?php

namespace App\Http\Controllers\Clerk;

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
        // changes you make here make sure they are the same as DIS/TeacherController/show

        $school_id = Auth::user()->school_id;

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



if($teacher_attendances->count() != 0){

    foreach($teacher_attendances as $teacher_attendance){

        $teacher_attendance_statuses[$teacher_attendance->date][$teacher_attendance->name] = $teacher_attendance->attendance;

        $teacher_attendance_notes[$teacher_attendance->date][$teacher_attendance->name] = $teacher_attendance->notes;

}

//dd($teacher_attendances);

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

    return redirect()->back()->withWarningMessage('There is no data for Teacher Attendance report');

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

        //validating
$validatedData = $request->validate([
    'teacher_id' => 'required',
    'attendance_date'=>'required',
    'attendance_status'=>'required',
]);

$teacher_id = $request->input('teacher_id');

$attendance_date = $request->input('attendance_date');

$attendance_status = $request->input('attendance_status');

$attendance_notes  = $request->input('attendance_notes');


//dd($teacher_id);
///check if attendance has not been registered already

$datacheck = TeacherAttendance::where('teacher_id',$teacher_id)
                               ->where('date',$attendance_date)
                               ->count();

///


if($datacheck > 0){

    return redirect()->back()->withWarningMessage('Attendance for this Teacher on this date has already been registered');

}else{


    $teacher_attendance = new TeacherAttendance();

    $teacher_attendance->teacher_id             = $teacher_id;
    $teacher_attendance->date                   = $attendance_date;
    $teacher_attendance->attendance             = $attendance_status;
    $teacher_attendance->notes                  = $attendance_notes;
    $teacher_attendance->create_id              = Auth::user()->id;
    $teacher_attendance->created_at             = carbon::now('Africa/Harare');
    $teacher_attendance->save();


return redirect()->back()->withSuccessMessage('Attendance successifully registered!');



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

        
        $school_idx = Teacher::where('id',$id)->pluck('school_id');

        $school_id = $school_idx[0];

        $schools = School::where('id','=',$school_id)->get();

        foreach($schools as $school){

            $school_name = $school->schoolname;

            //$school_level = $school->school_level;
        }

        ////
        
     
        //show attendance register for a particular teacher

        $teacher_attendances = TeacherAttendance::join('teachers','teachers.id','=','teacher_attendances.teacher_id')
                                                 ->join('users','users.id','=','teachers.user_id')
                                                 ->where('teacher_id','=',$id)->get();
                                                 

        $teacher_absent_days = TeacherAttendance::join('teachers','teachers.id','=','teacher_attendances.teacher_id')
                                                ->join('users','users.id','=','teachers.user_id')
                                                ->where('teacher_attendances.teacher_id','=',$id)
                                                ->where('teacher_attendances.attendance','=',0)
                                                ->count();

        $teacher_present_days = TeacherAttendance::join('teachers','teachers.id','=','teacher_attendances.teacher_id')
                                                ->join('users','users.id','=','teachers.user_id')
                                                ->where('teacher_attendances.teacher_id','=',$id)
                                                ->where('teacher_attendances.attendance','=',1)
                                                ->count();

if($teacher_attendances->count() != 0){

    if($teacher_attendances->count() != 0){

    
        $teacher_absent_rate  = round(100*$teacher_absent_days/($teacher_attendances->count()),2);
    
        $teacher_present_rate  = round(100*$teacher_present_days/($teacher_attendances->count()),2);
    
    }else{
    
        
        $teacher_absent_rate  = 0;
    
        $teacher_present_rate  = 0;
    }
    
    //
    
    $teacher_namex = $teacher_attendances->pluck('name');
    
    $teacher_name = $teacher_namex[0];
            
    
            $viewData = compact(
                'teacher_name',
                'teacher_attendances',
                'teacher_absent_days',
                'teacher_present_days',
                'teacher_absent_rate',
                'teacher_present_rate',
                'school_name',
                'school_id'
            );
    
            return view('teachers.teacher_attendance',$viewData);
                

}else{

            return redirect()->back()->withWarningMessage('No Attendance data for this teacher!');

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
