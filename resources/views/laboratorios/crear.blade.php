@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Agregar Laboratorios</span>
                    <a href="{{route('inicio_laboratorios')}}" class="btn btn-secondary btn-sm">Volver a lista de laboratorios...</a>
                </div>
                <div class="card-body">     
                  @if ( session('mensaje') )
                    <div class="alert alert-success">{{ session('mensaje') }}</div>
                  @endif
                  @if ( session('error') )
                    <div class="alert alert-danger">{{ session('error') }}</div>
                  @endif
                <form method="POST" action="{{route('guardar_laboratorios')}}" autocomplete="off">
                    @csrf
                    <input
                      type="text"
                      name="nombre"
                      placeholder="Nombre"
                      class="form-control mb-2"
                      required autocomplete="nombre"
                    />
                    <input
                      type="text"
                      name="descripcion"
                      placeholder="Descripción"
                      class="form-control mb-2"
                      required autocomplete="descripcion"
                    />
                    <input
                      type="text"
                      name="sede"
                      placeholder="Sede"
                      class="form-control mb-2"
                      required autocomplete="sede"
                    />
                    <input
                      type="text"
                      name="edificio"
                      placeholder="Edificio"
                      class="form-control mb-2"
                      required autocomplete="edificio"
                    />
                    <input
                      type="number"
                      name="capacidad"
                      placeholder="Capacidad"
                      class="form-control mb-2"
                      required autocomplete="capacidad"
                    />
                    <button class="btn btn-primary btn-block" type="submit">Agregar</button>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection