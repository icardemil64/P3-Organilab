@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Editar Dispositivo</span>
                    <span>
                        <a href="{{route('editar_dispositivos',$dispositivo->slug)}}" class="btn btn-primary btn-sm">Restaurar</a>                        
                        <a href="{{route('inicio_dispositivos')}}" class="btn btn-secondary btn-sm">Volver</a>
                    </span>
                </div>
                <div class="card-body">
                    @if ( session('mensaje') )
                    <div class="alert alert-success">{{ session('mensaje') }}</div>
                    @endif
                    @if ( session('error') )
                    <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    <form method="POST" action="{{route('actualizar_dispositivos',$dispositivo->slug)}}" autocomplete="off">
                        @method('PUT')
                        @csrf
                        <input 
                            type="text" 
                            name="nombre" 
                            value="{{ $dispositivo->nombre }}" 
                            class="form-control mb-2"
                            placeholder="Antiguo valor: { {{ $dispositivo->nombre }} }" 
                            required autocomplete="nombre"
                        />
                        <input 
                            type="text" 
                            name="descripcion" 
                            value="{{$dispositivo->descripcion}}" 
                            class="form-control mb-2" 
                            required autocomplete="descripcion"
                            placeholder="Antiguo valor: { {{ $dispositivo->descripcion }} }" 

                        />
                        <input 
                            type="text" 
                            name="marca" 
                            value="{{$dispositivo->marca}}" 
                            class="form-control mb-2"
                            required autocomplete="marca"
                            placeholder="Antiguo valor: { {{ $dispositivo->marca }} }" 

                        />
                        <input 
                            type="text" 
                            name="modelo" 
                            value="{{$dispositivo->modelo}}" 
                            class="form-control mb-2" 
                            required autocomplete="modelo"
                            placeholder="Antiguo valor: { {{ $dispositivo->modelo }} }" 

                        />
                        <button class="btn btn-primary btn-block" type="submit">Editar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection