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

                                <input type='hidden' name='subject_id' value='{{ $subject_id }}' />

                                <input type='hidden' name='subject_papers' value='{{ $subject_papers }}' />

                                <input type='hidden' name='testdate' value='{{ $test_date[$marks_student_id[$marks_id[0]]]  }}' />
                                
                                
                                <!-- ./col -->
                                <div class="col-12">

                                    <font color='red'><strong>{{ $subject_code }}</strong></font>: <i>
                                        {{ $subject_name }} </i>

                                </div>
                                <hr>
                       
                                <!--div class="col-6">
                                    <div class="form-group">
                                        <label for="Gender">
                                            <font color="red">*</font><strong>Test/Exam Date</strong>
                                        </label>
                                        
                                    </div>

                                </div-->

                                <hr>
                                <div class="row justify-content-center">
                            
                                    @if($subject_papers == 2)
                                    <div class="col-lg-3 col-6">
                                        <div class="form-group">
                                            <label for="glastName">
                                                <font color="red">*</font><strong>Maximum Possible marks: <font
                                                        color='red'>
                                                        Paper 1
                                                    </font></strong>
                                            </label>
                                            <input type="hidden" min='0' class="form-control" id="glastName"
                                                aria-describedby="" value="{{ $maxpos_p1[$marks_student_id[$marks_id[0]]] }}" name="max_marks_p1">
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-6">
                                        <div class="form-group">
                                            <label for="glastName">
                                                <font color="red">*</font><strong>Maximum Possible marks: <font
                                                        color='red'>
                                                        Paper 2
                                                    </font></strong>
                                            </label>
                                            <input type="number" min='0' class="form-control" id="glastName"
                                                aria-describedby="" value="{{ $maxpos_p2[$marks_student_id[$marks_id[0]]] }}" name="max_marks_p2">
                                        </div>
                                    </div>
                                    @elseif($subject_papers == 3)
                                    <div class="col-lg-3 col-4">
                                        <div class="form-group">
                                            <label for="glastName">
                                                <font color="red">*</font><strong>Maximum Possible marks: <font
                                                        color='red'>
                                                        Paper 1
                                                    </font></strong>
                                            </label>
                                            <input type="number" min='0' class="form-control" id="glastName"
                                                aria-describedby="" value="{{ $maxpos_p1[$marks_student_id[$marks_id[0]]] }}" name="max_marks_p1">
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-4">
                                        <div class="form-group">
                                            <label for="glastName">
                                                <font color="red">*</font><strong>Maximum Possible marks: <font
                                                        color='red'>
                                                        Paper 2
                                                    </font></strong>
                                            </label>
                                            <input type="number" min='0' class="form-control" id="glastName"
                                                aria-describedby="" value="{{ $maxpos_p2[$marks_student_id[$marks_id[0]]] }}" name="max_marks_p2">
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-4">
                                        <div class="form-group">
                                            <label for="glastName">
                                                <font color="red">*</font><strong>Maximum Possible marks: <font
                                                        color='red'>
                                                        Paper 3
                                                    </font></strong>
                                            </label>
                                            <input type="number" min='0' class="form-control" id="glastName"
                                                aria-describedby="" value="{{ $maxpos_p3[$marks_student_id[$marks_id[0]]] }}" name="max_marks_p3">
                                        </div>
                                    </div>
                                    @elseif($subject_papers == 4)
                                    <div class="col-lg-3 col-4">
                                        <div class="form-group">
                                            <label for="glastName">
                                                <font color="red">*</font><strong>Maximum Possible marks: <font
                                                        color='red'>
                                                        Paper 1
                                                    </font></strong>
                                            </label>
                                            <input type="number" min='0' class="form-control" id="glastName"
                                                aria-describedby="" value="{{ $maxpos_p1[$marks_student_id[$marks_id[0]]] }}" name="max_marks_p1">
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-4">
                                        <div class="form-group">
                                            <label for="glastName">
                                                <font color="red">*</font><strong>Maximum Possible marks: <font
                                                        color='red'>
                                                        Paper 2
                                                    </font></strong>
                                            </label>
                                            <input type="number" min='0' class="form-control" id="glastName"
                                                aria-describedby="" value="{{ $maxpos_p2[$marks_student_id[$marks_id[0]]] }}" name="max_marks_p2">
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-4">
                                        <div class="form-group">
                                            <label for="glastName">
                                                <font color="red">*</font><strong>Maximum Possible marks: <font
                                                        color='red'>
                                                        Paper 3
                                                    </font></strong>
                                            </label>
                                            <input type="number" min='0' class="form-control" id="glastName"
                                                aria-describedby="" value="{{ $maxpos_p3[$marks_student_id[$marks_id[0]]] }}" name="max_marks_p3">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-4">
                                        <div class="form-group">
                                            <label for="glastName">
                                                <font color="red">*</font><strong>Maximum Possible marks: <font
                                                        color='red'>
                                                        Paper 4
                                                    </font></strong>
                                            </label>
                                            <input type="number" min='0' class="form-control" id="glastName"
                                                aria-describedby="" value="{{ $maxpos_p4[$marks_student_id[$marks_id[0]]] }}" name="max_marks_p4">
                                        </div>
                                    </div>
                                    @endif
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
                                @if($subject_papers == 2)
                                <th scope="col">Paper 1</th>
                                <th scope="col">Paper 2</th>
                                @elseif($subject_papers == 3)
                                <th scope="col">Paper 1</th>
                                <th scope="col">Paper 2</th>
                                <th scope="col">Paper 3</th>
                                @elseif($subject_papers == 4)
                                <th scope="col">Paper 1</th>
                                <th scope="col">Paper 2</th>
                                <th scope="col">Paper 3</th>
                                <th scope="col">Paper 4</th>
                                @endif
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
                                @if($subject_papers == 2)
                                    @if(isset( $paper_1_marks[$class_student->student_id]) && isset( $paper_2_marks[$class_student->student_id]))
                                        <td><strong>{{ $paper_1_marks[$class_student->student_id] }}</strong></td>
                                        <td><strong>{{ $paper_2_marks[$class_student->student_id] }}</strong></td>
                                    @else
                                        <td align='center'><input type='number' min=0 step=0.1
                                        name="paper_1_<?php print_r($class_student->student_id);?>" />
                                        </td>
                                        <td align='center'><input type='number' min=0 step=0.1
                                        name="paper_2_<?php print_r($class_student->student_id);?>" />
                                        </td>
                                    @endif
                                @elseif($subject_papers == 3)
                                    @if(isset($paper_1_marks[$class_student->student_id]) && isset($paper_2_marks[$class_student->student_id]) && isset($paper_3_marks[$class_student->student_id])) 
                                        <td><strong>{{ $paper_1_marks[$class_student->student_id] }}</strong></td>
                                        <td><strong>{{ $paper_2_marks[$class_student->student_id] }}</strong></td>
                                        <td><strong>{{ $paper_3_marks[$class_student->student_id] }}</strong></td>
                                    @else
                                        <td align='center'><input type='number' min=0 step=0.1
                                        name="paper_1_<?php print_r($class_student->student_id);?>" />
                                        </td>
                                        <td align='center'><input type='number' min=0 step=0.1
                                        name="paper_2_<?php print_r($class_student->student_id);?>" />
                                        </td>
                                        <td align='center'><input type='number' min=0 step=0.1
                                        name="paper_3_<?php print_r($class_student->student_id);?>" />
                                        </td>
                                    @endif
                                @elseif($subject_papers == 4)
                                    @if(isset($paper_1_marks[$class_student->student_id]) && isset($paper_2_marks[$class_student->student_id]) && isset($paper_3_marks[$class_student->student_id]) && isset($paper_4_marks[$class_student->student_id]))
                                    <td><strong>{{ $paper_1_marks[$class_student->student_id] }}</strong></td>
                                    <td><strong>{{ $paper_2_marks[$class_student->student_id] }}</strong></td>
                                    <td><strong>{{ $paper_3_marks[$class_student->student_id] }}</strong></td>
                                    <td><strong>{{ $paper_4_marks[$class_student->student_id] }}</strong></td>
                                    @else
                                        <td align='center'><input type='number' min=0 step=0.1
                                        name="paper_1_<?php print_r($class_student->student_id);?>" />
                                        </td>
                                        <td align='center'><input type='number' min=0 step=0.1
                                        name="paper_2_<?php print_r($class_student->student_id);?>" />
                                        </td>
                                        <td align='center'><input type='number' min=0 step=0.1
                                        name="paper_3_<?php print_r($class_student->student_id);?>" />
                                        </td>
                                        <td align='center'><input type='number' min=0 step=0.1
                                            name="paper_4_<?php print_r($class_student->student_id);?>" />
                                        </td>
                                    @endif
                                @endif
                          
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