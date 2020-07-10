@extends('adminlte::page')

@section('title', 'Edit Admin')

@section('content_header')
@stop

@section('content')
{!! Form::model($data,['route' => ['admin.update', ['username' => $data->username]],'method'=>'PATCH','class'=>'form-horizontal']) !!}
@include('admin.form')
{!! Form::close() !!}
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop