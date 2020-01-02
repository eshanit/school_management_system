@extends('layouts.app_og')

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class='col-8'>
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">
                            <!--i class="fas fa-exclamation-triangle"></i-->
                            <small>
                                <strong>
                                    Report Card:
                                </strong>
                            </small>
                        </h3>
                    </div>
                    <div class='card-body'>
                        <div class='col-12'>
                            <div class='row col-12'>
                                <div class='col-6'>Name:</div>
                                <div class='col-6'>{{ $studentname }}</div>
                            </div>
                            <div class='row col-12'>
                                <div class='col-6'>Year:</div>
                                <div class='col-6'>{{ $year }}</div>
                            </div>
                            <div class='row col-12'>
                                <div class='col-6'>Term:</div>
                                <div class='col-6'>{{ $term_id }}</div>
                            </div>
                            <div class='row col-12'>
                                <div class='col-6'>Class:</div>
                                <div class='col-6'>{{ $classname }}</div>
                            </div>
                        </div>

                        <hr>

                        <table id="reportcard" class="table table-bordered table-striped" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Marks(Paper 1)</th>
                                    <th scope="col">Marks(Paper 2)</th>
                                    <th scope="col">Total Marks</th>
                                    <th scope="col">% Mark</th>
                                    <th scope="col">Subject Position</th>
                                    <th scope="col">Graded Points</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for($i = 0; $i < count($marks_id); $i++) <tr>

                                    <td>{{$subjectsdone[$marks_id[$i]]}}</td>
                                    @if($paper_1_marks[$marks_id[$i]] < 0.5*$max_marks_paper_1[$marks_id[$i]]) 
                                        <td>
                                        <font color='red'>{{$paper_1_marks[$marks_id[$i]]}}</font>
                                        /<strong>{{$max_marks_paper_1[$marks_id[$i]]}}</strong>
                                        </td>
                                    @else
                                        <td>
                                            <font color='blue'>{{$paper_1_marks[$marks_id[$i]]}}</font>
                                            /<strong>{{$max_marks_paper_1[$marks_id[$i]]}}</strong>
                                        </td>
                                    @endif
                                    @if($paper_2_marks[$marks_id[$i]] < 0.5*$max_marks_paper_2[$marks_id[$i]]) 
                                        <td>
                                        <font color='red'>{{$paper_2_marks[$marks_id[$i]]}}</font>
                                        /<strong>{{$max_marks_paper_2[$marks_id[$i]]}}</strong>
                                        </td>
                                    @else
                                        <td>
                                            <font color='blue'>{{$paper_2_marks[$marks_id[$i]]}}</font>
                                            /<strong>{{$max_marks_paper_2[$marks_id[$i]]}}</strong>
                                        </td>
                                    @endif

                                        <td>
                                        {{$total_marks[$marks_id[$i]]}}/<strong>{{$total_max_marks[$marks_id[$i]]}}</strong>
                                        </td>
                                    @if($aggregate_perc[$marks_id[$i]] < 50)
                                        <td><font color='red'>{{$aggregate_perc[$marks_id[$i]]}}%</font></td>
                                    @else
                                        <td><font color='blue'>{{$aggregate_perc[$marks_id[$i]]}}%</font></td>
                                    @endif
                                        <td>{{$rankedAggregatesSubjects[$marks_id[$i]][$student_idx]}}/<strong>{{count($rankedAggregatesSubjects[$marks_id[$i]])}}</strong>
                                        </td>
                                        <td>{{ $graded_points[$marks_id[$i]] }}</td>
                                        </tr>
                                        @endfor
                                        <tr>
                                            <td><strong>
                                                    <font color='green'>Total</font>
                                                </strong></td>
                                            <td></td>
                                            <td></td>
                                            <td><strong>
                                                    <font color='orange'>{{$total_marks_per_student[$student_idx]}}
                                                    </font>
                                                </strong></td>
                                            <td></td>
                                            <td></td>
                                            <td>-</td>
                                        </tr>
                            </tbody>
                        </table>

                        <div class='col-12'>
                            <hr>
                        </div>
                        <div class='row col-12'>
                            <div class='col-sm-4'>
                                <button class="info-box bg-light btn btn-block" type='submit'>
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Class Position</span>
                                        <hr>
                                        <span class="info-box-number text-center text-muted mb-0">
                                            <font color='red' size='8'>{{ $rankedAggregates[$student_idx] }}</font>
                                        </span>
                                    </div>
                                </button>
                            </div>

                            <div class='col-sm-4'>
                                <button class="info-box bg-light btn btn-block" type='submit'>
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">All Students</span>
                                        <hr>
                                        <span class="info-box-number text-center text-muted mb-0">
                                            <font color='446dff' size='8'>{{ count($rankedAggregates) }}</font>
                                        </span>
                                    </div>
                                </button>
                            </div>

                            <div class='col-sm-4'>
                                <button class="info-box bg-light btn btn-block" type='submit'>
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Total Points</span>
                                        <hr>
                                        <span class="info-box-number text-center text-muted mb-0">
                                            <font color='purple' size='8'>{{ $total_points }}</font>
                                        </span>
                                    </div>
                                </button>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
</section> @endsection