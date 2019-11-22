@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Agregar Dispositivo</span>
                    <a href="{{ route('inicio_dispositivos')}}" class="btn btn-secondary btn-sm">Volver a lista de dispositivos...</a>
                </div>
                <div class="card-body">     
                  @if ( session('mensaje') )
                    <div class="alert alert-success">{{ session('mensaje') }}</div>
                  @endif
                  @if ( session('error') )
                    <div class="alert alert-danger">{{ session('error') }}</div>
                  @endif
                  <form method="POST" action="{{ route('guardar_dispositivos')}}" autocomplete="off">
                    @csrf
                    <input
                      type="text"
                      name="nombre"
                      placeholder="Nombre"
                      class="form-control mb-2 @error('nombre') is-invalid @enderror"
                      value="{{ old('nombre') }}"
                      required autocomplete="nombre"
                    />

                    <input
                      type="text"
                      name="descripcion"
                      placeholder="Descripción"
                      class="form-control mb-2 @error('descripcion') is-invalid @enderror"
                      value="{{ old('descripcion') }}"
                      required autocomplete="descripcion"
                    />
                    <input
                      type="text"
                      name="marca"
                      placeholder="Marca"
                      class="form-control mb-2 @error('marca') is-invalid @enderror"
                      value="{{ old('marca') }}"
                      required autocomplete="marca"
                    />
                    <input
                      type="text"
                      name="modelo"
                      placeholder="Modelo"
                      class="form-control mb-2 @error('modelo') is-invalid @enderror"
                      value="{{ old('modelo') }}"
                      required autocomplete="modelo"
                    />
                    <input
                        type="number"
                        name="cantidad"
                        placeholder="Cantidad"
                        min="1"
                        max="100"
                        class="form-control mb-2 @error('cantidad') is-invalid @enderror"
                        value="{{ old('cantidad') }}"
                        required autocomplete="cantidad"
                    />
                    <button class="btn btn-primary btn-block" type="submit">Agregar</button>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection