@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Agregar observación</span>
                    <a href="{{URL::previous()}}" class="btn btn-secondary btn-sm">Volver a lista de observaciones...</a>
                </div>
                <div class="card-body">     
                  @if ( session('mensaje') )
                    <div class="alert alert-success">{{ session('mensaje') }}</div>
                  @endif
                  @if ( session('error') )
                    <div class="alert alert-danger">{{ session('error') }}</div>
                  @endif
                <form method="POST" action="{{route('guardar_observacion')}}" autocomplete="off">
                    @csrf
                    <!--
                    <input
                      type="text"
                      name="observacion"
                      placeholder="Observacion"
                      class="form-control mb-2"
                      required autocomplete="observacion"
                      rows="5"
                    />
                    -->
                    <input
                      type="hidden"
                      name="dispositivo_id"
                      placeholder="dispositivo"
                      class="form-control mb-2"
                      value="{{$dispositivo->id}}"
                    />
                    <label for="Observacion">Observacion</label>
                    <textarea class="form-control" name="observacion" id="" cols="30" rows="7" placeholder="Observacion"></textarea>
                    <button class="btn btn-primary btn-block my-2" type="submit">Agregar</button>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection