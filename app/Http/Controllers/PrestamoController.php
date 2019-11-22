<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prestamo;
use App\Laboratorio;
use App\Dispositivo;
use App\User;
use DB;

class PrestamoController extends Controller
{
    public function index(){
        return view('prestamos.index');
    }

    public function indexDispositivo(){
        $dispositivos = Dispositivo::distinct()->get(['nombre','descripcion','marca','modelo','slug']);
        return view('prestamos.indexDispositivos',compact('dispositivos'));
    }

    public function indexLaboratorio(){
        $laboratorios = DB::select('select * from laboratorios');
        return view('prestamos.indexLaboratorios',compact('laboratorios'));
    }

    public function listaDispositivos($slug){
        $dispositivos = Dispositivo::where('slug',$slug)->paginate(10);
        return view('prestamos.detalleListado',compact('dispositivos'));
    }

    public function prestamosActivos(){
        return view('prestamos.indexPrestamosActivos');
    }
    public function detalleDispositivo($slug,$id){
        $prestamos = DB::select("select * from prestamos where id_recurso = '$id'");
        foreach ($prestamos as $prestamo) {
            $prestamo->created_at = date('d-m-Y H:i', strtotime($prestamo->created_at));
            if($prestamo->fecha_entrega != NULL){
                $prestamo->fecha_entrega = date('d-m-Y H:i', strtotime($prestamo->fecha_entrega));
            }
            $laboratorio = Laboratorio::findOrFail($prestamo->id_laboratorio);
            $encargado = User::findOrFail($prestamo->id_encargado_salida);
            $prestamo->id_encargado_salida = $encargado->name.' '.$encargado->apellido;
            if(strcmp('null',$prestamo->id_encargado_recibo)!=0)
            {
                $encargado = User::findOrFail($prestamo->id_encargado_recibo);
                $prestamo->id_encargado_recibo = $encargado->name.' '.$encargado->apellido;
            }
            $prestamo->id_laboratorio = $laboratorio->nombre;
        }
        $dispositivo = Dispositivo::findOrFail($id);
        $laboratorio = Laboratorio::where('id',$dispositivo->id_laboratorio)->first();
        return view('prestamos.detalleDispositivo',compact('dispositivo','prestamos','laboratorio'));
    }

    //1
    public function crearPrestamoDispositivo($slug,$id){
        $dispositivo = Dispositivo::findOrFail($id);
        //$laboratorios = Laboratorio::all();
        $laboratorios = DB::select('SELECT * FROM laboratorios');
        return view('prestamos.crearPrestamoDispositivo',compact('dispositivo','laboratorios'));
    }

    //2
    public function guardarPrestamoDispositivo(Request $request){
        $laboratorio = Laboratorio::findOrFail($request->laboratorio);
        $recursoUpdate = Dispositivo::findOrFail($request->dispositivo_id);
        $recursoUpdate->estado = 'OCUPADO';
        $recursoUpdate->save();
        $prestamo = New Prestamo();
        $prestamo->id_alumno = $request->run;
        $prestamo->id_encargado_salida = auth()->user()->id;
        $prestamo->id_encargado_recibo = 'null';
        $prestamo->id_laboratorio = $laboratorio->id;
        $prestamo->id_recurso = $request->dispositivo_id;
        $prestamo->nombre = $request->nombre;
        $prestamo->apellido = $request->apellido;
        $prestamo->save();
        return redirect(route('prestamos_activos_dispositivos'));
    }

    public function listaPrestamosDispositivos(){
        $prestamos = DB::select("   select * 
                                    from prestamos 
                                    where id_encargado_recibo = 'null' and id_recurso <> 'null'");
        foreach ($prestamos as $prestamo) {
            $prestamo->created_at = date('d-m-Y H:i', strtotime($prestamo->created_at));
            $laboratorio = Laboratorio::findOrFail($prestamo->id_laboratorio);
            $encargado = User::findOrFail($prestamo->id_encargado_salida);
            $prestamo->id_encargado_salida = $encargado->name.' '.$encargado->apellido;
            $prestamo->id_laboratorio = $laboratorio->nombre;
            if($prestamo->id_recurso != null){
                $recurso = Dispositivo::findOrFail($prestamo->id_recurso);
                $prestamo->id_recurso = $recurso->nombre;
            }
            else{
                $prestamo->id_recurso = null;
            }
            
        }
        return view('prestamos.prestamosDispositivosActivos',compact('prestamos'));
    }

    //3
    public function actualizarPrestamoDispositivo($id){
        $prestamo = Prestamo::findOrFail($id);
        $dispositivo = Dispositivo::findOrFail($prestamo->id_recurso);
        $dispositivo->estado = 'LIBRE';
        $dispositivo->save();
        $prestamo->id_encargado_recibo = auth()->user()->id;
        $prestamo->fecha_entrega = date('Y-m-d H:i:s');
        $prestamo->save();
        return back()->with('mensaje','Préstamo finalizado!');
    }

    public function buscarDispositivo(Request $request){
        $dispositivos = DB::select("select nombre,descripcion,marca,modelo,slug 
                                    from dispositivos 
                                    where nombre LIKE '%$request->nombre%'
                                    group by nombre,descripcion,marca,modelo,slug");
        if($dispositivos == NULL){
            return 'No existe dispositivo';
        }
        else{
            return view('prestamos.busquedaDispositivo',compact('dispositivos'));
        }
    }

    public function detalleLaboratorio($slug,$id){
        $prestamos = DB::select("select * from prestamos where id_laboratorio = '$id' and id_recurso is null");
        $laboratorio = Laboratorio::findOrFail($id);
        foreach ($prestamos as $prestamo) {
            $prestamo->created_at = date('d-m-Y H:i', strtotime($prestamo->created_at));
            if($prestamo->fecha_entrega != NULL){
                $prestamo->fecha_entrega = date('d-m-Y H:i', strtotime($prestamo->fecha_entrega));
            }
            $encargado = User::findOrFail($prestamo->id_encargado_salida);
            $prestamo->id_encargado_salida = $encargado->name.' '.$encargado->apellido;
            if(strcmp('null',$prestamo->id_encargado_recibo)!=0)
            {
                $encargado = User::findOrFail($prestamo->id_encargado_recibo);
                $prestamo->id_encargado_recibo = $encargado->name.' '.$encargado->apellido;
            }
        }
        return view('prestamos.detalleLaboratorio',compact('prestamos','laboratorio'));
    }

    public function crearPrestamoLaboratorio($slug,$id){
        $laboratorio = Laboratorio::findOrFail($id);
        return view('prestamos.crearPrestamoLaboratorio',compact('laboratorio'));
    }

    public function guardarPrestamoLaboratorio(Request $request){
        $recursoUpdate = Laboratorio::findOrFail($request->laboratorio_id);
        $recursoUpdate->estado = 'OCUPADO';
        $recursoUpdate->save();
        $prestamo = New Prestamo();
        $prestamo->id_alumno = $request->run;
        $prestamo->id_encargado_salida = auth()->user()->id;
        $prestamo->id_encargado_recibo = 'null';
        $prestamo->id_laboratorio = $request->laboratorio_id;
        $prestamo->id_recurso = null;
        $prestamo->nombre = $request->nombre;
        $prestamo->apellido = $request->apellido;
        $prestamo->save();
        return redirect(route('prestamos_activos_laboratorios'));
    }

    public function listaPrestamosLaboratorios(){
        $prestamos = DB::select("   select * 
                                    from prestamos 
                                    where (id_encargado_recibo = 'null' and id_recurso IS NULL)");
        foreach ($prestamos as $prestamo) {
            $prestamo->created_at = date('d-m-Y H:i', strtotime($prestamo->created_at));
            $encargado = User::findOrFail($prestamo->id_encargado_salida);
            $prestamo->id_encargado_salida = $encargado->name.' '.$encargado->apellido;
        }
        return view('prestamos.prestamosLaboratoriosActivos',compact('prestamos'));
    }

    public function actualizarPrestamoLaboratorio($id){
        $prestamo = Prestamo::findOrFail($id);
        $laboratorio = Laboratorio::findOrFail($prestamo->id_laboratorio);
        $laboratorio->estado = 'LIBRE';
        $laboratorio->save();
        $prestamo->id_encargado_recibo = auth()->user()->id;
        $prestamo->fecha_entrega = date('Y-m-d H:i:s');
        $prestamo->save();
        return back()->with('mensaje','Préstamo finalizado!');
    }
}
