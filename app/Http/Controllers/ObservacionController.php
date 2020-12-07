<?php

namespace App\Http\Controllers;
use App\Observacion;
use App\Dispositivo;
use DB;
use Illuminate\Http\Request;

class ObservacionController extends Controller
{
    public function index(){
        $observaciones = DB::select('   SELECT observacions.id, observacions.id_recurso, dispositivos.nombre, observacions.estado
                                        FROM observacions, dispositivos 
                                        WHERE observacions.id_recurso = dispositivos.id 
                                        ORDER BY estado ASC');
        return view('observaciones.index',compact('observaciones'));
    }

    public function detalleObservacion($id){
        $observacion = Observacion::findOrFail($id);
        return view('observaciones.detalle',compact('observacion'));
    }

    public function crear($slug,$id){
        $dispositivo = Dispositivo::findOrFail($id);
        return view('observaciones.crear',compact('dispositivo'));
    }

    public function listarDispositivos()
    {   $dispositivos = Dispositivo::distinct()->get(['nombre','descripcion','marca','modelo','slug']);
        return view('observaciones.listadoDispositivos',compact('dispositivos'));
    }

    public function detalleListadoDispositivos($slug)
    {   $dispositivos = Dispositivo::where('slug',$slug)->paginate(10);
        return view('observaciones.detalleDispositivo',compact('dispositivos'));
    }

    public function detalleDispositivo($slug,$id){
        $observaciones = DB::select("select * from observacions where id_recurso = '$id'");
        $dispositivo = Dispositivo::findOrFail($id);
        return view('observaciones.historialDispositivos',compact('dispositivo','observaciones'));
    }

    public function guardarObservacion(Request $request){
        $recursoUpdate = Dispositivo::findOrFail($request->dispositivo_id);
        $recursoUpdate->estado = 'OCUPADO';
        $recursoUpdate->save();
        $observacion = new Observacion();
        $observacion->observacion = $request->observacion;
        $observacion->id_recurso = $request->dispositivo_id;
        $observacion->estado = 'PENDIENTE';
        $observacion->save();
        return redirect(route('listado_dispositivos_observaciones'))->with('mensaje','Observación ingresada!');
    }

    public function actualizarObservacion(Request $request){
        $observacion = Observacion::findOrFail($request->id);
        $observacion->estado = 'SOLUCIONADO';
        $observacion->solucion = $request->solucion;
        $observacion->fecha_reparacion = date('Y-m-d H:i:s');
        $observacion->save();
        $recursoUpdate = Dispositivo::findOrFail($observacion->id_recurso);
        $recursoUpdate->estado = 'LIBRE';
        $recursoUpdate->save();
        return redirect(route('inicio_observaciones'));
    }
}
