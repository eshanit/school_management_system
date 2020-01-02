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
                        <th scope="col">Paper 3</th>
                        <th scope="col">Paper 4</th>
                        <th scope="col">% Paper 1</th>
                        <th scope="col">% Paper 2</th>
                        <th scope="col">% Paper 3</th>
                        <th scope="col">% Paper 4</th>
                        <th scope="col">% Aggr Score</th>
                        <!--th scope="col">Subject Position</th>
                        <th scope="col">Edit/Delete</th-->
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
                        @if($percentage_p3[$mark->id] != "-")
                        <td>{{ $mark->marks_paper_3 }}/<strong>{{$mark->maxmarks_paper_3}}</strong></td>
                        @else
                        <td>-</strong></td>
                        @endif
                        @if($percentage_p4[$mark->id] != "-")
                        <td>{{ $mark->marks_paper_4 }}/<strong>{{$mark->maxmarks_paper_4}}</strong></td>
                        @else
                        <td>-</strong></td>
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
                    @if($percentage_p3[$mark->id] != "-")
                        @if($percentage_p3[$mark->id] < 50) <td align='center'>
                            <font color='red'>{{$percentage_p3[$mark->id]}}%</font>
                            </td>
                            @else
                            <td align='center'>
                                <font color='blue'>{{$percentage_p3[$mark->id]}}%</font>
                            </td>
                        @endif
                    @else
                    <td align='center'>
                                <font color='blue'>-</font>
                            </td>
                    @endif
                    @if($percentage_p4[$mark->id] != "-")
                        @if($percentage_p4[$mark->id] < 50) <td align='center'>
                                <font color='red'>{{$percentage_p4[$mark->id]}}%</font>
                                </td>
                                @else
                                <td align='center'>
                                    <font color='blue'>{{$percentage_p4[$mark->id]}}%</font>
                                </td>
                        @endif
                    @else
                    <td align='center'>
                                <font color='blue'>-</font>
                            </td>
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


                                    <!--td>{{ $rankedAggregates[$mark->id] }}</td>
                                    <td align='center'>
                                        <font color='orange'><span data-toggle="modal"
                                                data-target="#editStudent_<?php print_r($mark->student_id);?>"
                                                style="cursor:pointer"><i class="fas fa-user-edit fa-1.5x"></i></span>
                                        </font> /
                                        @if($mark->activestatus_id == 1 )
                                        <font color='red'>
                                            <a class="delete-student" data-student-id="{{$mark->student_id}}"
                                                onclick="deleteStudent({{ $mark->student_id }})">
                                                <span style="cursor:pointer">
                                                    <i class="fas fa-user-times fa-1.5x"></i>
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
                                    </td-->
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>

</section>


@endsection