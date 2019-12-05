<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegisterUser extends Controller
{
    public function datosuser(Request $request){

        $nombre = $request->nombre;
        $apellido = $request->apellido;
        $email = $request->email;
        $telefono = $request->telefono;
        $password = $request->password;
        $direccion = $request->direccion;
        $latitude = $request->latitude;
        $longitude = $request->longitude;

        $r = User::where('email', $email)->exists();

        if ($r==true) {
            $response = array(
                'status' => 'fail',
                'msj' => 'El email ya existe',
                'code' => 5
            );
            return response()->json($response);
        }

        $values = array(
            'name' => $nombre,
            'apellido' => $apellido,
            'email' => $email,
            'estado'=>'activo',
            'telefono'=>$telefono,
            'password'=>Hash::make($password),
            'direccion'=>$direccion,
            'latitude'=>$latitude,
            'longitude'=>$longitude,
        );
        $id2=User::insertGetId($values);

       /* $url=config('app.url')."/confir?id=$id2";

        $mail_config = array('url'=>$url,'name_app' => 'APATXEE', 'subtitle' => 'REGISTRO EXITOSO','msj' => 'Confirmación del registro','to'=>$email);
        Mail::send('vendor.mail.sendtemplates.register',$mail_config, function ($m) use ($mail_config) {
            $m->from('no-reply@ziim.com', $mail_config['name_app']);
            $m->to($mail_config['to'])->subject($mail_config['subtitle']);
        });*/

        $response = array(
            'status' => 'success',
            'msj' => 'Usuario Registrado',
            'data' => $values,
            'code' => 0,
        );
        return response()->json($response);
    }


    public function getuser(Request $request){

        $id = $request->id;
        $u = User::where('id', $id)->firts();

        $response = array(
            'status' => 'success',
            'msj' => 'Usuario',
            'data' => $u,
            'code' => 0,
        );
        return response()->json($response);
    }
    public function putuser(Request $request){

        $id = $request->id;
        $nombre = $request->nombre;
        $apellido = $request->apellido;
        $telefono = $request->telefono;
        $direccion = $request->direccion;
        $latitude = $request->latitude;
        $longitude = $request->longitude;

        $values = array(
            'name' => $nombre,
            'apellido' => $apellido,
            'telefono'=>$telefono,
            'direccion'=>$direccion,
            'latitude'=>$latitude,
            'longitude'=>$longitude,
        );
        $valores = User::where('id', $id)->update($values);
        $r = User::where('id', $id)->first();

        $response = array(
            'status' => 'success',
            'msj' => 'Editado correctamente',
            'data' => $r,
            'guardo' => $valores,
            'code' => 0,
        );
        return response()->json($response);
    }
}
