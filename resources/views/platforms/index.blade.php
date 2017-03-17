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
			<a href="#" id="btnNewPlatform" class="btn btn-block btn-flat btn-primary">
				<b>Cadastrar Nova Plataforma</b>
			</a>
		</div>
	</div>

	<hr>

	<div class="row" id="platformsWrapper">
		@foreach($platforms as $platform)
	    <div class="col-md-4" id="platform-{{$platform->id}}">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">{{ $platform->name }}</h3>
            <div class="pull-right">
            	<a href="{{ route('platform.edit', [$platform->id]) }}"><i class="fa fa-edit fa-fw" style="font-size:1.3em;"></i></a>
            </div>
          </div>

<<<<<<< HEAD
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
              <a href="{{---route('products.bycategory', [$product->category->name])--}}"><span class="label label-info pull-left" style="font-size: 0.8em;"><b>/{{ $platform->url }}</b></span></a>
              <div class="pull-right">
              	<a href="{{ route('platform.destroy', [$platform->id]) }}"><i class="fa fa-trash fa-fw" style="font-size:1.3em;"></i></a>
          		</div>
            </div>
=======
          <div class="box-body no-padding" style="
                        background-image: url({{-- route('images', [$product->photos->first()->path, 170]) --}});
                        background-size: cover;
                        background-repeat: no-repeat;
                        background-position: 50% 50%;
                        min-height: 120px;
            ">
>>>>>>> master
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
<<<<<<< HEAD
	    @endforeach
	</div>
=======
    @endforeach
	</div>		
>>>>>>> master
</div>

<div id="newPlatformModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Nova Plataforma</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                  <div id="errorNameWrapper" class="form-group @if($errors->has('name')) has-error @endif">
                    <label for="platformName">Nome</label>
                    {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'platformName', 'placeholder' => 'Nome da plataforma']) !!}
                    <span id="errorNameMessage">@if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif</span>
                  </div>
                  <div id="errorUrlWrapper" class="form-group @if ($errors->has('url')) has-error @endif">
                    <label for="platformUrl">URL</label>
                    {!! Form::text('url', null, ['class' => 'form-control', 'id' => 'platformUrl', 'placeholder' => 'URL para acessar a plataforma']) !!}
                    <span id="errorUrlMessage">@if ($errors->has('url')) <p class="help-block">{{ $errors->first('url') }}</p> @endif</span>
                  </div>
                </div>
            </div>
            <div class="modal-footer">
              <div class="pull-right">
                <a href="#" class="btn btn-danger btn-flat" onclick="hideModal()"><i class="fa fa-undo"></i> Voltar</a>&nbsp;&nbsp;&nbsp;
                <a href="#" id="saveNewPlatform" class="btn btn-primary btn-flat" onclick="savePlatform()"><i class="fa fa-save"></i> Salvar</a>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('inline_scripts')
<script type="text/javascript">
  // Open Confirmation Message
	$(document).on('click', '.btnDeletePlatform', function(event) {
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

  // Open New Platform Modal
  $('#btnNewPlatform').on('click', function(event) {
    event.preventDefault();
    
    cleanModalInputs();
    $('#newPlatformModal').modal();
  });

  // Clean inputs
  function cleanModalInputs() {
    $('#platformUrl').val('');
    $('#errorUrlMessage').empty();
    $('#errorUrlWrapper').removeClass('has-error');

    $('#platformName').val('');
    $('#errorNameMessage').empty();
    $('#errorNameWrapper').removeClass('has-error');
  }

  // Save Platform
  function savePlatform() {
    var name      = $('#platformName').val();
    var urlString = $('#platformUrl').val();

    $.ajax({
      headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
      method: 'POST',
      url: '/plataformas/salvar',
      data: {
        name: name,
        url: urlString
      },
      dataType: 'json',
      success: function(data) {
        var platform = data.platform;
        $('#newPlatformModal').modal('hide');
        flashNotification('Plataforma cadastrada.' ,'success');

        var contentToAppend = generatePlatformPanel(platform);
        $('#platformsWrapper').append(contentToAppend);
      },
      error: function(data) {
        var errors = data.responseJSON;

        $('#errorUrlMessage').empty();
        if(errors.url) {
          var contentToAppend = `<p class="help-block">${errors.url}</p>`;
          $('#errorUrlMessage').append(contentToAppend);
          $('#errorUrlWrapper').addClass('has-error');
        }
        else {
          $('#errorUrlWrapper').removeClass('has-error');
        }
        
        $('#errorNameMessage').empty();
        if(errors.name) {
          var contentToAppend = `<p class="help-block">${errors.name}</p>`;
          $('#errorNameMessage').append(contentToAppend);
          $('#errorNameWrapper').addClass('has-error');
        }
        else {
          $('#errorNameWrapper').removeClass('has-error');
        }
      }
    });
  }

  // Delete Platform
	function deletePlatform(platform_id) {
    $.ajax({
      headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
      method: 'DELETE',
      url: '/plataformas/' + platform_id + '/apagar',
      dataType: 'json',
      success: function(data) {
        $('#platform-'+data.platformId).remove();
        flashNotification('Plataforma foi excluída.' ,'success');
      },
      error: function(data) {
        flashNotification('Plataforma não foi excluída.' ,'error');
      }
    });
	}

  // Generate HTML for Platform Panel
  function generatePlatformPanel(platform) {
    return `
      <div class="col-md-4" id="platform-${platform.id}">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">${platform.name}</h3>
            <div class="pull-right">
              <a href="/plataformas/${platform.id}/editar"><i class="fa fa-edit fa-fw" style="font-size:1.3em;"></i></a>
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
                <b>/${platform.url}</b>
              </span>
            </a>

            <div class="pull-right">
              <a href="#" class="btnDeletePlatform" data-id="${platform.id}">
                <i class="fa fa-trash fa-fw" style="font-size:1.3em;"></i>
              </a>
            </div>  
          </div>
        </div>
        <!-- /.box -->
      </div>
    `;
  }
</script>
@endsection