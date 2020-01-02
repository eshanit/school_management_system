<?php

namespace App\Http\Controllers\Students;

use DB;
use Auth;
use App\School;
use App\Student;
use App\Guardian;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;


class StudentsController extends Controller
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
            'firstname' => 'required|max:50',
            'lastname' => 'required|max:50',
            'gender_id'=>'required',
            'birthnumber' =>'required',
            'dateofbirth'=>'required|date',
            'guardian_firstname' => 'required|max:50',
            'guardian_lastname' => 'required|max:50',
            'guardian_idnumber'=>'required'
            //'address'=>'required',
        ]);

    // check if student is already registered

    $school_id = Auth::user()->school_id;

    $schools = School::where('id','=',$school_id)->get();

    foreach($schools as $school){

        $school_name = $school->schoolname;

        $school_level = $school->school_level;

    
    }

        $birthnumber = $request->input('birthnumber');

        $checkduplicate = Student::where('birthnumber',strtoupper($birthnumber))->get();

        $checkduplicatecount = $checkduplicate->count();
        


if($checkduplicatecount >= 1 ){

    return redirect()->route('home') -> withErrorMessage("A student with same Id, $birthnumber , is already registered in the system");
 
}else{

    //input into students table
   $student = new Student();

   $student->school_id                = $school_id;
   $student->firstname                = $request -> input('firstname');
   $student->middlename               = $request -> input('middlename');  
   $student->lastname                 = $request -> input('lastname');
   $student->gender_id                = $request -> input('gender_id');
   $student->dateofbirth              = $request -> input('dateofbirth');
   $student->birthnumber              = strtoupper($birthnumber);
   $student->date_enrolled            = $request -> input('dateofenrollment');
   $student->create_id                = Auth::user()->id;
   $student->created_at               = carbon::now('Africa/Harare');
   $student->activestatus_id          = 1;
   $student->save();

   //

   $studentid = $student->id;

   //input into guardian table
   $guardian = new Guardian();

   $guardian->school_id                = $school_id;
   $guardian->first_name               = $request -> input('guardian_firstname');
   $guardian->middle_name              = $request -> input('guardian_middlename');  
   $guardian->last_name                = $request -> input('guardian_lastname');
   $guardian->idnumber                 = $request -> input('guardian_idnumber');
   $guardian->address                  = $request -> input('guardian_address');
   $guardian->phonenumber              = $request -> input('guardian_cellnumber');
   $guardian->email                    = $request -> input('guardian_email');
   $guardian->student_id               = $studentid;
   $guardian->create_id                = Auth::user()->id;
   $guardian->created_at               = carbon::now('Africa/Harare');
   $guardian->save();


   $studentname = $request -> input('firstname');

   return redirect()->route('home')->withSuccessMessage("$studentname's Successfully Added");

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
//
         //validating
         $validatedData = $request->validate([
            'firstname' => 'required|max:50',
            'lastname' => 'required|max:50',
            'gender_id'=>'required',
            'dateofbirth'=>'required|date',
            'guardian_firstname' => 'required|max:50',
            'guardian_lastname' => 'required|max:50',
            //'address'=>'required',
        ]);



   //input into students table
   $student = new Student();

   $student_firstname                = $request -> input('firstname');
   $student_middlename               = $request -> input('middlename');  
   $student_lastname                 = $request -> input('lastname');
   $student_gender_id                = $request -> input('gender_id');
   $student_dateofbirth              = $request -> input('dateofbirth');
   $student_birthnumber              = $request -> input('birthnumber');
   $student_date_enrolled            = $request -> input('dateofenrollment');
   $student_update_id                = Auth::user()->id;
   $student_updated_at               = carbon::now('Africa/Harare');

   $student = Student::find($id);
   $student -> update(
       [
           'firstname' => $student_firstname,
           'middlename' => $student_middlename,
           'lastname'=> $student_lastname,
           'gender_id' => $student_gender_id,
           'dateofbirth' => $student_dateofbirth,
           'birthnumber' => $student_birthnumber,
           'date_enrolled' => $student_date_enrolled,
           'update_id' => $student_update_id,
           'updated_at' => $student_updated_at
       ]
   );


   //input into guardian table
   $guardian = new Guardian();

   $guardian_first_name               = $request -> input('guardian_firstname');
   $guardian_middle_name              = $request -> input('guardian_middlename');  
   $guardian_last_name                = $request -> input('guardian_lastname');
   $guardian_address                  = $request -> input('guardian_address');
   $guardian_phonenumber              = $request -> input('guardian_cellnumber');
   $guardian_email                    = $request -> input('guardian_email');
   $guardian_update_id                = Auth::user()->id;
   $guardian_updated_at               = carbon::now('Africa/Harare');

   $guardian = Guardian::find($id);
   $guardian -> update(
       [
        'first_name' => $guardian_first_name,
        'middle_name' => $guardian_middle_name,
        'last_name' => $guardian_last_name,
        'address' => $guardian_address,
        'phonenumber' => $guardian_phonenumber,
        'email' => $guardian_email,
        'update_id' => $guardian_update_id,
        'updated_at' => $guardian_updated_at
       ]
 );


   $studentname = $request -> input('firstname');

   return redirect()->route('home')->withSuccessMessage("$studentname information Successfully Updated");


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
      DB::table('students')->where('id', '=', $id)
      ->update(['activestatus_id'=>2]);

     return redirect()->route('home');
   
    }

      
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function undelete($id)
    {

      //Softdelete
      DB::table('students')->where('id', '=', $id)
      ->update(['activestatus_id'=>1]);

     return redirect()->route('home');
   
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