@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Dispositivos disponibles en el departamento</span>
                        <span>
                            <a href="{{route('inicio_prestamos')}}" class="btn btn-secondary btn-sm">Volver</a>
                        </span>
                    </div>
                    <div class="card-body">
                            <form action="{{route('buscar_dispositivo_prestamo')}}" method="GET" autocomplete="off">
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
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dispositivos as $dispositivo)
                                <tr>
                                    <th scope="row"> </th>
                                    <td>
                                        <a href="{{route('lista_dispositivos_prestamo',$dispositivo->slug)}}">
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