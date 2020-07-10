<div class="card" style="padding:30px;width:80%;margin:auto;">
  <div class="box-header with-border">
    <h3 class="box-title">@yield('title')</h3>
  </div>
  <hr>
  <form class="form-horizontal">
    <div class="box-body">
      <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
        <label for="username" class="control-label text-right">Username :</label>
        <div>
          {!! Form::text('username',null,['class' => 'form-control','style'=>'width :100% !important;','id'=>'username',
             'readonly' => isset($data) ? empty($data->created_at ? false : true) : false ]) !!}
          @if ($errors->has('username'))
              <span class="help-block">
                  <strong>{{ $errors->first('username') }}</strong>
              </span>
          @endif
        </div>
      </div>
      <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <label for="password" class="control-label text-right">Password :</label>
        <div>
          {!! Form::password('password',null,['class' => 'form-control','style'=>'width :100% !important;','id'=>'password']) !!}
          @if ($errors->has('password'))
              <span class="help-block">
                  <strong>{{ $errors->first('password') }}</strong>
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
      <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
        <label for="role" class="control-label text-right">Role Admin :</label>
        <div>
          {!! Form::select('role',[1 => 'Super Admin', 2 => 'Admin'], null, ['class' => 'form-control','style'=>'width :100% !important;','id'=>'role']) !!}
          @if ($errors->has('role'))
              <span class="help-block">
                  <strong>{{ $errors->first('role') }}</strong>
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
