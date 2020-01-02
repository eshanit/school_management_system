<?php

namespace App\Http\Controllers\DIS;

use Auth;
use DB;
use App\Calender;
use App\User;
use App\School;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $calendars = DB::table('calenders')
                        ->orderBy('event_date', 'desc')
                        ->get();

                        $currentdate = carbon::now('Africa/Harare');

                        $schools = School::all();
                
                    if($schools->count() != 0){

                        foreach($schools as $school){
                
                            $school_name[$school->id] = $school->schoolname;
           
                        }

                         //past
                         $calendars_past = Calender::where('event_date','<',$currentdate)
                         ->count();


//present
$calendars_present = Calender::where('event_date','=',$currentdate)
                         ->count();

//future
$calendars_future = Calender::where('event_date','>',$currentdate)
                         ->count();


///
$users = User::all();

foreach($users as $user){

 $user_name[$user->id] = $user->name;

}
///

$viewData = compact(
 'calendars',
 'school_name',
 'currentdate',
 'calendars_past',
 'calendars_present',
 'calendars_future',
 'user_name'

);

 //
 if(session('success_message')){
                
    Alert::success('Success', session('success_message'));

}elseif(session('warning_message')){

Alert::warning('Failed', session('warning_message'));

}elseif(session('error_message')){

Alert::error('Failed', session('error_message'));

}


return view('dis.schoolcalendar',$viewData);


                    }else{

                        return redirect()->back()->withWarningMessage('No Calendars For any school Yet!');
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
    'schoolname' => 'required',
    'schoollevel_id' => 'required',
    'schooltype_id'=>'required',
    'schoolstatus_id'=>'required',
]);



$currentyear = carbon::now('Africa/Harare')->year;

//
$schoolname          = $request->input('schoolname');
$schoollevel_id      = $request->input('schoollevel_id');
$schooltype_id      = $request->input('schooltype_id');
$schoolstatus_id      = $request->input('schoolstatus_id');



///

$datacheck = School::where('schoolname',$schoolname)->count();

if($datacheck > 0){

    return redirect()->back()->withWarningMessage('School with same name already in the system');

}else{

    $school = new School();

    $school->schoolname     = $schoolname;
    $school->school_level   = $schoollevel_id;
    $school->school_type   = $schooltype_id;
    $school->school_status = $schoolstatus_id;
    $school->save();

    /***create school admin ***/

    $school_id = $school->id;

    $user = new User();

    $user->name        = 'Admin';
    $user->email        =  'admin'.$school_id.'@schoolmanagement.co.zw';
    $user->password     = Hash::make('administrator');
    $user->school_id    = $school_id;
    $user->save();

    ///

    $user_id = $user->id;

                $data['user_id']   = $user_id;
                $data['role_id']   = 1;
                $data['year']      = $currentyear;
                $data['create_id'] = Auth::user()->id;

    DB::table('role_user')
            ->insert($data);


    ///

    return redirect()->back()->withSuccessMessage('School successfully registered in the system');


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