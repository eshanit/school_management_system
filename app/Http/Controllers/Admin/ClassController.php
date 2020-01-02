<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\School;
use App\SchoolClass;
use App\SchoolGrade;
use App\SchoolSubClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClassController extends Controller
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
            'form' => 'required|max:50',
            'subclass' => 'required|max:50',
            'level_id' => 'required',
        ]);


        $school_id = Auth::user()->school_id;

        $schools = School::where('id','=',$school_id)->get();


        foreach($schools as $school){

            $school_name = $school->schoolname;

            $school_level = $school->school_level;

        
        }


        $grade = $request->input('form');

        $subclass = $request->input('subclass');

       $level_id = $request->input('level_id');

        ///step 1 > check if id exists

        $grade_idy = SchoolGrade::where('grade',$grade)
                                 ->where('schoollevel_id',$school_level)->get();

        $grade_id_count =  $grade_idy->count();

        if($grade_id_count != 0){

            $grade_idx = $grade_idy ->pluck('id');

           $grade_id = $grade_idx[0];

        }

       
        //dd($grade_id_count);

        $subclass_idy = SchoolSubClass::where('subclasses',$subclass)
                                        ->where('school_id',$school_id)
                                        ->get();

        $subclass_id_count = $subclass_idy->count();

        if($subclass_id_count != 0){

            $subclass_idx = $subclass_idy ->pluck('id');

            $subclass_id = $subclass_idx[0];

        }
       
        ///
        if(isset($grade_id) && isset($subclass_id)){
            $checkduplicate = SchoolClass::where('grade_id',$grade_id)
                                ->where('subclass_id',$subclass_id)
                                ->where('school_id',$school_id)
                                ->get();

        $checkduplicatecount = $checkduplicate->count();

        }else{

            $checkduplicatecount = 0;
        }
        
        

        if($checkduplicatecount >= 1){

            return redirect()->route('admin.home') -> withErrorMessage("class is already registered in the system");
            

        }else{

            ///form/grade

            //check if grade exists


            ///

            if($grade_id_count == 0){

                $schoolgrade = new SchoolGrade();

                $schoolgrade->grade = $grade;

                $schoolgrade->schoollevel_id = $school_level;

                $schoolgrade->save();


                //$schoolgrade_idx = SchoolGrade::where('grade',$grade)->pluck('id');

               // $schoolgrade_id = $schoolgrade_idx[0];

               $schoolgrade_id = $schoolgrade->id;
    
            }else{

                $schoolgrade_id = $grade_id;

            }

            


            //subclass


            //check if subclass exists

            if($subclass_id_count == 0){

                $schoolsubclass = new SchoolSubClass();

                $schoolsubclass->subclasses = $subclass;

                $schoolsubclass->school_id = $school_id;
    
                $schoolsubclass->save();
    
                //$schoolsubclass_idx = SchoolSubClass::where('subclasses',$subclass)->pluck('id');
    
                //$schoolsubclass_id = $schoolsubclass_idx[0];

                $schoolsubclass_id = $schoolsubclass->id;
    
            }else{

                $schoolsubclass_id = $subclass_id;
            }
           
            //insert into Schoolclasses

            $schoolclass = new SchoolClass();

            $schoolclass->school_id = $school_id;

            $schoolclass->grade_id = $schoolgrade_id;

            $schoolclass->subclass_id = $schoolsubclass_id;

            $schoolclass->level_id = $level_id;

            $schoolclass->save();

            return redirect()->route('admin.home')->withSuccessMessage("form $grade $subclass  Successfully Added into database");



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
        $schoolgradeclass_id = $id;

        $validatedData = $request->validate([
            'form' => 'required|max:50',
            'subclass' => 'required|max:50',
            'level_id' => 'required',
        ]);

///

$school_class = Schoolclass::where('id',$id)->get();

$grade_idx = $school_class->pluck('grade_id');

$subclass_idx = $school_class->pluck('subclass_id');

//

$grade_id = $grade_idx[0];

$subclass_id = $subclass_idx[0];

//update grade

$schoolgrade = new SchoolGrade();

$school_grade                          = $request->input('form');
$school_grade_updated_at               = carbon::now('Africa/Harare');

$schoolgrade = SchoolGrade::find($grade_id);
$schoolgrade -> update(
    [
        'grade' => $school_grade ,
        'updated_at' => $school_grade_updated_at
    ]
);

//update subclass

$schoolsubclass = new SchoolSubClass();

$school_sub_class  = $request->input('subclass');
$school_sub_class_updated_at = carbon::now('Africa/Harare');

$schoolsubclass = SchoolSubClass::find($subclass_id);
$schoolsubclass -> update(
    [
        'subclasses' => $school_sub_class,
        'updated_at' =>$school_sub_class_updated_at
    ]

    );

//update level

$schoolclass = new SchoolClass();

$level_id = $request->input('level_id');
$level_id_updated_at = carbon::now('Africa/Harare');

$schoolclass = SchoolClass::find($id);
$schoolclass -> update(
    [
        'level_id' => $level_id,
        'updated_at' => $level_id_updated_at
    ]
    );


return redirect()->back()->withSuccessMessage('Class Update Successfull');

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
        $school_class = Schoolclass::where('id',$id)->get();

        $grade_idx = $school_class->pluck('grade_id');

        $subclass_idx = $school_class->pluck('subclass_id');


        $grade_id = $grade_idx[0];

        $subclass_id = $subclass_idx[0];

        //remove from schoolclasstable

        $schoolclass_delete = SchoolClass::destroy($id);

        //remove from grade

        $school_grade = SchoolGrade::destroy($grade_id);

        //remove subclass

        $school_subclass = SchoolSubClass::destroy($subclass_id);
        
        return redirect()->back()->withSuccessMessage('Class deleted');


    }
}