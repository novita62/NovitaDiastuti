<form class="form-horizontal" id="myform" >
  <div >    
    <div class="form-group">
      <div class='input-group'>
        <label for="start" style="margin-right:10px;margin-top:5px;">Tanggal</label> 
        <input type='text' class="form-control " id="start" name="start"  data-container="body" value="{!! $tanggal_start !!}" autocomplete="off" style="margin-right:10px;" /> 
        <label for="end" style="margin-top:5px;">s/d</label> 
        <input type='text' class="form-control " id="end" name="end"  data-container="body" value="{!! $tanggal_end !!}" autocomplete="off" style="margin-left:10px;"  />        
      </div>
    </div>
  </div>
</form>