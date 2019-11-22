@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Modificar encargado</span>
                    <span>
                        <a href="{{route('editar_encargado',$encargado->id)}}" class="btn btn-primary btn-sm">Restaurar</a>
                        <form action="{{route('eliminar_encargado',$encargado->id)}}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit">
                                    Eliminar
                                </button>
                        </form>                          
                        <a href="{{route('inicio_encargados')}}" class="btn btn-secondary btn-sm">Volver</a>
                    </span>
                </div>
                <div class="card-body">     
                  @if ( session('mensaje') )
                    <div class="alert alert-success">{{ session('mensaje') }}</div>
                  @endif
                    <form method="POST" action="{{route('actualizar_encargado',$encargado->id)}}" autocomplete="off">
                    @method('PUT')
                    @csrf
                    <input
                        type="text"
                        name="run"
                        placeholder="Antiguo valor: { {{$encargado->run}} }"                         
                        value="{{$encargado->run}}"                      
                        class="form-control mb-2"
                        required autocomplete="run"
                    />
                    <input
                        type="text"
                        name="name"
                        placeholder="Antiguo valor: { {{$encargado->name}} }"                                                 
                        value="{{$encargado->name}}"
                        class="form-control mb-2"
                        required autocomplete="name"
                    />
                    <input
                      type="text"
                      name="apellido"
                      placeholder="Antiguo valor: { {{$encargado->apellido}} }"                         
                      value="{{$encargado->apellido}}"
                      required autocomplete="apellido"                      
                      class="form-control mb-2"
                    />
                    <input
                      type="text"
                      name="celular"
                      placeholder="Antiguo valor: { {{$encargado->celular}} }"                                               
                      value="{{$encargado->celular}}"
                      required autocomplete="celular"                      
                      class="form-control mb-2"
                    />
                    <div class="checkbox">
                      <label>
                        <input name="rol" type="checkbox" value="1">
                        Administrador
                      </label>
                    </div>
                    <button class="btn btn-primary btn-block" type="submit">Modificar</button>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection