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
          @include('layouts/sidebar')
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
