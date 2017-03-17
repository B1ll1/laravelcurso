<div class="box box-primary">
  <div class="box-header with-border">
    <!-- <h3 class="box-title"></h3> -->
  </div>
  <!-- /.box-header -->
  <!-- form start -->
  <form role="form">
    <div class="box-body">
      <div class="form-group @if($errors->has('name')) has-error @endif">
        <label for="platformName">Nome</label>
        {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'platformName', 'placeholder' => 'Nome da categoria']) !!}
        @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
      </div>
      <div class="form-group @if ($errors->has('description')) has-error @endif">
        <label for="platformDescription">Descrição</label>
        {!! Form::textarea('description', null, ['class' => 'form-control', 'id' => 'platformDescription', 'placeholder' => 'Descrição da categoria...', 'style' => 'resize: vertical;']) !!}
        @if ($errors->has('description')) <p class="help-block">{{ $errors->first('description') }}</p> @endif
      </div>
    </div>
    <!-- /.box-body -->

    <div class="box-footer">
      <div class="pull-right">
        <a href="#" class="btn btn-danger btn-flat"><i class="fa fa-undo"></i> Voltar</a>&nbsp;&nbsp;&nbsp;
        <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Salvar</button>
      </div>
    </div>
  </form>
</div>
<!-- /.box -->