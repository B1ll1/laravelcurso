@extends('layouts.master')

@section('header_title')
<section class="content-header">
	<h1>
		<i class="fa fa-buildin"></i> Editando Produto
	</h1>
	
	<ol class="breadcrumb">
		<li><a href="{{ route('platform.product.index', [$product->platform->id]) }}"><i class="fa fa-tag fa-fw"></i>Produtos</a></li>
		<li class="active">Editando Produto</li>
	</ol>
</section>
@stop

@section('content')
<div class="container-fluid">
	<hr>
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			{!! Form::model($product, ['route' => ['platform.product.update', $product->platform->id, $product->id], 'class' => '']) !!}
				@include('products.partials._form')
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection