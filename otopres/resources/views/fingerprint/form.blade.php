<form class="form-horizontal" id="myform">
  <hr>
  <div class='col-sm-12'>
    <div class="form-group">
      <div class='input-group'>
        <label for="tanggal" style="margin-right:10px;margin-top:5px;">Tanggal</label> 
        <input type='text' class="form-control col-sm-2" id="tanggal" name="tanggal" style="width:20px; !important;margin-right:15px;" data-container="body" value="{!! $tanggal !!}" autocomplete="off" />
        <label for="file_xls" style="margin-right:10px;margin-top:5px;">Import XLS</label> 
        <input type='file' class="form-control col-sm-3" id="file_xls" name="file_xls" style="margin-right:10px;" />
        <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Upload</button>
      </div>
    </div>
  </div>
  <hr>
</form>