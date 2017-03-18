@extends('layouts.master')

@section('header_title')
<section class="content-header">
	<h1>
		<i class="fa fa-tag fa-fw"></i> Produtos
	</h1>
	
	<ol class="breadcrumb">
		<li class="active">Produtos</li>
	</ol>
</section>
@stop

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-5 col-md-offset-3 col-xs-12">
			<a href="{{ route('platform.product.create', [$platformId]) }}" class="btn btn-block btn-flat btn-primary">
				<b>Cadastrar Novo Produtos</b>
			</a>
		</div>
	</div>

	<hr>

	<div class="row">
  @foreach($products as $product)
    <div class="col-md-4" id="product-{{$product->id}}">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{ $product->name }}</h3>
          <div class="pull-right">
            <a href="{{ route('platform.product.edit', [$platformId, $product->id]) }}"><i class="fa fa-edit fa-fw" style="font-size:1.3em;"></i></a>
            <a href="#" class="btnDeleteproduct" data-id="{{$product->id}}">
              <i class="fa fa-trash fa-fw" style="font-size:1.3em;"></i>
            </a>
          </div>
        </div>

        <div class="box-body no-padding" style="
                      background-image: url({{ $product->photo != NULL ? route('images', [$product->photo, 170]) : '/product_default.jpg'}});
                      background-size: cover;
                      background-repeat: no-repeat;
                      background-position: 50% 50%;
                      min-height: 120px;
          ">
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <a href="{{---route('products.bycategory', [$product->category->name])--}}">
            <span class="label label-info pull-left" style="font-size: 0.8em;">
              <b>{{ $product->category->name }}</b>
            </span>
          </a>

          <div class="pull-right" style="font-size: 1.2em;">
            <span>R$ {{number_format($product->price, 2, ',', '.')}}</span>
          </div>  
        </div>
      </div>
      <!-- /.box -->
    </div>
  @endforeach
	</div>		
</div>
@endsection

@section('inline_scripts')
<script type="text/javascript">
	$('.btnDeleteproduct').on('click', function(event) {
		event.preventDefault();
		var product_id = $(this).data('id');
		
		swal({
      title: 'Deseja mesmo deletar esta categoria?',
      text: 'Essa ação não poderá ser desfeita!',
      type: "warning",
      showCancelButton: true,
      confirmButtonText: 'Sim',
      cancelButtonText: 'Não',
    }).then(function() {
        deleteproduct(product_id);
    }, function(dismiss) {});
	});

	function deleteproduct(product_id) {
	    $.ajax({
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        method: 'DELETE',
        url: '/categorias/' + product_id + '/apagar',
        dataType: 'json'
	    })
	    .done(function(data) {
	      if(data.status == 'success') {
          $('#product-'+data.productId).remove();
	          flashNotification('Categoria foi excluída.' ,'success');
	      }
	      else {
	      	flashNotification('Categoria não foi excluída.' ,'error');
	      }
	    });
	}
</script>
@endsection