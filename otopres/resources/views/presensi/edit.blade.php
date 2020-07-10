@extends('adminlte::page')

@section('title', 'Edit Pangkat')

@section('content_header')
@stop

@section('content')
{!! Form::model($data,['route' => ['pangkat.update', ['id' => $data->id]],'method'=>'PATCH','class'=>'form-horizontal']) !!}
@include('pangkat.form')
{!! Form::close() !!}
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop