@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Enviar ticket de solución</span>
                    <span>                    
                        <a href="{{route('inicio_observaciones')}}" class="btn btn-secondary btn-sm">Volver</a>
                    </span>
                </div>
                <div class="card-body">
                    @if ( session('mensaje') )
                    <div class="alert alert-success">{{ session('mensaje') }}</div>
                    @endif
                    @if ( session('error') )
                    <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    <div class="my-3">
                        <h5>Problema</h5>
                        <textarea class="form-control" name="observacion" cols="30" rows="5" placeholder="Observacion" disabled>{{$observacion->observacion}}</textarea>
                    </div>
                    <h5>Solución</h5>
                    <form method="POST" action="{{route('actualizar_observacion',$observacion->id)}}" autocomplete="off">
                        @method('PUT')
                        @csrf
                        @if ($observacion->estado == 'PENDIENTE')
                            <textarea class="form-control" name="solucion" cols="30" rows="5" placeholder="Solución"></textarea>
                            <button class="btn btn-primary my-3 btn-block" type="submit">Enviar</button>
                        @else
                            <textarea class="form-control" name="solucion" cols="30" rows="5" placeholder="Solución" disabled>{{$observacion->solucion}}</textarea>                        
                        @endif                            
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection