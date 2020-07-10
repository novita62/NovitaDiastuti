@extends('adminlte::page')

@section('title', 'Master Admin')

@section('content_header')
    
@stop

@section('content')
<div class="card" style="padding:30px;">
  <div class="box-body">
    <div class="box box-danger box-solid">
          <div class="box-header">
            <h3 class="box-title">@yield('title')</h3>
            <?php if(Auth::user()->role == 1):?>
            <a href="{{ route('admin.create')}}" class="btn btn-primary btn pull-right"  title="Buat Pangkat"><i class="fa fa-plus-square"></i> Buat Admin</a>
            <?php endif;?>
          </div>
          <hr>
          <div class="box-body">
            <table id="datatables" class="table table-bordered table-striped table-hover">
              <thead>
              <tr>
                <th>username</th>
                <th>Nama Admin</th>
                <th>Role</th>
                <?php if(Auth::user()->role == 1):?>
                <th class="col-md-1 text-center">Action</th>
                <?php endif;?>
              </tr>
              </thead>
              <tbody>
              <?php
              $no=1;
              ?>
              @foreach($data as $row)
                <tr>
                  <td>{{$row->username}}</td>
                  <td>{{$row->nama}}</td>
                  <td>{{$row->role == 1 ? 'Super Admin' : 'Admin'}}</td>
                  <?php if(Auth::user()->role == 1):?>
                  <td class="text-center">
                    <div class="btn-group">
                        <a href="{{route('admin.destroy', ['username' => $row->username])}}" class="btn btn-danger btn-xs" style="margin-right:10px;" onclick="return confirm('Hapus Data ?')"><i class="fa fa-trash"></i></a> 
                        <a href="{{route('admin.edit', ['username' => $row->username])}}" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
                    </div>
                  </td>
                  <?php endif;?>
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
            { "width": "20%", "targets": 0 },            
            { "width": "40%", "targets": 1 },         
            { "width": "20%", "targets": 2 }, 
        ]
    });
</script>
@stop