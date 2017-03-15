
<div class="form-group @if ($errors->has('name')) has-error @endif">
    <label class="col-md-3 control-label">Nome<sup>*</sup></label>
    <div class="col-md-5">
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
    @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
</div>
<div class="form-group @if ($errors->has('email')) has-error @endif">
    <label class="col-md-3 control-label">Email<sup>*</sup></label>
    <div class="col-md-5">
        {!! Form::text('email', null, ['class' => 'form-control']) !!}
    </div>
    @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
</div>
@if(strpos(Request::url(), 'criar'))
<div class="form-group @if ($errors->has('password')) has-error @endif">
    <label class="col-md-3 control-label">Senha<sup>*</sup></label>
    <div class="col-md-3">
        {!! Form::password('password', null, ['class' => 'form-control']) !!}
    </div>
    @if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif
</div>
<div class="form-group @if ($errors->has('password_check')) has-error @endif">
    <label class="col-md-3 control-label">Confirmar Senha<sup>*</sup></label>
    <div class="col-md-3">
        {!! Form::password('password_check', null, ['class' => 'form-control']) !!}
    </div>
    @if ($errors->has('password_check')) <p class="help-block">{{ $errors->first('password_check') }}</p> @endif
</div>
@endif
@if(strpos(Request::url(), 'editar'))
<div class="form-group">
    <label class="col-md-3 control-label">Senha<sup>*</sup></label>
    <div class="col-md-5">
    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#editPassword">
        <i class="fa fa-edit"></i>
        Alterar
    </button>
    </div>
</div>
@endif
<div class="form-group">
    <label class="col-md-3 control-label">Imagem</label>
    <div class="col-md-3">
        {!! Form::file('photo', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Shows current image when editing -->
    <div class="col-sm-4">
        @if(strpos(Request::url(), 'editar'))
            <img src="{{ route('images', [$user->photo, 40]) }}">
        @endif
    </div><br><br>
</div>

{--
<div class="form-group" id="select_tipo_usuario3" style="display: none;">
    <label class="col-md-3 control-label" id="tipo_usuario3"></label>
        <div class="col-md-5 ">
            <select id="type_id3" class="select_type3 form-control" name="type_id3">
            </select>
        </div>
</div>
--}
<div class="clearfix form-actions">
    <div class="col-md-offset-4 col-md-8">
        <button id="save" class="btn btn-info" type="submit">
            <i class="fa fa-floppy-o"></i>
            Salvar
        </button>

        &nbsp; &nbsp; &nbsp;
        <a class="btn" href="{{route('index_usuario')}}">
            <i class="fa fa-undo"></i>
            Cancelar
        </a>
    </div>
</div>
