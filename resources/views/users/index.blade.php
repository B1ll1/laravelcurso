@extends('layouts.master')

@section('specific_styles')
    <link rel="stylesheet" href="/assets/css/jquery-ui-1.10.3.full.min.css" />
@stop

@section('header_title')
    <div class="col-md-5 col-xs-4">
        <div style="clear:both">
            <b class="page-title"><i class="fa fa-users"></i> Usuário</b>
            @if(Auth::user()->hasRole(['siga', 'prefeitura']))
                <div class="align-right">
                    <a href="{{route('criar_usuario')}}" class="btn btn-sm btn-success">
                        <i class="fa fa-plus"></i>
                        Adicionar Usuário
                    </a>
                </div>
            @endif
        </div>
    </div>
@stop

@section('breadcrumb_links')
    <a href="{{url('/')}}"><i class="fa fa-home"></i> Inicio</a>
    <span class="divider">/</span>
    <a href="#" class="bread-current">Usuarios</a>
@stop


@section('content')
    @foreach ($users as $user)
            <div class="col-md-3 item-list" id="user-{{$user->id}}">
                <div class="widget">
                    <div class="widget-head">
                        <div class="pull-left"><a href="#">{{ $user->name }}</a></div>
                        <div class="widget-icons pull-right">
                                <a href="{{route('editar_usuario',[$user->id])}}">
                                    <i class="fa fa-edit"></i>
                                </a>
                                @if(Auth::user()->hasRole(['siga', 'prefeitura']))
                                <a href="#" class="delete-user" data-user-id="{{$user->id}}" data-token="{{ csrf_token() }}">
                                    <i class="fa fa-remove"></i>
                                </a>
                                @endif
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="widget-content">
                        <a href="#"><div class="item-img cover" style="background-image: url('{{route('images', [$user->photo, 150])}}') ; min-height: 200px"></div></a>
                        <div class="widget-foot">
                            <!-- Footer goes here -->
                        </div>
                    </div>
                </div>
            </div>
    @endforeach
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
