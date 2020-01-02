@extends('layouts.app_dis')

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <!-- Small Box (Stat card) -->
        <h5 class="mb-2 mt-4"><strong>Dashboard</strong></h5>
        <div class="row justify-content-center">
                

            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $students->count() }}</h3>

                        <p>All Students</p>
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
                        <h3>{{ $male_students}} | {{$perc_male_students}}<sup style="font-size: 20px">%</sup></h3>

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
                        <h3>{{ $female_students }} | {{$perc_female_students}}<sup style="font-size: 20px">%</sup></h3>

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
    
<!-- table-->

<div class="card border-success ">
        <div class="card-header">
            <h3 class="card-title">
                Student Summary Statistics
            </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          
            <table id="dis_students" class="table table-bordered table-striped" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Student Name</th>
                            <th scope="col">Student Middlename</th>
                            <th scope="col">Student Surname</th>
                            <th scope="col">School Name</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Guardian Info</th>
                            <th scope="col">Attendance</th>
                            <th scope="col">Student Report</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = 1;
                        @endphp
                        @foreach ($school_students as $school_student)
                        <tr>
                            <td align='center'>{{ $i++ }}</td>
                            <td align='center'>{{ $school_student->firstname }}</td>
                            <td align='center'>{{ $school_student->middlename }}</td>
                            <td align='center'>{{ $school_student->lastname }}</td>
                            <td align='center'>{{ $school_student->schoolname }}</td>
                            @if( $school_student->gender_id == 1)
                            <td align='center'><font color='#446dff'>Male</font></td>
                            @else
                            <td align='center'><font color='#fd42ff'>Female</font></td>
                            @endif
                            @if($school_student->gender_id == 1)
                            <td align='center'>
                                <span style="cursor:pointer">
                                    <font color='446dff'><a data-toggle="modal"
                                            data-target="#Studentinfo_<?php print_r($school_student->student_id);?>"><i
                                                class="fas fa-info-circle fa-lg"></i></a></font>
                                </span>
                            </td>
                            @else
                            <td align='center'>
                                <span style="cursor:pointer">
                                    <font color='#fd42ff'><a data-toggle="modal"
                                            data-target="#Studentinfo_<?php print_r($school_student->student_id);?>"><i
                                                class="fas fa-info-circle fa-lg"></i></a></font>
                                </span>
                            </td>
                            @endif
                            <td align='center'><a role="button" class="btn btn-block btn-outline-warning btn-sm" href="{{ route('student_attendance.show',[$school_student->student_id,]) }}" disabled="disabled">View</a></td>
                            <td align='center'>
                                <span style="cursor:pointer" data-toggle="modal"
                                    data-target="#reports_<?php print_r($school_student->student_id);?>">
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


<!-- end table -->

<!-- table-->

<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            School Student Summary Statistics
        </h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      
        <table id="dis_teacher" class="table table-bordered table-striped" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">School Level</th>
                        <th scope="col">Female Students</th>
                        <th scope="col">Male Students</th>
                        <th scope="col">Total </th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i = 1;
                    @endphp

                    @if(isset($school_student_level_count))
                    @foreach($school_student_level_count as $school_name => $count)
                    <tr>
                        <td align='center'>{{ $i++ }}</td>
                        <td align='center'>{{ $school_name}}</td>
                        @if(isset($school_student_gender_level_count['Female'][$school_name]))
                        <td align='center'>{{ $school_student_gender_level_count['Female'][$school_name]}}</td>
                        @else
                        <td align='center'>-</td>
                        @endif
                        @if(isset($school_student_gender_level_count['Male'][$school_name]))
                        <td align='center'>{{ $school_student_gender_level_count['Male'][$school_name]}}</td>
                        @else
                        <td align='center'>-</td>
                        @endif
                        <td align='center'>{{ $count }}</td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
    </div>
    <!-- /.card-body -->
</div>

    </div>
    <!-- /.col -->
    </div>

    </div><!-- /.container-fluid -->
</section>

<!-- Modal for student information -->

@foreach($school_students as $school_student)
<div class="modal fade" id="reports_<?php print_r($school_student->student_id);?>" tabindex="-1" role="dialog"
    aria-labelledby="infomodal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="infomodal"><strong>
                        <font color='446dff'>Reports List for: {{ $school_student->firstname }}
                            {{ $school_student->middlename }}
                            {{ $school_student->lastname }} </font>
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
                            <td>{{ $school_student->grade }}{{ $school_student->subclasses }}
                            </td>
                            <td>{{ $currentyear }}
                            </td>
                            <td>1
                            </td>
                            <td>
                                <a href="{{ route('report.student', [$currentyear,1,$school_student->schoolclass_id,$school_student->student_id,]) }}"
                                    style="position: relative;">
                                    <i class="fas fa-chart-line"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>{{ $school_student->grade }}{{ $school_student->subclasses }}
                            </td>
                            <td>{{ $currentyear }}
                            </td>
                            <td>2
                            </td>
                            <td>
                                    <a href="{{ route('report.student', [$currentyear,2,$school_student->schoolclass_id,$school_student->student_id,]) }}"
                                            style="position: relative;">
                                            <i class="fas fa-chart-line"></i>
                                        </a>
                            </td>
                        </tr>
                        <tr>
                            <td>{{ $school_student->grade }}{{ $school_student->subclasses }}
                            </td>
                            <td>{{ $currentyear }}
                            </td>
                            <td>3
                            </td>
                            <td>
                                    <a href="{{ route('report.student', [$currentyear,3,$school_student->schoolclass_id,$school_student->student_id,]) }}"
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
<!-- modal for student info -->

@foreach($school_students as $school_student)
<div class="modal fade" id="Studentinfo_<?php print_r($school_student->student_id);?>" tabindex="-1" role="dialog"
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
                      <h2 class="lead"><b>{{ $school_student->firstname }} {{ $school_student->middlename }} {{ $school_student->lastname }}</b></h2>
                      <hr>
                      <p class="text-muted text-sm"><b>Gender: </b> 
                      @if($school_student->gender_id == 1)
                      <font color='#446dff'> Male </font>
                      @else
                      <font color='#ff80ed'> Female </font>
                      @endif
                       </p>
                       <p class="text-muted text-sm"><b>Date of Birth: </b> 
                      {{ $school_student->dateofbirth }}
                       </p>
                       <p class="text-muted text-sm"><b>ID: </b> 
                      {{ $school_student->birthnumber }}
                       </p>
                       </p>
                       <p class="text-muted text-sm"><b>Enrollment Date: </b> 
                      {{ $school_student->date_enrolled }}
                       </p>
                       <hr>
                       <p class="text-muted text-sm"><b>Guardian Name: </b> 
                       {{ $school_student->first_name }} {{ $school_student->middle_name }} {{ $school_student->last_name }}
                       </p>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building" style="color:#ffd700"></i></span> <font color='#3f632a'><strong>Address</strong></font>: {{ $school_student->address }}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone" style="color:#ffd700"></i></span> <font color='#3f632a'><strong>Phone #</strong></font>: {{ $school_student->phonenumber }}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-at" style="color:#ffd700"></i></span> <font color='#3f632a'><strong>email</strong></font>: {{ $school_student->email }}</li>
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
@endsection