@extends('adminlte::page')

@section('title', 'Buat Komdanas')

@section('content_header')
@stop

@section('content')
{!! Form::open(['route' => 'komdanas.store','class'=>'form-horizontal']) !!}
@include('komdanas.form')
{!! Form::close() !!}
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop