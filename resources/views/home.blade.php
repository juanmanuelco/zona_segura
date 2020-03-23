@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <div class="list-group">
                        <a href="{{route('registrar_sintomas')}}" class="list-group-item list-group-item-action">Registro de síntomas</a>
                        <a href="{{route('registrar_dato_mapa')}}" class="list-group-item list-group-item-action">Registrar dato en mapa</a>
                        <a href="{{route('noticias')}}" class="list-group-item list-group-item-action">Noticias</a>
                        <a href="{{route('preguntas')}}" class="list-group-item list-group-item-action">Preguntas</a>
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
