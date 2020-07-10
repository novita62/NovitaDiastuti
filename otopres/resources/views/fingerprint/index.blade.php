@extends('adminlte::page')

@section('title', 'Presensi Fingerprint')

@section('content_header')
    
@stop

@section('content')
<div class="card" style="padding:30px;">
  <div class="box-body">
    <div class="box box-danger box-solid">
          <div class="box-header">
            <h3 class="box-title">@yield('title')</h3>            
            {!! Form::open(['route' => 'fingerprint','class'=>'form-horizontal', 'id'=>'myForm', 'files' => true]) !!}
              @include('fingerprint.form')
            {!! Form::close() !!}
          </div>
          <div class="box-body">
            <table id="datatables" class="table table-bordered table-striped table-hover">
              <thead>
              <tr>
                <th>Tanggal</th>
                <th>ID</th>
                <th>NIP</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Status</th>
                <th>Masuk</th>
                <th>Pulang</th>
                <th>Terlambat</th>
                <th>Pulang Cepat</th>
                <th class="col-md-1 text-center">Action</th>
              </tr>
              </thead>
              <tbody>
              @foreach($data as $row)
                <tr>
                  <td>{{$row->tanggal}}</td>                     
                  <td>{{$row->id_finger}}</td>            
                  <td>{{$row->nip_pegawai}}</td>
                  <td>{{$row->pegawai->nama}}</td>
                  <td>{{$row->pegawai->jabatan->nama_jabatan}}</td>
                  <td>{{$row->status_komdanas}}</td>
                  <td>{{$row->jam_masuk}}</td>
                  <td>{{$row->jam_pulang}}</td>
                  <td>{{$row->terlambat}}</td>
                  <td>{{$row->pulang_cepat}}</td>
                  <td class="text-center">
                    <div class="btn-group">
                        <a href="{{route('fingerprint.destroy', ['id' => $row->id])}}" class="btn btn-danger btn-xs" style="margin-right:10px;" onclick="return confirm('Hapus Data ?')"><i class="fa fa-trash"></i></a> 
                    </div>
                  </td>
                </tr>
              @endforeach
              </tbody>
            </table>
          </div>
        </div>
  </div>
</div>
@stop

@section('css')
  <link rel="stylesheet" href="/css/admin_custom.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
@stop

@section('js')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>  
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>  

    <script type="text/javascript">    
        $(document).ready(function() { 
          $("#datatables").DataTable({
            "columnDefs": [
                { "width": "10%", "targets": 0 },     
                { "width": "15%", "targets": 1 },     
                { "width": "15%", "targets": 2 },     
                { "width": "10%", "targets": 3 },     
                { "width": "5%", "targets": 4 },     
                { "width": "10%", "targets": 5 },     
                { "width": "10%", "targets": 6 },     
                { "width": "10%", "targets": 7 },     
                { "width": "10%", "targets": 8 },     
                { "width": "15%", "targets": 9 },     
            ]
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
      });
    </script>
@stop