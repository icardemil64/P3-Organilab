@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Panel de reservas de recursos</span>
                    <a href="{{route('inicio_laboratorio')}}" class="btn btn-secondary btn-sm">Volver</a>
                </div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card border-primary" style="width: 18rem;">
                                <img class="card-img-top"
                                    src="https://cdn.pixabay.com/photo/2010/12/13/09/52/computer-1880_960_720.jpg"
                                    alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">Reserva dispositivo</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up
                                        the bulk of the card's content.</p>
                                    <a href="{{route('inicio_reservas_dispositivos')}}" class="btn btn-primary">Ir dispositivo</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card border-primary" style="width: 18rem;">
                                <img class="card-img-top"
                                    src="https://cdn.pixabay.com/photo/2017/03/28/12/07/bricks-2181920_960_720.jpg"
                                    alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">Reserva laboratorio</h5>                                    
                                    <p class="card-text">Some quick example text to build on the card title and make up
                                        the bulk of the card's content.</p>
                                    <a href="{{route('inicio_reservas_laboratorios')}}" class="btn btn-primary">Ir laboratorio</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection