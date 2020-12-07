@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Crear préstamo para el laboratorio <strong>{{$laboratorio->nombre}}</strong>.</span>
                    <a href="{{route('detalle_laboratorio_prestamo',[$laboratorio->slug,$laboratorio->id])}}" class="btn btn-secondary btn-sm">Volver</a>
                </div>
                <div class="card-body">     
                  @if ( session('mensaje') )
                    <div class="alert alert-success">{{ session('mensaje') }}</div>
                  @endif
                  <form method="POST" action="{{route('guardar_prestamo_laboratorio')}}" autocomplete="off">
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
                        <button class="btn btn-primary btn-block mt-sm-2" type="submit">Agregar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection