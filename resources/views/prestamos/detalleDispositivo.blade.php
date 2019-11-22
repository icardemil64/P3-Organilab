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
                            @if ($dispositivo->estado == 'LIBRE')
                                <a href="{{route('crear_prestamo_dispositivo',[$dispositivo->slug,$dispositivo->id])}}" class="btn btn-primary  btn-sm">
                                    Crear préstamo
                                </a>
                            @else
                                @if ($dispositivo->estado == 'ASIGNADO')
                                    <button type="button" class="btn btn-info btn-sm" disabled>Asignado</button>                                    
                                @else
                                    <button type="button" class="btn btn-danger btn-sm" disabled>Ocupado</button>
                                @endif
                            @endif                     
                            <a href="{{route('lista_dispositivos_prestamo',$dispositivo->slug)}}" class="btn btn-secondary btn-sm">Volver</a>
                        </span>
                    </div>
                    <div class="card-body">      
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">Alumno</th>
                                <th scope="col">Sala</th>
                                <th scope="col">Entrega</th>
                                <th scope="col">Recibo</th>
                                <th scope="col">Encargado entrega</th>
                                <th scope="col">Encargado recibo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($prestamos as $prestamo)
                                    <tr>
                                        <td>{{$prestamo->nombre}} {{$prestamo->apellido}}</td>
                                        <td>{{$prestamo->id_laboratorio}}</td>
                                        <td>{{$prestamo->created_at}}</td>
                                        <td>
                                            @if ($prestamo->fecha_entrega == NULL)
                                                <strong>[ OCUPADO ]</strong> 
                                            @else
                                                {{$prestamo->fecha_entrega}}
                                            @endif
                                        </td>
                                        <td>{{$prestamo->id_encargado_salida}}</td>
                                        <td>{{$prestamo->id_encargado_recibo}}</td>
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