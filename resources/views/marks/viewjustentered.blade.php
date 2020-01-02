@extends('layouts.app_og')

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">
                            <!--i class="fas fa-exclamation-triangle"></i-->
                            <small><strong>Year {{ $currentyear }} | Term {{ $termid }}</strong></small>
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <!-- Small Box (Stat card) -->
                        <h5 class="mb-2 mt-4"><strong></strong></h5>
                        <div class="row justify-content-center">

                            <div class='col-6'>

                                <strong>Subject</strong> | {{ $selectedsubject }}

                            </div>

                            <div class='col-6'>

                                <strong>Exam Date</strong> | {{ $testdate }}

                            </div>
                        </div>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>

    </div>

    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">
                <!--i class="fas fa-exclamation-triangle"></i-->
                <small><strong>Year {{ $currentyear }} | Term {{ $termid }}</strong></small>
            </h3>
        </div>
        <div class="card-body">
            <table id="newmarks" class="table table-bordered table-striped" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Surname</th>
                        <th scope="col">Subject</th>
                        <th scope="col">Paper 1</th>
                        <th scope="col">Paper 2</th>
                        @if($num_subject_papers == 3)
                        <th scope="col">Paper 3</th>
                        @elseif($num_subject_papers == 4)
                        <th scope="col">Paper 3</th>
                        <th scope="col">Paper 4</th>
                        @endif
                        <th scope="col">% Paper 1</th>
                        <th scope="col">% Paper 2</th>
                        @if($num_subject_papers == 3)
                        <th scope="col">% Paper 3</th>
                        @elseif($num_subject_papers == 4)
                        <th scope="col">% Paper 3</th>
                        <th scope="col">% Paper 4</th>
                        @endif
                        <th scope="col">% Aggr Score</th>
                        <th scope="col">Subject Position</th>
                        <th scope="col">Edit/Delete</th>
                    </tr>
                </thead>
                @php
                $i = 1;
                @endphp
                <tbody>
                    @foreach ($marks as $mark)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $mark->firstname }}</td>
                        <td>{{ $mark->lastname}}</td>
                        <td>{{ $mark->name}}</td>
                        <td>{{ $mark->marks_paper_1 }}/<strong>{{$mark->maxmarks_paper_1}}</strong></td>
                        <td>{{ $mark->marks_paper_2 }}/<strong>{{$mark->maxmarks_paper_2}}</strong></td>
                        @if($num_subject_papers == 3)
                        <td>{{ $mark->marks_paper_3 }}/<strong>{{$mark->maxmarks_paper_3}}</strong></td>
                        @elseif($num_subject_papers == 4)
                        <td>{{ $mark->marks_paper_3 }}/<strong>{{$mark->maxmarks_paper_3}}</strong></td>
                        <td>{{ $mark->marks_paper_4 }}/<strong>{{$mark->maxmarks_paper_4}}</strong></td>
                        @endif

                        @if($percentage_p1[$mark->id] < 50) <td align='center'>
                            <font color='red'>{{$percentage_p1[$mark->id]}}%</font>
                            </td>
                            @else
                            <td align='center'>
                                <font color='blue'>{{$percentage_p1[$mark->id]}}%</font>
                            </td>
                        @endif

                        @if($percentage_p2[$mark->id] < 50) <td align='center'>
                                <font color='red'>{{$percentage_p2[$mark->id]}}%</font>
                                </td>
                                @else
                                <td align='center'>
                                    <font color='blue'>{{$percentage_p2[$mark->id]}}%</font>
                                </td>
                        @endif
                    @if($num_subject_papers == 3)
                        @if($percentage_p3[$mark->id] < 50) <td align='center'>
                            <font color='red'>{{$percentage_p3[$mark->id]}}%</font>
                            </td>
                            @else
                            <td align='center'>
                                <font color='blue'>{{$percentage_p3[$mark->id]}}%</font>
                            </td>
                        @endif
                    @elseif($num_subject_papers == 4)
     
                    @if($percentage_p3[$mark->id] < 50) <td align='center'>
                        <font color='red'>{{$percentage_p3[$mark->id]}}%</font>
                        </td>
                        @else
                        <td align='center'>
                            <font color='blue'>{{$percentage_p3[$mark->id]}}%</font>
                        </td>
                    @endif

                        @if($percentage_p4[$mark->id] < 50) <td align='center'>
                                <font color='red'>{{$percentage_p4[$mark->id]}}%</font>
                                </td>
                                @else
                                <td align='center'>
                                    <font color='blue'>{{$percentage_p4[$mark->id]}}%</font>
                                </td>
                        @endif
                    @endif



                                @if($aggregatepercentage[$mark->id] < 50) <td align='center'>
                                    <font color='red'><strong>{{$aggregatepercentage[$mark->id]}}%</strong></font>
                                    </td>
                                    @else
                                    <td align='center'>
                                        <font color='blue'><strong>{{$aggregatepercentage[$mark->id]}}%</strong>
                                        </font>
                                    </td>
                                @endif


                                    <td>{{ $rankedAggregates[$mark->id] }}</td>
                                    <td align='center'>
                                        <font color='orange'><span data-toggle="modal"
                                                data-target="#editStudentMarks_<?php print_r($mark->student_id);?>"
                                                style="cursor:pointer"><i class="far fa-edit fa-1.5x"></i></span>
                                        </font> /
                                        @if($mark->activestatus_id == 1 )
                                        <font color='red'>
                                            <a class="delete-student" data-student-id="{{$mark->student_id}}"
                                                onclick="deleteStudent({{ $mark->student_id }})">
                                                <span style="cursor:pointer">
                                                    <i class="far fa-trash-alt fa-1.5x"></i>
                                                </span>
                                            </a>
                                        </font>
                                        @else
                                        <font color='green'>
                                            <a class="undelete-student" data-student-id="{{$mark->student_id}}"
                                                onclick="undeleteStudent({{ $mark->student_id }})">
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
    </div>
    </div>

</section>

<!-- edit class to student modal-->
@foreach($marks as $mark)
<div class="modal fade" id="editStudentMarks_<?php print_r($mark->student_id);?>" tabindex="-1" role="dialog"
    aria-labelledby="editing" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editing"><strong>
                        <font color='#96384e'>Edit Marks for:</font>
                        <font color='orange'>{{ $mark->firstname }} {{$mark->lastname}}</font>.<br>
                        <font color='#96384e'>Subject:</font>
                        <font color='orange'>{{ $selectedsubject }}</font>.

                    </strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form class="form-horizontal" method="POST" action="{{ route('teachermarksview.update',[$mark->id]) }}">
            
                {{ method_field('PUT') }}

                    {{ csrf_field() }}


                    <div class="form-group">
                        <input type="hidden" class="form-control" id="student" aria-describedby=""
                             value="{{$subject_id}}"
                            name="subject_id">
                    </div>

                    <div class="form-group">
                        <input type="hidden" class="form-control" id="student" aria-describedby=""
                             value="{{$num_subject_papers}}"
                            name="subject_paper_numbers">
                    </div>

                    <!---->


                    <div class="form-group">
                        <label for="School Grade">
                            <font color="red">*</font><strong>Paper 1</strong>
                        </label>
                        <div class="form-group">
                            <input type="number" class="form-control" id="student" aria-describedby=""
                                 value="{{ $mark->marks_paper_1 }}"
                                name="paper_1">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="School Grade">
                            <font color="red">*</font><strong>Paper 2</strong>
                        </label>
                        <div class="form-group">
                            <input type="number" class="form-control" id="student" aria-describedby=""
                                 value="{{ $mark->marks_paper_2 }}"
                                name="paper_2">
                        </div>
                    </div>

                    @if($num_subject_papers == 3)
                    <div class="form-group">
                        <label for="School Grade">
                            <font color="red">*</font><strong>Paper 3</strong>
                        </label>
                        <div class="form-group">
                            <input type="number" class="form-control" id="student" aria-describedby=""
                                 value="{{ $mark->marks_paper_3 }}"
                                name="paper_3">
                        </div>
                    </div>
                    @elseif($num_subject_papers == 4)

                    
                    <div class="form-group">
                        <label for="School Grade">
                            <font color="red">*</font><strong>Paper 3</strong>
                        </label>
                        <div class="form-group">
                            <input type="number" class="form-control" id="student" aria-describedby=""
                                 value="{{ $mark->marks_paper_3 }}"
                                name="paper_3">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="School Grade">
                            <font color="red">*</font><strong>Paper 4</strong>
                        </label>
                        <div class="form-group">
                            <input type="number" class="form-control" id="student" aria-describedby=""
                                 value="{{ $mark->marks_paper_4 }}"
                                name="paper_4">
                        </div>
                    </div>

                    @endif

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