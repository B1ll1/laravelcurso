@extends('layouts.master')

@section('specific_styles')
@stop

@section('header_title')

    <h2>
        Cadastrar Usuário
    </h2>

@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
          {!! Form::model(new \App\Models\User, ['route' => 'cadastrar_usuario', 'files' => true,
              'class' => 'form-horizontal', 'id' => 'user-create']) !!}
          @include('users/partials/_form')
          {!! Form::close() !!}
        </div>

    </div>
@stop

@section('specific_scripts')
  <script src="/assets/select2/js/select2.min.js"></script>
@stop


@section('inline_scripts')
   <script>
          $(".select_user_role_id").change(function(){
            console.log(this)
          });
    </script>

@stop
