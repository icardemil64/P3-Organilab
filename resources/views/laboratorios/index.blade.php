@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>
                            Lista de laboratorios
                        </span>
                        <span>
                            <a href="{{route('crear_laboratorios')}}" class="btn btn-primary btn-sm">Nuevo laboratorio</a>
                            <a href="{{route('inicio_departamento')}}" class="btn btn-secondary btn-sm">Volver</a>
                        </span>
                    </div>
                    <div class="card-body">
                        @if (session('mensaje'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('mensaje') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>                            
                        @endif      
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Sede</th>
                                <th scope="col">Edificio</th>
                                <th scope="col">Capacidad</th>
                                <th scope="col">Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($laboratorios as $laboratorio)
                                <tr>
                                    <th scope="row">{{ $laboratorio->id }}</th>
                                    <td>
                                        <a href="{{route('panel_laboratorio',$laboratorio->slug)}}">
                                            {{ $laboratorio->nombre }}
                                        </a>
                                    </td>
                                    <td>{{ $laboratorio->descripcion }}</td>
                                    <td>{{ $laboratorio->sede }}</td>
                                    <td>{{ $laboratorio->edificio}}</td>
                                    <td>{{ $laboratorio->capacidad}}</td>
                                    <td>
                                        @if ($laboratorio->estado == 'LIBRE')
                                            <span class="badge badge-success">Disponible</span>
                                        @else
                                            <span class="badge badge-danger">Ocupado</span>
                                        @endif
                                    </td>
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