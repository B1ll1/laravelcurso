<div class="box box-primary">
  <div class="box-header with-border">
    <!-- <h3 class="box-title"></h3> -->
  </div>
  <!-- /.box-header -->
  <!-- form start -->
  <form role="form">
    <div class="box-body">
      <div class="form-group @if($errors->has('name')) has-error @endif">
        <label for="productName">Nome</label>
        {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'productName', 'placeholder' => 'Nome do Produto']) !!}
        @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
      </div>

      <div class="form-group @if($errors->has('category_id')) has-error @endif">
        <label for="productCategory">Categoria</label>
        <select name="category_id" class="form-control">
          @foreach($categories as $category)
          <option value="{{$category->id}}">{{$category->name}}</option>
          @endforeach
        </select>
        @if ($errors->has('category_id')) <p class="help-block">{{ $errors->first('category_id') }}</p> @endif
      </div>

      @if(strpos(Request::url(), 'editar'))
      <div class="form-group @if($errors->has('status_id')) has-error @endif">
        <label for="productStatus">Status</label>
        <select name="status_id" class="form-control">
          @foreach($productStatus as $status)
          <option value="{{$status->id}}">{{$status->name}}</option>
          @endforeach
        </select>
        @if ($errors->has('status_id')) <p class="help-block">{{ $errors->first('status_id') }}</p> @endif
      </div>
      @endif

      <div class="form-group @if ($errors->has('price')) has-error @endif">
        <label for="platformPrice">Preço</label>
        {!! Form::text('price', null, ['class' => 'form-control', 'id' => 'platformPrice']) !!}
        @if ($errors->has('price')) <p class="help-block">{{ $errors->first('price') }}</p> @endif
      </div>

      <div class="form-group @if ($errors->has('amount_by_package')) has-error @endif">
        <label for="platformAmountByPackage">Quantidade por lote</label>
        {!! Form::number('amount_by_package', null, ['class' => 'form-control', 'id' => 'platformAmountByPackage']) !!}
        @if ($errors->has('amount_by_package')) <p class="help-block">{{ $errors->first('amount_by_package') }}</p> @endif
      </div>

      <div class="form-group @if ($errors->has('package_amount')) has-error @endif">
        <label for="platformPackageAmount">Quantidade de Lotes</label>
        {!! Form::number('package_amount', null, ['class' => 'form-control', 'id' => 'platformPackageAmount']) !!}
        @if ($errors->has('package_amount')) <p class="help-block">{{ $errors->first('package_amount') }}</p> @endif
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
        <a href="{{ route('platform.product.index', [$platformId]) }}" class="btn btn-danger btn-flat"><i class="fa fa-undo"></i> Voltar</a>&nbsp;&nbsp;&nbsp;
        <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Salvar</button>
      </div>
    </div>
  </form>
</div>
<!-- /.box -->