<div class="card" style="padding:30px;width:80%;margin:auto;">
  <div class="box-header with-border">
    <h3 class="box-title">@yield('title')</h3>
  </div>
  <hr>
  <form class="form-horizontal">
    <div class="box-body">
      <div class="form-group{{ $errors->has('nama_pangkat') ? ' has-error' : '' }}">
        <label for="nama_pangkat" class="control-label text-right">Nama Pangkat :</label>
        <div>
          {!! Form::text('nama_pangkat',null,['class' => 'form-control','style'=>'width :100% !important;','id'=>'nama_pangkat']) !!}
          @if ($errors->has('nama_pangkat'))
              <span class="help-block">
                  <strong>{{ $errors->first('nama_pangkat') }}</strong>
              </span>
          @endif
        </div>
      </div>
    </div>

    <div class="box-body text-center">
      <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Save</button>
      <a href="{{url('pangkat')}}" class="btn btn-danger"><i class="fa fa-remove"></i> Close</a>
    </div>
  </form>
</div>
