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
                    <h2>Users List</h2>
                    <hr>
                   <div style="text-align: right;margin: 20px">
                       <a href="/users/create" class="btn btn-primary">Add User</a>

                   </div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>

                        </tr>
                        </thead>
                        <tbody>
                       @foreach($users as $user)
                           <tr>
                               <th scope="row">{{$user->name}}</th>
                               <td>{{$user->email}}</td>
                               @if($user->role_id == 1 )
                                   <td> Guest</td>
                                   @elseif($user->role_id == 2)
                                    <td> Guest</td>
                               @endif
                               @if($user->status == 1)
                                   <td><span class="badge badge-success">Active</span></td>
                               @elseif($user->status == 0)
                                    <td><span class="badge badge-danger">Deactive</span></td>
                               @endif
                               <td><a href="/users/{{$user->id}}/edit/" class="btn btn-success">Edit</a></td>
                           </tr>
                       @endforeach


                        </tbody>
                    </table>

                </div>

            </main>
            <!-- page-content" -->
        </div>
        <!-- page-wrapper -->

    </div>
    </body>
@endsection
