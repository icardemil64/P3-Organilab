@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Crear préstamo: <strong> {{$laboratorio->nombre}} </strong></span>
                    <a href="{{route('detalle_laboratorio_reserva',[$laboratorio->slug,$laboratorio->id])}}" class="btn btn-secondary btn-sm">Volver</a>
                </div>
                <div class="card-body">     
                  @if ( session('mensaje') )
                    <div class="alert alert-success">{{ session('mensaje') }}</div>
                  @endif
                  @if ( session('error') )
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                  <form method="POST" action="{{route('guardar_reserva_laboratorio')}}" autocomplete="off">
                        @csrf
                        <input
                            type="text"
                            name="run"
                            placeholder="RUN"
                            class="form-control mb-2"
                            required autocomplete
                        />
                        <input
                            type="text"
                            name="nombre"
                            placeholder="Nombre"
                            class="form-control mb-2"
                            required autocomplete
                        />
                        <input
                            type="text"
                            name="apellido"
                            placeholder="Apellido"
                            class="form-control mb-2"
                            required autocomplete
                        />
                        <input
                            type="hidden"
                            name="laboratorio_id"
                            placeholder="laboratorio"
                            class="form-control mb-2"
                            value="{{$laboratorio->id}}"
                            required autocomplete
                        />

                        <select class="form-control my-2" name="horario">
                            @foreach ($horarios as $horario)
                            <option value="{{$horario->id}}">[BLOQUE: {{$horario->id}}] {{$horario->hora_inicio}}-{{$horario->hora_fin}}</option>
                            @endforeach
                        </select>
                        @if ($dias != [])
                            <select class="form-control my-2" name="fechas_disponibles">
                                @foreach ($dias as $dia)
                                    <option value="{{$dia}}">{{$dia}}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-primary btn-block mt-sm-2" type="submit">Agregar</button>
                        @else
                            <button class="btn btn-danger btn-block mt-sm-2" type="submit" disabled>No se puede reservar el laboratorio.</button>                            
                        @endif

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection