<div class="card" style="padding:30px;width:80%;margin:auto;">
  <div class="box-header with-border">
    <h3 class="box-title">@yield('title')</h3>
  </div>
  <hr>
  <form class="form-horizontal">
    <div class="box-body">
      <div class="form-group{{ $errors->has('nama_jabatan') ? ' has-error' : '' }}">
        <label for="nama_jabatan" class="control-label text-right">Nama Jabatan :</label>
        <div>
          {!! Form::text('nama_jabatan',null,['class' => 'form-control','style'=>'width :100% !important;','id'=>'nama_jabatan']) !!}
          @if ($errors->has('nama_jabatan'))
              <span class="help-block">
                  <strong>{{ $errors->first('nama_jabatan') }}</strong>
              </span>
          @endif
        </div>
      </div>
    </div>

    <div class="box-body text-center">
      <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Save</button>
      <a href="{{url('jabatan')}}" class="btn btn-danger"><i class="fa fa-remove"></i> Close</a>
    </div>
  </form>
</div>
