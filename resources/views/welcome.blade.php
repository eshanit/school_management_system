<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ZCN-School Management System</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .content-left {
                text-align: left;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    ZNC<i><font color='orange'>-</font></i>School<br>Management System
                </div>
                    <hr>
                    <p>There are <font color='orange'><strong>5</strong></font> accounts on this system:</p>
                    <div class="content-left" style="display: flex; justify-content: flex-end">
        <div class="col-6" style="flex-grow: 1;">
            <ul>
                <li><font color='446dff'><strong> DSI</strong></font> (District Inspectors which oversees all the schools in the system)
                    <br>
                    <strong>Username:</strong> dsi@murambindaschools.co.zw
                    <br>
                    <strong>Password:</strong> 12345678
                </li>
                <br>
                <li><font color='446dff'><strong> School Admin</strong></font> (Responsible for managing school users)
                    <br>
                    <strong>Username:</strong> admin1@schoolmanagement.co.zw
                    <br>
                    <strong>Password:</strong> 12345678
                </li>
                <br>
                <li><font color='446dff'><strong> School Clerk</strong></font> (Responsible for student and staff management)
                    <br>
                    <strong>Username:</strong> makumbe_clerk@schoolmanagement.co.zw
                    <br>
                    <strong>Password:</strong> 12345678
                </li>
                <br>
            </ul>
        </div>
            <div class="col-6">
                <ul>
                <li><font color='446dff'><strong> School Head</strong></font> (This is the school principal - overseas a particular school)
                    <br>
                    <strong>Username:</strong> makumbe_head@schoolmanagement.co.zw
                    <br>
                    <strong>Password:</strong> 12345678
                </li>
                <br>
                <li><font color='446dff'><strong> School Teacher</strong></font> (This is the class teacher - overseas a particular class)
                    <br>
                    <strong>Username:</strong> makumbe_teacher@schoolmanagement.co.zw
                    <br>
                    <strong>Password:</strong> 12345678
                </li>
            </ul>
        </div>
            
                    </div>
                   
                <!--div class="links">
                    <a href="https://laravel.com/docs">Docs</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://blog.laravel.com">Blog</a>
                    <a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://vapor.laravel.com">Vapor</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div-->
            </div>
            
        </div>
    </body>
</html>
