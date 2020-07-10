@extends('adminlte::page')

@section('title', 'Presensi Manual')

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
                {!! Form::open(['route' => 'presensi','class'=>'form-horizontal', 'id'=>'myForm']) !!}
                @include('presensi.form')
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
                    <th>Finger</th>
                    <th>Manual</th>
                    <th>Status</th>
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
                        if($row->manual !== null) {
                          $status = $row->manual->status_komdanas;
                        }elseif($row->finger !== null) {
                          $status = $row->finger->status_komdanas;
                        }elseif($row->kehadiran !== null) {
                          $status = $row->kehadiran->status_komdanas;
                        }
                      ?>
                      <td><?= $row->finger === null ? '' : $row->finger->jam_masuk. '/' .$row->finger->jam_pulang ?></td>
                      <td><?= $row->manual === null ? '' : $row->manual->jam_masuk. '/' .$row->manual->jam_pulang ?></td>
                      <td><?= $status?></td>
                      <td class="text-center">
                        <div class="btn-group">
                            <a href="#" class="btn btn-info btn-xs" style="margin-right:10px;" data-toggle="modal" data-target="#modal_<?= $row->nipid()?>"><i class="fa fa-edit"></i></a> 
                            <a href="{{route('presensi.destroy', ['nip' => $row->nip, 'tanggal' => $tanggal])}}" class="btn btn-danger btn-xs" onclick="return confirm('Hapus Data ?')"><i class="fa fa-trash"></i></a> 
                        </div>
                      </td>
                      
                      <div class="modal fade modal-vertical-centered" id="modal_<?= $row->nipid()?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog modal-lg" role="document">
                          <div class="modal-content">
                            <form class="form-horizontal" method="post" action="{{route('presensi')}}">
                              @csrf
                              <div class="modal-header">
                                <h4 class="modal-title">Presensi Manual</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              </div>
                              <div class="modal-body">                                  
                                  <input type="hidden" value = "<?= $tanggal?>" class = "form-control" name="tanggal">
                                  <input type="hidden" value = "<?= $row->nip?>" class = "form-control" name="nip">

                                  <label for="nip" class="control-label text-right">NIP :</label>
                                  <input type="text" value = "<?= $row->nip?>" class = "form-control" disabled>
                                  
                                  <label for="nama" class="control-label text-right">Nama :</label>
                                  <input type="text" value = "<?= $row->nama?>" class = "form-control" disabled>
                                  
                                  <label for="nip" class="control-label text-right">Jabatan :</label>
                                  <input type="text" value = "<?= $row->jabatan->nama_jabatan?>" class = "form-control" disabled>
                                  
                                  <label for="nip" class="control-label text-right">Pangkat :</label>
                                  <input type="text" value = "<?= $row->pangkat->nama_pangkat?>" class = "form-control" disabled>
                                  <br>
                                  <div style="width:100%">
                                    <div style="width:45%;float:left">
                                      <label for="jam_masuk" class="control-label text-right">Jam Masuk :</label>
                                      <input id="t0_<?=$row->nipid()?>_jam_masuk" name="jam_masuk" type="text"  class = "form-control" style="position:relative;">
                                    </div>
                                    <div style="margin-left:55%;">
                                      <label for="jam_pulang" class="control-label text-right">Jam Pulang :</label>
                                      <input id="t0_<?=$row->nipid()?>_jam_pulang" name="jam_pulang" type="text" class = "form-control" style="position:relative;">
                                    </div>
                                  </div>
                              </div>
                              <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Save</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>

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
                    <th>Finger</th>
                    <th>Manual</th>
                    <th>Status</th>
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
                        if($row->manual !== null) {
                          $status = $row->manual->status_komdanas;
                        }elseif($row->finger !== null) {
                          $status = $row->finger->status_komdanas;
                        }elseif($row->kehadiran !== null) {
                          $status = $row->kehadiran->status_komdanas;
                        }
                      ?>
                      <td><?= $row->finger === null ? '' : $row->finger->jam_masuk. '/' .$row->finger->jam_pulang ?></td>
                      <td><?= $row->manual === null ? '' : $row->manual->jam_masuk. '/' .$row->manual->jam_pulang ?></td>
                      <td><?= $status?></td>
                      <td class="text-center">
                            <a href="#" class="btn btn-info btn-xs" style="margin-right:10px;" data-toggle="modal" target="#t<?=$jab->id?>_modal_<?= $row->nipid()?>"><i class="fa fa-edit"></i></a> 
                            <a href="{{route('presensi.destroy', ['nip' => $row->nip, 'tanggal' => $tanggal])}}" class="btn btn-danger btn-xs" onclick="return confirm('Hapus Data ?')"><i class="fa fa-trash"></i></a> 
                      </td>
                      
                      <div class="modal fade modal-vertical-centered" id="t<?=$jab->id?>_modal_<?= $row->nipid()?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog modal-lg" role="document">
                          <div class="modal-content">
                            <form class="form-horizontal" >
                              @csrf
                              <div class="modal-header">
                                <h4 class="modal-title">Presensi Manual</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              </div>
                              <div class="modal-body">                                  
                                  <label for="nip" class="control-label text-right">NIP :</label>
                                  <input type="text" value = "<?= $row->nip?>" class = "form-control" disabled>
                                  
                                  <label for="nama" class="control-label text-right">Nama :</label>
                                  <input type="text" value = "<?= $row->nama?>" class = "form-control" disabled>
                                  
                                  <label for="nip" class="control-label text-right">Jabatan :</label>
                                  <input type="text" value = "<?= $row->jabatan->nama_jabatan?>" class = "form-control" disabled>
                                  
                                  <label for="nip" class="control-label text-right">Pangkat :</label>
                                  <input type="text" value = "<?= $row->pangkat->nama_pangkat?>" class = "form-control" disabled>
                                  <br>
                                  <div style="width:100%">
                                    <div style="width:45%;float:left">
                                      <label for="jam_masuk" class="control-label text-right">Jam Masuk :</label>
                                      <input id="t<?=$jab->id?>_<?=$row->nipid()?>_jam_masuk" name="jam_masuk" type="text"  class = "form-control" style="position:relative;">
                                    </div>
                                    <div style="margin-left:55%;">
                                      <label for="jam_pulang" class="control-label text-right">Jam Pulang :</label>
                                      <input id="t<?=$jab->id?>_<?=$row->nipid()?>_jam_pulang" name="jam_pulang" type="text" class = "form-control" style="position:relative;">
                                    </div>
                                  </div>
                              </div>
                              <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Save</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>

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
<input type="hidden" id="_pegawai" value = '<?= json_encode($pegawai)?>' >
<input type="hidden" id="_perjab" value = '<?= json_encode($perjab)?>' >
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
          var pegawai = JSON.parse(document.getElementById('_pegawai').value);   
          var perjab = JSON.parse(document.getElementById('_perjab').value);         

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

          for(var i = 0 ; i < pegawai.length ; i ++) { 
            var nid = pegawai[i].nip.replace(/\s/g,'');
              $('#t0_' + nid +'_jam_masuk').datetimepicker({
                format: 'HH:mm',            
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
              $('#t0_' + nid +'_jam_pulang').datetimepicker({
                format: 'HH:mm',           
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
          }
          for(var i = 0 ; i < jabatan.length ; i ++) {      
            for(var n = 0 ; n < perjab[jabatan[i].id].length ; n ++) {
              var nid = perjab[jabatan[i].id][n].nip.replace(/\s/g,'');
              $('#t'+jabatan[i].id+ '_' + nid +'_jam_masuk').datetimepicker({
                format: 'HH:mm',           
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
              $('#t'+jabatan[i].id+ '_' + nid +'_jam_pulang').datetimepicker({
                format: 'HH:mm',           
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
            }
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