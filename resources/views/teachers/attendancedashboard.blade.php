@extends('layouts.app_og')

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <!-- Small Box (Stat card) -->
        <h5 class="mb-2 mt-4"><strong>Dashboard</strong>| <font color='green'><i>{{ $class_students->count() }}</i></font> Students in this class</h5>
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

        
            <!-- ./col -->
        </div>
        <!-- /.row -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <strong>Fill in Form Below</strong>
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                    
            <form class="form-horizontal" method="POST" action="{{ route('student_attendance.store') }}">
                {{ csrf_field() }}

                    <input type='hidden' name='school_id' value='1' />

                    <input type='hidden' name='term_id' value='{{ $term_id }}' />

                    <input type='hidden' name='studentclass_id' value='{{ $schoolclass_id }}' />

                    <br>
                    <div class="col-2 form-group">
                        <label for="dateOfEnrollment">
                            <font color="red">*</font><strong>Date</strong>
                        </label>
                        <input type="date" class="form-control" id="dateOfEnrollment" aria-describedby=""
                            name="dateofattendance">
                    </div>
                    <br>
                <table id="student_attendance" class="table table-bordered table-striped" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Student Name</th>
                            <th scope="col">Student Middlename</th>
                            <th scope="col">Student Surname</th>
                            <th scope="col"><font color ='446dff'>Present</font></th>
                            <th scope="col"><font color ='red'>Not Present</font></th>
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
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="1" id="defaultCheck2" name="attendance_{{$class_student->id}}" checked='checked'>
                                </div>
    
                            </td>
                            <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="0" id="defaultCheck2" name="attendance_{{$class_student->id}}">
                                    </div>
        
                                </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <hr>

                <button type="submit" class="btn btn-primary float-right">Submit Attendance</button>
            </form>
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