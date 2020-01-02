<?php

namespace App\Http\Controllers\Clerk;

use DB;
use Auth;
use Carbon\Carbon;
use App\User;
use App\School;
use App\Calender;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class CalenderController extends Controller
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
        $school_id = Auth::user()->school_id;

        $schools = School::where('id','=',$school_id)->get();

        foreach($schools as $school){

            $school_name = $school->schoolname;

            //$school_level = $school->school_level;

        
        }

          //validating
          $validatedData = $request->validate([
            'eventdate' => 'required',
            'eventdesc' => 'required|max:50',
            'eventdetails'=>'required'
            //'address'=>'required',
        ]);

            $event_date = $request->input('eventdate');
            $event_desc = $request->input('eventdesc');
            $event_details = $request->input('eventdetails');


            $duplicateCheck = Calender::where('school_id',$school_id)
                                       ->where('event_date',$event_date)
                                       ->where('event_heading',$event_desc)
                                       ->where('event_description',$event_details)
                                       ->count();

        if($duplicateCheck == 0){

            $calendar = new Calender();

            $calendar->school_id  = $school_id;
            $calendar->event_date = $event_date;
            $calendar->event_heading = $event_desc;
            $calendar->event_description = $event_details;
            $calendar->create_id = Auth::user()->id;
            $calendar->save();

            return redirect()->back()->withSuccessMessage('Event Successifully registered');

            }else{

            return redirect()->back()->withWarningMessage('Event already registered');

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
        $currentdate = carbon::now('Africa/Harare');

        $school_id = $id;

        $schools = School::where('id','=',$school_id)
                          ->get();

        foreach($schools as $school){

            $school_name = $school->schoolname;

            //$school_level = $school->school_level;
        }


        $calendars = Calender::where('school_id',$school_id)
                                ->orderBy('event_date', 'desc')
                                ->get();

        //past
        $calendars_past = Calender::where('school_id',$school_id)
                                    ->where('event_date','<',$currentdate)
                                    ->count();


        //present
        $calendars_present = Calender::where('school_id',$school_id)
                                    ->where('event_date','=',$currentdate)
                                    ->count();

        //future
        $calendars_future = Calender::where('school_id',$school_id)
                                    ->where('event_date','>',$currentdate)
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
            'user_name',
            'school_id'

        );

         //
         if(session('success_message')){

            Alert::success('Success', session('success_message'));

    }elseif(session('warning_message')){

        Alert::warning('Failed', session('warning_message'));

}elseif(session('error_message')){

    Alert::error('Failed', session('error_message'));

}
       

        return view('clerk.calendar',$viewData);

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
       
           //validating
           $validatedData = $request->validate([
            'eventdate' => 'required',
            'eventdesc' => 'required|max:50',
            'eventdetails'=>'required'
            //'address'=>'required',
        ]);

        
   //input into students table
   $calendar = new Calender();

   $calendar_date                = $request -> input('eventdate');
   $calender_heading             = $request -> input('eventdesc');  
   $calender_details             = $request -> input('eventdetails');
   $calender_update_id           = Auth::user()->id;
   $calender_updated_at          = carbon::now('Africa/Harare');

   $calendar = Calender::find($id);
   $calendar -> update(
       [
           'event_date' => $calendar_date,
           'event_heading' => $calender_heading,
           'event_description'=> $calender_details,
           'update_id' => $calender_update_id,
           'updated_at' => $calender_updated_at
       ]
   );

   return redirect()->back()->withSuccessMessge('Event Successifully Updated');


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
            //
            $event_delete = Calender::destroy($id);
        
            return redirect()->back()->withSuccessMessage('Event deleted');
    }
}
