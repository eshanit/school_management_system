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
                        <h3>{{ $teachers->count() }}</h3>

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
                        <h3>{{ $male_teachers}} | {{$perc_male_teachers}}<sup style="font-size: 20px">%</sup></h3>

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
                        <h3>{{ $female_teachers }} | {{$perc_female_teachers}}<sup style="font-size: 20px">%</sup></h3>

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
           <!-- ./col -->
           <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-dark">
                    <div class="inner">
                        <h3>Attendance<sup style="font-size: 20px"></sup></h3>

                        <p>All Teachers</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <a class="small-box-footer" data-toggle="modal" data-target="#viewTeacherAttendance" style="cursor:pointer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->
          
        
        </div>
    
<!-- table-->

<div class="card">
        <div class="card-header">
            <h3 class="card-title">
                School Teacher Summary Statistics
            </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          
            <table id="dis_teacher_summary" class="table table-bordered table-striped" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Teacher Name</th>
                            <th scope="col">School Name</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Date Started</th>
                            <th scope="col">Teacher Phone</th>
                            <th scope="col">Teacher Email</th>
                            <th scope="col">Teacher Address</th>
                            <th scope="col">Status</th>
                            <th scope="col">Attendance</th>
                            <th scope="col">Current Class</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = 1;
                        @endphp
                        @foreach ($school_teachers as $school_teacher)
                        <tr>
                            <td align='center'>{{ $i++ }}</td>
                            <td align='center'>{{ $school_teacher->name }}</td>
                            <td align='center'>{{ $school_teacher->schoolname }}</td>
                            @if( $school_teacher->gender_id == 1)
                            <td align='center'><font color='446dff'>Male</font></td>
                            @else
                            <td align='center'><font color='pink'>Female</font></td>
                            @endif
                            <td align='center'>{{ $school_teacher->date_started }}</td>
                            <td align='center'>{{ $school_teacher->phone_number }}</td>
                            <td align='center'>{{ $school_teacher->email }}</td>
                            <td align='center'>{{ $school_teacher->address }}</td>
                            @if($school_teacher->activestatus_id == 1)
                            <td align='center'><font color='green'>Active</font></td>
                            @else
                            <td align='center'><font color='red'>Inactive</font></td>
                            @endif
                            <td align='center'><a role="button" class="btn btn-block btn-outline-warning btn-sm" href="{{ route('teacher_attendance.show',$school_teacher->id) }}" disabled="disabled">View</a></td>
                            <td>
                                @if(isset($teacherclass[$school_teacher->id]))
                                    <a role="button" class="btn btn-block btn-outline-info btn-sm" href="{{ route('class_teacher.show',$school_teacher->id)}}">Get in</a>
                                @else
                                    <font color='red'>Unallocated</font>
                                @endif
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
            School Teacher Summary Statistics
        </h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      
        <table id="dis_teacher" class="table table-bordered table-striped" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">School Level</th>
                        <th scope="col">Female Teachers</th>
                        <th scope="col">Male Teachers</th>
                        <th scope="col">Total </th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i = 1;
                    @endphp
                   @if($school_teacher_level_count != NULL) 
                    @foreach($school_teacher_level_count as $school_name => $count)
                    <tr>
                        <td align='center'>{{ $i++ }}</td>
                        <td align='center'>{{ $school_name}}</td>
                        @if(isset($school_teacher_gender_level_count['Female'][$school_name]))
                        <td align='center'>{{ $school_teacher_gender_level_count['Female'][$school_name]}}</td>
                        @else
                        <td align='center'>-</td>
                        @endif
                        @if(isset($school_teacher_gender_level_count['Male'][$school_name]))
                        <td align='center'>{{ $school_teacher_gender_level_count['Male'][$school_name] }}</td>
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


<!-- end table -->

    </div>
    <!-- /.col -->
    </div>

    </div><!-- /.container-fluid -->
</section>

<!--modal for student registration -->
<div class="modal fade" id="viewTeacherAttendance">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Teacher Attendance By School</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                   
                        <table id="school_teacher_attendance" class="table table-bordered table-striped" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">School Name</th>
                                        <th scope="col">Attendance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i = 1;
                                    @endphp
                                    @foreach ($schools as $school)
                                    <tr>
                                        <td align='center'>{{ $i++ }}</td>
                                        <td align='center'>{{ $school->schoolname }}</td>
                                        <td align='center'><a role="button" class="btn btn-block btn-outline-info btn-sm" href="{{ route('dis_teacher_attendance.show',$school->id)}}">view</a>
                                        </td>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                   

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

@endsection