@extends('adminlte::page')

@section('title', 'Master Komdanas')

@section('content_header')
    
@stop

@section('content')
<div class="card" style="padding:30px;">
  <div class="box-body">
    <div class="box box-danger box-solid">
          <div class="box-header">
            <h3 class="box-title">@yield('title')</h3>
            <a href="{{ route('komdanas.create')}}" class="btn btn-primary btn pull-right"  title="Buat Komdanas"><i class="fa fa-plus-square"></i> Buat Komdanas</a>
          </div>
          <hr>
          <div class="box-body">
            <table id="datatables" class="table table-bordered table-striped table-hover">
              <thead>
              <tr>
                <th>Kode</th>
                <th>Keterangan</th>
                <th>Deskripsi</th>
                <th class="col-md-1 text-center">Action</th>
              </tr>
              </thead>
              <tbody>
              <?php
              $no=1;
              ?>
              @foreach($data as $row)
                <tr>
                  <td>{{$row->kode}}</td>
                  <td>{{$row->keterangan}}</td>
                  <td>{{$row->deskripsi}}</td>
                  <td class="text-center">
                    <div class="btn-group">
                        <a href="{{route('komdanas.destroy', ['kode' => $row->kode])}}" class="btn btn-danger btn-xs" style="margin-right:10px;" onclick="return confirm('Hapus Data ?')"><i class="fa fa-trash"></i></a> 
                        <a href="{{route('komdanas.edit', ['kode' => $row->kode])}}" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
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
            { "width": "10%", "targets": 0 },            
            { "width": "40%", "targets": 1 },        
            { "width": "40%", "targets": 2 }
        ]
    });
</script>
@stop