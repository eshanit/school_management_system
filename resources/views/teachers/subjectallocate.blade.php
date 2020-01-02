@extends('layouts.app_og')

@section('content')
<!-- Main content -->

<div class="container-fluid">

    <div class="justify-content-center">
  <h4>Please select subjects for class and click submit</h4>
    <hr>

    <div class="col-md-6">

    @if($subjects->count()> 0)

        <form class="form-horizontal" method="POST" action="{{ route('subjectclass.store') }}">
            {{ csrf_field() }}

            <input type='hidden' name='schoolclass_id'  value="{{$schoolclass_id}}" />

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">
                            <font color='red'><strong>Subject Code</strong></font>
                        </th>
                        <th scope="col">
                            <font color='red'><strong>Subject Name</strong></font>
                        </th>
                        <th scope="col">
                            <font color='green'><strong>Action</strong></font>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php

  $i=1;

?>

                    @foreach($subjects as $subject)
                    <tr>
                        <th scope="row">{{$i++}}</th>
                        <td>{{ $subject->code }}</td>
                        <td>{{ $subject->name }}</td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{$subject->id}}" id="defaultCheck2" name="subject_{{$subject->id}}">
                            </div>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <hr>
            <button type="submit" class="btn btn-primary float-right">Submit</button>
        </form>
        @else

        <font color='red'><i>No subjects (Learning areas) allocated listed yet.</i></font>

        @endif
    </div>
</div>
    @endsection