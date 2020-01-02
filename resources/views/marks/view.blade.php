@extends('layouts.app_og')

@section('content')
<!-- Main content -->
<section class="content">

    <div class="container-fluid">
        <form class="form-horizontal" method="POST" action="{{ route('teachermarksenter.store') }}">

            {{ csrf_field() }}

            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">
                                <!--i class="fas fa-exclamation-triangle"></i-->
                                <small><strong>Year {{ $currentyear }} | Term {{ $term_id}} </strong></small>
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <!-- Small Box (Stat card) -->
                            <h5 class="mb-2 mt-4"><strong></strong></h5>
                            <div class="row justify-content-center">

                                <input type='hidden' name='term_id' value='{{ $term_id }}' />

                                <input type='hidden' name='studentclass_id' value='{{ $schoolclass_id }}' />

                                <input type='hidden' name='teacher_id' value='{{ $teacher_id }}' />

                                <!-- ./col -->
                                <div class="col-lg-3 col-6">
                                    <div class="form-group">
                                        <label for="Gender">
                                            <font color="red">*</font><strong>Subject</strong>
                                        </label>
                                        <select class="form-control" name='subject_id'>
                                            <option disabled selected>..Select Subject..</option>
                                            @foreach($subjects as $subject)
                                            <option value="{{$subject->id}}">{{$subject->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>

                                <!-- ./col -->
                                <div class="col-lg-3 col-6">
                                    <div class="form-group">
                                        <label for="Gender">
                                            <font color="red">*</font><strong>Test/Exam Date</strong>
                                        </label>
                                        <input type="date" class="form-control" id="testdate" aria-describedby=""
                                            name="testdate">
                                    </div>

                                </div>
                            </div>
                            <hr>
                            <div class="row justify-content-center">
                                <!-- ./col -->
                                <div class="col-lg-3 col-6">
                                    <div class="form-group">
                                        <label for="glastName">
                                            <font color="red">*</font><strong>Maximum Possible marks: <font color='red'>
                                                    Paper 1
                                                </font></strong>
                                        </label>
                                        <input type="number" min='0' class="form-control" id="glastName"
                                            aria-describedby="" placeholder="" name="max_marks_p1">
                                    </div>
                                </div>

                                <div class="col-lg-3 col-6">
                                    <div class="form-group">
                                        <label for="glastName">
                                            <font color="red">*</font><strong>Maximum Possible marks: <font color='red'>
                                                    Paper 2
                                                </font></strong>
                                        </label>
                                        <input type="number" min='0' class="form-control" id="glastName"
                                            aria-describedby="" placeholder="" name="max_marks_p2">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <div class="card">
                <div class="card-header">
                    <!--h3 class="card-title">
                        <strong>Marks Portal</strong>: <button type="button" class="btn btn-outline-info btn-sm"
                            data-toggle="modal" data-target="#enterMarks">Enter Marks</button> | <button type="button"
                            class="btn  btn-outline-danger btn-sm" data-toggle="modal" data-target="#viewmarks">View
                            Marks</button>
                    </h3-->
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <table id="enter_marks" class="table table-bordered table-striped" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Student Name</th>
                                <th scope="col">Student Middlename</th>
                                <th scope="col">Student Surname</th>
                                <th scope="col">Paper 1</th>
                                <th scope="col">Paper 2</th>
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
                                <td align='center'><input type='number' min=0 step=0.1
                                        name="paper_1_<?php print_r($class_student->student_id);?>" /></td>
                                <td align='center'><input type='number' min=0 step=0.1
                                        name="paper_2_<?php print_r($class_student->student_id);?>" /></td>

                                <!--td align='center'>
                                    <font color='orange'><span data-toggle="modal"
                                            data-target="#editStudent_<?php print_r($class_student->student_id);?>"
                                            style="cursor:pointer"><i class="fas fa-user-edit fa-lg"></i></span>
                                    </font> /
                                    @if(($class_student->activestatus_id) == 1 )
                                    <font color='red'>
                                        <a class="delete-student" data-student-id="{{$class_student->student_id}}"
                                            onclick="deleteStudent({{ $class_student->student_id }})">
                                            <span style="cursor:pointer">
                                                <i class="fas fa-user-times fa-lg"></i>
                                            </span>
                                        </a>
                                    </font>
                                    @else
                                    <font color='green'>
                                        <a class="undelete-student" data-student-id="{{$class_student->student_id}}"
                                            onclick="undeleteStudent({{ $class_student->student_id }})">
                                            <span style="cursor:pointer">
                                                <i class="fas fa-user-check fa-1.5x"></i>
                                            </span>
                                        </a>
                                        @endif
                                    </font>
                                </td-->
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <hr>

                    <button type="submit" class="btn btn-primary float-right">Submit Marks</button>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </form>
</div>

</section>


@endsection