@extends('layouts.app_og')

@section('content')
<!-- Main content -->

<div class="container-fluid">

@if($currentclasses_count != 0)

    <div class="row justify-content-center">
        <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <a class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Previous Classes</span>
                        <span class="info-box-number text-center text-muted mb-0">{{ $pastclasses_count }}</span>
                            <hr>
                            <i class="fas fa-angle-double-left float-left"></i>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-sm-6">
                    @if($currentclasses_count == 1)
                    <a class="info-box bg-light" href="{{route('class_teacher.show',$teacher_id)}}">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Current Classes</span>
                            <span class="info-box-number text-center text-muted mb-0">{{ $currentclasses_count }} <span>
                                    <hr>
                                    <i class="fas fa-angle-double-right float-right"></i>
                        </div>
                    </a>
                    @elseif($currentclasses_count > 1)
                    <a class="info-box bg-light" data-toggle="modal"
                    data-target="#classes">
                            <div class="info-box-content">
                                <span class="info-box-text text-center text-muted">Current Classes</span>
                                <span class="info-box-number text-center text-muted mb-0">{{ $currentclasses_count }} <span>
                                        <hr>
                                        <i class="fas fa-angle-double-right float-right"></i>
                            </div>
                    </a>
                    @else
                    <span class="info-box bg-light" href="">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Current Classes</span>
                            <span class="info-box-number text-center text-muted mb-0">0 <span>
                                    <hr>
                                    <i class="fas fa-angle-double-right float-right"></i>
                        </div>
                    </span>
                    @endif
                </div>
            </div>

        </div>
    </div>

   </div>
<!--modal create new subject -->
<div class="modal fade" id="classes">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Class List</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <table id="students" class="table table-bordered table-striped" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">year</th>
                                        <th scope="col">Class</th>
                                        <th scope="col">View</th>
                                     
                                        <!--th scope="col">Edit/Delete</th-->
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i = 1;
                                    @endphp
                                    @foreach ($currentclasses as $currentclass)
                                    <tr>
                                        <td align='center'>{{ $i++ }}</td>
                                        <td align='center'>{{ $currentclass->year }}</td>
                                        <td align='center'>{{ $currentclass->grade }}{{ $currentclass->subclasses }}</td>
                                        <td align='center'>-</td>
                                        
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
@else
<div class="row justify-content-center">
<font color='red'><i>No classes allocated yet.</i></font>
</div>
@endif

    </div>
    

    @endsection