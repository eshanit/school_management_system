@extends('layouts.app_og')

@section('content')
<!-- Main content -->
<section class="content">

    <div class="container-fluid">
        <div class='row'>
            <div class='col-md-6'>
                <!-- Small Box (Stat card) -->
                <h5 class="mb-2 mt-4"><strong>User Roles</strong></h5>
                <!-- /.row -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><button type="button" class="btn btn-block btn-outline-info btn-sm"
                                data-toggle="modal" data-target="#allusers">Users |
                                {{ $users->count() }}</button>
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <table id="user_roles" class="table table-bordered table-striped" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i = 1;
                                @endphp
                                @foreach ($user_roles as $user_role)
                                <tr>
                                    <td align='center'>{{ $i++ }}</td>
                                    <td align='center'>{{ $user_role->name }}</td>
                                    <td align='center'>{{ $user_role->rolename }}</td>
                                    <td align='center'>{{ $user_role->email }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class='col-md-6'>
                <!-- /.card -->
                <h5 class="mb-2 mt-4"><strong>Roles</strong></h5>
                <!-- /.row -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><button type="button" class="btn btn-block btn-outline-danger btn-sm"
                                data-toggle="modal" data-target="#addrole"><strong>Add Roles</strong> | {{ $roles->count() }}</button>
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <table id="roles" class="table table-bordered table-striped" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Roles</th>
                                    <th scope="col">Edit/Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i = 1;
                                @endphp
                                @foreach ($roles as $role)
                                <tr>
                                    <td align='center'>{{ $i++ }}</td>
                                    <td align='center'>{{ $role->rolename }}</td>
                                    <td align='center'>
                                        
                                        <!--a class="delete-role-class" href="{{route('role.destroy',[$role->id])}}">
                                            <span style="cursor:pointer">
                                                <font color='red'>  <i class="fas fa-user-times fa-lg"></i></font>
                                            </span>
                                        </a-->
                                        -
                                    </td>
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

        <hr>

        <div class='row'>
            <div class='col-md-6'>
                <!-- Small Box (Stat card) -->
                <h5 class="mb-2 mt-4"><strong>Classes</strong></h5>
                <!-- /.row -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><button type="button" class="btn btn-block btn-outline-warning btn-sm"
                                data-toggle="modal" data-target="#addclass">Add Class |
                                {{ $schoolgradeclasses->count() }}</button>
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <table id="admin_school_classes" class="table table-bordered table-striped" cellspacing="0"
                            width="100%">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Form/Grade</th>
                                    <th scope="col">Subclass</th>
                                    <th scope="col">Edit/Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i = 1;
                                @endphp
                                @foreach ($schoolgradeclasses as $schoolgradeclass)
                                <tr>
                                    <td align='center'>{{ $i++ }}</td>
                                    <td align='center'>{{ $schoolgradeclass->grade }}</td>
                                    <td align='center'>{{ $schoolgradeclass->subclasses }}</td>
                                    <td align='center'>
                                        <font color='orange'><span data-toggle="modal"
                                                data-target="#editClass_<?php print_r($schoolgradeclass->id);?>"
                                                style="cursor:pointer"><i class="fas fa-user-edit fa-lg"></i></span>
                                        </font> /
                                       
                                            <a class="delete-admin-class" href="{{route('adminclass.destroy',[$schoolgradeclass->id])}}">
                                                <span style="cursor:pointer">
                                                    <font color='red'>  <i class="fas fa-user-times fa-lg"></i></font>
                                                </span>
                                            </a>
                                        
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>

            <div class='col-md-6'>
                <!-- Small Box (Stat card) -->
                <h5 class="mb-2 mt-4"><strong>Subject</strong></h5>
                <!-- /.row -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><button type="button" class="btn btn-block btn-outline-success btn-sm"
                                data-toggle="modal" data-target="#addsubject"><strong>Add Subject |
                                {{ $subjects->count() }}</strong></button>
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <table id="admin_subjects" class="table table-bordered table-striped" cellspacing="0"
                            width="100%">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Subject Code</th>
                                    <th scope="col">Subject Name</th>
                                    <th scope="col">Edit/Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i = 1;
                                @endphp
                                @foreach ($subjects as $subject)
                                <tr>
                                    <td align='center'>{{ $i++ }}</td>
                                    <td align='center'>{{ $subject->code }}</td>
                                    <td align='center'>{{ $subject->name }}</td>
                                    <td align='center'>
                                        <font color='orange'><span data-toggle="modal"
                                                data-target="#editSubject_<?php print_r($subject->id);?>"
                                                style="cursor:pointer"><i class="fas fa-user-edit fa-lg"></i></span>
                                        </font> /
                                        <a class="delete-admin-class" href="{{route('adminsubject.destroy',[$role->id])}}">
                                            <span style="cursor:pointer">
                                                <font color='red'>  <i class="fas fa-user-times fa-lg"></i></font>
                                            </span>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>

        </div>

    </div><!-- /.container-fluid -->
</section>

<!--Modals-->


<!--modal Users -->
<div class="modal fade" id="allusers">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create New Role</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="user_roles" class="table table-bordered table-striped" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">User Name</th>
                            <th scope="col">email</th>
                            <th scope="col">Edit/Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = 1;
                        @endphp
                        @foreach ($users as $user)
                        <tr>
                            <td align='center'>{{ $i++ }}</td>
                            <td align='center'>{{ $user->name }}</td>
                            <td align='center'>{{ $user->email }}</td>
                            <td align='center'>
                                <font color='orange'><span data-toggle="modal"
                                        data-target="#editStudent_<?php print_r($user->id);?>" style="cursor:pointer"><i
                                            class="fas fa-user-edit fa-lg"></i></span>
                                </font> /
                                <font color='red'>
                                    <a class="delete-student" data-student-id="{{$user->id}}"
                                        onclick="deleteStudent({{ $user->id }})">
                                        <span style="cursor:pointer">
                                            <i class="fas fa-user-times fa-lg"></i>
                                        </span>
                                    </a>
                                </font>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>


            </div>
            <!--div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div-->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<!--modal create new role -->
<div class="modal fade" id="addrole">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create New Role</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="{{ route('role.store') }}">
                    {{ csrf_field() }}

                    <div class="container">
                        <div class="row">
                            <div class="col-md">
                                <div class="form-group">
                                    <label for="firstName">
                                        <font color="red">*</font><strong>Role</strong>
                                    </label>
                                    <input type="text" class="form-control" id="role_name" aria-describedby=""
                                        placeholder="e.g Teacher" name="role">
                                </div>

                            </div>

                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-right">Submit</button>
                </form>
            </div>
            <!--div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div-->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!--modal create new class -->
<div class="modal fade" id="addclass">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create New Class</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="{{ route('adminclass.store') }}">
                    {{ csrf_field() }}

                    <div class="container">
                        <div class="row">
                            <div class="col-md">
                                <div class="form-group">
                                    <label for="form_name">
                                        <font color="red">*</font><strong>Form/Grade</strong>
                                    </label>
                                    <input type="text" class="form-control" id="form_name" aria-describedby=""
                                        placeholder="e.g 3" name="form">
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md">
                                <div class="form-group">
                                    <label for="class_name">
                                        <font color="red">*</font><strong>Sub Class</strong>
                                    </label>
                                    <input type="text" class="form-control" id="class_name" aria-describedby=""
                                        placeholder="e.g b/arts" name="subclass">
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md">
                                <div class="form-group">
                                    <label for="class_name">
                                        <font color="red">*</font><strong>Level</strong>
                                    </label>
                                    <select class="form-control" name='level_id'>
                                        <option disabled selected>..Select level..</option>
                                        @foreach($levels as $level)
                                        <option value="{{$level->id}}">{{$level->level}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-right">Submit</button>
                </form>
            </div>
            <!--div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div-->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>



<!--edit classes-->

@foreach ($schoolgradeclasses as $schoolgradeclass)
<!--modal create new class -->
<div class="modal fade" id="editClass_<?php print_r($schoolgradeclass->id);?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">Edit Class {{$schoolgradeclass->grade}}{{$schoolgradeclass->subclasses}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="{{ route('adminclass.update',[$schoolgradeclass->id]) }}">
                    {{ method_field('PUT') }}

                    {{ csrf_field() }}

                    <div class="container">
                        <div class="row">
                            <div class="col-md">
                                <div class="form-group">
                                    <label for="form_name">
                                        <font color="red">*</font><strong>Form/Grade</strong>
                                    </label>
                                    <input type="text" class="form-control" id="form_name" aria-describedby=""
                                placeholder="{{$schoolgradeclass->grade}}"  value={{$schoolgradeclass->grade}} name="form">
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md">
                                <div class="form-group">
                                    <label for="class_name">
                                        <font color="red">*</font><strong>Sub Class</strong>
                                    </label>
                                    <input type="text" class="form-control" id="class_name" aria-describedby=""
                                    placeholder="{{$schoolgradeclass->subclasses}}"  value={{$schoolgradeclass->subclasses}} name="subclass">
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md">
                                <div class="form-group">
                                    <label for="class_name">
                                        <font color="red">*</font><strong>Level</strong>
                                    </label>
                                    <select class="form-control" name='level_id'>
                                        <option disabled selected>..Select level..</option>
                                        @foreach($levels as $level)
                                        <option value="{{$level->id}}">{{$level->level}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-right">Submit</button>
                </form>
            </div>
            <!--div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div-->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>    
@endforeach



<!--modal create new subject -->
<div class="modal fade" id="addsubject">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create New Subject</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="{{ route('adminsubject.store') }}">
                    {{ csrf_field() }}

                    <div class="container">
                        <div class="row">
                            <div class="col-md">
                                <div class="form-group">
                                    <label for="subject_code">
                                        <font color="red">*</font><strong>Subject Code</strong>
                                    </label>
                                    <input type="text" class="form-control" id="subject_Code" aria-describedby=""
                                        placeholder="e.g 4001" name="subjectcode">
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md">
                                <div class="form-group">
                                    <label for="subject_name">
                                        <font color="red">*</font><strong>Subject Name</strong>
                                    </label>
                                    <input type="text" class="form-control" id="subject_name" aria-describedby=""
                                        placeholder="e.g Agriculture" name="subjectname">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md">
                                <div class="form-group">
                                    <label for="number_paper">
                                        <font color="red">*</font><strong>Number of Papers</strong>
                                    </label>
                                    <select class="form-control" name='numberpaper'>
                                        <option disabled selected>..Select..</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option> 
                                    </select>
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md">
                                <div class="form-group">
                                    <label for="class_name">
                                        <font color="red">*</font><strong>Level</strong>
                                    </label>
                                    <select class="form-control" name='level_id'>
                                        <option disabled selected>..Select level..</option>
                                        @foreach($levels as $level)
                                        <option value="{{$level->id}}">{{$level->level}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-right">Submit</button>
                </form>
            </div>
            <!--div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div-->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>




@endsection