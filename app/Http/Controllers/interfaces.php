<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class interfaces extends Controller
{
    public function __construct()
    {

        set_time_limit(0);
        $this->middleware('auth');
    } 

    public function registrar_sintomas(){
        if(Auth::user()->tipo == 'Administrador'){
            $sintomas = DB::table('sintomas')->where('activo', true)->get();
            return view('paginas.admin.sintomas', ['sintomas' => $sintomas]);
        }
        return redirect(route('home'));
    }
    public function registrar_sistema_post(Request $data){
        $existente = DB::table('sintomas')->where('nombre', $data->nombre)->where('activo', true)->first();


        if ( $existente != null) {
            return redirect(route('registrar_sintomas'))->with('error', 'Ya existe un síntoma registrado con ese nombre');
        }else{
            DB::table('sintomas')->insert([
                'nombre' =>  $data->nombre,
                'gravedad' =>  $data->gravedad
            ]);
            return redirect(route('registrar_sintomas'))->with('status', 'Síntomas registrados con éxito');
        }
       
    }

    public function registrar_dato_mapa(){
        if(Auth::user()->tipo == 'Administrador'){
            $usuarios = DB::table('users')->where('existente', true)->where('tipo', 'Usuario')->where('estado', '!=', '0')->get();
            $establecimientos = DB::table('establecimientos')->where('activo', true)->get();
            return view('paginas.admin.datos_mapa',[
                "usuarios" => $usuarios,
                "establecimientos" => $establecimientos
            ]);
        }
        return redirect(route('home'));
    }

    public function ingreso_usuario(Request $data){
        try {
            $usuario = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make("Password of user default"),
                'cedula' => $data['cedula'],
                'direccion' => $data['direccion'],
                'telefono' => $data['telefono'],
                'nacimiento' => $data['nacimiento'],
                'genero' => $data['genero'],
                'token' => substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10),
                'longitud' => $data['longitud'],
                'latitud' => $data['latitud'],
                'estado' => $data['estado']
            ]);
            return redirect(route('registrar_dato_mapa'))->with('status', 'Usuario agregado exitosamente');

        } catch (\Throwable $th) {
            return redirect(route('registrar_dato_mapa'))->with('error', 'No se puede registrar');

        }  
    }

    public function ingreso_establecimiento(Request $data){
        DB::table('establecimientos')->insert([
            'nombre' => $data['name_e'],
            'direccion' => $data['direccion_e'],
            'telefono' => $data['telefono_e'],
            'longitud' => $data['longitud_e'],
            'latitud' => $data['latitud_e'],
            'activo' => true,
        ]);
        return redirect(route('registrar_dato_mapa'))->with('status', 'Establecimiento agregado exitosamente');
    }

    public function noticias(){
        if(Auth::user()->tipo == 'Administrador'){
           $noticias = DB::table('noticias')->where('activo', true)->orderBy('id', 'desc')->limit(25)->get();
           return view('paginas.admin.noticias', ['noticias' => $noticias]);
        }
        return redirect(route('home'));
    }

    public function guardarNoticia(Request $datos){
        DB::table('noticias')->insert([
            'titulo' => $datos['titulo'],
            'descripcion' => $datos['detalle'],
            'referencia' => $datos['link'],
            'estado' => $datos['urgencia'],
        ]);
        return redirect(route('noticias'))->with('status', 'Noticia publicada con éxito');
    }

    public function preguntas(){
        if(Auth::user()->tipo == 'Administrador'){
           $preguntas = DB::table('preguntas')->where('activo', true)->orderBy('id', 'desc')->get();
           return view('paginas.admin.preguntas', ['preguntas' => $preguntas]);
        }
        return redirect(route('home'));
    }

    public function responder($id, Request $datos){
        DB::table('preguntas')->where('id', $id)->update([
            'respuesta' => $datos['respuesta'. $id]
        ]);
        return redirect(route('preguntas'))->with('status', 'Se ha respondido con éxito');
    }
}
