@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Modificar laboratorio</span>
                    <span>
                        <a href="{{route('editar_laboratorios',$laboratorio->slug)}}" class="btn btn-primary btn-sm">Restaurar</a>                        
                        <a href="{{route('detalle_laboratorio',$laboratorio->slug)}}" class="btn btn-secondary btn-sm">Volver</a>
                    </span>
                </div>
                <div class="card-body">     
                  @if ( session('mensaje') )
                    <div class="alert alert-success">{{ session('mensaje') }}</div>
                  @endif
                  @if ( session('error') )
                    <div class="alert alert-danger">{{ session('error') }}</div>
                  @endif
                    <form method="POST" action="{{route('actualizar_laboratorio',$laboratorio->slug)}}" autocomplete="off">
                    @method('PUT')
                    @csrf
                    <input
                        type="text"
                        name="nombre"
                        value="{{$laboratorio->nombre}}"
                        class="form-control mb-2"
                        required autocomplete="nombre"
                        placeholder="Antiguo valor: { {{$laboratorio->nombre}} }" 
                    />
                    <input
                        type="text"
                        name="descripcion"
                        value="{{$laboratorio->descripcion}}"                      
                        class="form-control mb-2"
                        required autocomplete="descripcion"
                        placeholder="Antiguo valor: { {{$laboratorio->descripcion}} }"                         
                    />
                    <input
                        type="text"
                        name="sede"
                        value="{{$laboratorio->sede}}"                      
                        class="form-control mb-2"
                        required autocomplete="sede"
                        placeholder="Antiguo valor: { {{$laboratorio->sede}} }"                         
                    />
                    <input
                        type="text"
                        name="edificio"
                        value="{{$laboratorio->edificio}}"                      
                        class="form-control mb-2"
                        required autocomplete="edificio"
                        placeholder="Antiguo valor: { {{$laboratorio->edificio}} }"                         
                    />
                    <button class="btn btn-primary btn-block" type="submit">Modificar</button>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection