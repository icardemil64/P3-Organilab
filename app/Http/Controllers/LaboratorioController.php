<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Laboratorio;
use App\Dispositivo;
use App\Reserva;
use App\Prestamo;
use DB;

class LaboratorioController extends Controller
{
    public function index(Request $request)
    {   $request->user()->authorizeRoles(['admin']);
        $laboratorios = Laboratorio::all();
        return view('laboratorios.index',compact('laboratorios'));
    }



    public function crear(){
        return view('laboratorios.crear');
    }



    public function guardarLaboratorio(Request $request){
        $request->user()->authorizeRoles(['admin']);
        $validador = Laboratorio::where('nombre',$request->nombre)->first();
        if($validador === NULL){
            $slug = str_replace(' ','_',$request->nombre);
            $slug = strtolower($slug);
            $laboratorio = new Laboratorio();
            $laboratorio->nombre = $request->nombre;
            $laboratorio->descripcion = $request->descripcion;
            $laboratorio->sede = $request->sede;
            $laboratorio->edificio = $request->edificio;
            $capacidad = $request->capacidad;
            if($capacidad > 0)
            {
                $laboratorio->capacidad = $capacidad;
                $laboratorio->slug = $slug;
                $laboratorio->save();
                return back()->with('mensaje','Laboratorio agregado!');
            }
            else{
                return back()->with('error','La capacidad debe ser mayor a cero.');
            }
            
        }
        else{
            return back()->with('error','El laboratorio ya existe en el sistema.');
        }
    }



    public function detalleLaboratorio($slug){
        $laboratorio = Laboratorio::where('slug',$slug)->first();
        return view('laboratorios.panel',compact('laboratorio'));
    }

    public function historialPrestamosLaboratorio($slug){
        $laboratorio = Laboratorio::where('slug',$slug)->first();
        return view('laboratorios.detalle',compact('laboratorio'));
    }


    public function editarLaboratorio($slug){
        $laboratorio = Laboratorio::where('slug',$slug)->first();
        return view('laboratorios.editar',compact('laboratorio'));
    }



    public function guardarLaboratorioActualizado(Request $request, $slug){
        $laboratorio = Laboratorio::where('slug',$slug)->first();
        if($request->nombre === $laboratorio->nombre){
            $laboratorio->descripcion = $request->descripcion;
            $laboratorio->sede = $request->sede;
            $laboratorio->edificio = $request->edificio;
            $laboratorio->save();
            return back()->with('mensaje','Laboratorio modificado');
        }
        else{
            $slug = str_replace(' ','_',$request->nombre);
            $slug = strtolower($slug);
            $validador = Laboratorio::where('nombre',$request->nombre);
            if($validador === NULL){
                $laboratorio->nombre = $request->nombre;
                $laboratorio->descripcion = $request->descripcion;
                $laboratorio->sede = $request->sede;
                $laboratorio->edificio = $request->edificio;
                $laboratorio->slug = $slug;
                return back()->with('mensaje','Laboratorio modificado');
            }
            else{
            return back()->with('error','Ya existe un laboratorio en el sistema con este nombre.');
            }
        }
    }

    public function eliminarLaboratorio($slug){
        $laboratorio = Laboratorio::where('slug',$slug)->first();
        $dispositivos = Dispositivo::where('id_laboratorio',$laboratorio->id)->get();
        foreach($dispositivos as $dispositivo){
            $dispositivo->estado = 'LIBRE';
            $dispositivo->id_laboratorio = null;
            $dispositivo->save();
        } 
        $reserva = DB::delete("delete from reservas where (id_laboratorio = '$laboratorio->id' and id_recurso IS NULL)");
        $prestamo = DB::delete("delete from prestamos where (id_laboratorio = '$laboratorio->id' and id_recurso IS NULL)");
        $laboratorio -> delete();
        return redirect(route('inicio_laboratorios'))->with('mensaje','Laboratorio eliminado de forma exitosa');
    }

    public function asignarDispositivos($slug){
        $laboratorio = Laboratorio::where('slug',$slug)->first();
        $dispositivos = Dispositivo::distinct()->get(['nombre','descripcion','marca','modelo','slug']);        
        return view('laboratorios.asignarDispositivo',compact('laboratorio','dispositivos'));
    }

    public function asignarDispositivosDetalle($slug_lab,$slug_dis){ 
        $laboratorio = Laboratorio::where('slug',$slug_lab)->first();        
        $dispositivos = DB::select("select * from dispositivos where slug ='$slug_dis'");
        return view('laboratorios.asignarDispositivoDetalle',compact('laboratorio','dispositivos'));
    }

    public function asignarDispositivoALaboratorioAdd($slug_lab,$slug_dis,$id_dis){
        $laboratorio = Laboratorio::where('slug',$slug_lab)->first();        
        $dispositivo = Dispositivo::findOrFail($id_dis);
        $dispositivo->id_laboratorio = $laboratorio->id;
        $dispositivo->estado = 'ASIGNADO';
        $dispositivo->save();
        return back();
    }

    public function asignarDispositivoALaboratorioDelete($slug_lab,$slug_dis,$id_dis){
        $dispositivo = Dispositivo::findOrFail($id_dis);
        $dispositivo->id_laboratorio = null;
        $dispositivo->estado = 'LIBRE';
        $dispositivo->save();
        return back();
    }

    public function indexDispositivosAsignados($slug){
        $laboratorio = Laboratorio::where('slug',$slug)->first();        
        $dispositivos = DB::select("select * from dispositivos where id_laboratorio ='$laboratorio->id'");
        return view('laboratorios.indexDispositivosAsignados',compact('dispositivos','laboratorio'));
    }
}
