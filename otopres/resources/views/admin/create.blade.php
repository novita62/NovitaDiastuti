@extends('adminlte::page')

@section('title', 'Buat Admin')

@section('content_header')
@stop

@section('content')
{!! Form::open(['route' => 'admin.store','class'=>'form-horizontal']) !!}
@include('admin.form')
{!! Form::close() !!}
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop