@extends('layouts.app_og')

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <!-- Small Box (Stat card) -->
        <h5 class="mb-2 mt-4"><strong>teacher's portal</strong></h5>
        <div class="row justify-content-center">
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>-</h3>

                        <p>All Teachers (Average rate of Absence)</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
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
                        <h3>-<sup
                                style="font-size: 20px">%</sup></h3>

                        <p>Male Teachers (Average Rate of Absence)</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-male"></i>
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
                        <h3>-<sup
                                style="font-size: 20px">%</sup></h3>

                        <p>Female Teachers (Average rate of Absence)</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-female"></i>
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
                    <i><font color='red'>*</font><strong>NB</strong></i> : Hover mouse on the spinning icon.
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                <table id="teachers_attendance" class="table table-bordered table-striped" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Date</th>
                            @foreach($school_teachers as $school_teacher)
                                <th scope="col">{{ $school_teacher->name }}</th>
                            @endforeach
        
                        </tr>
                    </thead>
                    
                    <tbody>
                        @php
                        $i = 1;
                        @endphp
                      
                        @foreach($teacher_attendance_statuses as $date => $statuses)
                        <tr>
                            <td align='center'>{{ $i++ }}</td>
                            <td align='center'>{{ $date }}</td>
                            
                        @foreach($statuses as $teacher => $status)
                                @if($status == 1)
                                <td align='center'>
                                        <span title="Notes" data-toggle="popover" data-trigger="hover"
                                data-content="{{ $teacher_attendance_notes[$date][$teacher] }}" style="cursor:pointer"><font color='446dff'>
                                        @if(  $teacher_attendance_notes[$date][$teacher] != NULL )
                                            <i class="fas fa-check fa-spin"></i>
                                        @else
                                            <i class="fas fa-check"></i>
                                        @endif
                                </font>
                                       </span>
                                </td>
                                @else
                                <td align='center'>
                                        <span title="Notes" data-toggle="popover" data-trigger="hover"
                                data-content="{{ $teacher_attendance_notes[$date][$teacher] }}" style="cursor:pointer"><font color='red'>
                                        @if(  $teacher_attendance_notes[$date][$teacher] != NULL )
                                        <i class="fas fa-times fa-spin"></i>
                                    @else
                                        <i class="fas fa-times"></i>
                                    @endif
                                </font>
                                     </span>
                                    </td>
                                @endif 
                             
                        @endforeach
                      
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