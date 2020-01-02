<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>{{ config('app.name', 'School Management System') }}</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}" rel="stylesheet">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}" rel="stylesheet">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">

    
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">

     <!-- DataTables button-->
     <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                @if(Auth::user()->hasRole("Clerk"))
                    <a href="{{ url('/home') }}" class="nav-link">Home</a>
                @elseif(Auth::user()->hasRole("Head") || Auth::user()->hasRole("Deputy Head"))
                    <a href="{{ route('management.index') }}" class="nav-link">Home</a>
                @elseif(Auth::user()->hasRole("Teacher"))
                    <a href="{{ route('teacher.index') }}" class="nav-link">Home</a>
                @elseif(Auth::user()->hasRole("Admin"))
                <a href="{{ url('/admin') }}" class="nav-link">Home</a>
                @elseif(Auth::user()->hasRole("dis"))
                <a href="{{ url('/dis') }}" class="nav-link">Home</a>
                @endif
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                        <button type="button" class="btn btn-block btn-outline-warning btn-sm"
                        data-toggle="modal" data-target="#admin">Contact Admin</button>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                      <font color="#fff">|</font>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                        <button type="button" class="btn btn-block btn-outline-danger btn-sm"
                        data-toggle="modal" data-target="#support">Contact Support</button>
                </li>
            </ul>

            <!-- SEARCH FORM -->
            <form class="form-inline ml-3">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Search"
                        aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
             
                <!-- li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-comments"></i>
                        <span class="badge badge-danger navbar-badge">3</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                           
                            <div class="media">
                                <img src="dist/img/user1-128x128.jpg" alt="User Avatar"
                                    class="img-size-50 mr-3 img-circle">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Brad Diesel
                                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">Call me whenever you can...</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                           
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                   
                            <div class="media">
                                <img src="dist/img/user8-128x128.jpg" alt="User Avatar"
                                    class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        John Pierce
                                        <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">I got your message bro</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                          
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            
                            <div class="media">
                                <img src="dist/img/user3-128x128.jpg" alt="User Avatar"
                                    class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Nora Silvester
                                        <span class="float-right text-sm text-warning"><i
                                                class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">The subject goes here</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                         
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                    </div>
                </li>
             
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li-->
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
                            class="fas fa-th-large"></i></a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src="" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">
                    <strong>DIS</strong>
                </span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <!--div class="image">
                        <img src="" class="img-circle elevation-2" alt="User Image">
                    </div-->
                    <div class="info">
                            <?php $role = Auth::user()->roles->pluck('rolename') ?>

                        @if(isset($role))
                        <a href="#" class="d-block"> {{ $role[0] }}</a>
                        @else
                        <a href="#" class="d-block">User</a>
                        @endif
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        @if(Auth::user()->hasRole("Admin"))
                        <li class="nav-item has-treeview menu-open">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Allocations
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('role.index')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>User -> Role</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Teacher -> Class</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Class -> Subject</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @elseif(Auth::user()->hasRole("Teacher"))
                        <li class="nav-item has-treeview menu-open">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Subject Allocations
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('subjectclass.index')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Class -> Subject</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif
                        <li class="nav-item">
                                <a href="{{ route('dis_calendar.index')}}" class="nav-link">
                                        <i class="nav-icon fas fa-th"></i>
                                        <p>
                                        
                                                <button type="button" class="btn btn-info btn-block">
                                                        DIS Calendar <span class="badge badge-light"></span>
                                                </button>
                                        </p>
                                    </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Main content -->
            <main class="py-4">
                @yield('content')
            </main>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <!--aside class="control-sidebar control-sidebar-dark">
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside-->
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2019 <a href="">function<font color='red'><i>x</i></font>.io</a>.</strong> All
            rights
            reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>

    <!--script src="{{ asset('js/jquery.min.js') }}"></script-->
    <!-- Bootstrap 4 -->
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>

    <!-- SweetAlert2 -->
    <script src="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

    <!-- DataTables -->
    <script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.js') }}"></script>

    <script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>

    <script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.js') }}"></script>

    <script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>

    <script src="{{ asset('adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>

    <script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>

    @include('sweetalert::alert')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.17.4/dist/sweetalert2.all.min.js"></script>

    <!-- Optional: include a polyfill for ES6 Promises for IE11 and Android browser -->
    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>

    <script>
    $(function() {
        $("#students").DataTable({
            responsive: true,
            dom: 'Bfrtip',
            buttons: [
            'print'
        ]
        });

        $("#school_classes").DataTable({
            responsive: true,
            dom: 'Bfrtip',
            buttons: [
            'print'
        ]
        });

        $("#teachers").DataTable({
            responsive: true,
            dom: 'Bfrtip',
            buttons: [
            'print'
        ]
        });

        $("#enter_marks").DataTable({
            "responsive": true,
            "paging": false,
            dom: 'Bfrtip',
            buttons: [
            'print'
        ]
        });

        $("#newmarks").DataTable({
            "responsive": true,
            "paging": false,
            dom: 'Bfrtip',
            buttons: [
            'print'
        ]
        });

        $("#markschedule").DataTable({
            "responsive": true,
            "paging": false,
            dom: 'Bfrtip',
            buttons: [
            'print'
        ]
        });
       
        $("#markschedule_paper_1").DataTable({
            "responsive": true,
            "paging": false,
            dom: 'Bfrtip',
            buttons: [
            'print'
        ]
        });

        $("#markschedule_paper_2").DataTable({
            "responsive": true,
            "paging": false,
            dom: 'Bfrtip',
            buttons: [
            'print'
        ]
        });

        $("#reportcard").DataTable({
            "responsive": true,
            "paging": false,
        });

        $('#example').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            dom: 'Bfrtip',
            buttons: [
            'print'
        ]
        });

        $("#user_roles").DataTable({
            "responsive": true,
            "paging": false,
            dom: 'Bfrtip',
            buttons: [
            'print'
        ]
        });

        $("#roles").DataTable({
            "responsive": true,
            "paging": false,
            dom: 'Bfrtip',
            buttons: [
            'print'
        ]
        });

        
        $("#admin_school_classes").DataTable({
            responsive: true,
            dom: 'Bfrtip',
            buttons: [
            'print'
        ]
        });

        $("#admin_subjects").DataTable({
            responsive: true,
            dom: 'Bfrtip',
            buttons: [
            'print'
        ]
        });

        
        $("#student_attendance").DataTable({
            responsive: true,
            dom: 'Bfrtip',
            buttons: [
            'print'
        ]
        });
        
        $("#dis_teacher_summary").DataTable({
            responsive: true,
            dom: 'Bfrtip',
            buttons: [
            'print'
        ]
        });


        $("#dis_teacher").DataTable({
            responsive: true,
            dom: 'Bfrtip',
            buttons: [
            'print'
        ]
        });

        $("#dis_students").DataTable({
            responsive: true,
            dom: 'Bfrtip',
            buttons: [
            'print'
        ]
        });

        $("#school_teacher_attendance").DataTable({
            responsive: true,
            dom: 'Bfrtip',
            buttons: [
            'print'
        ]
        });

        
        $("#dis_calendar").DataTable({
            responsive: true,
            dom: 'Bfrtip',
            buttons: [
            'print'
        ]
        });
        
        
    });
    </script>
    <script>
    $(document).ready(function() {
        $('[data-toggle="popover"]').popover();
    });
    </script>
    <!-- delete and undelete function for students -->
    <script>

    function deleteStudent(student_id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
                window.location.href = '/student/delete/' + student_id;
            }

        })
    }
    </script>

    <script>
    function undeleteStudent(student_id) {
        /*    swal({
                title: "Are you sure?",
                text: "Are you sure that you want to undelete this student?",
                type: "warning",
                showCancelButton: true,
                closeOnConfirm: false,
                confirmButtonText: "Yes, undelete it!",
                confirmButtonColor: "#009900"
            }).then(function(isConfirm) {
                swal(
                    'Deleted!',
                    'Student has been undeleted.',
                    'success'
                );
                window.location.href = '/student/undelete/' + student_id;
            });
        */


        Swal.fire({
            title: 'Are you sure?',
            text: "Are you sure that you want to undelete this student?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, undelete it!'
        }).then((result) => {
            if (result.value) {
                Swal.fire(
                    'Deleted!',
                    'Student has been undeleted.',
                    'success'
                )
                window.location.href = '/student/undelete/' + student_id;
            }

        })

    }
    </script>

    <!-- delete and undelete function for teachers -->
    <script>
    
    function deleteTeacher(teacher_id) {
        /*  swal({
            title: "Are you sure?",
            text: "Are you sure that you want to delete this student?",
            type: "warning",
            showCancelButton: true,
            closeOnConfirm: false,
            confirmButtonText: "Yes, delete it!",
            confirmButtonColor: "#ec6c62"
        }).then(function(isConfirm) {
            swal(
                'Deleted!',
                'Student has been deleted.',
                'success'
            );
            window.location.href = '/student/delete/' + student_id;
        });

*/

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                Swal.fire(
                    'Deleted!',
                    'Teacher reverted to user.',
                    'success'
                )
                window.location.href = 'teacher/delete/' + teacher_id;
            }

        })
    }
    </script>

    <script>
    function undeleteTeacher(teacher_id) {
        /*    swal({
                title: "Are you sure?",
                text: "Are you sure that you want to undelete this student?",
                type: "warning",
                showCancelButton: true,
                closeOnConfirm: false,
                confirmButtonText: "Yes, undelete it!",
                confirmButtonColor: "#009900"
            }).then(function(isConfirm) {
                swal(
                    'Deleted!',
                    'Student has been undeleted.',
                    'success'
                );
                window.location.href = '/student/undelete/' + student_id;
            });
        */


        Swal.fire({
            title: 'Are you sure?',
            text: "Are you sure that you want to undelete this teacher?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, undelete it!'
        }).then((result) => {
            if (result.value) {
                Swal.fire(
                    'Deleted!',
                    'Teacher reverted to User.',
                    'success'
                )
                window.location.href = '/teacher/undelete/' + teacher_id;
            }

        })

    }
    </script>

<script>
function deleteClassSubject(subject_id) {
    /*  swal({
        title: "Are you sure?",
        text: "Are you sure that you want to delete this student?",
        type: "warning",
        showCancelButton: true,
        closeOnConfirm: false,
        confirmButtonText: "Yes, delete it!",
        confirmButtonColor: "#ec6c62"
    }).then(function(isConfirm) {
        swal(
            'Deleted!',
            'Student has been deleted.',
            'success'
        );
        window.location.href = '/student/delete/' + student_id;
    });

*/

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            Swal.fire(
                'Deleted!',
                'Teacher reverted to user.',
                'success'
            )
            window.location.href = 'teacher/class/subject/delete/' + subject_id;
        }

    })
}
</script>
</body>

<!--modal for admin msg -->
<div class="modal fade" id="admin" tabindex="-1" role="dialog" aria-labelledby="editing" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editing"><strong>
                            Send message to :<font color='#008080'>Admin:</font>
    
                        </strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
    
                   
                        <div class="form-group">
                                <label for="gAddress">
                                    <font color="red">*</font><strong>Message</strong>
                                </label>
                                <textarea class="form-control" id="gAddress"
                                    placeholder="type in here..."
                                    name="guardian_address"
                                    rows="3"></textarea>
                        </div>
                        <button type="button" class="btn btn-primary" disabled>Send SMS/Message</button>
                </div>
                <!--div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div-->
            </div>
        </div>
</div>

<!-- modal for support -->

<div class="modal fade" id="support" tabindex="-1" role="dialog" aria-labelledby="editing" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editing"><strong>
                            Sent message to :<font color='red'>Support</font>
    
                        </strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                        <div class="form-group">
                                <label for="gAddress">
                                    <font color="red">*</font><strong>Message</strong>
                                </label>
                                <textarea class="form-control" id="gAddress"
                                    placeholder="type in here..."
                                    name="guardian_address"
                                    rows="3"></textarea>
                        </div>
                   
                        <button type="button" class="btn btn-primary" disabled>Send SMS/Message</button>
                </div>
                <div class="modal-footer">
                    <strong>Tinashe</strong>: +263 771 493 239 
                    <strong>Joseph</strong>: +263 773 03 1221 
                </div>
            </div>
        </div>
</div>
</html>