<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Dispositivo;

class DispositivoController extends Controller
{
    public function index(Request $request)
    {   $request->user()->authorizeRoles(['admin']);
        $dispositivos = Dispositivo::distinct()->get(['nombre','descripcion','marca','modelo','slug']);
        return view('dispositivos.index',compact('dispositivos'));
    }



    public function crear(){
        return view('dispositivos.crear');
    }



    public function guardarDispositivo(Request $request){
        $request -> validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'modelo' => 'required',
            'marca' => 'required'
        ]);
        $validador = Dispositivo::where('nombre',$request->nombre)->first();
        if($validador === NULL){
            $slug = str_replace(' ','_',$request->nombre);
            $slug = strtolower($slug);
            $iteracion = $request->cantidad;
            for ($i=0; $i < $iteracion; $i++) {
                $dispositivo = new Dispositivo();
                $dispositivo->nombre = $request->nombre;
                $dispositivo->descripcion = $request->descripcion;
                $dispositivo->modelo = $request->modelo;
                $dispositivo->marca = $request->marca;
                $dispositivo->slug = $slug;
                $dispositivo->save();            
            }
            return back()->with('mensaje','Dispositivo(s) agregado!');
        }
        else{
            return back()->with('error','El dispositivo ya existe en el sistema.');
        }
    }



    public function listaDispositivos($slug){
        $dispositivos = Dispositivo::where('slug',$slug)->paginate(10);
        return view('dispositivos.detalleListado',compact('dispositivos'));
    }



    public function eliminarDispositivo($slug,$id){
        $dispositivoEliminar = Dispositivo::findOrFail($id);
        $reserva = DB::delete("delete from reservas where (id_recurso = '$dispositivoEliminar->id')");
        $prestamo = DB::delete("delete from prestamos where (id_recurso = '$dispositivoEliminar->id')");
        $dispositivoEliminar->delete();
        return back()->with('mensaje','Dispositivo eliminado');
    }



    public function detalleDispositivo($slug,$id){
        $prestamos = DB::select("select * from prestamos where id_recurso = '$id'");
        foreach ($prestamos as $prestamo) {
            $prestamo->created_at = date('d-m-Y H:i', strtotime($prestamo->created_at));
            $prestamo->fecha_entrega = date('d-m-Y H:i', strtotime($prestamo->fecha_entrega));
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
        return view('dispositivos.detalleDispositivo',compact('dispositivo','prestamos'));
    }

    public function editarDispositivo($slug){
        $dispositivo = Dispositivo::where('slug',$slug)->first();
        return view('dispositivos.editar',compact('dispositivo'));
    }

    public function guardarDispositivoActualizado(Request $request, $slug){
        $dispositivos = Dispositivo::where('slug',$slug)->get();
        $request -> validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'modelo' => 'required',
            'marca' => 'required'
        ]);
        $slug = str_replace(' ','_',$request->nombre);
        $slug = strtolower($slug);
        if($dispositivos[0]->nombre === $request->nombre){
            foreach ($dispositivos as $dispositivo){
                $dispositivo->nombre = $request->nombre;
                $dispositivo->descripcion = $request->descripcion;
                $dispositivo->modelo = $request->modelo;
                $dispositivo->marca = $request->marca;
                $dispositivo->slug = $slug;
                $dispositivo->save();
            }
            return back()->with('mensaje','Dispositivo(s) actualizados.');
        }
        else{
            $validador = Dispositivo::where('nombre',$request->nombre)->first();
            if($validador === NULL){
                foreach ($dispositivos as $dispositivo){
                    $dispositivo->nombre = $request->nombre;
                    $dispositivo->descripcion = $request->descripcion;
                    $dispositivo->modelo = $request->modelo;
                    $dispositivo->marca = $request->marca;
                    $dispositivo->slug = $slug;
                    $dispositivo->save();
                }
                return redirect(route('editar_dispositivos',$dispositivo->slug))->with('mensaje','Dispositivo(s) actualizados.');
            }
            else{
                return back()->with('error','Ya existe un dispositivo con ese nombre en el sistema.');
            }
        }
    }

    public function buscarDispositivo(Request $request){
        $dispositivos = DB::select("select nombre,descripcion,marca,modelo,slug 
                                    from dispositivos 
                                    where nombre LIKE '%$request->nombre%'
                                    group by nombre,descripcion,marca,modelo,slug");
        if($dispositivos == NULL){
            return back()->with('error','¡No existe dispositivo!');
        }
        else{
            return view('dispositivos.busquedaDispositivo',compact('dispositivos'));
        }
    }
}