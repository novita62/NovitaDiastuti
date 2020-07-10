@extends('adminlte::page')

@section('title', 'Buat Jabatan')

@section('content_header')
@stop

@section('content')
{!! Form::open(['route' => 'jabatan.store','class'=>'form-horizontal']) !!}
@include('jabatan.form')
{!! Form::close() !!}
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop