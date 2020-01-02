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
                    <a href="#" class="nav-link">Contact</a>
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
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
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

    @include('sweetalert::alert')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.17.4/dist/sweetalert2.all.min.js"></script>

    <!-- Optional: include a polyfill for ES6 Promises for IE11 and Android browser -->
    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>

    <script>
    $(function() {
        $("#students").DataTable({
            responsive: true
        });

        $("#school_classes").DataTable({
            responsive: true
        });

        $("#teachers").DataTable({
            responsive: true
        });

        $("#enter_marks").DataTable({
            "responsive": true,
            "paging": false,
        });

        $("#newmarks").DataTable({
            "responsive": true,
            "paging": false,
        });

        $("#markschedule").DataTable({
            "responsive": true,
            "paging": false,
        });
       
        $("#markschedule_paper_1").DataTable({
            "responsive": true,
            "paging": false,
        });

        $("#markschedule_paper_2").DataTable({
            "responsive": true,
            "paging": false,
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
        });

        $("#user_roles").DataTable({
            "responsive": true,
            "paging": false,
        });

        $("#roles").DataTable({
            "responsive": true,
            "paging": false,
        });

        
        $("#admin_school_classes").DataTable({
            responsive: true
        });

        $("#admin_subjects").DataTable({
            responsive: true
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


</body>

</html>