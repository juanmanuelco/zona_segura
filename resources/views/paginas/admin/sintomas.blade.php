@extends('layouts.app')

@section('content')

<div class="container">
	<h1>Registro de sintomatologías</h1>
	<br>
	@include('includes.central_mensajes')
	<br>
	<div class="row">
		<div class="col-6">
			<form method="POST" action="{{route('registrar_sistema_post')}}">
				{{ csrf_field() }} 
				<div class="form-group">
					<label for="exampleInputEmail1">Nombre del síntoma</label>
					<input class="form-control" required name="nombre">
					<small id="emailHelp" class="form-text text-muted">Nombre con el que será registrado</small>
				</div>

				<div class="form-group">
					<label for="exampleInputEmail1">Gravedad del síntoma</label>
					<input type="range" required class="form-control" id="" name="gravedad" min="0" max="5">
					<small id="Nivelhelp" class="form-text text-muted">La gravedad servirá para estimar el promedio
						nivel</small>
				</div>

				<button type="submit" class="btn btn-primary">Registrar</button>
			</form>
		</div>
		<div class="col-6">
			<table class="table">
				<thead class="thead-dark">
					<tr>
						<th scope="col" style="width:10%">#</th>
						<th scope="col" style="width:60%">Síntoma</th>
						<th scope="col" style="width:10%">Gravedad</th>
						<th scope="col" style="width:20%">Opciones</th>
					</tr>
				</thead>
				<div style="display:none">{{ $count = 1 }}</div>
				<tbody>	
					@foreach ($sintomas as $sintoma)
						<tr>
							<td>{{$count++}}</td>
							<td>
								{{$sintoma->nombre_sintoma}}
							</td>
							<td>
								{{$sintoma->gravedad}} / 5
							</td>
							<td>
								<button  class="btn btn-info" >
									<i class="zmdi zmdi-edit"></i>
								</button>

								<button class="btn btn-danger" >
									<i class="zmdi zmdi-delete"></i>
								</button>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

@endsection