@extends('layouts.master')

@section('header_title')
<section class="content-header">
	<h1>
		<i class="fa fa-tag fa-fw"></i> Categorias
	</h1>
	
	<ol class="breadcrumb">
		<li class="active">Categorias</li>
	</ol>
</section>
@stop

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-5 col-md-offset-3 col-xs-12">
			<a href="{{ route('category.create') }}" class="btn btn-block btn-flat btn-primary">
				<b>Cadastrar Nova Categoria</b>
			</a>
		</div>
	</div>

	<hr>

	<div class="row">
		<div class="col-md-12">
      <table class="table table-striped table-hover">
        <thead>
        <tr>
          <th>Nome</th>
          <th>Descrição</th>
          <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
        <tr id="category-{{$category->id}}">
          <td>{{$category->name}}</td>
          <td>{{$category->description}}</td>
          <td class="text-center">
            <a href="{{ route('category.edit', [$category->id]) }}" class="btn btn-primary btn-flat">
              <i class="fa fa-edit fa-fw"></i>
            </a>
            <a href="#" class="btn btn-danger btn-flat btnDeleteCategory" data-id="{{$category->id}}">
              <i class="fa fa-trash fa-fw"></i>
            </a>
          </td>
        </tr>
        @endforeach
        </tbody>
      </table>
    </div>
	</div>		
</div>
@endsection

@section('inline_scripts')
<script type="text/javascript">
	$('.btnDeleteCategory').on('click', function(event) {
		event.preventDefault();
		var category_id = $(this).data('id');
		
		swal({
      title: 'Deseja mesmo deletar esta categoria?',
      text: 'Essa ação não poderá ser desfeita!',
      type: "warning",
      showCancelButton: true,
      confirmButtonText: 'Sim',
      cancelButtonText: 'Não',
    }).then(function() {
        deleteCategory(category_id);
    }, function(dismiss) {});
	});

	function deleteCategory(category_id) {
	    $.ajax({
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        method: 'DELETE',
        url: '/categorias/' + category_id + '/apagar',
        dataType: 'json'
	    })
	    .done(function(data) {
	      if(data.status == 'success') {
          $('#category-'+data.categoryId).remove();
	          flashNotification('Categoria foi excluída.' ,'success');
	      }
	      else {
	      	flashNotification('Categoria não foi excluída.' ,'error');
	      }
	    });
	}
</script>
@endsection