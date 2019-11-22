@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Laboratorios disponibles en el departamento</span>
                        <span>
                            <a href="{{route('inicio_reserva')}}" class="btn btn-secondary btn-sm">Volver</a>
                        </span>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Edificio</th>
                                <th scope="col">Capacidad</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($laboratorios as $laboratorio)
                                <tr>
                                    <th scope="row"> </th>
                                    <td>
                                        <a href="{{route('detalle_laboratorio_reserva',[$laboratorio->slug,$laboratorio->id])}}">
                                            {{ $laboratorio->nombre }}
                                        </a>
                                    </td>
                                    <td>{{ $laboratorio->descripcion }}</td>
                                    <td>{{ $laboratorio->edificio }}</td>
                                    <td>{{ $laboratorio->capacidad }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection