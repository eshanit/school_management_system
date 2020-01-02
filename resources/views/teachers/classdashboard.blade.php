@extends('layouts.app_og')

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small Box (Stat card) -->
        <h5 class="mb-2 mt-4"><strong>Dashboard</strong>| <font color='green'><i>{{ $class_students->count() }}</i></font> Students in this class|   <a role="button" class="btn  btn-outline-danger btn-sm"
            data-toggle="modal"
                        data-target="#attendance_register">Attendance portal</a></h5>
        <div class="row">


            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $classname }}</h3>

                        <p>Class</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-school"></i>
                    </div>
                    <span class="small-box-footer" style="cursor:pointer" data-toggle="modal"
                        data-target="#schoolclasses">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </span>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $subjects->count() }}</h3>

                        <p>Learning  Areas</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <a href="" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $malestudents -> count() }} | {{$percentage_male_students}}<sup
                                style="font-size: 20px">%</sup></h3>

                        <p>Male Students</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-male"></i>
                    </div>
                    <span class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </span>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $femalestudents -> count() }} | {{$percentage_female_students}}<sup
                                style="font-size: 20px">%</sup></h3>

                        <p>Female Students</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-female"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    @if(Auth::user()->hasRole("Teacher"))
                    <strong>Marks Portal</strong>: <button type="button" class="btn btn-outline-info btn-sm"
                        data-toggle="modal" data-target="#enterMarks">Enter Marks</button>
                    @else
                    <strong>Marks Portal</strong>: <button type="button" class="btn btn-outline-info btn-sm"
                        data-toggle="modal" data-target="#enterMarks" disabled>Enter Marks</button>
                    @endif
                    |
                    @if(Auth::user()->hasRole("Head") || Auth::user()->hasRole("Deputy Head") || Auth::user()->hasRole("dis")  )
                    <a role="button" class="btn  btn-outline-danger btn-sm"
                        href="{{ route('teachermarksview.show',$schoolclass_id) }}">View
                        Marks</a>
                    @elseif(Auth::user()->hasRole("Teacher"))
                    <a role="button" class="btn  btn-outline-danger btn-sm"
                        href="{{ route('teachermarksview.index') }}">View
                        Marks</a>
                    @endif
                    | <button type="button" class="btn  btn-outline-warning btn-sm" data-toggle="modal"
                        data-target="#viewMarksSchedule"><strong>Final
                            Mark Schedule</strong></button>
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                <table id="students" class="table table-bordered table-striped" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Student Name</th>
                            <th scope="col">Student Middlename</th>
                            <th scope="col">Student Surname</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Info</th>
                            <th scope="col">Status</th>
                            <th scope="col">Attendance</th>
                            <th scope="col">Reports</th>
                            <!--th scope="col">Edit/Delete</th-->
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = 1;
                        @endphp
                        @foreach ($class_students as $class_student)
                        <tr>
                            <td align='center'>{{ $i++ }}</td>
                            <td align='center'>{{ $class_student->firstname }}</td>
                            <td align='center'>{{ $class_student->middlename }}</td>
                            <td align='center'>{{ $class_student->lastname }}</td>
                            @if($class_student->gender_id == 1)
                            <td align='center'>
                                <font color='446dff'>Male</font>
                            </td>
                            @else
                            <td align='center'>
                                <font color='pink'>Female</font>
                            </td>
                            @endif
                            <td align='center'>
                                <span style="cursor:pointer">
                                    <font color='446dff'><a data-toggle="modal"
                                            data-target="#Studentinfo_<?php print_r($class_student->student_id);?>"><i
                                                class="fas fa-info-circle fa-lg"></i></a></font>
                                </span>
                            </td>
                            <td align='center'>
                                @if(($class_student->activestatus_id) == 1 )
                                <font color='green'><span title="Active" data-toggle="popover" data-trigger="hover"
                                        data-content="This student is still a part of the school."><i
                                            class="far fa-check-circle fa-lg"></i></span></font>
                                @else
                                <font color='red'><span title="InActive" data-toggle="popover" data-trigger="hover"
                                        data-content="This student is still NO LONGER a part of the school."><i
                                            class="fas fa-ban fa-lg"></i></span></font>
                                @endif
                            </td>
                            <td align='center'><a role="button" class="btn btn-block btn-outline-warning btn-sm" href="{{ route('student_attendance.show',[$class_student->student_id]) }}">View</a></td>
                          
                            <td align='center'>
                                <span style="cursor:pointer" data-toggle="modal"
                                    data-target="#reports_<?php print_r($class_student->student_id);?>">
                                    <i class="fas fa-chart-line fa-lg"></i>
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        @if($subjects != NULL)
        <hr>
        <div class="row justify-content-center">
       
            <div class="col-md-6">
            <h4><strong>Subjects allocated for this class.</strong></h4>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">
                                <font color='red'><strong>Learning Area Code</strong></font>
                            </th>
                            <th scope="col">
                                <font color='red'><strong>Learning Area</strong></font>
                            </th>
                            @if(Auth::user()->hasRole("Teacher"))
                            <th scope="col">
                                <font color='green'><strong>Action</strong></font>
                            </th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
     <?php
    
      $i=1;
    
    ?>
    
            @foreach($subjects as $subject)
                        <tr>
                            <th scope="row">{{$i++}}</th>
                            <td>{{ $subject->code }}</td>
                            <td>{{ $subject->name }}</td>
                            @if(Auth::user()->hasRole("Teacher"))
                            <td>
                                    <span style="cursor:pointer" data-toggle="modal" data-target="#editClassSubject_<?php print_r($subject->code);?>"><font color='orange'><i class="far fa-edit"></i></font></span> | 
                                    <font color='red'>
                                            <a class="delete-classsubject" data-classsubject-id="{{$subject->id}}"
                                                onclick="deleteClassSubject({{ $subject->id }})">
                                                <span style="cursor:pointer">
                                                        <i class="far fa-trash-alt"></i>
                                                </span>
                                            </a>
                                    </font>
                            </td>
                            @endif
                        </tr>
             @endforeach
                    </tbody>
                </table>
    
            </div>
        </div>
        @else
        <div class="row justify-content-center">
            <div class="col-md-6">
            <h4><strong>No subjects allocated for this class yet.</strong></h4>
            </div>
        </div>
    
    @endif
    
    </div>
    <!-- /.col -->
    </div>

    </div><!-- /.container-fluid -->
</section>

<!-- /.modal -->


<!-- Modal for student information -->

@foreach($class_students as $class_student)
<div class="modal fade" id="Studentinfo_<?php print_r($class_student->student_id);?>" tabindex="-1" role="dialog"
    aria-labelledby="infomodal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="infomodal"><strong>
                        <font color='446dff'>Student Information</font>
                    </strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="card bg-light">
                    <!--div class="card-header text-muted border-bottom-0">
                  Student
                </div-->
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-7">
                                <h2 class="lead"><b>{{ $class_student->firstname }} {{ $class_student->middlename }}
                                        {{ $class_student->lastname }}</b></h2>
                                <hr>
                                <p class="text-muted text-sm"><b>Gender: </b>
                                    @if($class_student->gender_id == 1)
                                    <font color='#446dff'> Male </font>
                                    @else
                                    <font color='#ff80ed'> Female </font>
                                    @endif
                                </p>
                                <p class="text-muted text-sm"><b>Date of Birth: </b>
                                    {{ $class_student->dateofbirth }}
                                </p>
                                </p>
                                <p class="text-muted text-sm"><b>Enrollment Date: </b>
                                    {{ $class_student->date_enrolled }}
                                </p>
                                <hr>
                                <p class="text-muted text-sm"><b>Guardian Name: </b>
                                    {{ $class_student->first_name }} {{ $class_student->middle_name }}
                                    {{ $class_student->last_name }}
                                </p>
                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"
                                                style="color:#ffd700"></i></span>
                                        <font color='#3f632a'><strong>Address</strong></font>:
                                        {{ $class_student->address }}
                                    </li>
                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"
                                                style="color:#ffd700"></i></span>
                                        <font color='#3f632a'><strong>Phone #</strong></font>:
                                        {{ $class_student-> phonenumber }}
                                    </li>
                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-at"
                                                style="color:#ffd700"></i></span>
                                        <font color='#3f632a'><strong>email</strong></font>:
                                        {{ $class_student-> email }}
                                    </li>
                                </ul>

                            </div>
                            <div class="col-5 text-center">
                                <img src="../../dist/img/user2-160x160.jpg" alt="" class="img-circle img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-right">
                            <a href="#" class="btn btn-sm bg-teal">
                                <i class="fas fa-comments"></i>
                            </a>
                            <a href="#" class="btn btn-sm btn-primary">
                                <i class="fas fa-user"></i> View Profile
                            </a>
                        </div>
                    </div>
                </div>

            </div>
            <!--div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div-->
        </div>
    </div>
</div>
@endforeach


<div class="modal fade" id="enterMarks" tabindex="-1" role="dialog" aria-labelledby="infomodal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="infomodal"><strong>
                        <font color='446dff'>Choose which term to enter marks</font>
                    </strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="">
                    <!--div class="card-header text-muted border-bottom-0">
                  Student
                </div-->
                    <div class="card-body pt-0">

                        <form class="form-horizontal" method="POST"
                            action="{{ route('teachermarksenter.entermarks') }}">

                            {{ csrf_field() }}
                            <input type='hidden' name='schoolclass_id' value='{{ $schoolclass_id }}'>
                            <div class="row col-12">
                                <div class="col-md">
                                    <div class="form-group">
                                        <label class="radio-inline">
                                            <input type="radio" name="term_id" value='1' checked><strong>Term 1</strong>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-group">
                                        <label class="radio-inline">
                                            <input type="radio" name="term_id" value='2'><strong>Term 2</strong>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-group">
                                        <label class="radio-inline">
                                            <input type="radio" name="term_id" value='3'><strong>Term 3</strong>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="Subject">
                                        <font color="red">*</font><strong>Subject</strong>
                                    </label>
                                    <select class="form-control" name='subject_id'>
                                        <option disabled selected>..Select Subject..</option>
                                        @foreach($subjects as $subject)
                                        <option value="{{$subject->subject_id}}">{{$subject->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                            <button type="submit" class="btn btn-primary float-right">Submit</button>
                        </form>
                        <!--div class="col-12 col-sm-4">
                                <form class="form-horizontal" method="POST"
                                    action="{{ route('teachermarksenter.entermarks') }}">

                                    {{ csrf_field() }}

                                    <input type='hidden' name='term_id' value='1'>
                                    <input type='hidden' name='level_id' value='{{ $level_id }}'>
                                    <input type='hidden' name='schoolclass_id' value='{{ $schoolclass_id }}'>

                                    <button class="info-box bg-light btn btn-block" type='submit'>
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Term</span>
                                            <span class="info-box-number text-center text-muted mb-0">1</span>
                                        </div>
                                    </button>
                                </form>
                            </div>
                            <div class="col-12 col-sm-4">
                                <form class="form-horizontal" method="POST"
                                    action="{{ route('teachermarksenter.entermarks') }}">

                                    {{ csrf_field() }}

                                    <input type='hidden' name='term_id' value='2'>
                                    <input type='hidden' name='level_id' value='{{ $level_id }}'>
                                    <input type='hidden' name='schoolclass_id' value='{{ $schoolclass_id }}'>

                                    <button class="info-box bg-light btn btn-block" type='submit'>
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Term</span>
                                            <span class="info-box-number text-center text-muted mb-0">2</span>
                                        </div>
                                    </button>
                                </form>
                            </div>
                            <div class="col-12 col-sm-4">
                                <form class="form-horizontal" method="POST"
                                    action="{{ route('teachermarksenter.entermarks') }}">

                                    {{ csrf_field() }}

                                    <input type='hidden' name='term_id' value='3'>
                                    <input type='hidden' name='level_id' value='{{ $level_id }}'>
                                    <input type='hidden' name='schoolclass_id' value='{{ $schoolclass_id }}'>

                                    <button class="info-box bg-light btn btn-block" type='submit'>
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Term</span>
                                            <span class="info-box-number text-center text-muted mb-0">3</span>
                                        </div>
                                    </button>
                                </form>
                            </div-->
                    </div>
                </div>
                <!--div class="card-footer">
                        <div class="text-right">
                            <a href="#" class="btn btn-sm bg-teal">
                                <i class="fas fa-comments"></i>
                            </a>
                            <a href="#" class="btn btn-sm btn-primary">
                                <i class="fas fa-user"></i> View Profile
                            </a>
                        </div>
                    </div-->
            </div>

        </div>
        <!--div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div-->
    </div>
</div>
</div>


<div class="modal fade" id="viewMarksSchedule" tabindex="-1" role="dialog" aria-labelledby="infomodal"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="infomodal"><strong>
                        <font color='orange'>Choose which term to view mark schedule</font>
                    </strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="">
                    <!--div class="card-header text-muted border-bottom-0">
                  Student
                </div-->
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-12 col-sm-4">
                                <form class="form-horizontal" method="POST"
                                    action="{{ route('teacher.markschedule') }}">

                                    {{ csrf_field() }}

                                    <input type='hidden' name='term_id' value='1'>
                                    <input type='hidden' name='level_id' value='{{ $level_id }}'>
                                    <input type='hidden' name='schoolclass_id' value='{{ $schoolclass_id }}'>

                                    <button class="info-box bg-light btn btn-block" type='submit'>
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Term</span>
                                            <span class="info-box-number text-center text-muted mb-0">1</span>
                                        </div>
                                    </button>
                                </form>
                            </div>
                            <div class="col-12 col-sm-4">
                                <form class="form-horizontal" method="POST"
                                    action="{{ route('teacher.markschedule') }}">

                                    {{ csrf_field() }}

                                    <input type='hidden' name='term_id' value='2'>
                                    <input type='hidden' name='level_id' value='{{ $level_id }}'>
                                    <input type='hidden' name='schoolclass_id' value='{{ $schoolclass_id }}'>

                                    <button class="info-box bg-light btn btn-block" type='submit'>
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Term</span>
                                            <span class="info-box-number text-center text-muted mb-0">2</span>
                                        </div>
                                    </button>
                                </form>
                            </div>
                            <div class="col-12 col-sm-4">
                                <form class="form-horizontal" method="POST"
                                    action="{{ route('teacher.markschedule') }}">

                                    {{ csrf_field() }}

                                    <input type='hidden' name='term_id' value='3'>
                                    <input type='hidden' name='level_id' value='{{ $level_id }}'>
                                    <input type='hidden' name='schoolclass_id' value='{{ $schoolclass_id }}'>

                                    <button class="info-box bg-light btn btn-block" type='submit'>
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Term</span>
                                            <span class="info-box-number text-center text-muted mb-0">3</span>
                                        </div>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--div class="card-footer">
                        <div class="text-right">
                            <a href="#" class="btn btn-sm bg-teal">
                                <i class="fas fa-comments"></i>
                            </a>
                            <a href="#" class="btn btn-sm btn-primary">
                                <i class="fas fa-user"></i> View Profile
                            </a>
                        </div>
                    </div-->
                </div>

            </div>
            <!--div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div-->
        </div>
    </div>
</div>

<!-- Modal for student information -->

@foreach($class_students as $class_student)
<div class="modal fade" id="reports_<?php print_r($class_student->student_id);?>" tabindex="-1" role="dialog"
    aria-labelledby="infomodal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="infomodal"><strong>
                        <font color='446dff'>Reports List for: {{ $class_student->firstname }}
                            {{ $class_student->middlename }}
                            {{ $class_student->lastname }} </font>
                    </strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <table id="students" class="table table-bordered table-striped" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">Class</th>
                            <th scope="col">Year</th>
                            <th scope="col">Term</th>
                            <th scope="col">report</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $classname }}
                            </td>
                            <td>{{ $currentyear }}
                            </td>
                            <td>1
                            </td>
                            <td>
                                <a href="{{ route('report.student', [$currentyear,1,$schoolclass_id,$class_student->student_id,]) }}"
                                    style="position: relative;">
                                    <i class="fas fa-chart-line"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>{{ $classname }}
                            </td>
                            <td>{{ $currentyear }}
                            </td>
                            <td>2
                            </td>
                            <td>
                                    <a href="{{ route('report.student', [$currentyear,2,$schoolclass_id,$class_student->student_id,]) }}"
                                            style="position: relative;">
                                            <i class="fas fa-chart-line"></i>
                                        </a>
                            </td>
                        </tr>
                        <tr>
                            <td>{{ $classname }}
                            </td>
                            <td>{{ $currentyear }}
                            </td>
                            <td>3
                            </td>
                            <td>
                                    <a href="{{ route('report.student', [$currentyear,3,$schoolclass_id,$class_student->student_id,]) }}"
                                            style="position: relative;">
                                            <i class="fas fa-chart-line"></i>
                                        </a>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
            <!--div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div-->
        </div>
    </div>
</div>
@endforeach
<!-- modal for editing subjects -->


@foreach($subjects as $subject)
<div class="modal fade" id="editClassSubject_<?php print_r($subject->code);?>" tabindex="-1" role="dialog"
    aria-labelledby="editing" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editing"><strong>
                        Change: <font color='#96384e'> {{$subject->code}}| {{$subject->name}}:</font>

                    </strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form class="form-horizontal" method="POST" action="{{ route('subjectclass.update',[$subject->id]) }}">
            
                {{ method_field('PUT') }}

                    {{ csrf_field() }}

                <input type='hidden' name='schoolclass_id' value='{{ $schoolclass_id }}' />


                    <div class="form-group">
                        <label for="School Grade">
                            <font color="red">*</font><strong>Subjects</strong>
                        </label>
                        <select class="form-control" name='subject_id'>
                            <option disabled selected>..Select Subject..</option>
                            @foreach($allsubjects as $allsubject)
                            <option value="{{$allsubject-> id}}">{{$allsubject -> name}}</option>
                            @endforeach
                        </select>
                    </div>


                    <button type="submit" class="btn btn-info float-right">Submit</button>
                </form>

            </div>
            <!--div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div-->
        </div>
    </div>
</div>
@endforeach

<div class="modal fade" id="attendance_register" tabindex="-1" role="dialog"
    aria-labelledby="editing" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editing"><strong>
                        Select Term

                    </strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">

                <div class='col-4'>
                        <a  href="{{ route('attendance.index',[1,$schoolclass_id,]) }}"> 
                <div class="card card-body">
                    <dl>
                     Term 1 
                    </dl>
                 </div>
                </a>
                </div>

                <div class='col-4'>
                        <a  href="{{ route('attendance.index',[2,$schoolclass_id,]) }}"> 
                 <div class="card card-body">
                       
                    <dl>
                      Term 2
                    </dl>
                
                 </div>
                </a>
                </div>

                <div class='col-4'>
                        <a  href="{{ route('attendance.index',[$currentyear,2,$schoolclass_id,]) }}"> 
                 <div class="card card-body">
                    <dl>
                      Term 3
                    </dl>
                 </div>
                </a>
                </div>

                </div>
            </div>
            <!--div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div-->
        </div>
    </div>
</div>

@endsection