@extends('layouts.app_og')

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">

            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">
                        <!--i class="fas fa-exclamation-triangle"></i-->
                        <small><strong>
                                <font color='red'>raw marks</font>: Year {{ $currentyear }} | Term {{ $term_id }} |
                                Form {{$classname}}
                            </strong></small>
                    </h3>
                </div>
                <div class="card-body">
                    <table id="markschedule" class="table table-bordered table-striped" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                @for($i = 0 ;$i< count($class_subjects);$i++) <th scope="col">
                                    {{ $subjectname[$class_subjects[$i]] }}</th>
                                    @endfor
                                    <th scope="col">Total</th>
                                    <th scope="col">Class Position</th>
                            </tr>
                        </thead>

                        <tbody>
                            @for($i=0 ; $i < count($student_idy) ;$i++) <tr>
                                <td>{{ $i+1 }}</td>
                                <td>{{ $studentname[$student_idy[$i]] }}</td>
                                @for($j = 0 ;$j < count($class_subjects);$j++)
                                    @if($total_marks_per_student_per_subject[$student_idy[$i]][$class_subjects[$j]] <
                                    0.5*$maxpos_total_per_student[$student_idy[$i]][$class_subjects[$j]]) <td
                                    scope="col">
                                    <font color='red'>
                                        {{ $total_marks_per_student_per_subject[$student_idy[$i]][$class_subjects[$j]]}}
                                    </font>
                                    /<strong>{{ $maxpos_total_per_student[$student_idy[$i]][$class_subjects[$j]]}}</strong>
                                    </td>
                                    @else
                                    <td scope="col">
                                        <font color='blue'>
                                            {{ $total_marks_per_student_per_subject[$student_idy[$i]][$class_subjects[$j]]}}
                                        </font>
                                        /<strong>{{ $maxpos_total_per_student[$student_idy[$i]][$class_subjects[$j]]}}</strong>
                                    </td>
                                    @endif
                                    @endfor
                                    <td>{{ $total_marks_per_student[$student_idy[$i]]}}</td>
                                    <td>{{ $rankedAggregates[$student_idy[$i]] }}</td>
                                    </tr>
                                    @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <hr>
        <div class="row justify-content-center">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">
                        <!--i class="fas fa-exclamation-triangle"></i-->
                        <small><strong>
                                <font color='red'>raw Paper 1 marks</font>: Year {{ $currentyear }} | Term
                                {{ $term_id }} | Form {{$classname}}
                            </strong></small>
                    </h3>
                </div>
                <div class="card-body">
                    <table id="markschedule_paper_1" class="table table-bordered table-striped" cellspacing="0"
                        width="100%">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                @for($i = 0 ;$i< count($class_subjects);$i++) <th scope="col">
                                    {{ $subjectname[$class_subjects[$i]] }}</th>
                                    @endfor
                            </tr>
                        </thead>

                        <tbody>
                            @for($i=0 ; $i < count($student_idy) ;$i++) <tr>
                                <td>{{ $i+1 }}</td>
                                <td>{{ $studentname[$student_idy[$i]] }}</td>
                                @for($j = 0 ;$j < count($class_subjects);$j++)
                                    @if($paper_1_marks_per_student[$student_idy[$i]][$class_subjects[$j]] <
                                    0.5*$maxpos_p1_per_student[$student_idy[$i]][$class_subjects[$j]]) <td scope="col">
                                    <font color='red'>
                                        {{ $paper_1_marks_per_student[$student_idy[$i]][$class_subjects[$j]]}}
                                    </font>
                                    /<strong>{{ $maxpos_p1_per_student[$student_idy[$i]][$class_subjects[$j]]}}</strong>
                                    </td>
                                    @else
                                    <td scope="col">
                                        <font color='blue'>
                                            {{ $paper_1_marks_per_student[$student_idy[$i]][$class_subjects[$j]]}}
                                        </font>
                                        /<strong>{{ $maxpos_p1_per_student[$student_idy[$i]][$class_subjects[$j]]}}</strong>
                                    </td>
                                    @endif
                                    @endfor
                                    </tr>
                                    @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <hr>
        <div class="row justify-content-center">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">
                        <!--i class="fas fa-exclamation-triangle"></i-->
                        <small><strong>
                                <font color='red'>raw Paper 2 marks</font>: Year {{ $currentyear }} | Term
                                {{ $term_id }} | Form {{$classname}}
                            </strong></small>
                    </h3>
                </div>
                <div class="card-body">
                    <table id="markschedule_paper_2" class="table table-bordered table-striped" cellspacing="0"
                        width="100%">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                @for($i = 0 ;$i< count($class_subjects);$i++) <th scope="col">
                                    {{ $subjectname[$class_subjects[$i]] }}</th>
                                    @endfor
                            </tr>
                        </thead>

                        <tbody>
                            @for($i=0 ; $i < count($student_idy) ;$i++) <tr>
                                <td>{{ $i+1 }}</td>
                                <td>{{ $studentname[$student_idy[$i]] }}</td>
                                @for($j = 0 ;$j < count($class_subjects);$j++)
                                    @if($paper_2_marks_per_student[$student_idy[$i]][$class_subjects[$j]] <
                                    0.5*$maxpos_p2_per_student[$student_idy[$i]][$class_subjects[$j]]) <td scope="col">
                                    <font color='red'>
                                        {{ $paper_2_marks_per_student[$student_idy[$i]][$class_subjects[$j]]}}
                                    </font>
                                    /<strong>{{ $maxpos_p2_per_student[$student_idy[$i]][$class_subjects[$j]]}}</strong>
                                    </td>
                                    @else
                                    <td scope="col">
                                        <font color='blue'>
                                            {{ $paper_2_marks_per_student[$student_idy[$i]][$class_subjects[$j]]}}
                                        </font>
                                        /<strong>{{ $maxpos_p2_per_student[$student_idy[$i]][$class_subjects[$j]]}}</strong>
                                    </td>
                                    @endif
                                    @endfor
                                    </tr>
                                    @endfor
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <!-- /.col -->

        <hr>
        <div class="row justify-content-center">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">
                        <!--i class="fas fa-exclamation-triangle"></i-->
                        <small><strong>
                                <font color='red'>raw Paper 3 marks</font>: Year {{ $currentyear }} | Term
                                {{ $term_id }} | Form {{$classname}}
                            </strong></small>
                    </h3>
                </div>
                <div class="card-body">
                    <table id="markschedule_paper_3" class="table table-bordered table-striped" cellspacing="0"
                        width="100%">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                @for($i = 0 ;$i< count($class_subjects);$i++) <th scope="col">
                                    {{ $subjectname[$class_subjects[$i]] }}</th>
                                    @endfor
                            </tr>
                        </thead>

                        <tbody>
                            @for($i=0 ; $i < count($student_idy) ;$i++) <tr>
                                <td>{{ $i+1 }}</td>
                                <td>{{ $studentname[$student_idy[$i]] }}</td>
                                @for($j = 0 ;$j < count($class_subjects);$j++)
                                    @if($paper_3_marks_per_student[$student_idy[$i]][$class_subjects[$j]] <
                                    0.5*$maxpos_p3_per_student[$student_idy[$i]][$class_subjects[$j]]) <td scope="col">
                                    <font color='red'>
                                        {{ $paper_3_marks_per_student[$student_idy[$i]][$class_subjects[$j]]}}
                                    </font>
                                    /<strong>{{ $maxpos_p3_per_student[$student_idy[$i]][$class_subjects[$j]]}}</strong>
                                    </td>
                                    @else
                                    <td scope="col">
                                        <font color='blue'>
                                            {{ $paper_3_marks_per_student[$student_idy[$i]][$class_subjects[$j]]}}
                                        </font>
                                        /<strong>{{ $maxpos_p3_per_student[$student_idy[$i]][$class_subjects[$j]]}}</strong>
                                    </td>
                                    @endif
                                    @endfor
                                    </tr>
                                    @endfor
                        </tbody>
                    </table>
                </div>
            </div>

        </div>


        <hr>
        <div class="row justify-content-center">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">
                        <!--i class="fas fa-exclamation-triangle"></i-->
                        <small><strong>
                                <font color='red'>raw Paper 4 marks</font>: Year {{ $currentyear }} | Term
                                {{ $term_id }} | Form {{$classname}}
                            </strong></small>
                    </h3>
                </div>
                <div class="card-body">
                    <table id="markschedule_paper_4" class="table table-bordered table-striped" cellspacing="0"
                        width="100%">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                @for($i = 0 ;$i< count($class_subjects);$i++) <th scope="col">
                                    {{ $subjectname[$class_subjects[$i]] }}</th>
                                    @endfor
                            </tr>
                        </thead>

                        <tbody>
                            @for($i=0 ; $i < count($student_idy) ;$i++) <tr>
                                <td>{{ $i+1 }}</td>
                                <td>{{ $studentname[$student_idy[$i]] }}</td>
                                @for($j = 0 ;$j < count($class_subjects);$j++)
                                    @if($paper_4_marks_per_student[$student_idy[$i]][$class_subjects[$j]] <
                                    0.5*$maxpos_p4_per_student[$student_idy[$i]][$class_subjects[$j]]) <td scope="col">
                                    <font color='red'>
                                        {{ $paper_4_marks_per_student[$student_idy[$i]][$class_subjects[$j]]}}
                                    </font>
                                    /<strong>{{ $maxpos_p4_per_student[$student_idy[$i]][$class_subjects[$j]]}}</strong>
                                    </td>
                                    @else
                                    <td scope="col">
                                        <font color='blue'>
                                            {{ $paper_4_marks_per_student[$student_idy[$i]][$class_subjects[$j]]}}
                                        </font>
                                        /<strong>{{ $maxpos_p4_per_student[$student_idy[$i]][$class_subjects[$j]]}}</strong>
                                    </td>
                                    @endif
                                    @endfor
                                    </tr>
                                    @endfor
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
    </div>
    </div>
</section>


@endsection