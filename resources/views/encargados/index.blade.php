@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Lista de encargados de laboratorio</span>
                        <span>
                            <a href="{{route('crear_encargado')}}" class="btn btn-primary btn-sm">Nuevo encargado</a>
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
                                <th scope="col">RUN</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Apellido</th>
                                <th scope="col">Email</th>
                                <th scope="col">Celular</th>
                                <th scope="col">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($encargados as $encargado)
                                <tr>
                                    <th scope="row">{{ $encargado->run }}</th>
                                    <td>{{ $encargado->name }}</td>
                                    <td>{{ $encargado->apellido }}</td>
                                    <td>{{ $encargado->email }}</td>
                                    <td>{{ $encargado->celular }}</td>
                                    <td>
                                        <a href="{{route('editar_encargado',$encargado->id)}}">Editar</a>
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