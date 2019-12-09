<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Datetime;
use Illuminate\Support\Facades\Mail;

class loginController extends Controller
{
    public function login(Request $request){
        $device_token = $request->device_token;
        $email = $request->email;
        $password = $request->password;



        if(!isset($email)){
            $response = array(
                'status'=> 'fail',
                'msj'=> 'Email vacio',
                'code'=> 5,
            );


            return response()->json($response);
        }
        
        if(!isset($password)){
            $response = array(
                'status'=> 'fail',
                'msj'=> 'Password Vacio',
                'code'=> 5,
            );

            return response()->json($response);

        }


        if (Auth::attempt(['email' => $email, 'password' => $password])){
            $id_user = User::where('email',$email)->first();


            $data = User::find($id_user->id);

            $status=$id_user->estado;


            if($status=='inactivo'){
                $response = array(
                    'status'=> 'fail',
                    'msj'=> 'No Has verificado el correo',
                    'code'=> 5,
                );
            }else{
                $response = array(
                    'status'=> 'success',
                    'msj'=> '',
                    'stado'=> $status,
                    'data' => $data,
                    'code'=> 0,
                );
            }
            return response()->json($response);
        }else{
            $response = array(
                'status'=> 'fail',
                'msj'=> 'Credenciales Incorrectas',
                'code'=> 5,
            );

            return response()->json($response);
        }
    }

    public function recupera(Request $request){

        $device_token = $request->device_token;
        $email = $request->email;
        $password = $request->password;

        if(!isset($email)){
            $response = array(
                'status'=> 'fail',
                'msj'=> 'Email vacio',
                'code'=> 5,
            );

            return response()->json($response);
        }

        $r = User::where('email', $email)->exists();

        if ($r==false) {
            $response = array(
                'status' => 'fail',
                'msj' => 'ERROR! El email no existe',
                'code' => 5
            );
            return response()->json($response);
        }else{

            $id_user = User::where('email',$email)->first();

            $data = User::find($id_user->id);

            $url=config('app.url')."/recuperaform?id=$id_user->id&email=$id_user->email";

            $mail_config = array('name_app' => 'Rapipana', 'subtitle' => 'Recuperar password','name' => $data->name,'url' => $url,'msj' => 'recuperacion de password','to'=>$email);
            Mail::send('vendor.mail.sendtemplates.recupera',$mail_config, function ($m) use ($mail_config) {
                $m->from('no-reply@ziim.com', $mail_config['name_app']);
                $m->to($mail_config['to'])->subject($mail_config['subtitle']);
            });

            $response = array(
                'status'=> 'success',
                'msj'=> 'Te enviamos un correo puede tardar unos minutos',
                'data' => $data,
                'code'=> 0,
            );

            return response()->json($response);
        }

    }
    //ir al formulario de recuperar
    public function recuperaform(Request $request){

        $id = $request->id;
        $email = $request->email;


        if (!isset($id)) {
            $response = array(
                'status' => 'fail',
                'msj' => 'id  vacio',
                'code' => 5,
            );
            return response()->json($response);
        }
        if (!isset($email)) {
            $response = array(
                'status' => 'fail',
                'msj' => 'email  vacio',
                'code' => 5,
            );
            return response()->json($response);
        }
        $datauser= User::where('id',$id)->first();
        $email=User::where('email',$email)->first();

        return view('vendor.confir.recupera',['user'=>$datauser]);
    }


    public function cambiarpass(Request $request){

        $id = $request->id;
        $email = $request->email;
        $pass2= $request->pass;


        if (!isset($id)) {
            $response = array(
                'status' => 'fail',
                'msj' => 'id  vacio',
                'code' => 5,
            );
            return response()->json($response);
        }
        if (!isset($pass2)) {
            $response = array(
                'status' => 'fail',
                'msj' => 'codigo  vacio',
                'code' => 5,
            );
            return response()->json($response);
        }
        $tpass=User::where('email',$email)->count();



        if($tpass>0){

            $values2 = array(
                'password' => bcrypt($pass2)
            );
            User::where('id', $id)->update($values2);
            $datosuser = User::where('id',$id)->first();
            //         $email=$datosuser->email;
//            $mail_config = array('name_app' => 'Panel Administrador', 'subtitle' => 'Contraseña Actualizada','msj' => 'Confirmación del registro','to'=>$email);
//            Mail::send('vendor.mail.sendtemplates.recuperagood',$mail_config, function ($m) use ($mail_config) {
//                $m->from('no-reply@ziim.com', $mail_config['name_app']);
//                $m->to($mail_config['to'])->subject($mail_config['subtitle']);
//            });

            $datauser= User::where('id',$id)->first();
            return view('vendor.confir.recuperada',['user'=>$datauser,'mensaje'=>'Se restablecio su contraseña correctamente']);

        }else{
            return view('vendor.confir.recuperada',['user'=>'','mensaje'=>'No se pudo restaurar contraseña correctamente']);
        }


    }
    public function confir(Request $request){

        $id = $request->id;

        if (!isset($id)) {
            $response = array(
                'status' => 'fail',
                'msj' => 'id  vacio',
                'code' => 5,
            );
            return response()->json($response);
        }

        $datauser= User::where('id',$id)->first();
        if($datauser->estado == 'activo'){

            $response = array(
                'status' => 'fail',
                'msj' => 'Ya Estas Verificado',
                'code' => 5,
            );
            return response()->json($response);
        }else{
            $values = array(
                'estado' => 'activo',
            );
            User::where('id', $id)->update($values);
            $response = array(
                'status' => 'success',
                'msj' => 'Estatus actualizados',
                'code' => 0,
            );

            $datosuser = User::where('id',$id)->first();
            $email=$datosuser->email;

            $mail_config = array('name'=>$datauser->name,'name_app' => 'Rapipana', 'subtitle' => 'REGISTRO EXITOSO','msj' => 'Confirmación del registro','to'=>$email);
            Mail::send('vendor.mail.sendtemplates.registergood',$mail_config, function ($m) use ($mail_config) {
                $m->from('no-reply@ziim.com', $mail_config['name_app']);
                $m->to($mail_config['to'])->subject($mail_config['subtitle']);
            });

            //return response()->json($response);
            return view('vendor.confir.confir');
            // return redirect('confir/confir');

        }
    }


}
