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
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $schools->count() }}</h3>
        
                                <p>Schools</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-school"></i>
                            </div>
                            <a href="#" class="small-box-footer">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $teachers->count() }}</h3>

                        <p>All Teachers</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="{{route('dis_teachers.index')}}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $students ->count() }}</h3>

                        <p>All Students</p>
                    </div>
                    <div class="icon">
                    <i class="fas fa-users"></i>
                    </div>
                    <a href="{{route('dis_students.index')}}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-dark">
                        <div class="inner">
                            <h3>-</h3>
    
                            <p>Schools Calendar</p>
                        </div>
                        <div class="icon">
                        <i class="fas fa-calendar-alt"></i>
                        </div>
                        <a href="{{route('schools.index')}}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
        
        </div>
    
<!-- table-->

<div class="card">
        <div class="card-header">
            <h3 class="card-title">
             <button type="button" class="btn btn-block btn-outline-info btn-sm"
                data-toggle="modal" data-target="#addSchool">Add new school</button>
            </h3>
            </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          
            <table id="students" class="table table-bordered table-striped" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">School Name</th>
                            <th scope="col">School Type</th>
                            <th scope="col">School Ownership</th>
                            <th scope="col">School Level</th>
                            <th scope="col">Female Students</th>
                            <th scope="col">Male Students</th>
                            <th scope="col">Total Students</th>
                            <th scope="col">Female Teachers</th>
                            <th scope="col">Male Teachers</th>
                            <th scope="col">Total Teachers</th>
                            <th scope="col">Info</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = 1;
                        @endphp
                        @foreach ($schools as $school)
                        <tr>
                            <td align='center'>{{ $i++ }}</td>
                            <td align='center'>
                                
                                <font color='green'>
                                    <span title="School Admin" data-toggle="popover" data-trigger="hover" style="cursor:pointer" 
                                data-content="<?php print_r("admin$school->id@schoolmanagement.co.zw"); ?>" ><strong>{{ $school->schoolname }}</strong></span>
                            </font>
                            </td>
                            <td align='center'>{{ $school->status }}</td>
                            <td align='center'>{{ $school->type }}</td>
                            <td align='center'>{{ $school->level }}</td>
                            @if(isset($school_student_gender_count[$school->id][2]))
                            <td align='center'>{{ $school_student_gender_count[$school->id][2] }} (<i>{{ round(100*($school_student_gender_count[$school->id][2])/count($student_id[$school->id]),2)}}%</i>)</td>
                            @else
                            <td align='center'>0</td>
                            @endif
                            @if(isset($school_student_gender_count[$school->id][1]))
                            <td align='center'>{{ $school_student_gender_count[$school->id][1] }} (<i>{{ round(100*($school_student_gender_count[$school->id][1])/count($student_id[$school->id]),2)}}%</i>)</td>
                            @else
                            <td align='center'>0</td>
                            @endif
                            @if(isset($student_id[$school->id]))
                            <td align='center'><font color='446dff'><strong>{{ count($student_id[$school->id])}}</strong></font></td>
                            @else
                            <td align='center'>0</td>
                            @endif
                            @if(isset($school_teacher_gender_count[$school->id][2]))
                            <td align='center'>{{ $school_teacher_gender_count[$school->id][2] }} (<i>{{ round(100*($school_teacher_gender_count[$school->id][2])/count($teacher_id[$school->id]),2)}}%</i>)</td>
                            @else
                            <td align='center'>0</td>
                            @endif
                            @if(isset($school_teacher_gender_count[$school->id][1]))
                            <td align='center'>{{ $school_teacher_gender_count[$school->id][1] }} (<i>{{ round(100*($school_teacher_gender_count[$school->id][1])/count($teacher_id[$school->id]),2)}}%</i>)</td>
                            @else
                            <td align='center'>0</td>
                            @endif
                            @if(isset($teacher_id[$school->id]))
                            <td align='center'><font color='red'><strong>{{ count($teacher_id[$school->id])}}</strong></font></td>
                            @else
                            <td align='center'>0</td>
                            @endif
                            <td align='center'><a role="button" class="btn btn-block btn-outline-info btn-sm" href="{{ route('dis.show',$school->id)}}">Info</a>
                            </td>
                            </td>
                        </tr>
                        @endforeach
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
<!--modal for school registration -->
<div class="modal fade" id="addSchool">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New School</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="{{ route('schools.store') }}">
                    {{ csrf_field() }}

                    <div class="container">
                        <div class="row">
                            <div class="col-md">
                                <div class="form-group">
                                    <label for="schoolName">
                                        <font color="red">*</font><strong>School Name</strong>
                                    </label>
                                    <input type="text" class="form-control" id="schoolName" aria-describedby=""
                                        placeholder="school name" name="schoolname">
                                </div>

                    

                                <div class="form-group">
                                    <label for="level">
                                        <font color="red">*</font><strong>School Level</strong>
                                    </label>
                                    <select class="form-control" name='schoollevel_id'>
                                        <option>..Select Level..</option disabled selected>
                                        @foreach($schoollevels as $schoollevel)
                                        <option value="{{$schoollevel->id}}">{{$schoollevel->level}}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="Type">
                                        <font color="red">*</font><strong>School Type</strong>
                                    </label>
                                    <select class="form-control" name='schooltype_id'>
                                        <option>..Select Type..</option disabled selected>
                                        @foreach($schooltypes as $schooltype)
                                        <option value="{{$schooltype->id}}">{{$schooltype->type}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="status">
                                        <font color="red">*</font><strong>School Status</strong>
                                    </label>
                                    <select class="form-control" name='schoolstatus_id'>
                                        <option>..Select Status..</option disabled selected>
                                        @foreach($schoolstatuses as $schoolstatus)
                                        <option value="{{$schoolstatus->id}}">{{$schoolstatus->status}}</option>
                                        @endforeach
                                    </select>
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

@endsection