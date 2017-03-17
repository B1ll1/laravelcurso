<div class="box box-primary">
  <div class="box-header with-border">
    <!-- <h3 class="box-title"></h3> -->
  </div>
  <!-- /.box-header -->
  <!-- form start -->
  <form role="form">
    <div class="box-body">
      <div class="form-group @if($errors->has('name')) has-error @endif">
        <label for="userName">Nome</label>
        {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'userName', 'placeholder' => 'Nome do usuário']) !!}
        @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
      </div>
      <div class="form-group @if ($errors->has('email')) has-error @endif">
        <label for="userEmail">Email</label>
        {!! Form::text('email', null, ['class' => 'form-control', 'id' => 'userEmail', 'placeholder' => 'Email do usuário']) !!}
        @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
      </div>

      @if(strpos(Request::url(), 'criar'))
        <div class="form-group @if ($errors->has('password')) has-error @endif">
            <label for="userPassword">Senha</label>
            {!! Form::password('password', ['class' => 'form-control', 'id' => 'userPassword', 'placeholder' => 'Senha do usuário']) !!}
            @if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif
        </div>
        <div class="form-group @if ($errors->has('password_check')) has-error @endif">
            <label for="userPasswordCheck">Confirmação de Senha</label>
            {!! Form::password('password_check', ['class' => 'form-control', 'id' => 'userPasswordCheck', 'placeholder' => 'Confirmação de senha do usuário']) !!}
            @if ($errors->has('password_check')) <p class="help-block">{{ $errors->first('password_check') }}</p> @endif
        </div>
        @endif
        @if(strpos(Request::url(), 'editar'))
            <div class="form-group">
                <label>Senha<sup>*</sup></label>
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#editPassword">
                    <i class="fa fa-edit"></i>
                    Alterar
                </button>
            </div>
        @endif
        @if(Auth::user()->user_role_id==1)
        <!-- radio -->
          <div class="form-group">
            <label>Tipo de Usuário</label>
                <select class="form-control" id="role_select" name="user_role_id">
                </select>
          </div>
          <!-- select -->
          <div class="form-group" id="select_platform" style="display: none;">
            <label>Plataforma</label>
                <select class="form-control" id="platform_select" name="platform_id">
                </select>
          </div>

        @elseif(Auth::user()->user_role_id==2)
        <div class="form-group" id="radio_button_group_platform">
        </div>
        @endif
        <div class="form-group">
            <label for="userPhoto">Imagem</label>
            {!! Form::file('photo', null, ['class' => 'form-control', 'id' => 'userPhoto']) !!}

            <!-- Shows current image when editing -->
            <div class="col-sm-4">
                @if(strpos(Request::url(), 'editar'))
                    <img src="{{ route('images', [$user->photo, 40]) }}">
                @endif
            </div><br><br>
        </div>
    </div>

    <!-- /.box-body -->

    <div class="box-footer">
      <div class="pull-right">
        <a href="{{route('user.index')}}" class="btn btn-danger btn-flat"><i class="fa fa-undo"></i> Voltar</a>&nbsp;&nbsp;&nbsp;
        <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Salvar</button>
      </div>
    </div>
  </form>
</div>
<!-- /.box -->

