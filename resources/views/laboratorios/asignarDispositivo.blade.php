@extends('layouts.app')
@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Asignar dispositivos a {{$laboratorio->nombre}}</span>
                        <span>                  
                            <a href="{{route('indice_dispositivos_asignados',$laboratorio->slug)}}" class="btn btn-secondary btn-sm">Volver</a>
                        </span>
                    </div>
                    <div class="card-body">      
                        @foreach ($dispositivos as $dispositivo)
                            <div>
                                <a href="{{route('asignar_dispositivos_laboratorio_detalle',[$laboratorio->slug,$dispositivo->slug])}}">
                                <div class="card text-white bg-dark  mb-3">
                                    <div class="card-header">{{$dispositivo->nombre}}</div>
                                        <div class="card-body">
                                            <h5 class="card-title">{{$dispositivo->descripcion}}</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    </div>
                                </div>
                                </a>
                            </div>
                        @endforeach
                        {{-- {{$dispositivos->links()}} --}}
                {{-- fin card body --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection