
<div class="card" style="padding:30px;width:80%;margin:auto;">
  <div class="box-header with-border">
    <h3 class="box-title">@yield('title')</h3>
  </div>
  <hr>
  <form class="form-horizontal">
    <div class="box-body">
      <div class="form-group{{ $errors->has('nip') ? ' has-error' : '' }}">
        <label for="nip" class="control-label text-right">NIP :</label>
        <div>
          {!! Form::text('nip',null,['class' => 'form-control','style'=>'width :100% !important;','id'=>'nip',
             'readonly' => isset($data) ? (empty($data->nip ? false : true)) : false ]) !!}
          @if ($errors->has('nip'))
              <span class="help-block">
                  <strong>{{ $errors->first('nip') }}</strong>
              </span>
          @endif
        </div>
      </div>
      <div class="form-group{{ $errors->has('id_jabatan') ? ' has-error' : '' }}">
        <label for="id_jabatan" class="control-label text-right">Jabatan :</label>
        <div>
          {!! Form::select('id_jabatan',\App\Jabatan::all()->pluck('nama_jabatan', 'id')->toArray() , null,
            ['class' => 'form-control','style'=>'width :100% !important;','id'=>'role']) !!}
          @if ($errors->has('id_jabatan'))
              <span class="help-block">
                  <strong>{{ $errors->first('id_jabatan') }}</strong>
              </span>
          @endif
        </div>
      </div>
      <div class="form-group{{ $errors->has('id_pangkat') ? ' has-error' : '' }}">
        <label for="id_pangkat" class="control-label text-right">Pangkat :</label>
        <div>
          {!! Form::select('id_pangkat',\App\Pangkat::all()->pluck('nama_pangkat', 'id')->toArray() , null,
            ['class' => 'form-control','style'=>'width :100% !important;','id'=>'role']) !!}
          @if ($errors->has('id_pangkat'))
              <span class="help-block">
                  <strong>{{ $errors->first('id_pangkat') }}</strong>
              </span>
          @endif
        </div>
      </div>
      <div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
        <label for="nama" class="control-label text-right">Nama :</label>
        <div>
          {!! Form::text('nama',null,['class' => 'form-control','style'=>'width :100% !important;','id'=>'nama']) !!}
          @if ($errors->has('nama'))
              <span class="help-block">
                  <strong>{{ $errors->first('nama') }}</strong>
              </span>
          @endif
        </div>
      </div>
      <div class="form-group{{ $errors->has('nama_file') ? ' has-error' : '' }}">
        <label for="nama_file" class="control-label text-right">Nama File :</label>
        <div>
          {!! Form::text('nama_file',null,['class' => 'form-control','style'=>'width :100% !important;','id'=>'nama_file']) !!}
          @if ($errors->has('nama_file'))
              <span class="help-block">
                  <strong>{{ $errors->first('nama_file') }}</strong>
              </span>
          @endif
        </div>
      </div>

      <div style="width:100%;">
            <div style="width:45%;float:left;">            
              <div class="form-group{{ $errors->has('jam_masuk') ? ' has-error' : '' }}" style="width:90% !important; margin-left:10%;position:relative;">
                <label for="jam_masuk" class="control-label text-right">Jam Masuk :</label>
                <div>
                  {!! Form::text('jam_masuk',null,['class' => 'form-control','style'=>'','id'=>'jam_masuk']) !!}
                  @if ($errors->has('jam_masuk'))
                      <span class="help-block">
                          <strong>{{ $errors->first('jam_masuk') }}</strong>
                      </span>
                  @endif
                </div>
              </div>
            </div>
            <div style="margin-left:55%;">
              <div class="form-group{{ $errors->has('jam_pulang') ? ' has-error' : '' }}" style="width:92% !important;position:relative;">
                <label for="jam_pulang" class="control-label text-right">Jam Pulang :</label>
                <div>
                  {!! Form::text('jam_pulang',null,['class' => 'form-control','style'=>'','id'=>'jam_pulang']) !!}
                  @if ($errors->has('jam_pulang'))
                      <span class="help-block">
                          <strong>{{ $errors->first('jam_pulang') }}</strong>
                      </span>
                  @endif
                </div>
              </div>
            </div>
      </div>

    </div>

    <div class="box-body text-center">
      <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Save</button>
      <a href="{{url('pegawai')}}" class="btn btn-danger"><i class="fa fa-remove"></i> Close</a>
    </div>
  </form>
</div>

<script> 
    </script>
