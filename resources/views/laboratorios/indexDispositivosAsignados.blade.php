@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>
                            Lista de dispositivos asignados
                        </span>
                        <span>
                            <a href="{{route('asignar_dispositivos_laboratorio',$laboratorio->slug)}}" class="btn btn-primary btn-sm">Gestionar dispositivos</a>
                            <a href="{{route('panel_laboratorio',$laboratorio->slug)}}" class="btn btn-secondary btn-sm">Volver</a>
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
                        @if ($dispositivos != NULL)
                            <div class="row">
                                @foreach ($dispositivos as $dispositivo)  
                                    <div class="col-6">
                                        <div class="alert alert-dark" role="alert">
                                            <div class="row">
                                                <div class="col-4"> <strong>ID:</strong> {{$dispositivo->id}} </div>
                                                <div class="col-8">
                                                    <strong>Nombre:</strong> {{$dispositivo->nombre}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                  
                                @endforeach
                            </div>
                        @else
                        <div class="my-5" style="text-align:center">
                            <h5>¡No hay dispositivos asignados!</h5>
                        </div>    
                        @endif      

                        {{-- {{$dispositivos->links()}} --}}
                {{-- fin card body --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection