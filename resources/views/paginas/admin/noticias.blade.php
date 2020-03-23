@extends('layouts.app')

@section('content')

<div class="container">
	<h1>Publicación de noticias</h1>

	

	<div class="row">
		<div class="col-4">
            @include('includes.central_mensajes')
			<form method="POST" action="{{route('guardarNoticia')}}">
				{{ csrf_field() }} 
				<div class="form-group">
					<label for="exampleInputEmail1">Título de la noticia</label>
					<input class="form-control" required name="titulo">
                </div>

                <div class="form-group">
					<label for="exampleInputEmail1">Detalle de la noticia</label>
					<textarea class="form-control" maxlength="1000" required name="detalle"></textarea>
                </div>
                
                <div class="form-group">
					<label for="exampleInputEmail1">Link de referencia</label>
					<input class="form-control" type="url"  name="link">
                </div>
                <div class="form-group">
					<label for="exampleInputEmail1">Nivel (Informativo, Advertencia, Urgente)</label>
					<input class="form-control" type="range"  name="urgencia" min="0" max="2">
                </div>

				<button type="submit" class="btn btn-primary">Registrar</button>
			</form>
		</div>
		<div class="col-8">
            <div style="display:none">{{ $count = 1 }}</div>
            @foreach ($noticias as $noticia)
            <div class="card" style="margin-bottom:12px">
                <div class="card-header">
                Noticia  del {{$noticia->fecha_registro}}
                </div>
                <div class="card-body">
                <h5 class="card-title">{{$noticia->titulo}}</h5>
                <p class="card-text">{{$noticia->descripcion}}</p>


                @if ($noticia->estado == '0')
                    <a href="{{$noticia->referencia}}" target="_blank" class="btn btn-primary">Link de referencia</a>
                @elseif ($noticia->estado == '1')
                    <a href="{{$noticia->referencia}}" target="_blank" class="btn btn-warning">Link de referencia</a>
                @else
                    <a href="{{$noticia->referencia}}" target="_blank" class="btn btn-danger">Link de referencia</a>
                @endif
                            

               
                </div>
            </div>
            @endforeach

            
		</div>
	</div>
</div>

@endsection