<div class="card" style="padding:30px;width:80%;margin:auto;">
  <div class="box-header with-border">
    <h3 class="box-title">@yield('title')</h3>
  </div>
  <hr>
  <form class="form-horizontal">
    <div class="box-body">
        <input type="hidden" value = "<?= $pegawai->nip?>" class = "form-control" name="nip">
        <div class="form-group">
            <label for="nip" class="control-label text-right">NIP :</label>
            <input type="text" value = "<?= $pegawai->nip?>" class = "form-control" disabled>
        </div>

        <div class="form-group">
            <label for="nama" class="control-label text-right">Nama :</label>
            <input type="text" value = "<?= $pegawai->nama?>" class = "form-control" disabled>
        </div>

        <div class="form-group">
            <label for="nip" class="control-label text-right">Jabatan :</label>
            <input type="text" value = "<?= $pegawai->jabatan->nama_jabatan?>" class = "form-control" disabled>
        </div>

        <div class="form-group">
            <label for="nip" class="control-label text-right">Pangkat :</label>
            <input type="text" value = "<?= $pegawai->pangkat->nama_pangkat?>" class = "form-control" disabled>
        </div>
      
        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
            <label for="status" class="control-label text-right">Status Komdanas :</label>
            <div>
            {!! Form::select('status',\App\Komdanas::all()->map(function($data){return ['kode' => $data->kode, 'keterangan' => '('.$data->kode.') '.$data->keterangan ];})
                ->pluck('keterangan', 'kode')->toArray() , null,
                ['class' => 'form-control','style'=>'width :100% !important;','id'=>'status']) !!}
            @if ($errors->has('status'))
                <span class="help-block">
                    <strong>{{ $errors->first('status') }}</strong>
                </span>
            @endif
            </div>
        </div>
        <br>
        <div style="width:100%;">
            <div style="width:45%;float:left;">            
                <div class="form-group{{ $errors->has('tanggal_start') ? ' has-error' : '' }}" style="width:90% !important; margin-left:10%;position:relative;">
                <label for="tanggal_start" class="control-label text-right">Tanggal Mulai :</label>
                <div>
                    {!! Form::text('tanggal_start',null,['class' => 'form-control','style'=>'','id'=>'tanggal_start']) !!}
                    @if ($errors->has('tanggal_start'))
                    <span class="help-block">
                    <strong>{{ $errors->first('tanggal_start') }}</strong>
                    </span>
                    @endif
                </div>
                </div>
            </div>
            <div style="margin-left:55%;">
                <div class="form-group{{ $errors->has('tanggal_end') ? ' has-error' : '' }}" style="width:92% !important;position:relative;">
                <label for="tanggal_end" class="control-label text-right">Tanggal Selesai :</label>
                <div>
                    {!! Form::text('tanggal_end',null,['class' => 'form-control','style'=>'','id'=>'tanggal_end']) !!}
                    @if ($errors->has('tanggal_end'))
                    <span class="help-block">
                    <strong>{{ $errors->first('tanggal_end') }}</strong>
                    </span>
                    @endif
                </div>
                </div>
            </div>
        </div>
        <br>
        <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
            <label for="file" class="control-label text-right">Dokumen :</label>
            <div>
            {!! Form::file('file',null,['class' => 'form-control','style'=>'width :100% !important;','id'=>'file']) !!}
            @if ($errors->has('file'))
                <span class="help-block">
                    <strong>{{ $errors->first('file') }}</strong>
                </span>
            @endif
            </div>
        </div>
        

    </div>
    <hr>
    <div class="box-body text-center">
      <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Save</button>
      <a href="{{url('pangkat')}}" class="btn btn-danger"><i class="fa fa-remove"></i> Close</a>
    </div>
  </form>
</div>
