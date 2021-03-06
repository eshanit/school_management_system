@extends('layouts.app_og')

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <!-- Small Box (Stat card) -->
        <h5 class="mb-2 mt-4"><strong>{{ $teacher_name }}</strong>| ({{$school_name}})</h5>
        <div class="row justify-content-center">
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-warning">
                    <div class="inner">
                    <h3>{{ $teacher_attendances -> count() }}</h3>

                        <p>Days Recorded</p>
                    </div>
                    <div class="icon">
                            <i class="far fa-calendar-alt"></i>
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
                    <h3>{{ $teacher_present_rate }}<sup
                                style="font-size: 20px">%</sup></h3>

                        <p>Rate of Presence</p>
                    </div>
                    <div class="icon">
                            <i class="far fa-calendar-check"></i>
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
                    <h3>{{  $teacher_absent_rate }}<sup
                                style="font-size: 20px">%</sup></h3>

                        <p>Rate of Absence</p>
                    </div>
                    <div class="icon">
                            <i class="far fa-calendar-times"></i>
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
                Attendance Report for: <i><font color='red'>{{ $teacher_name }}</font><strong></strong></i>
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                <table id="teachers_attendance" class="table table-bordered table-striped" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Date</th>
                            <th scope="col">Attendance</th>
                            <th scope="col">Notes</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @php
                        $i = 1;
                        @endphp
                      
                        @foreach($teacher_attendances as $teacher_attendance)
                        <tr>
                            <td align='center'>{{ $i++ }}</td>
                            <td align='center'>{{ $teacher_attendance->date }}</td>
                            @if($teacher_attendance->attendance == 1)
                                <td align='center'><font color='#466dff'>Present</font></td>
                            @else
                                <td align='center'><font color='red'>Absent</font></td>
                            @endif
                            @if($teacher_attendance->notes)
                            <td align='center'>{{ $teacher_attendance->notes }}</td>
                            @else
                            <td align='center'>-</td>
                            @endif
                            <td align='center'>
                            
                                    <font color='orange'><span data-toggle="modal"
                                            data-target="#editTeacherAttendance_<?php print_r($teacher_attendance->id);?>"
                                            style="cursor:pointer"><i class="fas fa-user-edit fa-lg"></i></span>
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

@endsection