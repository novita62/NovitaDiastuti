@extends('adminlte::page')

@section('title', 'Form Kehadiran Pegawai')

@section('content_header')
@stop

@section('content')
{!! Form::model($pegawai,['route' => ['kehadiran.store'],'method'=>'POST','class'=>'form-horizontal', 'files' => true]) !!}
@include('kehadiran.form_kehadiran')
{!! Form::close() !!}
@stop

@section('css')
  <link rel="stylesheet" href="/css/admin_custom.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.0.0/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
@stop

@section('js')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.0.0/js/bootstrap-datetimepicker.min.js"></script>  
    <script type="text/javascript"> 
      $(document).ready(function() {
          $('#tanggal_start').datetimepicker({
                format:'DD/MM/YYYY',
                icons: {
                    today: "fas fa-bomb",
                    date: "fas fa-calendar",
                    time: "fas fa-clock-o",
                    up: "fa fa-arrow-up",
                    next: "fa fa-arrow-right",
                    down: "fa fa-arrow-down",
                    previous: "fa fa-arrow-left",
                    clear: "fas fa-circle-o",
                    close: "fas fa-times"
                },
          });
          $('#tanggal_end').datetimepicker({
                format:'DD/MM/YYYY',
                icons: {
                    today: "fas fa-bomb",
                    date: "fas fa-calendar",
                    time: "fas fa-clock-o",
                    up: "fa fa-arrow-up",
                    next: "fa fa-arrow-right",
                    down: "fa fa-arrow-down",
                    previous: "fa fa-arrow-left",
                    clear: "fas fa-circle-o",
                    close: "fas fa-times"
                },
          });
      });
    </script>    
@stop