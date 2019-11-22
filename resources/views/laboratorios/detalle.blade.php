@extends('layouts.app')
@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Activididad del laboratorio {{$laboratorio->nombre}}</span>
                        <span>
                            <a href="{{route('editar_laboratorios',$laboratorio->slug)}}" class="btn btn-warning btn-sm">Modificar</a>  
                            <form action="{{route('eliminar_laboratorio',$laboratorio->slug)}}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit">
                                    Eliminar
                                </button>
                            </form>                          
                            <a href="{{route('panel_laboratorio',$laboratorio->slug)}}" class="btn btn-secondary btn-sm">Volver</a>
                        </span>
                    </div>
                    <div class="card-body">      
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Alumno</th>
                                <th scope="col">Fecha entrega</th>
                                <th scope="col">Fecha recibo</th>
                                <th scope="col">Encargado entrega</th>
                                <th scope="col">Encargado recibo</th>
                                </tr>
                            </thead>
                        </table>
                        {{-- {{$dispositivos->links()}} --}}
                {{-- fin card body --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection