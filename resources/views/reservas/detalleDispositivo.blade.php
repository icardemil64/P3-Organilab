@extends('layouts.app')
@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10" style="text-align:center">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>
                            <strong>Nombre: </strong>{{$dispositivo->nombre}} 
                            <strong>ID:</strong> {{$dispositivo->id}}
                            @if ($dispositivo->id_laboratorio != NULL)
                                <strong>Ubicación:</strong> {{$laboratorio->nombre}}
                            @endif
                        </span>
                        <span>
                            @if ($dispositivo->estado == 'ASIGNADO')
                                <button type="button" class="btn btn-info btn-sm" disabled>Asignado</button>                                    
                            @else
                                <a href="{{route('crear_reserva_dispositivo',[$dispositivo->slug,$dispositivo->id])}}" class="btn btn-primary  btn-sm">
                                    Crear reserva
                                </a>
                            @endif                     
                            <a href="{{route('lista_dispositivos_reserva',$dispositivo->slug)}}" class="btn btn-secondary btn-sm">Volver</a>
                        </span>
                    </div>
                    <div class="card-body">   
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">Alumno</th>
                                <th scope="col">Sala</th>
                                <th scope="col">Entrega</th>
                                <th scope="col">Bloque reservado</th>
                                <th scope="col">Encargado entrega</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reservas as $reserva)
                                    <tr>
                                        <td>{{$reserva->nombre}} {{$reserva->apellido}}</td>
                                        <td>{{$reserva->id_laboratorio}}</td>
                                        <td>{{$reserva->dia_entrega}}</td>
                                        <td>{{$reserva->bloque_horario}}</td>
                                        <td>{{$reserva->id_encargado_salida}}</td>
                                    <tr>                                    
                                @endforeach
                            </tbody>
                        </table>
                {{-- fin card body --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection