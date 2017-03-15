<div class="box box-primary">
  <div class="box-header with-border">
    <!-- <h3 class="box-title"></h3> -->
  </div>
  <!-- /.box-header -->
  <!-- form start -->
  <form role="form">
    <div class="box-body">
      <div class="form-group">
        <label for="platformName">Nome</label>
        {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'platformName', 'placeholder' => 'Nome da plataforma']) !!}
      </div>
      <div class="form-group">
        <label for="platformUrl">URL</label>
        {!! Form::text('url', null, ['class' => 'form-control', 'id' => 'platformUrl', 'placeholder' => 'URL para acessar a plataforma']) !!}
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