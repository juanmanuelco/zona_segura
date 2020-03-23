@extends('layouts.app')

@section('content')


    <div class="container">
        @include('includes.central_mensajes')
        @foreach ($preguntas as $pregunta)
           <form action="/responder/{{$pregunta->id}}" method="post" id="form_{{$pregunta->id}}">
            {{ csrf_field() }} 
                <div class="card" style="margin-bottom:12px">
                    <div class="card-header">
                        Pregunta  del {{$pregunta->fecha_registro}}
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><b>{{$pregunta->pregunta}}</b></h5>
                        <p class="card-text">{{$pregunta->respuesta}}</p>

                        <input type="text" class="form-control" name="respuesta{{$pregunta->id}}">

                        <br>


                        <button type="submit" class="btn btn-primary" form="form_{{$pregunta->id}}">Responder</button>

                    </div>
                </div>
           </form>
        @endforeach
    </div>
@endsection