<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
</head>
<body>
	@include('includes.cabecera')

	<div class="" style="margin-left:2%; margin-right:2%">
		@include('includes.central_mensajes')
		<br>
		<div class="row">
			<div class="col-3">
				<h3>Registro de usuarios</h3>
				<form method="POST" action="{{route('ingreso_usuario')}}">
					{{ csrf_field() }}
					<div class="form-group">
						<input class="form-control" required placeholder="Nombre del usuario" required name="name">
					</div>
	
					<div class="form-group">
						<input class="form-control" required placeholder="E-mail" type="email" required name="email">
					</div>
	
					<div class="form-group">
						<input class="form-control" placeholder="Cédula" type="text" required name="cedula">
					</div>
	
					<div class="form-group">
						<input class="form-control" placeholder="Dirección" type="text" required name="direccion">
					</div>
	
					<div class="form-group">
						<input class="form-control" placeholder="Teléfono" type="tel" required name="telefono">
					</div>
	
					<div class="form-group">
						<select name="genero" class="form-control" id="" aria-placeholder="Género">
							<option value="Masculino">Masculino</option>
							<option value="Femenino">Femenino</option>
							<option value="Otro">Otro</option>
						</select>
					</div>
	
					<div class="form-group">
						<input class="form-control" placeholder="Estado"  type="range" name="estado" min="0" max="4" id="">
					</div>
	
					<div class="form-group">
						<input class="form-control" placeholder="Fecha de nacimiento" type="date" required
							name="nacimiento">
					</div>
	
					<div class="input-group mb-3" onclick="abrirMapa()">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">Ubicación</span>
						</div>
						<input type="text" readonly  title="Click aquí" name="latitud" id="txt_mapa_lat" class="form-control">
						<input type="text" readonly  title="Click aquí" name="longitud" id="txt_mapa_lon" class="form-control">
					</div>
	
	
					<button type="submit" class="btn btn-primary">Registrar</button>
				</form>
			</div>
			<div class="col-9">
				<table class="table table-responsive" style="max-height:450px">
					<thead class="thead-dark">
						<tr>
							<th scope="col" style="width:10%">#</th>
							<th scope="col" style="width:20%">Funciones</th>
							<th scope="col" style="width:20%">Nombre</th>
							<th scope="col" style="width:20%">Email</th>
							<th scope="col" style="width:10%">Cédula</th>
							<th scope="col" style="width:20%">Direccion</th>
							<th scope="col" style="width:20%">Teléfono</th>
							<th scope="col" style="width:20%">Género</th>
							<th scope="col" style="width:20%">Nacimiento</th>
						</tr>
					</thead>
					<div style="display:none">{{ $count = 1 }}</div>
					<tbody>
						@foreach ($usuarios as $usuario)
						<tr>
							@if ($usuario->estado == '0')
							<td>{{$count++}}</td>
							@elseif ($usuario->estado == '1')
							<td style="background-color:blue; color:#ffffff">{{$count++}}</td>
							@elseif ($usuario->estado == '2')
							<td style="background-color:green">{{$count++}}</td>
							@elseif ($usuario->estado == '3')
							<td style="background-color:yellow">{{$count++}}</td>
							@else
							<td style="background-color:red">{{$count++}}</td>
							@endif
	
							<td>
								<button class="btn btn-info" onclick="cargarModal(
									'{{$usuario->id}}', 
									'{{$usuario->name}}', 
									'{{$usuario->email}}', 
									'{{$usuario->cedula}}',  
									'{{$usuario->direccion}}', 
									'{{$usuario->telefono}}',  
									'{{$usuario->genero}}', 
									'{{$usuario->nacimiento}}' )">
									<i class="zmdi zmdi-edit"></i>
								</button>
	
								<button class="btn btn-danger" onclick="eliminarRegistro( '{{$usuario->id}}')">
									<i class="zmdi zmdi-delete"></i>
								</button>
							</td>
							<td>{{$usuario->name}}</td>
							<td>{{$usuario->email}}</td>
							<td>{{$usuario->cedula}}</td>
							<td>{{$usuario->direccion}}</td>
							<td>{{$usuario->telefono}}</td>
							<td>{{$usuario->genero}}</td>
							<td>{{$usuario->nacimiento}}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-3">
				<h3>Registro de centros de salud</h3>
				<form method="POST" action="{{route('ingreso_establecimiento')}}">
					{{ csrf_field() }}
					<div class="form-group">
						<input class="form-control" required placeholder="Nombre del establecimiento" required
							name="name_e">
					</div>
	
					<div class="form-group">
						<input class="form-control" placeholder="Dirección" type="text" required name="direccion_e">
					</div>
	
					<div class="form-group">
						<input class="form-control" placeholder="Teléfono" type="tel" required name="telefono_e">
					</div>

					<div class="input-group mb-3" onclick="abrirMapaEs()">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">Ubicación</span>
						</div>
						<input type="text" readonly  title="Click aquí" name="latitud_e" id="txt_mapa_lat_e" class="form-control">
						<input type="text" readonly  title="Click aquí" name="longitud_e" id="txt_mapa_lon_e" class="form-control">
					</div>
	
					<button type="submit" class="btn btn-primary">Registrar</button>
				</form>
			</div>
			<div class="col-9">
				<table class="table table-responsive" style="max-height:450px; width:100%">
					<thead class="thead-dark">
						<tr>
							<th scope="col" style="width:10%">#</th>
							<th scope="col" style="width: 30%;">Funciones</th>
							<th scope="col" style="width:60%">Nombre</th>
							<th scope="col" style="width:20%">Direccion</th>
							<th scope="col" style="width:20%">Teléfono</th>
						</tr>
					</thead>
					<div style="display:none">{{ $counter = 1 }}</div>
					<tbody>
						@foreach ($establecimientos as $establecimiento)
						<tr>
							<td>{{$counter++}}</td>
							<td>
								<button class="btn btn-info" >
									<i class="zmdi zmdi-edit"></i>
								</button>
	
								<button class="btn btn-danger" >
									<i class="zmdi zmdi-delete"></i>
								</button>
							</td>
							<td>{{$establecimiento->nombre}}</td>
							<td>{{$establecimiento->direccion}}</td>
							<td>{{$establecimiento->telefono}}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>










	<div id="modal_obtener_ubicacion" class="modal">
		<div class="modal-content contenedor-bordes blanco">
			<div class="modal-header">
				<h3 class="modal-title">Escoger ubicación</h3>
				<button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div style="height: 500px; width: 100%; padding: 12;">
				<div id="map"></div>
			</div>
			<div style="text-align:right; padding:12px">
				<button class="btn nwarning" style="max-width:100px" onclick="hideModal()">Aceptar</button>
			</div>
		</div>
	</div>
	<style>
		#map {
			height: 100%;
		}
		html, body {
			height: 100%;
			margin: 0;
			padding: 0;
		}
	</style>

	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBRn8bzxtBtX-Nxqf2582BqyFchxX1k70M"></script>
	<script>
		var map;
		var markers = [];
		var tipo_modal =1;
		function hideModal() {
			document.getElementById('modal_obtener_ubicacion').style.display = "none";
		}
		function abrirMapa(){
			abrirModal('modal_obtener_ubicacion')
		}
		function abrirMapaEs(){
			tipo_modal =2;
			abrirModal('modal_obtener_ubicacion')
		}


		function abrirModal(modal){
			var modal = document.getElementById(modal);
			modal.style.display = "block";
			var cerrar = modal.getElementsByClassName('close')[0]
			cerrar.onclick = ()=>{ 
				modal.style.display = "none";
			}
			window.onclick = (event)=> {
				if (event.target == modal) 	modal.style.display = "none";		
			}
		}
	
		navigator.geolocation.getCurrentPosition(function (position) {
			var latitud_cabecera = null;
			var longitud_cabecera = null;

            lat = (latitud_cabecera == null || latitud_cabecera== undefined)? position.coords.latitude : latitud_cabecera
            lang = (longitud_cabecera == null || longitud_cabecera== undefined)? position.coords.longitude : longitud_cabecera
            map = new google.maps.Map(document.getElementById('map'), {
                center: { lat: lat, lng: lang },
                zoom: 17,
            });
            addMarker(new google.maps.LatLng(lat, lang))
            map.addListener('click', function (event) {
                addMarker(event.latLng);
            });


            // Adds a marker to the map and push to the array.
            function addMarker(location) {
                setMapOnAll(null)
                var marker = new google.maps.Marker({
                    position: location,
                    map: map
				});
				if(tipo_modal == 1){
					document.getElementById('txt_mapa_lat').value = location.lat()
					document.getElementById('txt_mapa_lon').value = location.lng()
				}
				if(tipo_modal == 2){
					document.getElementById('txt_mapa_lat_e').value = location.lat()
					document.getElementById('txt_mapa_lon_e').value = location.lng()
				}
				

                markers.push(marker);
            }

            // Sets the map on all markers in the array.
            function setMapOnAll(map) {
                for (var i = 0; i < markers.length; i++) {
                    markers[i].setMap(map);
                }
            }
        })
	</script>
	<div style="height: 200px;">

	</div>
</body>
</html>
