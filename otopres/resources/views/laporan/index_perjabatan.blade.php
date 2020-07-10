@extends('adminlte::page')

@section('title', 'Laporan Presensi Persorangan')

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
              <div style="width:60%;float:left;">
                <div style="widht:100%">
                    <div style="width:60%;float:left;">
                        {!! Form::open(['route' => 'laporan.perjabatan','class'=>'form-horizontal', 'id'=>'myForm']) !!}
                        @include('laporan.form_perjabatan')
                        {!! Form::close() !!}
                    </div>
                    <div style="margin-left:63%">
                        <ul class="nav nav-pills ">
                        <li class="nav-item dropdown">
                            <a id='btnx' class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Pilih Jabatan</a>
                            <div class="dropdown-menu">
                            @foreach($jabatan as $p) 
                            <a data-toggle="tab" class="dropdown-item" href="#menu_<?=$p->id?>"> <?= $p->nama_jabatan ?></a>
                            @endforeach
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
            <?php $aktif = false; ?>
                @foreach($data as $key => $d)
                <div id="menu_{{$key}}" class="tab-pane fade show">
                    <table id="tbl_{{$key}}" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>Jam Masuk</th>
                                <th>Jam Pulang</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                                <th>Dokumen</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($d as $row)
                            <tr>
                                <td>{{$row->nip_pegawai}}</td>
                                <td>{{$row->pegawai->nama}}</td>
                                <td>{{$row->jam_masuk}}</td>
                                <td>{{$row->jam_pulang}}</td>
                                <td>{{$row->status_komdanas}}</td>
                                <td>{{$row->keterangan}}</td>
                                <td>{{$row->file}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>    
                @endforeach
            </div>
          </div>
    </div>
  </div>
</div>
<input type="hidden" id="_cetak" value = "{{route('laporan.cetak_perjabatan', ['tanggal' => $tanggal, 'id' => ''])}}" >
<input type="hidden" id="_jabatan" value = '{{json_encode($jabatan)}}' >
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
            if(id != 0) {
                var cetak = document.getElementById('_cetak').value;
                console.log(cetak + encodeURIComponent(id));
                var win = window.open(cetak + encodeURIComponent(id), '_blank');
                win.focus();
            }
        }
        var id = 0;
        $(document).ready(function() {
          $(".dropdown-menu a").click(function(){
            var selText = $(this).text();
            id = $(this).attr("href").replace('#menu_', '');
            $("#btnx").text(selText)
          });
          var jabatan = JSON.parse(document.getElementById('_jabatan').value);
          for(var i = 0 ; i < jabatan.length ; i ++) {
                $("#tbl_"+ jabatan[i].id).DataTable({
            });
          }
          
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
          
        });

    </script>
@stop
