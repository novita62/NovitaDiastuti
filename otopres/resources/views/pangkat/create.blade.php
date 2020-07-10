@extends('adminlte::page')

@section('title', 'Buat Pangkat')

@section('content_header')
@stop

@section('content')
{!! Form::open(['route' => 'pangkat.store','class'=>'form-horizontal']) !!}
@include('pangkat.form')
{!! Form::close() !!}
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop