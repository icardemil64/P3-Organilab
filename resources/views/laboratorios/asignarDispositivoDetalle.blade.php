@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>
                            Lista de {{$dispositivos[0]->nombre}}
                        </span>
                        <span>
                            <a href="{{route("asignar_dispositivos_laboratorio",$laboratorio->slug)}}" class="btn btn-secondary btn-sm">Volver</a>
                        </span>
                    </div>
                    <div class="card-body">    
                            <div class="row">
                                @foreach ($dispositivos as $dispositivo)
                                    <div class="col-6">
                                        @if ($dispositivo->estado == 'LIBRE' || $dispositivo->estado == 'ASIGNADO')
                                            @if ($dispositivo->id_laboratorio == null)
                                                <a href="{{route("asignar_dispositivo_a_laboratorio_add",[$laboratorio->slug,$dispositivo->slug,$dispositivo->id])}}">                                        
                                                    <div class="alert alert-dark" role="alert">
                                                        <div class="row">
                                                            <div class="col-5"> <strong>ID:</strong> {{$dispositivo->id}} </div>
                                                            <div class="col-7">
                                                                <strong>Estado:</strong> Libre
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>                                        
                                                @else
                                                <a href="{{route("asignar_dispositivo_a_laboratorio_delete",[$laboratorio->slug,$dispositivo->slug,$dispositivo->id])}}">                                        
                                                    <div class="alert alert-info" role="alert">
                                                        <div class="row">
                                                            <div class="col-5"> <strong>ID:</strong> {{$dispositivo->id}} </div>
                                                            <div class="col-7"> <strong>Estado:</strong> Asignado</div>
                                                        </div>
                                                    </div>
                                                </a>
                                            @endif
                                        @else
                                            <div class="alert alert-warning" role="alert">
                                                <div class="row">
                                                    <div class="col-5"> <strong>ID:</strong> {{$dispositivo->id}} </div>
                                                    <div class="col-7"> <strong>Estado:</strong> Préstamo</div>
                                                </div>
                                            </div>
                                        @endif
                                        
                                    </div>                                    
                                @endforeach
                            </div>
                        {{-- {{$dispositivos->links()}} --}}
                {{-- fin card body --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection