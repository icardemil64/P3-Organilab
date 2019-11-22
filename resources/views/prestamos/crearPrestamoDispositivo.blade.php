@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Crear préstamo</span>
                    <a href="{{route('detalle_dispositivo_prestamo',[$dispositivo->slug,$dispositivo->id])}}" class="btn btn-secondary btn-sm">Volver</a>
                </div>
                <div class="card-body">     
                  @if ( session('mensaje') )
                    <div class="alert alert-success">{{ session('mensaje') }}</div>
                  @endif
                  <form method="POST" action="{{route('guardar_prestamo_dispositivo')}}" autocomplete="off">
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
                            type="text"
                            name="dispositivo_nombre"
                            placeholder="dispositivo"
                            class="form-control mb-2"
                            value="{{$dispositivo->nombre}}"
                            disabled
                        />
                        <input
                            type="hidden"
                            name="dispositivo_id"
                            placeholder="dispositivo"
                            class="form-control mb-2"
                            value="{{$dispositivo->id}}"
                            required autocomplete
                        />
                        @if ($laboratorios != null)
                            <select class="form-control" name="laboratorio">
                                @foreach ($laboratorios as $laboratorio)
                                    <option value="{{$laboratorio->id}}">{{$laboratorio->nombre}}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-primary btn-block mt-sm-2" type="submit">Agregar</button>
                        @else
                              <input 
                                type="text"
                                class="form-control mb-2"
                                value="No hay laboratorios registrados en el sistema."
                                disabled
                                />
                            <button class="btn btn-danger btn-block mt-sm-2" type="submit" disabled>No se puede enviar préstamo</button>
                        @endif                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection