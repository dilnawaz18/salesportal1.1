@extends('layouts.app')
@section('content')

    <h1>EditCustomer</h1>
    <br>
    {!! Form::open(['action'=>['CustomersController@update',$customer->id],'method'=>'POST']) !!}

    <div class="form-group">
        {{Form::label('name','Customer Name:')}}
        {{Form::text('name',$customer->name,['class'=>'form-control','placeholder'=>'Customer Name: '])}}
    </div>
    <div class="form-group">
        {{Form::label('web_url','Website URL:')}}
        {{Form::text('web_url',$customer->web_url,['class'=>'form-control','placeholder'=>'Website URL: '])}}
    </div>
    {{Form::hidden('_method','PUT')}}
    {{Form::submit('Edit',['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection
