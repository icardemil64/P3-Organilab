@extends('layouts.app')
@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Activididad del laboratorio {{$dispositivo->nombre}}</span>
                        <span>
                            @if ($dispositivo->estado == 'LIBRE' || $dispositivo->estado == 'ASIGNADO')
                                <a href="{{route('crear_observacion',[$dispositivo->slug,$dispositivo->id])}}" class="btn btn-primary  btn-sm">
                                    Crear observación
                                </a>
                            @else
                                <button type="button" class="btn btn-danger btn-sm" disabled>Ocupado</button>
                            @endif                     
                            <a href="{{route('listado_dispositivos_observaciones')}}" class="btn btn-secondary btn-sm">Volver</a>
                        </span>
                    </div>
                    <div class="card-body">      
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">Nombre dispositivo</th>
                                <th scope="col">Observacion</th>
                                <th scope="col" style="text-align:center">Fecha reparacion</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($observaciones as $observacion)
                                    <tr>
                                        <td>{{$dispositivo->nombre}}</td>
                                        <td>{{$observacion->observacion}}</td>
                                        <td style="text-align:center">
                                            @if ($observacion->fecha_reparacion == null)
                                                <span class="badge badge-warning">Pendiente</span>
                                            @else
                                                {{$observacion->fecha_reparacion}}
                                            @endif
                                        </td>
                                    <tr>                                    
                                @endforeach
                            </tbody>
                        </table>
                        {{-- {{$dispositivos->links()}} --}}
                {{-- fin card body --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection