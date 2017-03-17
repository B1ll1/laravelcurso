@extends('layouts.master')

@section('header_title')

    <h2>
       Edição de Usuário
    </h2>

@stop

@section('content')
   @if(Session::has('msg_error'))
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Erro!</strong> Já existe um usuário com este email:
            {{Session::get('msg_error')}}
        </div>
    @endif

    <div class="container-fluid">
        <hr>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                {!! Form::model($user, ['route' => ['user.update', $user], 'files' => true]) !!}
                    @include('users.partials._form')
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    {{-- Modal para alterar senha --}}
        <div id="editPassword" class="modal fade" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <strong>Alterar Senha</strong>
                    </div>
                    <div class="modal-body">
                        <div>
                            {!! Form::open(['method' => 'PATCH', 'id' => 'formEditPassword']) !!}
                                @include('users.partials._form-password')
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('inline_scripts')
<script>
    //********************************* Update Password Function ****************************************
    $('#formEditPassword').submit(function(e) {
        e.preventDefault();
        var senha = $(this).find('input[name=password]').val();
        var confirmacao_senha = $(this).find('input[name=password_confirmation]').val();
        if(senha == confirmacao_senha){
            var data = $(this).find('input[name=password]').val();

            $.ajax({
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                method: 'PATCH',
                url: '{{ route('user.update_password', $user->id) }}',
                data: {
                    data: data,
                },
                dataType: 'json'
            })
            .done(function(data) {
                if(data.status == 'success') {
                    $('#editPassword').modal('hide');
                    swal("", "Senha alterada com sucesso!", "success");
                }
            });
        }
        else{
            swal("", "A Senha e a Confirmação de Senha devem ser iguais!!", "warning");
        }

    });
    //********************************************************************************************
</script>

@endsection

@section('specific_scripts')
@endsection