@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

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
                                    src="https://cdn.pixabay.com/photo/2015/09/05/20/02/coding-924920_960_720.jpg"
                                    alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">Gestionar dispositivos</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up
                                        the bulk of the card's content.</p>
                                    <a href="{{ route('inicio_dispositivos')}}" class="btn btn-primary">Ir dispositivos</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card border-primary" style="width: 18rem;">
                                <img class="card-img-top"
                                    src="https://cdn.pixabay.com/photo/2015/05/17/05/34/window-770535_960_720.jpg"
                                    alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">Gestionar salas</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up
                                        the bulk of the card's content.</p>
                                    <a href="{{ route('inicio_laboratorios')}}" class="btn btn-primary">Ir salas</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-sm-6">
                            <div class="card border-primary" style="width: 18rem;">
                                <img class="card-img-top"
                                    src="https://cdn.pixabay.com/photo/2018/01/17/07/06/laptop-3087585_960_720.jpg"
                                    alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">Gestionar encargados</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up
                                        the bulk of the card's content.</p>
                                    <a href="{{ route('inicio_encargados')}}" class="btn btn-primary">Ir encargados</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card border-primary" style="width: 18rem;">
                                <img class="card-img-top"
                                    src="https://cdn.pixabay.com/photo/2014/08/26/21/27/service-428539_960_720.jpg"
                                    alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">Ver observaciones</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up
                                        the bulk of the card's content.</p>
                                    <a href="{{route('inicio_observaciones')}}" class="btn btn-primary">Ir observaciones</a>
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