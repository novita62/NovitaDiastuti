@extends('adminlte::page')

@section('title', 'Presensi Kehadiran')

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
              <div style="width:30%;float:left;">
                {!! Form::open(['route' => 'kehadiran','class'=>'form-horizontal', 'id'=>'myForm']) !!}
                @include('kehadiran.form')
                {!! Form::close() !!}
              </div>
              <div style="margin-left:32%">
                <ul class="nav nav-pills ">
                  <li class="nav-item dropdown">
                    <a id='btnx' class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Semua Jabatan</a>
                    <div class="dropdown-menu">
                      <a data-toggle="tab" class="dropdown-item" href="#menu_0">Semua Jabatan</a>
                    @foreach($jabatan as $jab) 
                      <a data-toggle="tab" class="dropdown-item" href="#menu_{{$jab->id}}">{{$jab->nama_jabatan}}</a>
                    <?php $first = true; ?>
                    @endforeach
                    </div>
                  </li>
                </ul>           
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
                    <th>Status</th>
                    <th>Keterangan</th>
                    <th class="col-md-1 text-center">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($pegawai as $row)
                    <tr>
                      <td>{{$row->nip}}</td>                  
                      <td>{{$row->nama}}</td>
                      <td>{{$row->jabatan->nama_jabatan}}</td>
                      <?php 
                        $status="";
                        if($row->kehadiran !== null) {
                          $status = $row->kehadiran->status_komdanas;
                        }elseif($row->manual !== null) {
                          $status = $row->manual->status_komdanas;
                        }elseif($row->finger !== null) {
                          $status = $row->finger->status_komdanas;
                        }
                      ?>
                      <td><?= $status ?></td>
                      <td><?= $row->keterangan?></td>
                      <td class="text-center">
                        <div class="btn-group">
                            <a href="{{route('kehadiran.create', ['nip' => $row->nip, 'tanggal' => $tanggal])}}" class="btn btn-info btn-xs" style="margin-right:10px;" ><i class="fa fa-edit"></i></a> 
                            <a href="{{route('kehadiran.destroy', ['nip' => $row->nip, 'tanggal' => $tanggal])}}" class="btn btn-danger btn-xs" onclick="return confirm('Hapus Data ?')"><i class="fa fa-trash"></i></a> 
                        </div>
                      </td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>          
              </div>

              @foreach($jabatan as $jab)
              <?php $perj = $perjab[$jab->id] ?>
              <div id="menu_{{$jab->id}}" class="tab-pane fade">
                <table id="tbl_{{$jab->id}}" class="table table-bordered table-striped table-hover">
                  <thead>
                  <tr>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Pangkat</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                    <th class="col-md-1 text-center">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($perjab[$jab->id] as $row)
                    <tr>
                      <td>{{$row->nip}}</td>                  
                      <td>{{$row->nama}}</td>
                      <td>{{$row->pangkat->nama_pangkat}}</td>
                      <?php 
                        $status="";
                        if($row->kehadiran !== null) {
                          $status = $row->kehadiran->status_komdanas;
                        }elseif($row->manual !== null) {
                          $status = $row->manual->status_komdanas;
                        }elseif($row->finger !== null) {
                          $status = $row->finger->status_komdanas;
                        }
                      ?>
                      <td><?= $status ?></td>
                      <td><?= $row->keterangan?></td>
                      <td class="text-center">
                            <a href="{{route('kehadiran.create', ['nip' => $row->nip, 'tanggal' => $tanggal])}}" class="btn btn-info btn-xs" style="margin-right:10px;" ><i class="fa fa-edit"></i></a> 
                            <a href="{{route('kehadiran.destroy', ['nip' => $row->nip, 'tanggal' => $tanggal])}}" class="btn btn-danger btn-xs" onclick="return confirm('Hapus Data ?')"><i class="fa fa-trash"></i></a> 
                      </td>                     

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
<input type="hidden" id="_jabatan" value = '<?= json_encode($jabatan)?>' >
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
        $(document).ready(function() { 
          var jabatan = JSON.parse(document.getElementById('_jabatan').value);     

          console.log(jabatan);
          $(".dropdown-menu a").click(function(){
            var selText = $(this).text();
            console.log(selText);
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
                  { "width": "25%", "targets": 0 },            
                  { "width": "30%", "targets": 1 },
                  { "width": "20%", "targets": 2 },          
                  { "width": "10%", "targets": 3 },          
                  { "width": "10%", "targets": 4 },          
                  { "width": "5%", "targets": 5 },
              ]
          });

          for(var i = 0 ; i < jabatan.length ; i ++) {      
            $("#tbl_"+jabatan[i].id).DataTable({
                "columnDefs": [
                  { "width": "25%", "targets": 0 },            
                  { "width": "30%", "targets": 1 },
                  { "width": "20%", "targets": 2 },          
                  { "width": "10%", "targets": 3 },          
                  { "width": "10%", "targets": 4 },          
                  { "width": "5%", "targets": 5 },
                ]
            });
          }
        });

    </script>
@stop