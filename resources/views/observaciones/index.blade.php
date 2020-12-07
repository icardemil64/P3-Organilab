@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>
                            Lista de observaciones
                        </span>
                        <span>
                            @auth
                                @if (Auth::user()->hasRole('admin'))
                                    <a href="{{route('inicio_departamento')}}" class="btn btn-secondary btn-sm">Volver</a>                                    
                                @else
                                    <a href="{{route('inicio_laboratorio')}}" class="btn btn-secondary btn-sm">Volver</a>                                    
                                @endif
                            @endauth
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
                                <th scope="col" >ID Equipo</th>
                                <th scope="col" >Nombre Equipo</th>
                                <th scope="col" >Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($observaciones as $observacion)
                                <tr>
                                    <td>
                                        <a href="{{route('detalle_observacion',$observacion->id)}}">
                                            TICKET #{{ $observacion->id }}
                                        </a>
                                    </td>
                                    <td>{{ $observacion->id_recurso }}</td>
                                    <td>{{ $observacion->nombre }}</td>
                                    <td>
                                        @if ($observacion->estado == 'SOLUCIONADO')
                                            <span class="badge badge-success">Solucionado</span>
                                        @else
                                            <span class="badge badge-danger">Pendiente</span>
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