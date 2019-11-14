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
                    <h2>Create User</h2>
                    <hr>

                    {!! Form::open(['action'=>['UsersController@update',$user->id],'method'=>'PUT']) !!}

                    <div class="form-group">
                        {{Form::label('name','Name:')}}
                        {{Form::text('name',$user->name,['class'=>'form-control','placeholder'=>'Your good name...: '])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('name','Email:')}}
                        {{Form::email('email',$user->email,['class'=>'form-control','placeholder'=>'Your email','readonly'=>'true'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('role','Select Role')}}
                        {{Form::select('role', ['1' => 'Guest', '2' => 'Premium'],$user->role_id,['class'=> 'form-control'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('status','Status')}}
                        <br>
                        @if($user->status == 1)
                            {{Form::label('active','Active')}}
                            {{Form::radio('status', '1',true)}}
                            <br>
                            {{Form::label('deactive','Deactive')}}
                            {{Form::radio('status', '0')}}
                        @elseif($user->status == 0)

                            {{Form::label('active','Active')}}
                            {{Form::radio('status', '1')}}
                            <br>
                            {{Form::label('deactive','Deactive')}}
                            {{Form::radio('status', '0',true)}}
                        @endif
                    </div>


                    {{Form::submit('update',['class'=>'btn btn-primary'])}}
                    {!! Form::close() !!}

                    {{--                        <form action="{{ url("users") }}" method="POST">--}}
                    {{--                            {{ csrf_field()  }}--}}
                    {{--                            <div class="form-group">--}}
                    {{--                                <label for="name">Name</label>--}}
                    {{--                                <input type="text" class="form-control" id="name" placeholder="Your good name is? ">--}}
                    {{--                            </div>--}}
                    {{--                            <div class="form-group">--}}
                    {{--                                <label for="email">Email address</label>--}}
                    {{--                                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">--}}
                    {{--                            </div>--}}
                    {{--                            <div class="form-group">--}}
                    {{--                                <label for="role">Select role</label>--}}
                    {{--                                <select class="form-control" id="role">--}}
                    {{--                                    <option>Guest</option>--}}
                    {{--                                    <option>Premium</option>--}}

                    {{--                                </select>--}}
                    {{--                            </div>--}}
                    {{--                            <div class="form-check">--}}
                    {{--                                <input class="form-check-input" type="radio" name="status" id="status_active" value="1" checked>--}}
                    {{--                                <label class="form-check-label" for="status_active">--}}
                    {{--                                    Active--}}
                    {{--                                </label>--}}
                    {{--                            </div>--}}
                    {{--                            <div class="form-check">--}}
                    {{--                                <input class="form-check-input" type="radio" name="status" id="status_deactive" value="0">--}}
                    {{--                                <label class="form-check-label" for="exampleRadios2">--}}
                    {{--                                    Inactive--}}
                    {{--                                </label>--}}
                    {{--                            </div>--}}

                    {{--                            <button type="submit" class="btn btn-primary pull-right">Submit</button>--}}




                    {{--                        </form>--}}


                </div>

            </main>
            <!-- page-content" -->
        </div>
        <!-- page-wrapper -->

    </div>
    </body>
@endsection
