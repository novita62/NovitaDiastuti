@extends('adminlte::page')

@section('title', 'Edit Pegawai')

@section('content_header')
@stop

@section('content')
{!! Form::model($data,['route' => ['pegawai.update', ['nip' => $data->nip]],'method'=>'PATCH','class'=>'form-horizontal']) !!}
@include('pegawai.form')
{!! Form::close() !!}
@stop

@section('css')
  <link rel="stylesheet" href="/css/admin_custom.css">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
@stop

@section('js')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>  
    <script type="text/javascript"> 
      $(document).ready(function() {
          $('#jam_masuk').datetimepicker({
            format: 'HH:mm',
          });
          $('#jam_pulang').datetimepicker({
            format: 'HH:mm'
          });
      });
    </script>    
@stop