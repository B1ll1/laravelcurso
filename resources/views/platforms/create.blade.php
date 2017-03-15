@extends('layouts.master')

@section('header_title')
<section class="content-header">
	<h1>
		<i class="fa fa-buildin"></i> Nova Plataforma
	</h1>
	
	<ol class="breadcrumb">
		<li><a href="{{ route('platform.index') }}">Plataformas</a></li>
		<li class="active">Nova Plataforma</li>
	</ol>
</section>
@stop

@section('content')
<div class="container-fluid">
	<hr>
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			{!! Form::model(new App\Models\Platform, ['route' => ['platform.store'], 'class' => '']) !!}
				@include('platforms.partials._form')
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection