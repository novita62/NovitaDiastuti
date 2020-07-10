<head>
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<style>
        
    #tbl_0 {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #tbl_0 td, #tbl_0 th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #tbl_0 tr:nth-child(even){background-color: #f2f2f2;}

    #tbl_0 tr:hover {background-color: #ddd;}

    #tbl_0 th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #4CAF50;
        color: white;
    }
</style>
</head>
<div class="card" >
  <div class="box-body">
    <div class="box box-danger box-solid">
          <div class="box-header">
            <h3 class="box-title">Laporan Presensi</h3>
            <h4 ><?=  $title?></h4>
            <h4>Tanggal : <?= date('d-m-Y', strtotime($tanggal_start)) ?> s/d <?= date('d-m-Y', strtotime($tanggal_start)) ?></h4>
          </div>
          <hr>
          <div class="box-body">          

            <div id="menu_0" class="tab-pane fade show active">
                <table id="tbl_0" class="table table-bordered table-striped table-hover">
                  <thead>
                    <tr>                  
                        <th>Tanggal</th>
                        <th>Jam Masuk</th>
                        <th>Jam Pulang</th>
                        <th>Status</th>
                        <th>Keterangan</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php foreach($data as $row):?>
                    <tr>
                        <td>{{$row->tanggal}}</td>
                        <td>{{$row->jam_masuk}}</td>
                        <td>{{$row->jam_pulang}}</td>
                        <td>{{$row->status_komdanas}}</td>
                        <td>{{$row->keterangan}}</td>
                    </tr>
                  <?php endforeach;?>
                  </tbody>
                </table>
              </div>
            
          </div>
    </div>
  </div>
</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>  
<script type="text/javascript">
        $(document).ready(function() {

          $("#tbl_0").DataTable({
              "searching": false,
              "paging":   false,
              "ordering": false,
          });

        });

    </script>
