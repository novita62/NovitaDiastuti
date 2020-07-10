@extends('adminlte::page')

@section('title', 'Edit Komdanas')

@section('content_header')
@stop

@section('content')
{!! Form::model($data,['route' => ['komdanas.update', ['kode' => $data->kode]],'method'=>'PATCH','class'=>'form-horizontal']) !!}
@include('komdanas.form')
{!! Form::close() !!}
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop