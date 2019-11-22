@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                            <span>Dispositivos: <strong>{{$dispositivos[0]->marca}} {{$dispositivos[0]->modelo}}</strong> disponibles</span>                        
                        <a href="{{ route('inicio_reservas_dispositivos') }}" class="btn btn-secondary btn-sm">Volver</a>
                    </div>
                    <div class="card-body">
                        @if ( session('mensaje') )
                            <div class="alert alert-danger">{{ session('mensaje') }}</div>
                        @endif      
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Marca</th>
                                <th scope="col">Modelo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dispositivos as $dispositivo)
                                <tr>
                                    <th scope="row">{{ $dispositivo->id }}</th>
                                    <td>
                                        <a href="{{route('detalle_dispositivo_reserva',[$dispositivo->slug,$dispositivo->id])}}">
                                            {{ $dispositivo->nombre }}
                                        </a>
                                    </td>
                                    <td>{{ $dispositivo->descripcion }}</td>
                                    <td>{{ $dispositivo->marca }}</td>
                                    <td>{{ $dispositivo->modelo }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$dispositivos->links()}}
                {{-- fin card body --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection