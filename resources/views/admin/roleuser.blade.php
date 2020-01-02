@extends('layouts.app_og')

@section('content')
<!-- Main content -->
<section class="content">

    <div class="container-fluid">
        <h5 class="mb-2 mt-4"><strong>
                <font color='orange'>Allocate Roles to Users</font>
            </strong></h5>
        <hr>
        <div class='row'>
            <div class='col-md-6'>
                <!-- Small Box (Stat card) -->
                <h5 class="mb-2 mt-4"><strong>User Roles</strong></h5>
                <!-- /.row -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            users: <font color='446dff'>{{ $users->count() }}</font>
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <table id="user_roles" class="table table-bordered table-striped" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">email</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Edit/Delete</th>
                                </tr>

                            </thead>
                            <tbody>

                                @for ($i=0; $i < count($user_id); $i++) <tr>
                                    <td align='center'>{{ $i+1 }}</td>
                                    <td align='center'>{{ $user_name[$user_id[$i]] }}</td>
                                    <td align='center'>{{ $user_email[$user_id[$i]] }}</td>
                                    @if(isset($roleusers_rolename[$user_id[$i]]))
                                    <td align='center'>
                                        <font color='#53bf14'><strong>{{ $roleusers_rolename[$user_id[$i]] }}</strong>
                                        </font>
                                    </td>
                                    @else
                                    <td align='center'><button type="button"
                                            class="btn btn-block btn-outline-warning btn-sm" data-toggle="modal"
                                            data-target="#allocate_role_<?php print_r($user_id[$i]); ?>"><strong>allocate</strong></button>
                                    </td>
                                    @endif
                                    <td align='center'>
                                        <font color='orange'><span data-toggle="modal"
                                                data-target="#editUser_<?php print_r($user_id[$i]);?>"
                                                style="cursor:pointer"><i class="fas fa-user-edit fa-lg"></i></span>
                                        </font> /
                                        <font color='red'>
                                            <a class="delete-studentx" data-student-idx="{{$user_id[$i]}}"
                                                onclick="deleteStudentx({{ $user_id[$i] }})">
                                                <span style="cursor:pointer">
                                                    <i class="fas fa-user-times fa-lg"></i>
                                                </span>
                                            </a>
                                        </font>
                                    </td>
                                    </tr>
                                    @endfor
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
                                data-toggle="modal" data-target="#addrole"><strong>Add Roles</strong> |
                                {{ $roles->count() }}</button>
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
                                        <a class="delete-role-class" href="{{route('role.destroy',[$role->id])}}">
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
                <!-- /.card -->
            </div>
            <!-- /.col -->
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
                                    <a class="delete-studentx" data-student-id="{{$user->id}}"
                                        onclick="deleteStudentx({{ $user->id }})">
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


@for($i=0; $i < count($user_id); $i++) <div class="modal fade" id="allocate_role_<?php print_r($user_id[$i]); ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Allocate Role to: {{ $user_name[$user_id[$i]] }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="{{ route('adminroleuser.store') }}">
                    {{ csrf_field() }}

                    <input type="hidden" class="form-control" id="role_name" aria-describedby=""
                        value="{{ $user_id[$i] }}" name="user_id">

                    <div class="container">
                        <div class="row">
                            <div class="col-md">
                                    <div class="form-group">
                                            <label for="Gender">
                                                <font color="red">*</font><strong>Gender</strong>
                                            </label>
                                            <select class="form-control" name='gender_id'>
                                                <option>..Select Gender..</option disabled selected>
                                                @foreach($genders as $gender)
                                                <option value="{{$gender->id}}">{{$gender->gender}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                <div class="form-group">
                                    <label for="firstName">
                                        <font color="red">*</font><strong>Role</strong>
                                    </label>
                                    <select class="form-control" name='role_id'>
                                        <option>..Select Role..</option disabled selected>
                                        @foreach($roles as $role)
                                        <option value="{{$role->id}}">{{$role->rolename}}</option>
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
    @endfor

<!--editing-->

    @foreach($users as $user)
<div class="modal fade" id="editUser_<?php print_r($user->id);?>" tabindex="-1" role="dialog"
    aria-labelledby="editing" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editing"><strong>
                        <font color='brown'>edit User:</font>
                        <font color='orange'>{{$user->name}}</font>
                    </strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form class="form-horizontal" method="POST" action="{{ route('adminroleuser.update',[$user->id]) }}">
                    {{ method_field('PUT') }}

                    {{ csrf_field() }}

                    <div class="container">
                        <div class="row">
                            <div class="col-md">
                                <div class="form-group">
                                    <label for="firstName">
                                        <font color="red">*</font><strong>Name</strong>
                                    </label>
                                    <input type="text" class="form-control" id="firstName" aria-describedby=""
                                        placeholder="{{$user->name}}" value="{{$user->name}}"
                                        name="name">
                                </div>

                                
                                <div class="form-group">
                                    <label for="middleName"><strong>email</strong></label>
                                    <input type="email" class="form-control" id="middleName" aria-describedby=""
                                placeholder="{{ $user->email }}" value={{ $user->email }}
                                        name="email">
                                </div>

                                <div class="form-group">
                                    <label for="middleName"><strong>Password</strong></label>
                                    <input type="text" class="form-control" id="middleName" aria-describedby=""
                                        placeholder="password"
                                        name="password">
                                </div>

                                <div class="form-group">
                                    <label for="middleName"><strong>Repeat Password</strong></label>
                                    <input type="text" class="form-control" id="middleName" aria-describedby=""
                                        placeholder="password repeat"
                                        name="password_repeat">
                                </div>

                                @if(isset($roleusers_rolename[$user->id]))
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="firstName">
                                            <font color="red">*</font><strong>Role</strong>
                                        </label>
                                        <select class="form-control" name='role_id'>
                                            <option>..Select Role..</option disabled selected>
                                            @foreach($roles as $role)
                                            <option value="{{$role->id}}" {{ ($role->rolename == $roleusers_rolename[$user->id] ? 'selected="selected"' : '')}}>{{$role->rolename}}</option>
                                            @endforeach
                                        </select>
                                    </div>
    
                                </div>
                                @endif

                            </div>
                         
                        </div>
                    </div>
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