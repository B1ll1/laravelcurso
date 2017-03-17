@extends('layouts.master')

@section('specific_styles')
@stop

@section('header_title')

    <h2>
        Cadastrar Usuário
    </h2>

@stop

@section('content')
<div class="container-fluid">
  <hr>
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      {!! Form::model(new \App\Models\User, ['route' => 'user.store', 'files' => true, 'id' => 'user-create', 'method' => 'POST']) !!}
      @include('users/partials/_form')
     {!! Form::close() !!}
    </div>
  </div>
</div>
@stop

@section('specific_scripts')
@stop


@section('inline_scripts')
    <script>
         $( document ).ready(function() {
            $('#role_select').empty();

            let options_default = '<option value="" disabled="disabled" selected>Selecione um Tipo de Usuário</option>'
            $.ajax({
                    url: "/usuarios/ajaxroles",
                    dataType: 'json',
                    delay: 250,
                    method:'get',
                    success: function (data){
                        $('#role_select').append(options_default);
                        let option_ajax = data.map( (obj) => {
                                $('#role_select').append('<option value="' + obj.id + '">' + obj.name + '</option>')
                        })
                        // var roles_data = $.map(data, function (obj) {
                        //     obj.text = obj.text || obj.name; // replace name with the property used for the text
                        //     return obj;
                        // });
                    }
            });

            $('#role_select').change(function(){
                let role_id = $('#role_select').val()
                if(role_id != 1){
                    $('#select_platform').show()
                    $('#platform_select').empty()
                    $.ajax({
                        url: "/plataformas/ajaxplataformas",
                        dataType: 'json',
                        delay: 250,
                        data: {role_id: role_id},
                        method:'get',
                        success: function (data){
                            $('#platform_select').empty();
                             let platform_ajax = data.map( (obj,key) => {
                                if(key==0)
                                    $('#platform_select').append('<option value="' + obj.id + '" selected>' + obj.name + '</option>')
                                else
                                    $('#platform_select').append('<option value="' + obj.id + '">' + obj.name + '</option>')
                            })
                        }
                    });
                }
                else{
                    $('#select_platform').hide()
                    $('#platform_select').empty()
                }

            })

        });

    </script>
@stop
