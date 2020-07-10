@extends('adminlte::page')

@section('title', 'Master Pegawai')

@section('content_header')
    
@stop

@section('content')
<div class="card" style="padding:30px;">
  <div class="box-body">
    <div class="box box-danger box-solid">
          <div class="box-header">
            <h3 class="box-title">@yield('title')</h3>
            <a href="{{ route('pegawai.create')}}" class="btn btn-primary btn pull-right"  title="Buat Pegawai"><i class="fa fa-plus-square"></i> Buat Pegawai</a>
          </div>
          <hr>
          <div class="box-body">
            <table id="datatables" class="table table-bordered table-striped table-hover">
              <thead>
              <tr>
                <th>NIP</th>
                <th>Nama Pegawai</th>
                <th>Nama File</th>
                <th>Jabatan</th>
                <th>Pangkat</th>
                <th>Jam Kerja</th>
                <th class="col-md-1 text-center">Action</th>
              </tr>
              </thead>
              <tbody>
              <?php
              $no=1;
              ?>
              @foreach($data as $row)
                <tr>
                  <td>{{$row->nip}}</td>
                  <td>{{$row->nama}}</td>
                  <td>{{$row->nama_file}}</td>
                  <td>{{$row->jabatan->nama_jabatan}}</td>
                  <td>{{$row->pangkat->nama_pangkat}}</td>
                  <td>{{$row->jam_masuk. '- '.$row->jam_pulang}}</td>
                  <td class="text-center">
                    <div class="btn-group">
                        <a href="{{route('pegawai.destroy', ['nip' => $row->nip])}}" class="btn btn-danger btn-xs" style="margin-right:10px;" onclick="return confirm('Hapus Data ?')"><i class="fa fa-trash"></i></a> 
                        <a href="{{route('pegawai.edit', ['nip' => $row->nip])}}" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
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
@stop

@section('js')
<script type="text/javascript">
    $("#datatables").DataTable({
        "columnDefs": [
            { "width": "15%", "targets": 0 },     
            { "width": "20%", "targets": 1 },     
            { "width": "20%", "targets": 2 },     
            { "width": "20%", "targets": 3 },            
            { "width": "15%", "targets": 4 }
        ]
    });
</script>
@stop