@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Lista de dispositivos para {{auth()->user()->name}}</span>
                        <span>
                            <a href="{{ route('crear_dispositivos')}}" class="btn btn-primary btn-sm">Nuevo dispositivo</a>
                            <a href="{{ route('inicio_departamento')}}" class="btn btn-secondary btn-sm">Volver</a>
                        </span>
                    </div>
                    <div class="card-body">
                        @if ( session('error') )
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        <form action="{{route('buscar_dispositivo')}}" method="GET" autocomplete="off">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Nombre de dispositivo a buscar" aria-label="Buscador" aria-describedby="basic-addon1" name="nombre">
                            </div>
                        </form>      
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Marca</th>
                                <th scope="col">Modelo</th>
                                <th scope="col">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dispositivos as $dispositivo)
                                <tr>
                                    <th scope="row">{{ $dispositivo->id }}</th>
                                    <td>
                                        <a href="{{ route('lista_dispositivos',$dispositivo->slug)}}">
                                            {{ $dispositivo->nombre }}
                                        </a>
                                    </td>
                                    <td>{{ $dispositivo->descripcion }}</td>
                                    <td>{{ $dispositivo->marca }}</td>
                                    <td>{{ $dispositivo->modelo }}</td>
                                    <td>
                                        <a href="{{ route('editar_dispositivos',$dispositivo->slug)}}">Editar</a>                                      
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