<div class="card" style="padding:30px;width:80%;margin:auto;">
  <div class="box-header with-border">
    <h3 class="box-title">@yield('title')</h3>
  </div>
  <hr>
  <form class="form-horizontal">
    <div class="box-body">
      <div class="form-group{{ $errors->has('kode') ? ' has-error' : '' }}">
        <label for="kode" class="control-label text-right">Kode :</label>
        <div>
          {!! Form::text('kode',null,['class' => 'form-control','style'=>'width :100% !important;','id'=>'kode',
             'readonly' => isset($data) ? empty($data->kode ? false : true) : false ]) !!}
          @if ($errors->has('kode'))
              <span class="help-block">
                  <strong>{{ $errors->first('kode') }}</strong>
              </span>
          @endif
        </div>
      </div>
      <div class="form-group{{ $errors->has('keterangan') ? ' has-error' : '' }}">
        <label for="keterangan" class="control-label text-right">Keterangan :</label>
        <div>
          {!! Form::textarea('keterangan',null,['class' => 'form-control', 'rows' => 2, 'style'=>'width :100% !important;','id'=>'keterangan']) !!}
          @if ($errors->has('keterangan'))
              <span class="help-block">
                  <strong>{{ $errors->first('keterangan') }}</strong>
              </span>
          @endif
        </div>
      </div>
      <div class="form-group{{ $errors->has('deskripsi') ? ' has-error' : '' }}">
        <label for="deskripsi" class="control-label text-right">Deskripsi :</label>
        <div>
          {!! Form::textarea('deskripsi',null,['class' => 'form-control', 'rows' => 2, 'style'=>'width :100% !important;','id'=>'deskripsi']) !!}
          @if ($errors->has('deskripsi'))
              <span class="help-block">
                  <strong>{{ $errors->first('deskripsi') }}</strong>
              </span>
          @endif
        </div>
      </div>
    </div>

    <div class="box-body text-center">
      <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Save</button>
      <a href="{{url('komdanas')}}" class="btn btn-danger"><i class="fa fa-remove"></i> Close</a>
    </div>
  </form>
</div>
