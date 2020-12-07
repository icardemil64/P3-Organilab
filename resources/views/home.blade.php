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
                                    src="https://cdn.pixabay.com/photo/2016/11/19/14/00/code-1839406_960_720.jpg"
                                    alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">Registrar prestamo</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    <a href="{{route('inicio_prestamos')}}" class="btn btn-primary">Ir registro</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card border-primary" style="width: 18rem;">
                                <img class="card-img-top"
                                    src="https://cdn.pixabay.com/photo/2017/02/18/11/00/checklist-2077018_960_720.jpg"
                                    alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">Ver préstamos</h5>                                    
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        <a href="{{route('prestamos_activos')}}" class="btn btn-primary">Ir préstamos</a>
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
