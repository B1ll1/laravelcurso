@extends('layouts.master')

@section('header_title')
<section class="content-header">
	<h1>
		<i class="fa fa-buildin"></i> Editando Categoria
	</h1>
	
	<ol class="breadcrumb">
		<li><a href="{{ route('category.index') }}"><i class="fa fa-tag fa-fw"></i>Categorias</a></li>
		<li class="active">Editando Categoria</li>
	</ol>
</section>
@stop

@section('content')
<div class="container-fluid">
	<hr>
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			{!! Form::model($category, ['route' => ['category.update', $category->id], 'class' => '']) !!}
				@include('categories.partials._form')
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection