<?php

namespace App\Http\Controllers\DIS;

use DB;
use Auth;
use Carbon\Carbon;
use App\User;
use App\School;
use App\Discalendar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         //
         $currentdate = carbon::now('Africa/Harare');

         $calendars = DB::table('discalendars')
                                 ->orderBy('event_date', 'desc')
                                 ->get();
 
         //past
         $calendars_past = DisCalendar::where('event_date','<',$currentdate)
                                     ->count();
 
 
         //present
         $calendars_present = Discalendar::where('event_date','=',$currentdate)
                                     ->count();
 
         //future
         $calendars_future = Discalendar::where('event_date','>',$currentdate)
                                          ->count();
 
 
         ///
         $users = User::all();
 
         foreach($users as $user){
 
             $user_name[$user->id] = $user->name;
 
         }
         ///
 
         $viewData = compact(
             'calendars',
             'currentdate',
             'calendars_past',
             'calendars_present',
             'calendars_future',
             'user_name',
 
         );
 
          //
          if(session('success_message')){
 
             Alert::success('Success', session('success_message'));
 
     }elseif(session('warning_message')){
 
         Alert::warning('Failed', session('warning_message'));
 
 }elseif(session('error_message')){
 
     Alert::error('Failed', session('error_message'));
 
 }
        
 
         return view('dis.calendar',$viewData);
 
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


            $duplicateCheck = Discalendar::where('event_date',$event_date)
                                       ->where('event_heading',$event_desc)
                                       ->where('event_description',$event_details)
                                       ->count();

        if($duplicateCheck == 0){

            $calendar = new Discalendar();

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
   $calendar = new Discalendar();

   $calendar_date                = $request -> input('eventdate');
   $calender_heading             = $request -> input('eventdesc');  
   $calender_details             = $request -> input('eventdetails');
   $calender_update_id           = Auth::user()->id;
   $calender_updated_at          = carbon::now('Africa/Harare');

   $calendar = Discalendar::find($id);
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
    }
}
