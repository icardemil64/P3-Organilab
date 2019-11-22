<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Hash;

class EncargadoController extends Controller
{
    public function index(Request $request){
        $request->user()->authorizeRoles(['admin']);
        $encargados = DB::select('  select u.id, u.run, u.name, u.apellido, u.email, u.celular 
                                    from users u,role_user ru  
                                    where (u.id=ru.user_id) and (ru.role_id=2)');
        return view('encargados.index',compact('encargados'));
    }



    public function crear(Request $request){
        $request->user()->authorizeRoles(['admin']);
        return view('encargados.crear');
    }



    public function guardarEncargado(Request $request){
        $validador = User::where('email',$request->email)->first();
        if($validador === NULL){
            $user =  User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'apellido' => $request['apellido'],
                'run' => $request['run'],
                'celular' => $request['celular'],
            ]);
            $user->roles()->attach(Role::where('name', 'user')->first());
            return redirect(route('inicio_encargados'))->with('mensaje','Encargado agregado!');
        }
        else{
            return back()->with('error','El encargado ya existe en el sistema. Cambiar email.');
        }
    }



    public function editarEncargado($id){
        $encargado = User::findOrFail($id);
        return view('encargados.editar',compact('encargado'));
    }



    public function guardarEncargadoActualizado(Request $request, $id){
        $encargado = User::findOrFail($id);
        $encargado->run = $request->run;
        $encargado->name = $request->name;
        $encargado->apellido = $request->apellido;
        $encargado->celular = $request->celular;
        $encargado->save();
        if($request->rol == 1)
        {
            DB::table('role_user')
            ->where('user_id',$id)
            ->update(['role_id'=>1]);
        }
        return redirect(route('inicio_encargados'))->with('mensaje','Encargado actualizado!');
    }



    public function eliminarEncargado($id){
        $encargado = User::findOrFail($id);
        $encargado -> delete();
        return redirect(route('inicio_encargados'))->with('mensaje','Encargado eliminado!');
    }
}
