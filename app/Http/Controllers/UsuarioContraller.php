<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UsuarioContraller extends Controller
{
    public function registroMovil(Request $data){
        try {
            $usuario = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'cedula' => $data['cedula'],
                'direccion' => $data['direccion'],
                'telefono' => $data['telefono'],
                'nacimiento' => $data['nacimiento'],
                'genero' => $data['genero'],
                'token' => substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10)
            ]);
            return $usuario;
        } catch (\Throwable $th) {
            return '1';
        }  
    }

    public function loginMovil(Request $data){
        $usuario = DB::table('users')->where('email', $data['email'])->first();
        if (!Hash::check($data->password, $usuario->password)) {
            return '1';
        }else{
            return  response()->json($usuario) ;
        }

    }

    public function mostrarSintomas(){
        $sintomas = DB::table('sintomas')->where('activo', true)->get();
        
        
        return  response()->json($sintomas) ;
    }


    public function envioAnalisis(Request $data){

        $suma = DB::table('sintomas')->where('activo', true)->sum('gravedad');

        $gravedad_estado =0;
        $total = 0;
        foreach ($data->sintomas as $sintoma) {

            $sintoma_registrado = DB::table('sintomas_usuario')->where('usuario', $data->usuario)
            ->where('sintoma', $sintoma['key'])
            ->join('sintomas','sintomas_usuario.sintoma','=','sintomas.id')
            ->first();
            if($sintoma_registrado == null){
                DB::table('sintomas_usuario')->insert([
                    'usuario' => $data->usuario,
                    'sintoma' => $sintoma['key'],
                    'fecha_registro' => date('Y-m-d H:i:s'),
                    'avaluado' => $sintoma['selector']
                ]);
            }else{
                DB::table('sintomas_usuario')->where('id', $sintoma_registrado->id)->update([
                    'avaluado' =>  $sintoma['selector'],
                    'fecha_registro' => date('Y-m-d H:i:s')
                ]);
            }
            if( $sintoma['selector']){
                $total = $total + (int)$sintoma_registrado->gravedad;
               
            }
        }

        $p30 = $suma*0.3;
        $p50 = $suma * 0.5;
        $p80 = $suma * 0.8;

        if($total >= $p30){
            $gravedad_estado =1;
        }

        if($total >= $p50){
            $gravedad_estado =2;
        }

        if($total >= $p80){
            $gravedad_estado =3;
        }


        DB::table('users')->where('id', $data->usuario)->where('estado', '!=', '4')->update([
            'longitud' => $data->longitud,
            'latitud' => $data->latitud,
            'estado' => $gravedad_estado . ""
        ]);


        return '1';
    }

    public function verPuntosMapa(){
        //$users = factory(User::class, 3000)->create();
        
        $usuarios = DB::table('users')->where('existente', true)->where('tipo', 'Usuario')->where('estado', '!=', '0')->inRandomOrder()->limit(250)->get();
        $establecimientos = DB::table('establecimientos')->where('activo', true)->get();
        return  response()->json([
            "usuarios" => $usuarios,
            "establecimientos" => $establecimientos
        ]) ;
    }

    public function verTodasNoticias(){
        $noticias = DB::table('noticias')->where('activo', true)->orderBy('id', 'desc')->limit(25)->get();
        return  response()->json($noticias) ;
    }
    public function verTodasPreguntas(){
        $noticias = DB::table('preguntas')->where('activo', true)->orderBy('id', 'desc')->get();
        return  response()->json($noticias) ;
    }
    public function enviarPregunta(Request $datos){
       DB::table('preguntas')->insert([
        'pregunta' =>$datos['pregunta'],
        'respuesta' => ''
       ]);
       return '1';
    }

}
