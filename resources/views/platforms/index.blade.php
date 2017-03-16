@extends('layouts.master')

@section('header_title')
<section class="content-header">
	<h1>
		<i class="fa fa-buildin"></i> Plataformas
	</h1>
	
	<ol class="breadcrumb">
		<li class="active">Plataformas</li>
	</ol>
</section>
@stop

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-5 col-md-offset-3 col-xs-12">
			<a href="{{ route('platform.create') }}" class="btn btn-block btn-flat btn-primary">
				<b>Cadastrar Nova Plataforma</b>
			</a>
		</div>
	</div>

	<hr>

	<div class="row">
		@foreach($platforms as $platform)
	    <div class="col-md-4" id="platform-{{$platform->id}}">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">{{ $platform->name }}</h3>
            <div class="pull-right">
            	<a href="{{ route('platform.edit', [$platform->id]) }}"><i class="fa fa-edit fa-fw" style="font-size:1.3em;"></i></a>
            </div>
          </div>

          <div class="box-body no-padding" style="
                        background-image: url({{-- route('images', [$product->photos->first()->path, 170]) --}});
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
            		<b>/{{ $platform->url }}</b>
          		</span>
          	</a>

            <div class="pull-right">
            	<a href="#" class="btnDeletePlatform" data-id="{{$platform->id}}">
            		<i class="fa fa-trash fa-fw" style="font-size:1.3em;"></i>
        			</a>
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
	$('.btnDeletePlatform').on('click', function(event) {
		event.preventDefault();
		var platform_id = $(this).data('id');
		
		swal({
      title: 'Deseja mesmo deletar esta plataforma?',
      text: 'Essa ação não poderá ser desfeita!',
      type: "warning",
      showCancelButton: true,
      confirmButtonText: 'Sim',
      cancelButtonText: 'Não',
    }).then(function() {
        deletePlatform(platform_id);
    }, function(dismiss) {});
	});

	function deletePlatform(platform_id) {
	    $.ajax({
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        method: 'DELETE',
        url: '/plataformas/' + platform_id + '/apagar',
        dataType: 'json'
	    })
	    .done(function(data) {
	      if(data.status == 'success') {
          $('#platform-'+data.platformId).remove();
	          flashNotification('Plataforma foi excluída.' ,'success');
	      }
	      else {
	      	flashNotification('Plataforma não foi excluída.' ,'error');
	      }
	    });
	}
</script>
@endsection