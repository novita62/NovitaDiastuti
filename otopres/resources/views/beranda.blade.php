@extends('adminlte::page')

@section('title', 'Beranda')

@section('content_header')
@stop

@section('content')
    <div class='card'  style="padding:20px;">
        <img src="{{URL::asset('/storage/images/logopn.png')}}" alt="Image" width="100%"/>
        <hr>
        <h1 align="center">Sistem Otomatisasi Presensi Kehadiran</h1>
        <h3 align="center">Daftar Hadir Pengadilan Negeri,</h3>
        <h3 align="center">Hubungan Industrial dan Tindak Pidana Korupsi Yogyakarta Kelas IA</h3>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop