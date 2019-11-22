<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dispositivo;
use App\Horario;
use App\Laboratorio;
use App\Reserva;
use App\User;
use DB;


class ReservaController extends Controller
{
    public function index(){
        return view('reservas.index');
    }

    public function indexDispositivos(){
        $dispositivos = Dispositivo::distinct()->get(['nombre','descripcion','marca','modelo','slug']);
        return view('reservas.indexDispositivos',compact('dispositivos'));
    }

    public function listaDispositivos($slug){
        $dispositivos = Dispositivo::where('slug',$slug)->paginate(10);
        return view('reservas.detalleListadoDispositivo',compact('dispositivos'));
    }

    public function detalleDispositivo($slug,$id){
        $reservas = DB::select("select * from reservas where id_recurso = '$id'");
        foreach ($reservas as $reserva) {
            $reserva->created_at = date('d-m-Y', strtotime($reserva->created_at));
            $reserva->dia_entrega = date('d-m-Y l', strtotime($reserva->dia_entrega));
            $laboratorio = Laboratorio::findOrFail($reserva->id_laboratorio);
            $horario = Horario::findOrFail($reserva->id_bloque_horario);
            $reserva->bloque_horario = date('H:i',strtotime($horario->hora_inicio)).' '.date('H:i',strtotime($horario->hora_fin));
            $encargado = User::findOrFail($reserva->id_encargado_salida);
            $reserva->id_encargado_salida = $encargado->name.' '.$encargado->apellido;
            if(strcmp('null',$reserva->id_encargado_recibo)!=0)
            {
                $encargado = User::findOrFail($reserva->id_encargado_recibo);
                $reserva->id_encargado_recibo = $encargado->name.' '.$encargado->apellido;
            }
            $reserva->id_laboratorio = $laboratorio->nombre;
        }
        $dispositivo = Dispositivo::findOrFail($id);
        $laboratorio = Laboratorio::where('id',$dispositivo->id_laboratorio)->first();
        return view('reservas.detalleDispositivo',compact('dispositivo','reservas','laboratorio'));
    }

    public function crearReservaDispositivo($slug,$id){
        $dispositivo = Dispositivo::findOrFail($id);
        $laboratorios = DB::select('SELECT * FROM laboratorios');
        $horarios = DB::select('SELECT * FROM horarios');
        $temp = getdate();
        $dia_actual = $temp['wday'];
        $indice = 1;
        if($dia_actual != 6){
            for ($i=$dia_actual;$i < 6;$i++){
                $dias[$indice] = date("Y-m-d l", strtotime("+$indice day"));
                $indice++;
            }
        }
        else{
            $dias = [];
        }
        foreach ($horarios as $horario){
            $horario->hora_inicio = date('H:i',strtotime($horario->hora_inicio));
            $horario->hora_fin = date('H:i',strtotime($horario->hora_fin));
        }
        
        return view('reservas.crearDispositivo',compact('dispositivo','laboratorios','horarios','dias'));
    }

    public function guardarReservaDispositivo(Request $request){
        $dispositivo = Dispositivo::findOrFail($request->dispositivo_id);
        $laboratorio = Laboratorio::findOrFail($request->laboratorio);
        $fecha_temp = date('Y-m-d H:i:s', strtotime($request->fechas_disponibles));
        $reserva_verificacion = DB::select("SELECT * 
                                            FROM reservas 
                                            WHERE id_recurso='$request->dispositivo_id'
                                            and dia_entrega = '$fecha_temp'
                                            and id_bloque_horario = '$request->horario'");
        if($reserva_verificacion == []){
            $reserva = new Reserva();
            $reserva->run = $request->run;
            $reserva->nombre = $request->nombre;
            $reserva->apellido = $request->apellido;
            $reserva->id_encargado_salida = auth()->user()->id;
            $reserva->id_encargado_recibo = 'null';
            $reserva->id_laboratorio = $laboratorio->id;
            $reserva->id_recurso = $request->dispositivo_id;
            $reserva->dia_entrega = $fecha_temp;
            $reserva->id_bloque_horario = $request->horario;
            $reserva->save();
            return redirect(route('crear_reserva_dispositivo',[$dispositivo->slug,$dispositivo->id]))->with('mensaje','¡Reserva creada!.');;            
        }
        else{
            return back()->with('error','El laboratorio ya fue reservado para la fecha solicitada.');            
        }
    }

    public function indexLaboratorio(){
        $laboratorios = DB::select('select * from laboratorios');
        return view('reservas.indexLaboratorios',compact('laboratorios'));
    }

    public function detalleLaboratorio($slug,$id){
        $reservas = DB::select("select * from reservas where id_laboratorio = '$id'");
        $laboratorio = Laboratorio::findOrFail($id);
        foreach ($reservas as $reserva) {
            $reserva->created_at = date('d-m-Y', strtotime($reserva->created_at));
            $reserva->dia_entrega = date('d-m-Y l', strtotime($reserva->dia_entrega));
            $horario = Horario::findOrFail($reserva->id_bloque_horario);
            $reserva->bloque_horario = date('H:i',strtotime($horario->hora_inicio)).' '.date('H:i',strtotime($horario->hora_fin));
            $encargado = User::findOrFail($reserva->id_encargado_salida);
            $reserva->id_encargado_salida = $encargado->name.' '.$encargado->apellido;
            if(strcmp('null',$reserva->id_encargado_recibo)!=0)
            {
                $encargado = User::findOrFail($reserva->id_encargado_recibo);
                $reserva->id_encargado_recibo = $encargado->name.' '.$encargado->apellido;
            }
        }
        return view('reservas.detalleLaboratorio',compact('reservas','laboratorio'));
    }

    public function crearReservaLaboratorio($slug,$id){
        $laboratorio = Laboratorio::findOrFail($id);
        $horarios = DB::select('SELECT * FROM horarios');
        $temp = getdate();
        $dia_actual = $temp['wday'];
        $indice = 1;
        if($dia_actual != 6){
            for ($i=$dia_actual;$i < 6;$i++){
            $dias[$indice] = date("Y-m-d l", strtotime("+$indice day"));
            $indice++;
            }
        }
        else{
            $dias = [];
        }

        foreach ($horarios as $horario){
            $horario->hora_inicio = date('H:i',strtotime($horario->hora_inicio));
            $horario->hora_fin = date('H:i',strtotime($horario->hora_fin));
        }
        
        return view('reservas.crearLaboratorio',compact('laboratorio','horarios','dias'));
    }

    public function guardarReservaLaboratorio(Request $request){
        $fecha_temp = date('Y-m-d H:i:s', strtotime($request->fechas_disponibles));
        $laboratorio = Laboratorio::findOrFail($request->laboratorio_id);
        $reserva_verificacion = DB::select("SELECT * 
                                            FROM reservas 
                                            WHERE id_laboratorio='$request->laboratorio_id'
                                            and dia_entrega = '$fecha_temp'
                                            and id_bloque_horario = '$request->horario'");
        if($reserva_verificacion == []){
            $reserva = new Reserva();
            $reserva->run = $request->run;
            $reserva->nombre = $request->nombre;
            $reserva->apellido = $request->apellido;
            $reserva->id_encargado_salida = auth()->user()->id;
            $reserva->id_encargado_recibo = 'null';
            $reserva->id_laboratorio = $request->laboratorio_id;
            $reserva->dia_entrega = $fecha_temp;
            $reserva->id_bloque_horario = $request->horario;
            $reserva->save();
            return redirect(route('crear_reserva_laboratorio',[$laboratorio->slug,$laboratorio->id]))->with('mensaje','¡Reserva creada!.');;
        }
        else{
            return back()->with('error','El laboratorio ya fue reservado para la fecha solicitada.');
        }
    }
}
////FALTA POR HACER
/* TO DO:
    + Registrar prestamos de laboratorios
    + Registrar reservas de laboratorios 
    + Eliminar el registro de dispositivos asignados en caso de eliminar una sala
    + Eliminar el registro de reservas en caso de que se elimine un dispositivo o una sala


    Registrar reserva -> tiempo de antelación
    Asignar dispositivos a laboratorio
    Busqueda de equipos
    Observación
*/
