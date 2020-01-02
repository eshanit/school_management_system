<?php

namespace App\Http\Controllers\Admin;

use DB;
Use Auth;
use App\Subject;
use App\School;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubjectController extends Controller
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
         //validating
         $validatedData = $request->validate([
            'subjectcode' => 'required|max:50',
            'subjectname' => 'required',
            'numberpaper' => 'required',
            'level_id' => 'required'
        ]);


        $school_id = Auth::user()->school_id;

        $schools = School::where('id','=',$school_id)->get();


        foreach($schools as $school){

            $school_name = $school->schoolname;

            $school_level = $school->school_level;

        
        }


        ///import data from form
        $subject_code = $request->input('subjectcode');
        $subject_name = $request->input('subjectname');
        $number_paper = $request->input('numberpaper');
        $level_id     = $request->input('level_id');

        /// check duplicates

        $checkduplicate = Subject::where('code',$subject_code)
                                   ->where('school_id',$school_id)
                                   ->count();

        if($checkduplicate >= 1){

            return redirect()->route('admin.home') -> withErrorMessage("Subject $subject_code is already registered in the system");

        }else{

            $subject = new Subject();

            $subject->school_id = $school_id;
            $subject->code      = $subject_code;
            $subject->name      = $subject_name;
            $subject->school_id = $school_id;
            $subject->papers    = $number_paper;
            $subject->save();

            //insert subject level

            $subject_id = $subject->id;

            $data['school_id'] =  $school_id;

            $data['subject_id'] =  $subject_id;

            $data['level_id']   = $level_id;

            $subject_level = DB::table('subjectlevel')
                            ->insert(
                                $data
                            );


            
          return redirect()->route('admin.home')->withSuccessMessage("Subject $subject_name($subject_code) Successfully Added into database");


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
        $subject_delete = Subject::destroy($id);
        
        return redirect()->back()->withSuccessMessage('Subject deleted');
    }
}
