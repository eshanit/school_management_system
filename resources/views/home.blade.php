@extends('layouts.app_og')

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <!-- Small Box (Stat card) -->
    <h5 class="mb-2 mt-4"><strong>Dashboard| {{ $schools[0]->schoolname }}</strong></h5>
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $teachers->count() }}</h3>

                        <p>Teachers</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="{{route('teachers.index')}}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $schoolclasses ->count() }}</h3>

                        <p>Classes</p>
                    </div>
                    <div class="icon">
                    <i class="fas fa-school"></i>
                    </div>
                    <span class="small-box-footer" style="cursor:pointer" data-toggle="modal" data-target="#schoolclasses">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </span>
                </div>
            </div>
            
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $malestudents -> count() }} | {{$percentage_male_students}}<sup style="font-size: 20px">%</sup></h3>

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
                        <h3>{{ $femalestudents -> count() }} | {{$percentage_female_students}}<sup style="font-size: 20px">%</sup></h3>

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
                    <button type="button" class="btn btn-block btn-outline-info btn-sm"
                        data-toggle="modal" data-target="#studentregistration">Register new student</button>
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
                                <th scope="col">Class</th>
                                <th scope="col">Info</th>
                                <th scope="col">Status</th>
                                <th scope="col">Edit/Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 1;
                            @endphp
                            @foreach ($students as $student)
                            <tr>
                                <td align='center'>{{ $i++ }}</td>
                                <td align='center'>{{ $student->firstname }}</td>
                                <td align='center'>{{ $student->middlename }}</td>
                            <td align='center'>{{ $student->lastname }}</td>
                                @if(isset($student_class[$student->id]))
                                <td align='center'><strong><font color='#ac0f16'>{{ $student_class[$student->id] }}</font></strong> <span style="cursor:pointer" data-toggle="modal"
                                        data-target="#editClassStudent_<?php print_r($student->id);?>"><strong> <i class="far fa-edit"></i> </span></td>
                                @else
                                <td align='center'><button type="button" class="btn btn-sm btn-outline-success"
                                        data-toggle="modal"
                                        data-target="#addClassStudent_<?php print_r($student->id);?>"><strong>Add
                                            Class</strong></button>
                                </td>
                                @endif
                                @if($student->gender_id == 1)
                                <td align='center'>
                                    <span style="cursor:pointer">
                                        <font color='446dff'><a data-toggle="modal"
                                                data-target="#Studentinfo_<?php print_r($student->id);?>"><i
                                                    class="fas fa-info-circle fa-lg"></i></a></font>
                                    </span>
                                </td>
                                @else
                                <td align='center'>
                                    <span style="cursor:pointer">
                                        <font color='#fd42ff'><a data-toggle="modal"
                                                data-target="#Studentinfo_<?php print_r($student->id);?>"><i
                                                    class="fas fa-info-circle fa-lg"></i></a></font>
                                    </span>
                                </td>
                                @endif
                                <td align='center'>
                                    @if(($student->activestatus_id) == 1 )
                                    <font color='green'><span title="Active" data-toggle="popover" data-trigger="hover"
                                            data-content="This student is still a part of the school."><i
                                                class="far fa-check-circle fa-lg"></i></span></font>
                                    @else
                                    <font color='red'><span title="InActive" data-toggle="popover" data-trigger="hover"
                                            data-content="This student is still NO LONGER a part of the school."><i
                                                class="fas fa-ban fa-lg"></i></span></font>
                                    @endif
                                </td>
                                <td align='center'>
                                    <font color='orange'><span data-toggle="modal"
                                            data-target="#editStudent_<?php print_r($student->id);?>"
                                            style="cursor:pointer"><i class="fas fa-user-edit fa-lg"></i></span>
                                    </font> /
                                    @if(($student->activestatus_id) == 1 )
                                    <font color='red'>
                                        <a class="delete-student" data-student-id="{{$student->id}}"
                                            onclick="deleteStudent({{ $student->id }})">
                                            <span style="cursor:pointer">
                                                <i class="fas fa-user-times fa-lg"></i>
                                            </span>
                                        </a>
                                    </font>
                                    @else
                                    <font color='green'>
                                        <a class="undelete-student" data-student-id="{{$student->id}}"
                                            onclick="undeleteStudent({{ $student->id }})">
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
<!--modal for student registration -->
<div class="modal fade" id="studentregistration">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Register New Student</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="{{ route('student.store') }}">
                    {{ csrf_field() }}

                    <div class="container">
                        <div class="row">
                            <div class="col-md">
                                <div class="form-group">
                                    <label for="firstName">
                                        <font color="red">*</font><strong>First Name</strong>
                                    </label>
                                    <input type="text" class="form-control" id="firstName" aria-describedby=""
                                        placeholder="first name" name="firstname">
                                </div>

                                <div class="form-group">
                                    <label for="middleName"><strong>Middle Name</strong></label>
                                    <input type="text" class="form-control" id="middleName" aria-describedby=""
                                        placeholder="middle name" name="middlename">
                                </div>

                                <div class="form-group">
                                    <label for="lastName">
                                        <font color="red">*</font><strong>Last Name</strong>
                                    </label>
                                    <input type="text" class="form-control" id="lastName" aria-describedby=""
                                        placeholder="surname" name="lastname">
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
                                    <label for="dateOfBirth">
                                        <font color="red">*</font><strong>Date of Birth</strong>
                                    </label>
                                    <input type="date" class="form-control" id="dateOfBirth" aria-describedby=""
                                        name="dateofbirth">
                                </div>

                                <div class="form-group">
                                    <label for="birthNumber"><strong>Birth Certificate Number</strong></label>
                                    <input type="text" class="form-control" id="birthNumber" aria-describedby=""
                                        placeholder="birth certificate number" name="birthnumber">
                                </div>

                                <div class="form-group">
                                    <label for="dateOfEnrollment">
                                        <font color="red">*</font><strong>Date of Enrollment</strong>
                                    </label>
                                    <input type="date" class="form-control" id="dateOfEnrollment" aria-describedby=""
                                        name="dateofenrollment">
                                </div>

                            </div>
                            <div class="col-md">
                                <div class="form-group">
                                    <label for="gfirstName">
                                        <font color="red">*</font><strong>Guardian Name</strong>
                                    </label>
                                    <input type="text" class="form-control" id="gfirstName" aria-describedby=""
                                        placeholder="first name" name="guardian_firstname">
                                </div>

                                <div class="form-group">
                                    <label for="gmiddleName"><strong> Guardian Middle Name</strong></label>
                                    <input type="text" class="form-control" id="gmiddleName" aria-describedby=""
                                        placeholder="middle name" name="guardian_middlename">
                                </div>

                                <div class="form-group">
                                    <label for="glastName">
                                        <font color="red">*</font><strong>Guardian Last Name</strong>
                                    </label>
                                    <input type="text" class="form-control" id="glastName" aria-describedby=""
                                        placeholder="surname" name="guardian_lastname">
                                </div>
                                <div class="form-group">
                                    <label for="glastName">
                                        <font color="red">*</font><strong>Guardian ID</strong>
                                    </label>
                                    <input type="text" class="form-control" id="glastName" aria-describedby=""
                                        placeholder="guardian id number" name="guardian_idnumber">
                                </div>

                                <div class="form-group">
                                    <label for="gAddress">
                                        <font color="red">*</font><strong>Address</strong>
                                    </label>
                                    <textarea class="form-control" id="gAddress" name="guardian_address"
                                        rows="3"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="gcellnumber"><strong>Cell Number</strong></label>
                                    <input type="text" class="form-control" id="gcellnumber" name="guardian_cellnumber"
                                        aria-describedby="" name="contact">
                                </div>

                                <div class="form-group">
                                    <label for="gemail"><strong>email</strong></label>
                                    <input type="email" class="form-control" id="gemail" name="guardian_email"
                                        aria-describedby="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-right">Submit</button>
                </form>
            </div>
            <!--div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div-->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!-- Modal for student information -->

@foreach($students as $student)
<div class="modal fade" id="Studentinfo_<?php print_r($student->id);?>" tabindex="-1" role="dialog"
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
                      <h2 class="lead"><b>{{ $student->firstname }} {{ $student->middlename }} {{ $student->lastname }}</b></h2>
                      <hr>
                      <p class="text-muted text-sm"><b>Gender: </b> 
                      @if($student->gender_id == 1)
                      <font color='#446dff'> Male </font>
                      @else
                      <font color='#ff80ed'> Female </font>
                      @endif
                       </p>
                       <p class="text-muted text-sm"><b>Date of Birth: </b> 
                      {{ $student->dateofbirth }}
                       </p>
                       <p class="text-muted text-sm"><b>ID: </b> 
                      {{ $student->birthnumber }}
                       </p>
                       </p>
                       <p class="text-muted text-sm"><b>Enrollment Date: </b> 
                      {{ $student->date_enrolled }}
                       </p>
                       <hr>
                       <p class="text-muted text-sm"><b>Guardian Name: </b> 
                       {{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }}
                       </p>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building" style="color:#ffd700"></i></span> <font color='#3f632a'><strong>Address</strong></font>: {{ $student->address }}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone" style="color:#ffd700"></i></span> <font color='#3f632a'><strong>Phone #</strong></font>: {{ $student-> phonenumber }}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-at" style="color:#ffd700"></i></span> <font color='#3f632a'><strong>email</strong></font>: {{ $student-> email }}</li>
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

<!-- add class to student modal-->
@foreach($students as $student)
<div class="modal fade" id="addClassStudent_<?php print_r($student->id);?>" tabindex="-1" role="dialog"
    aria-labelledby="editing" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editing"><strong>
                        <font color='#96384e'>Add Student:</font>
                        <font color='orange'>{{$student->firstname}} {{$student->lastname}}</font> to a class.
                    </strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form class="form-horizontal" method="POST" action="{{ route('studentclass.store') }}">
            

                    {{ csrf_field() }}


                    <div class="form-group">
                        <input type="hidden" class="form-control" id="student" aria-describedby=""
                             value="{{$student->id}}"
                            name="student_id">
                    </div>


                    <div class="form-group">
                        <label for="School Grade">
                            <font color="red">*</font><strong>Form</strong>
                        </label>
                        <select class="form-control" name='schoolgrade_id'>
                            <option>..Select Grade..</option disabled selected>
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
                            <option>..Select Class..</option disabled selected>
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


<!-- Modal for editing Student Info -->

@foreach($students as $student)
<div class="modal fade" id="editStudent_<?php print_r($student->id);?>" tabindex="-1" role="dialog"
    aria-labelledby="editing" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editing"><strong>
                        <font color='brown'>edit Student:</font>
                        <font color='orange'>{{$student->firstname}} {{$student->lastname}}</font>
                    </strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form class="form-horizontal" method="POST" action="{{ route('student.update',[$student->id]) }}">
                    {{ method_field('PUT') }}

                    {{ csrf_field() }}

                    <div class="container">
                        <div class="row">
                            <div class="col-md">
                                <div class="form-group">
                                    <label for="firstName">
                                        <font color="red">*</font><strong>First Name</strong>
                                    </label>
                                    <input type="text" class="form-control" id="firstName" aria-describedby=""
                                        placeholder="{{$student->firstname}}" value="{{$student->firstname}}"
                                        name="firstname">
                                </div>

                                <div class="form-group">
                                    <label for="middleName"><strong>Middle Name</strong></label>
                                    <input type="text" class="form-control" id="middleName" aria-describedby=""
                                        placeholder="{{$student->middlename}}" value="{{$student->middlename}}"
                                        name="middlename">
                                </div>

                                <div class="form-group">
                                    <label for="lastName">
                                        <font color="red">*</font><strong>Last Name</strong>
                                    </label>
                                    <input type="text" class="form-control" id="lastName" aria-describedby=""
                                        placeholder="{{$student->lastname}}" value="{{$student->lastname}}"
                                        name="lastname">
                                </div>

                                <div class="form-group">
                                    <label for="Gender">
                                        <font color="red">*</font><strong>Gender</strong>
                                    </label>
                                    <select class="form-control" name='gender_id'>
                                        <option disabled selected>..Select Gender..</option>
                                        @foreach($genders as $gender)
                                        <option value="{{ $gender->id }}"
                                            {{ ($gender->id == $student->gender_id ? 'selected="selected"' : '') }}>
                                            {{ $gender->gender }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="dateOfBirth">
                                        <font color="red">*</font><strong>Date of Birth</strong>
                                    </label>
                                    <input type="date" class="form-control" id="dateOfBirth" aria-describedby=""
                                        placeholder="{{$student->dateofbirth}}" value="{{$student->dateofbirth}}"
                                        name="dateofbirth">
                                </div>

                                <div class="form-group">
                                    <label for="birthNumber"><strong>Birth Certificate Number</strong></label>
                                    <input type="text" class="form-control" id="birthNumber" aria-describedby=""
                                        placeholder="{{$student->birthnumber}}" value="{{$student->birthnumber}}"
                                        name="birthnumber">
                                </div>
                                <div class="form-group">
                                    <label for="dateOfEnrollment">
                                        <font color="red">*</font><strong>Date of Enrollment</strong>
                                    </label>
                                    <input type="date" class="form-control" id="dateOfEnrollment" aria-describedby=""
                                    placeholder="{{$student->date_enrolled}}" value="{{$student->date_enrolled}}"
                                        name="dateofenrollment">
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group">
                                    <label for="gfirstName">
                                        <font color="red">*</font><strong>Guardian Name</strong>
                                    </label>
                                    <input type="text" class="form-control" id="gfirstName" aria-describedby=""
                                        placeholder="{{$student->first_name }}"
                                        value="{{$student->first_name }}" name="guardian_firstname">
                                </div>

                                <div class="form-group">
                                    <label for="gmiddleName"><strong> Guardian Middle Name</strong></label>
                                    <input type="text" class="form-control" id="gmiddleName" aria-describedby=""
                                        placeholder="{{$student->middle_name }}"
                                        value="{{$student->middle_name }}" name="guardian_middlename">
                                </div>

                                <div class="form-group">
                                    <label for="glastName">
                                        <font color="red">*</font><strong>Guardian Last Name</strong>
                                    </label>
                                    <input type="text" class="form-control" id="glastName" aria-describedby=""
                                        placeholder="{{$student->last_name }}"
                                        value="{{$student->last_name }}" name="guardian_lastname">
                                </div>

                                <div class="form-group">
                                    <label for="gAddress">
                                        <font color="red">*</font><strong>Address</strong>
                                    </label>
                                    <textarea class="form-control" id="gAddress"
                                        placeholder="{{$student->address }}"
                                        value="{{$student->address }}" name="guardian_address"
                                        rows="3"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="gcellnumber"><strong>Cell Number</strong></label>
                                    <input type="text" class="form-control" id="gcellnumber" name="guardian_cellnumber"
                                        aria-describedby="" placeholder="{{$student->phonenumber }}"
                                        value="{{$student->phonenumber}}" name="contact">
                                </div>

                                <div class="form-group">
                                    <label for="gemail"><strong>email</strong></label>
                                    <input type="email" class="form-control" id="gemail"
                                        placeholder="{{$student->email}}"
                                        value="{{$student->email}}" name="guardian_email"
                                        aria-describedby="">
                                </div>
                            </div>
                        </div>
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

<!-- modal for viewing class list -->

<div class="modal fade" id="schoolclasses" tabindex="-1" role="dialog" aria-labelledby="editing" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editing"><strong>
                        <font color='#008080'>School Classes:</font>

                    </strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <table id="school_classes" class="table table-bordered table-striped" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Form/Grade</th>
                            <th scope="col">Class</th>
                            <th scope="col">Class Teacher</th>
                            <th scope="col">Number of <font color='#fd42ff'><strong>Girls</strong></font></th>
                            <th scope="col">Number of <font color='blue'><strong>Boys</strong></font></th>
                            <th scope="col"><font color='purple'><strong>Total</strong></font></th>
                            <!--th scope="col">Edit/Delete</th-->
                        </tr>
                    </thead>
                    @php
                    $i = 1;
                    @endphp
                    <tbody>
                        @foreach($schoolgradeclasses as $schoolgradeclass)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$schoolgradeclass->grade}}</td>
                            <td>{{$schoolgradeclass->subclasses}}</td>
                            <td>-</td>
                            @if(isset($student_class_gender_count[$schoolgradeclass->id][2]))
                            <td>{{ $student_class_gender_count[$schoolgradeclass->id][2] }}</td>
                            @else
                            <td>0</td>
                            @endif
                            @if(isset($student_class_gender_count[$schoolgradeclass->id][1]))
                            <td>{{ $student_class_gender_count[$schoolgradeclass->id][1] }}</td>
                            @else
                            <td>0</td>
                            @endif
                            @if(isset($student_class_gender_total[$schoolgradeclass->id]))
                            <td><font color='purple'><strong>{{$student_class_gender_total[$schoolgradeclass->id] }}<strong></font></td>
                            @else
                            <td><font color='purple'><strong>0</font></td>
                            @endif
                            <!--td>-</td-->
                        </tr>
                        @endforeach
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

<!-- edit class to student modal-->
@foreach($students_school_classes as $students_school_class)
<div class="modal fade" id="editClassStudent_<?php print_r($students_school_class->id);?>" tabindex="-1" role="dialog"
    aria-labelledby="editing" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editing"><strong>
                        <font color='#96384e'>Edit Student Class for:</font>
                        <font color='orange'>{{$students_school_class->firstname}} {{$students_school_class->lastname}}</font>.<br>
                        <font color='#96384e'>Current Class:</font>
                        <font color='orange'>{{ $student_class[$students_school_class->id]}}</font>.

                    </strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form class="form-horizontal" method="POST" action="{{ route('studentclass.update',[$students_school_class->id]) }}">
            
                {{ method_field('PUT') }}

                    {{ csrf_field() }}


                    <div class="form-group">
                        <input type="hidden" class="form-control" id="student" aria-describedby=""
                             value="{{$students_school_class->id}}"
                            name="student_id">
                    </div>


                    <div class="form-group">
                        <label for="School Grade">
                            <font color="red">*</font><strong>Form</strong>
                        </label>
                        <select class="form-control" name='schoolgrade_id'>
                            <option disabled selected>..Select Form..</option>
                            @foreach($schoolgrades as $schoolgrade)
                            <option value="{{$schoolgrade -> id}}"
                            {{ ($schoolgrade -> id == $students_school_class->grade_id ? 'selected="selected"' : '') }}
                            >{{$schoolgrade -> grade}}</option>
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
                            {{ ($schoolsubclass -> id == $students_school_class->subclass_id ? 'selected="selected"' : '') }}
                            >{{$schoolsubclass->subclasses}}</option>
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
@endsection