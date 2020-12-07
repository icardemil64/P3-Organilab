@extends('layouts.app')
@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Lista de préstamos activos</span>
                        <span>
                            @auth
                                @if (Auth::user()->hasRole('admin'))
                                    <a href="{{route('inicio_prestamos_activos')}}" class="btn btn-secondary btn-sm">Volver</a>                                    
                                @else
                                    <a href="{{route('inicio_prestamos_activos')}}" class="btn btn-secondary btn-sm">Volver</a>
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
                                <tr style="font-size:13px">
                                <th scope="col">Alumno</th>
                                <th scope="col" style="text-align:center">Entrega</th>
                                <th scope="col">Encargado entrega</th>
                                <th scope="col">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($prestamos as $prestamo)
                                    <tr style="font-size:14px">
                                        <td>{{$prestamo->nombre}} {{$prestamo->apellido}}</td>
                                        <td style="text-align: center">{{$prestamo->created_at}}</td>
                                        <td>{{$prestamo->id_encargado_salida}}</td>
                                        <td>
                                            <a href="{{route('actualizar_prestamo_laboratorio',$prestamo->id)}}" class="badge badge-success">
                                                Finalizar
                                            </a>
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