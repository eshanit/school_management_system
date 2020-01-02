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
                            <small><strong>Year {{ $currentyear }} </strong></small>
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <!-- Small Box (Stat card) -->
                        <h5 class="mb-2 mt-4"><strong></strong></h5>
                        <div class="row justify-content-center">
                            <form class="form-horizontal" method="POST"
                                action="{{ route('teachermarksenter.viewmarks',[$teacher_id]) }}">
                                
                                {{ csrf_field() }}

                                <div class='col-12'>
                                    <div class="form-group">
                                        <label for="School Grade">
                                            <font color="red">*</font><strong>Term</strong>
                                        </label>
                                        <select class="form-control" name='term_id'>
                                            <option>..Select Term..</option disabled selected>
                                            @foreach($terms as $term)
                                            <option value="{{$term -> id}}">{{ $term -> term}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class='col-12'>
                                    <div class="form-group">
                                        <label for="School Grade">
                                            <font color="red">*</font><strong>Subjects</strong>
                                        </label>
                                        <select class="form-control" name='subject_id'>
                                            <option>..Select Subject..</option disabled selected>
                                            <option value='0'>All Subjects</option>
                                            @foreach($subjects as $subject)
                                            <option value="{{$subject -> id}}">{{ $subject -> name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                        </div>
                        <button type="submit" class="btn btn-info float-right">Submit</button>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>

    </div>
    </form>
</section>


@endsection