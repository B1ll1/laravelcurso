@extends('layouts.master')

@section('specific_styles')
@stop

@section('header_title')
    <section class="content-header">
    <h1>
        <i class="fa fa-buildin"></i> Usuários
    </h1>

    <ol class="breadcrumb">
        <li class="active">Usuários</li>
    </ol>
</section>
@stop

@section('breadcrumb_links')
    <a href="{{url('/')}}"><i class="fa fa-home"></i> Inicio</a>
    <span class="divider">/</span>
    <a href="#" class="bread-current">Usuarios</a>
@stop


@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-5 col-md-offset-3 col-xs-12">
            <a href="{{ route('user.create') }}" class="btn btn-block btn-flat btn-primary">
                <b>Cadastrar Novo Usuário</b>
            </a>
        </div>
    </div>

    <hr>

    <div class="row">
        @foreach($users as $user)
        <div class="col-md-4">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">{{ $user->name }}</h3>
            </div>

            <div class="box-body no-padding" style="
                            background-image: url('{{route('images', [$user->photo, 150])}}');
                            background-size: cover;
                            background-repeat: no-repeat;
                            background-position: 50% 50%;
                            min-height: 120px;
                ">
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <div class="pull-right">
                <a href="#" class="delete-user" data-user-id="{{$user->id}}" data-token="{{ csrf_token() }}"><i class="fa fa-trash fa-fw" style="font-size:1.3em;"></i></a>
                </div>
            </div>
          </div>
          <!-- /.box -->
        </div>
        @endforeach
    </div>
</div>
@stop



@section('inline_scripts')
    <script>
        $('.delete-user').click(function() {
            var user_id = $(this).attr("data-user-id");
            var token = $(this).attr("data-token");
            deleteUser(user_id, token);
        });

        function deleteUser(user_id, token) {
            swal({
                title: "Deseja mesmo deletar este usuário?",
                text: "Não será possível reverter essa operação.",
                type: "warning",
                showCancelButton: true,
                cancelButtonText: "Cancelar",
                closeOnConfirm: false,
                confirmButtonText: "Sim, deletar!",
                confirmButtonColor: "#DD6B55"
            }, function() {
                $.ajax({
                            headers: { 'X-CSRF-TOKEN': $('.delete-user').attr("data-token") },
                            url: "/siga/usuario/" + user_id + "/deletar",
                            type: "post",
                            data: [user_id, token]
                        })
                        .done(function() {
                            swal({
                                title: "Deletado!",
                                text: "O usuário foi deletado com sucesso.",
                                type: "success",
                                confirmButtonText: "Ok"
                            }, function() {
                                setTimeout(function() { location.reload(1);}, 500);
                            });
                        }).error(function() {
                    swal({
                        title: "Erro",
                        text: "O usuário não pode ser deletado.",
                        type: "error",
                        confirmButtonText: "Ok"
                    }, function() {
                        location.reload();
                    });
                });
            });
        }

    </script>
@stop

@section('specific_scripts')

@stop
