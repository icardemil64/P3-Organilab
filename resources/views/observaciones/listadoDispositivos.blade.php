@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Lista de dispositivos para {{auth()->user()->name}}</span>
                        <span>
                            <a href="{{ route('inicio_laboratorio')}}" class="btn btn-secondary btn-sm">Volver</a>
                        </span>
                    </div>
                    @if ( session('mensaje') )
                        <div class="alert alert-success">{{ session('mensaje') }}</div>
                    @endif
                    <div class="card-body">      
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
                                        <a href="{{ route('detalle_listado_dispositivos_observaciones',$dispositivo->slug)}}">
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
                        {{-- {{$dispositivos->links()}} --}}
                {{-- fin card body --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection