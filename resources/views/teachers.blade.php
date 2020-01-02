@extends('layouts.app_og')

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <!-- Small Box (Stat card) -->
        <h5 class="mb-2 mt-4"><strong>teacher's portal</strong></h5>
        <div class="row justify-content-center">
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $teachers->count()}}</h3>

                        <p>Teachers</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
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
                        <h3>{{ $maleteachers -> count() }} | {{ $percentage_male_teachers }}<sup
                                style="font-size: 20px">%</sup></h3>

                        <p>Male Teachers</p>
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
                        <h3>{{ $femaleteachers -> count() }} | {{ $percentage_female_teachers }}<sup
                                style="font-size: 20px">%</sup></h3>

                        <p>Female Teachers</p>
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
                    <button type="button" class="btn btn-block btn-outline-info btn-sm"
                        data-toggle="modal" data-target="#addUserTeacher">User <i class="fas fa-angle-double-right"></i>
                        Teacher
                    </button>
                    <a role="button" class="btn btn-block btn-outline-success btn-sm"
                href="{{ route('teacher_attendance.index') }}">Teacher Attendance Report
                    </a>
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                <table id="teachers" class="table table-bordered table-striped" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Teacher Name</th>
                            <th scope="col">Current Class</th>
                            <th scope="col">Info</th>
                            <th scope="col">Status</th>
                            <th scope="col"><font color='orange'>View Attendance</font></th>
                            <th scope="col"><font color='red'>Attendance</font></th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = 1;
                        @endphp
                        @foreach ($user_teachers as $user_teacher)
                        <tr>
                            <td align='center'>{{ $i++ }}</td>
                            <td align='center'>{{ $user_teacher->name }}</td>
                            @if(isset($teacher_class[$user_teacher->id]))
                            <td align='center'><strong>
                                    <font color='#ac0f16'>{{ $teacher_class[$user_teacher->id] }}</font>
                                    |
                                </strong>
                                <button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal"
                                    data-target="#editClassTeacher_<?php print_r($user_teacher->id);?>"><strong>
                                        Edit Class
                                </button>
                                |
                                <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal"
                                    data-target="#resetClassTeacher_<?php print_r($user_teacher->id);?>"><strong>
                                        Reset Class
                                </button>
                            </td>
                            @else
                            <td align='center'><button type="button" class="btn btn-sm btn-outline-danger"
                                    data-toggle="modal"
                                    data-target="#addClassTeacher_<?php print_r($user_teacher->id);?>"><strong>Add
                                        Class</strong></button>
                            </td>
                            @endif
                            <td align='center'>
                                <span style="cursor:pointer">
                                    <font color='446dff'><a data-toggle="modal"
                                            data-target="#Teacherinfo_<?php print_r($user_teacher->id);?>"><i
                                                class="fas fa-info-circle fa-lg"></i></a></font>
                                </span>
                            </td>
                            <td align='center'>
                                @if(($user_teacher->activestatus_id) == 1 )
                                <font color='green'><span title="Active" data-toggle="popover" data-trigger="hover"
                                        data-content="This teacher is still a part of the school."><i
                                            class="far fa-check-circle fa-lg"></i></span></font>
                                @else
                                <font color='red'><span title="InActive" data-toggle="popover" data-trigger="hover"
                                        data-content="This teacher is still NO LONGER a part of the school."><i
                                            class="fas fa-ban fa-lg"></i></span></font>
                                @endif
                            </td>
                            <td align='center'>
                                    <a role="button" class="btn btn-block btn-outline-warning btn-sm"
                                    href="{{ route('teacher_attendance.show',$user_teacher->id) }}">View Attendance
                                        </a>
                            </td>

                            <td align='center'><button type="button" class="btn btn-sm btn-outline-danger"
                                data-toggle="modal"
                                data-target="#markAttendance_<?php print_r($user_teacher->id);?>"><strong>Mark Attendance</strong></button>
                        </td>
                            <td align='center'>
                                <!--font color='orange'><span data-toggle="modal"
                                        data-target="#editTeacher_<?php print_r($user_teacher->id);?>"
                                        style="cursor:pointer"><i class="fas fa-user-edit fa-lg"></i></span>
                                </font-->
                                @if(($user_teacher->activestatus_id) == 1 )
                                <font color='red'>
                                    <a class="delete-teacher" data-teacher-id="{{$user_teacher->id}}"
                                        onclick="deleteTeacher({{ $user_teacher->id }})" disabled>
                                        <span style="cursor:pointer">
                                            <i class="fas fa-user-times fa-lg"></i>
                                        </span>
                                    </a>
                                </font>
                                @else
                                <font color='green'>
                                    <a class="undelete-teacher" data-teacher-id="{{$user_teacher->id}}"
                                        onclick="undeleteTeacher({{ $user_teacher->id }})">
                                        <span style="cursor:pointer">
                                            <i class="fas fa-user-check fa-1.5x"></i>
                                        </span>
                                    </a>
                                    @endif
                                </font>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
    </div>

    </div><!-- /.container-fluid -->
</section>



<!-- add converting user to teacher modal-->
@foreach($users as $user)
<div class="modal fade" id="addUserTeacher" tabindex="-1" role="dialog" aria-labelledby="editing" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editing"><strong>
                        <font color='#96384e'>Convert User:</font>
                         to a Teacher.
                    </strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form class="form-horizontal" method="POST" action="{{ route('teacher_class.store') }}">


                    {{ csrf_field() }}


                    <div class="form-group">
                        <label for="School Grade">
                            <font color="red">*</font><strong>User</strong>
                        </label>
                        <select class="form-control" id='teacher_class2' name='user_id'>
                            <option disabled selected>..Select User..</option>
                            @foreach($users as $user)
                            <option value="{{$user -> id}}" @if(isset($user_allocated_status[$user->id]))
                                {{ ($user_allocated_status[$user->id]==1 ? 'disabled="disabled"' : '') }}
                                @endif
                                >{{$user -> name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="Gender">
                            <font color="red">*</font><strong>Gender</strong>
                        </label>
                        <select class="form-control" name='gender_id'>
                            <option>..Select Gender..</option disabled selected>
                            @foreach($genders as $gender)
                            <option value="{{$gender->id}}">{{$gender->gender}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="School Grade">
                            <font color="#446dff">* <i>(Optional)</i></font><strong>Grade</strong>
                        </label>
                        <select class="form-control" name='schoolgrade_id'>
                            <option disabled selected>..Select Grade..</option>
                            @foreach($schoolgrades as $schoolgrade)
                            <option value="{{$schoolgrade -> id}}">{{$schoolgrade -> grade}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="Class Name">
                            <font color="#446dff">* <i>(Optional)</i></font><strong>Class Name</strong>
                        </label>
                        <select class="form-control" name='schoolclass_id'>
                            <option disabled selected>..Select Class..</option>
                            @foreach($schoolsubclasses as $schoolsubclass)
                            <option value="{{$schoolsubclass->id}}">{{$schoolsubclass->subclasses}}</option>
                            @endforeach
                        </select>
                    </div>

                    <button id="send" type="submit" class="btn btn-info float-right">Submit</button>
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



<!-- edit class to teacher modal-->
@foreach($teachers_school_classes as $teachers_school_class)
<div class="modal fade" id="editClassTeacher_<?php print_r($teachers_school_class->id);?>" tabindex="-1" role="dialog"
    aria-labelledby="editing" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editing"><strong>
                        <font color='#96384e'>Edit Class for Teacher:</font>
                        <font color='orange'>{{$teachers_school_class->name}}</font>.<br>
                        <font color='#96384e'>Current Class:</font>
                        <font color='orange'>{{ $teacher_class[$teachers_school_class->id]}}</font>.
                    </strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form class="form-horizontal" method="POST"
                    action="{{ route('teacher_class.update',[$teachers_school_class->id]) }}">

                    {{ method_field('PUT') }}

                    {{ csrf_field() }}


                    <div class="form-group">
                        <input type="hidden" class="form-control" id="student" aria-describedby=""
                            value="{{$teachers_school_class->id}}" name="teacher_id">
                    </div>


                    <div class="form-group">
                        <label for="School Grade">
                            <font color="red">*</font><strong>Grade</strong>
                        </label>
                        <select class="form-control" name='schoolgrade_id'>
                            <option disabled selected>..Select Grade..</option>
                            @foreach($schoolgrades as $schoolgrade)
                            <option value="{{$schoolgrade -> id}}"
                                {{ ($schoolgrade -> id == $teachers_school_class->grade_id ? 'selected="selected"' : '') }}>
                                {{$schoolgrade -> grade}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="Class Name">
                            <font color="red">*</font><strong>Class Name</strong>
                        </label>
                        <select class="form-control" name='schoolclass_id'>
                            <option disabled selected>..Select Class..</option>
                            @foreach($schoolsubclasses as $schoolsubclass)
                            <option value="{{$schoolsubclass->id}}"
                                {{ ($schoolsubclass -> id == $teachers_school_class->subclass_id ? 'selected="selected"' : '') }}>
                                {{$schoolsubclass->subclasses}}</option>
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


<!-- add class to teacher -->
@foreach($user_teachers as $user_teacher)
<div class="modal fade" id="addClassTeacher_<?php print_r($user_teacher->id);?>" tabindex="-1" role="dialog"
    aria-labelledby="editing" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editing"><strong>
                        <font color='#96384e'>Add Class for Teacher:</font>
                        <font color='orange'>{{$user_teacher->name}}</font>.<br>
                    </strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <div class="modal-body">

                <form class="form-horizontal" method="GET"
                    action="{{ route('teacher_class.storeteacher',[$user_teacher->id]) }}">

                    {{ csrf_field() }}

                 
                    <div class="form-group">
                        <label for="School Grade">
                            <font color="red">*</font><strong>Grade/Form</strong>
                        </label>
                        <select class="form-control" name='schoolgrade_id'>
                            <option disabled selected>..Select Grade/Form..</option>
                            @foreach($schoolgrades as $schoolgrade)
                            <option value="{{$schoolgrade -> id}}">{{$schoolgrade -> grade}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="Class Name">
                            <font color="red">*</font><strong>Class Name</strong>
                        </label>
                        <select class="form-control" name='schoolclass_id'>
                            <option disabled selected>..Select Class..</option>
                            @foreach($schoolsubclasses as $schoolsubclass)
                            <option value="{{$schoolsubclass->id}}">{{$schoolsubclass->subclasses}}</option>
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



<!-- model for resetting class -->

@foreach($user_teachers as $user_teacher)
<div class="modal fade" id="resetClassTeacher_<?php print_r($user_teacher->id);?>" tabindex="-1" role="dialog"
    aria-labelledby="editing" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editing"><strong>
                        <font color='#96384e'>Reset Class for Teacher:</font>
                        <font color='orange'>{{$user_teacher->name}}</font>.<br>
                    </strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center text-center">

                    <div class='col-sm-12'>
                        <p> Please click buttton below to <font color='red'><i>reset</i></font> the teacher's class: <font color='red'><b>
                        @if(isset($teacher_class[$user_teacher->id]))
                        {{ $teacher_class[$user_teacher->id]}}
                        @endif
                        </b></font></p>
                        <br>
                    </div>
                    <div class='col-sm-12'>
                        <form class="form-horizontal" method="GET"
                            action="{{ route('teacher_class.classreset',[$user_teacher->id]) }}">

                            {{ csrf_field() }}


                            <input type='hidden' value='2' name='allocatestatus_id' />

                            <button type="submit" class="btn btn-warning"><strong>Reset Class</strong></button>

                        </form>
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

<!--model for marking attendance -->


@foreach($user_teachers as $user_teacher)
<div class="modal fade" id="markAttendance_<?php print_r($user_teacher->id);?>" tabindex="-1" role="dialog"
    aria-labelledby="editing" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editing"><strong>
                        <font color='#96384e'>Attendance:</font> 
                        <font color='orange'>{{$user_teacher->name}}</font>.<br>
                        <font color='#96384e'>Date:</font>  <font color='green'>{{$currentdate}}</font>.
                    </strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form class="form-horizontal" method="POST"
                    action="{{ route('teacher_attendance.store') }}">

                    {{ csrf_field() }}

                    <input type="hidden" class="form-control" id="dateOfBirth" aria-describedby=""
                    name="teacher_id" value={{ $user_teacher->id }}>

                    <div class="form-group">
                        <label for="dateOfBirth">
                            <font color="red">*</font><strong>Date</strong>
                        </label>
                        <input type="date" class="form-control" id="dateOfBirth" aria-describedby=""
                            name="attendance_date">
                    </div>


                    <div class="form-group">
              
                            <div class="form-check">
                                
                                <label class="checkbox-inline"><input class="form-check-input" type="radio" value="1" name="attendance_status" checked='checked'>Present</label>
                          
                            </div>
                            
                            <div class="form-check">
                                     <label class="checkbox-inline"><input class="form-check-input" type="radio" value="0" name="attendance_status">Not Present</label>
                            </div>

                    </div>
                 



<hr>

                    <div class="form-group">
                        <label for="Class Name">
                            <strong>Notes</strong> (*<font color='446dff'><i>Optional</i></font>)
                        </label>
                        <textarea class="form-control" id="gAddress" name="attendance_notes" placeholder="Reason for absence..."
                        rows="3"></textarea>
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

@endsection