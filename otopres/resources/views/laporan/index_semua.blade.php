@extends('adminlte::page')

@section('title', 'Laporan Presensi - Semua')

@section('content_header')

@stop

@section('content')
<div class="card" style="padding:30px;">
  <div class="box-body">
    <div class="box box-danger box-solid">
          <div class="box-header">
            <h3 class="box-title">@yield('title')</h3>
          </div>
          <hr>
          <div class="box-body">
            <div style="widht:100%">
              <div style="width:50%;float:left;">
                <div style="widht:100%">
                <div style="width:60%;float:left;">
                    {!! Form::open(['route' => 'laporan.semua','class'=>'form-horizontal', 'id'=>'myForm']) !!}
                    @include('laporan.form_semua')
                    {!! Form::close() !!}
                </div>
                <div style="margin-left:63%">
                    <ul class="nav nav-pills ">
                    <li class="nav-item dropdown">
                        <a id='btnx' class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Semua Presensi</a>
                        <div class="dropdown-menu">
                        <a data-toggle="tab" class="dropdown-item" href="#menu_0">Semua Presensi</a>
                        <a data-toggle="tab" class="dropdown-item" href="#menu_1">Presensi Tidak Lengkap</a>
                        </div>
                    </li>
                    </ul>
                </div>
                </div>
              </div>
              <div style="margin-left:92%">
                    <button class="btn btn-info btn-lm" onclick="cetak()">Cetak</button>
              </div>
            </div>

            <hr>
            <div class="tab-content">
              <div id="menu_0" class="tab-pane fade show active">
                <table id="tbl_0" class="table table-bordered table-striped table-hover">
                  <thead>
                  <tr>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Jam Masuk</th>
                    <th>Jam Pulang</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($pegawai_all as $row)
                    <tr>
                      <td>{{$row->nip}}</td>
                      <td>{{$row->nama}}</td>
                      <td>{{$row->jabatan->nama_jabatan}}</td>
                      <td>{{$row->masuk}}</td>
                      <td>{{$row->pulang}}</td>
                      <td>{{$row->status}}</td>
                      <td>{{$row->keterangan}}</td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              <div id="menu_1" class="tab-pane fade ">
                <table id="tbl_1" class="table table-bordered table-striped table-hover">
                  <thead>
                  <tr>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Jam Masuk</th>
                    <th>Jam Pulang</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($pegawai_tidak_lengkap as $row)
                    <tr>
                      <td>{{$row->nip}}</td>
                      <td>{{$row->nama}}</td>
                      <td>{{$row->jabatan->nama_jabatan}}</td>
                      <td>{{$row->masuk}}</td>
                      <td>{{$row->pulang}}</td>
                      <td>{{$row->status}}</td>
                      <td>{{$row->keterangan}}</td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
    </div>
  </div>
</div>
<input type="hidden" id="_cetak" value = "{{route('laporan.cetak_semua', ['tanggal' => $tanggal, 'jenis' => ''])}}" >
@stop

@section('css')
  <link rel="stylesheet" href="/css/admin_custom.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
  <style>
  </style>
@stop

@section('js')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        function cetak() {
            var cetak = document.getElementById('_cetak').value;
            console.log(cetak + jenis_presensi);
            var win = window.open(cetak + jenis_presensi, '_blank');
            win.focus();
        }
        var jenis_presensi = 1;
        $(document).ready(function() {
          $(".dropdown-menu a").click(function(){
            var selText = $(this).text();
            jenis_presensi = selText === 'Semua Presensi' ? 1 : 2;
            $("#btnx").text(selText)
          });

          $('#tanggal').datetimepicker({
            useCurrent: false,
            format: 'DD/MM/YYYY'
          }).on('dp.change', function (e) {
            var inpt = $('#tanggal').val();
            console.log('tanggal ' + inpt);
            if(moment(inpt, 'DD/MM/YYYY',true).isValid()) {
                var tanggal = moment(inpt).format('YYYY-MM-DD');
                document.getElementById("myForm").submit();
            }else if(inpt === '') {
                document.getElementById("myForm").submit();
            }
          });

          $("#tbl_0").DataTable({
              "columnDefs": [
                  { "width": "15%", "targets": 0 },
                  { "width": "25%", "targets": 1 },
                  { "width": "20%", "targets": 2 },
                  { "width": "5%", "targets": 3 },
                  { "width": "5%", "targets": 4 },
                  { "width": "5%", "targets": 5 },
                  { "width": "25%", "targets": 6 },
              ]
          });

          $("#tbl_1").DataTable({
              "columnDefs": [
                  { "width": "15%", "targets": 0 },
                  { "width": "25%", "targets": 1 },
                  { "width": "20%", "targets": 2 },
                  { "width": "5%", "targets": 3 },
                  { "width": "5%", "targets": 4 },
                  { "width": "5%", "targets": 5 },
                  { "width": "25%", "targets": 6 },
              ]
          });
        });

    </script>
@stop
