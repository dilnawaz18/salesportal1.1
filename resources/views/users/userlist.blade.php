@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href={{asset('dashboard/dashboard.css')}}>

    <div class="container-fluid ">
        <script src={{asset('dashboard/dashboard.js')}}>  </script>

        <!------ Include the above in your HEAD tag ---------->


        <div class="page-wrapper chiller-theme toggled">
            <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
                <i class="fas fa-bars"></i>
            </a>
            <nav id="sidebar" class="sidebar-wrapper">
                <div class="sidebar-content">
                    <div class="sidebar-brand">
                        <a href="#">pro sidebar</a>
                        <div id="close-sidebar">
                            <i class="fas fa-times"></i>
                        </div>
                    </div>
                    <div class="sidebar-header">
                        <div class="user-pic">
                            <img class="img-responsive img-rounded" src="https://raw.githubusercontent.com/azouaoui-med/pro-sidebar-template/gh-pages/src/img/user.jpg"
                                 alt="User picture">
                        </div>
                        <div class="user-info">
          <span class="user-name">Jhon
            <strong>Smith</strong>
          </span>
                            <span class="user-role">Administrator</span>
                            <span class="user-status">
            <i class="fa fa-circle"></i>
            <span>Online</span>
          </span>
                        </div>
                    </div>

                    <!-- sidebar-search  -->
                    <div class="sidebar-menu">
                        <ul>
                            <li>
                                <a href="#">
                                    <span>User List</span>
                                </a>
                            </li>

                            <li class="sidebar-dropdown">
                                <a href="#">
                                    <span>Users</span>
                                </a>
                                <div class="sidebar-submenu">
                                    <ul>
                                        <li>
                                            <a href="#">Create User
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">List Users</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>




                        </ul>
                    </div>
                    <!-- sidebar-menu  -->
                </div>
                <!-- sidebar-content  -->
                {{--                <div class="sidebar-footer">--}}
                {{--                    <a href="#">--}}
                {{--                        <i class="fa fa-bell"></i>--}}
                {{--                        <span class="badge badge-pill badge-warning notification">3</span>--}}
                {{--                    </a>--}}
                {{--                    <a href="#">--}}
                {{--                        <i class="fa fa-envelope"></i>--}}
                {{--                        <span class="badge badge-pill badge-success notification">7</span>--}}
                {{--                    </a>--}}
                {{--                    <a href="#">--}}
                {{--                        <i class="fa fa-cog"></i>--}}
                {{--                        <span class="badge-sonar"></span>--}}
                {{--                    </a>--}}
                {{--                    <a href="#">--}}
                {{--                        <i class="fa fa-power-off"></i>--}}
                {{--                    </a>--}}
                {{--                </div>--}}
            </nav>
            <!-- sidebar-wrapper  -->
            <main class="page-content">
                <div class="container-fluid">
                    <h2>Dashboard</h2>
                    <hr>
                    <div class="row">

                    </div>

                </div>

            </main>
            <!-- page-content" -->
        </div>
        <!-- page-wrapper -->

    </div>
    </body>
@endsection
