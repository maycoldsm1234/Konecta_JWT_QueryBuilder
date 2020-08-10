@extends('layout')

@section('content')
	<div class="row">
		<button id="btn-clientenuevo" type="button" class="btn btn-primary btn--raised" data-toggle="modal" data-target="#modal-cliente">Nuevo cliente</button>
	</div>
    <div class="table-responsive">
    	<table id="tabla-clientes" class="table table-bordered">
        	<thead class="thead-default">
            	<tr align="center">
					<th>Documento</th>
                	<th>Cliente</th>
                    <th>Correo</th>
                    <th>Direccion</th>
                    <th>Telefonos</th>
                    <th>Opciones</th>
                </tr>
           	</thead>
            <tfoot>
				<tr align="center">
					<th>Documento</th>
                	<th>Cliente</th>
                    <th>Correo</th>
                    <th>Direccion</th>
                    <th>Telefonos</th>
                    <th>Opciones</th>
                </tr>
			</tfoot>
			<tbody>
				@foreach ($clients as $client)
					<tr>
						<td align="center">{{ $client->doc }}</td>
						<td align="center">{{ $client->name }}</td>
						<td>{{ $client->email }}</td>
						<td align="center">{{ $client->dir }}</td>
						<td align="center">{{ $client->tel }}</td>
						<td align="center">
							<div class="btn-group btn-group-sm mr-1">
								<button type="button" class="btn btn-warning btn-clienteeditar" data-toggle="modal" data-target="#modal-cliente" data-user='{{ json_encode($client) }}'>
									<i class="zmdi zmdi-edit zmdi-hc-fw"></i>
								</button>
								<button type="button" class="btn btn-danger btn-clienteeliminar" data-id_client="{{ $client->id }}"><i class="zmdi zmdi-delete zmdi-hc-fw"></i></button>
							</div>
						</td>
					</tr>
				@endforeach
			</tbody>
        </table>
   	</div>

	<div class="modal fade" id="modal-cliente" tabindex="-1">
    	<div class="modal-dialog">
        	<div class="modal-content">
            	<div class="modal-header">
                	<h5 class="modal-title pull-left">Crear cliente</h5>
                </div>
                <div class="modal-body">
					<form id="FormCliente">
						@csrf
						<input id="Accion_cliente" type="hidden" value="nuevo" >
						<input type="hidden" id="id_cliente" name="id_cliente"  value="" >
						<div class="row">
                        	<label class="col-sm-4 col-form-label" style="text-align:right">Documento</label>
                            <div class="col-sm-6">
                            	<div class="form-group">
                                	<input type="text" id="doc" name="doc" class="form-control" placeholder="Documento" required>
                                    <i class="form-group__bar"></i>
                                </div>
                            </div>
                       	</div>
                    	<div class="row">
                        	<label class="col-sm-4 col-form-label" style="text-align:right">Cliente</label>
                            <div class="col-sm-6">
                            	<div class="form-group">
                                	<input type="text" id="name" name="name" class="form-control" placeholder="Cliente nombre" required>
                                    <i class="form-group__bar"></i>
                                </div>
                            </div>
                       	</div>
						<div class="row">
                        	<label class="col-sm-4 col-form-label" style="text-align:right">Direccion</label>
                            <div class="col-sm-6">
                            	<div class="form-group">
                                	<input type="text" id="dir" name="dir" class="form-control" placeholder="Direccion" required>
                                    <i class="form-group__bar"></i>
                                </div>
                            </div>
                       	</div>
						<div class="row">
                        	<label class="col-sm-4 col-form-label" style="text-align:right">Telefonos</label>
                            <div class="col-sm-6">
                            	<div class="form-group">
                                	<input type="text" id="tel" name="tel" class="form-control" placeholder="Telefonos" required>
                                    <i class="form-group__bar"></i>
                                </div>
                            </div>
                       	</div>
						<div class="row">
                        	<label class="col-sm-4 col-form-label" style="text-align:right">Email</label>
                            <div class="col-sm-6">
                            	<div class="form-group">
                                	<input type="email" id="email" name="email" class="form-control" placeholder="Email Address" required>
                                    <i class="form-group__bar"></i>
                                </div>

                            </div>
                       	</div>
					</form>
                </div>
                <div class="modal-footer">
					<button id="Btn-GuardarCliente" type="button" class="btn btn-link">Guardar</button>
					<button type="button" class="btn btn-link" data-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('script')
	<script src="{{ asset('src/vendors/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('src/vendors/datatables-buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('src/vendors/datatables-buttons/buttons.print.min.js') }}"></script>
    <script src="{{ asset('src/vendors/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('src/vendors/datatables-buttons/buttons.html5.min.js') }}"></script>
	<script src="{{ asset('src/vendors/sweetalert2/sweetalert2.min.js') }}"></script>
	<script type="application/javascript">
		$(function(){
			$('#tabla-clientes').DataTable();
			
			$('#btn-clientenuevo').on('click', function(){
				$('#modal-cliente .modal-title').html('Crear cliente');
				$('#modal-cliente .password').show();
				$('#modal-cliente #username').prop('readonly', false);
				$('#Accion_cliente').val('nuevo');
			});
			
			$('.btn-clienteeditar').on('click', function(){
				var client = $(this).data('user');
				$('#modal-cliente .modal-title').html('Editar cliente');
				$('#Accion_cliente').val('editar');
				$('#doc').val(client.doc);
				$('#name').val(client.name);
				$('#id_cliente').val(client.id);
				$('#dir').val(client.dir);
				$('#email').val(client.email);
				$('#tel').val(client.tel);
			});
			
			$('.btn-clienteeliminar').click(function(){
				var id_client = $(this).data('id_client');
                swal({
                    title: 'Eliminar Cliente!',
                    text: 'Esta  seguro que desea eliminar el cliente?',
                    type: 'warning',
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonClass: 'btn btn-danger',
                    confirmButtonText: 'Si, Eliminar!',
                    cancelButtonClass: 'btn btn-secondary',
					cancelButtonText: 'No'
                }).then((result) => {
  					if (result.value) {
						$.ajax({
							url:  "{{ route('clientes/eliminar') }}",
							data : {
								id_cliente : id_client,
								"_token" : "{{ csrf_token() }}",
							},
							type: 'POST',
							dataType : 'json',
							headers: {'Authorization': 'Bearer '+localStorage.getItem("token")},
							success: function(respuesta) {
								swal({
									title: 'Cliente eliminado',
									type: 'success',
									buttonsStyling: false,
									confirmButtonClass: 'btn btn-primary'
								});
								location.reload(true);
							},
							error: function() {
							  console.log("No se ha podido obtener la información");
							}
						});
					}
                    
                });
            });
			
			$('#Btn-GuardarCliente').on('click', function(){
				if($('#Accion_cliente').val() == 'nuevo'){
					var user_url = "{{ route('clientes/registrar') }}";
				}else{
					var user_url = "{{ route('clientes/editar') }}";
				}
				$.ajax({
					url: user_url,
					data : $('form#FormCliente').serialize(),
					type: 'POST',
  					dataType : 'json',
					headers: {'Authorization': 'Bearer '+localStorage.getItem("token")},
					success: function(respuesta) {
					 	location.reload(true);
					},
					error: function() {
					  console.log("No se ha podido obtener la información");
					}
				});
			});
			
			

		});
	</script>
@endsection