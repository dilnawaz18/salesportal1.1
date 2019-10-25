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
                    <table class="table table-striped">
                           <tr>
                               <td> Name</td>
                               <td>Location</td>
                               <td>Industry</td>
                               <td>Edit</td>
                               <td>Delete</td>

                           </tr>
                           @foreach($customers as $customer)
                               <tr>
                                   <td> {{$customer->name}}</td>
                               <td>{{$customer->location->name}}</td>
                               <td>{{$customer->industry->name}}</td>
                                   <td><a href="customers/{{$customer->id}}/edit" class="btn btn-primary ">Edit</a> </td>

                                   <td>
                                       {!!Form::open(['action'=>['CustomersController@destroy', $customer->id],'method'=>'POST','class'=>'btn btn-primary,pull-right'])!!}
                                       {{Form::hidden('_method','DELETE')}}
                                       {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
                                       {!! Form::close() !!}

                                   </td>
                               </tr>
                           @endforeach
                       </table>

                </div>

            </main>
            <!-- page-content" -->
        </div>
        <!-- page-wrapper -->

    </div>
    </body>
@endsection
