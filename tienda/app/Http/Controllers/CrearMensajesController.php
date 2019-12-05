<?php

namespace App\Http\Controllers;

use App\db_products;
use App\db_user_cliente;
use App\TblContactoPublicacion;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Tbl_publicaciones;

class CrearMensajesController extends Controller
{
    //
    
    public function create(){
        $form = '
             <form action="mensajes" method="post">
                    '.csrf_field().'
                <input type="text" name="id_publicacion" id="" placeholder="id_publicacion">
                <input type="text" name="nombre" id="" placeholder="nombre">
                <input type="text" name="apellido" id="" placeholder="apellido">
                <input type="email" name="email" id="" placeholder="email">
                <input type="tel" name="telefono" id="" placeholder="telefono">
                <textarea name="descripcion" id="" cols="30" rows="10"></textarea>
                <input type="text" name="estado" value="leer">
                <input type="submit" value="Guardar">
            </form>';

        return $form;
    }
    
    public function store(Request $request){
        $input = $request->all();
        if ($request->get('id_publicacion') != "") {
           /* TblContactoPublicacion::create($input);
            
            $id_publicacion = $request->get('id_publicacion');
            $publicacion = Tbl_publicaciones::find($id_publicacion);
        */

            $data = array(
                'name'=>$request['nombre'],
                'telefono'=>$request['telefono'],
                'texto'=>$request['descripcion'],
             /*   'publicacion'=>$publicacion->titulo*/
                );
            Mail::send('email.email_contacto_publicacion', $data, function($message) {
                global $request;
                $message->to('yond1994@gmail.com', 'Apatxee.com')->subject
                ('Apatxee.com | Contacto por publicacíon');
                $message->from($request['email'],$request['nombre']);
            });
        }else{
            $data = array(
                'name'=>$request['nombre'],
                'texto'=>$request['descripcion'],
                'telefono'=>$request['telefono']
                );
            Mail::send('email.email', $data, function($message) {
                global $request;
                $message->to('contacto@agrofans.com', 'AgroFans.com')->subject
                ('AgroFans.com | Contacto');
                $message->from($request['email'],$request['nombre']);
            });
        }
    }
    public function comprar(Request $request){

        $id_publicacion = $request->id_publicacion;
        $id_cliente = $request->id_cliente;

        if(!isset($id_publicacion)){
            $response = array(
                'status'=> 'fail',
                'msj'=> 'Producto no exite',
                'code'=> 5,
            );
            return response()->json($response);
        }
        $r = Tbl_publicaciones::where('id', $id_publicacion)->exists();
        $u = User::where('id', $id_cliente)->exists();

        if ($u==false) {
            $response = array(
                'status' => 'fail',
                'msj' => 'El usuario no existe',
                'code' => 5
            );
            return response()->json($response);
        }
        if ($r==false) {
            $response = array(
                'status' => 'fail',
                'msj' => 'el producto no existe',
                'code' => 5
            );
            return response()->json($response);
        }else{

            $usuario= User::where('id',$id_cliente)->first();
           //$producto = Tbl_publicaciones::where('id', $id_publicacion)->first();

            $producto  = db_products::join('users', 'tbl_publicaciones.id_user','=','users.id')
                ->select('tbl_publicaciones.id','users.*','tbl_publicaciones.*')
                ->orderBy('tbl_publicaciones.id', 'DESC')
                ->where('tbl_publicaciones.id',$id_publicacion)
                ->first();




            //$url=config('app.url')."/recuperaform?id=$id_user->id&email=$id_user->email";

            $mail_config = array('name_app' => 'Tusite', 'subtitle' => 'Producto enviado','name' => $usuario->name,'url' => $producto->name,'vendedor' => $producto,'to'=>$usuario->email);
            Mail::send('vendor.mail.sendtemplates.dataproducto',$mail_config, function ($m) use ($mail_config) {
                $m->from('pedidos@proyectos2019.com', $mail_config['name_app']);
                $m->to($mail_config['to'])->subject($mail_config['subtitle']);
            });


//            $this->sendGCM();

            $mail_config2 = array('name_app' => 'Tu site', 'subtitle' => '¡Alguien compro tu producto!','name' => $producto->name,'url' => $producto->name,'producto'=>$producto,'cliente' => $usuario,'to'=>'pedidos@proyectos2019.com');
            Mail::send('vendor.mail.sendtemplates.dataprovendedor',$mail_config2, function ($m) use ($mail_config2) {
                $m->from('pedidos@proyectos2019.com', $mail_config2['name_app']);
                $m->to($mail_config2['to'])->subject($mail_config2['subtitle']);
            });

            $values = array(
                'vendido'=>'process',
            );
            $horas = Carbon::now();
            $qr = str_random(11);
            $valuesventa = array(
                'id_cliente'=>$usuario->id,
                'id_vendedor'=>$producto->id_user,
                'id_producto'=>$producto->id,
                'fecha'=>$horas,
                'status'=>'pedin',
                'qr'=>$qr
            );
            $id2=db_user_cliente::insertGetId($valuesventa);
//            Tbl_publicaciones::where('id', $id_publicacion)->update($values);

            $response = array(
                'status'=> 'success',
                'msj'=> 'Te enviamos un correo puede tardar unos minutos',
                'data' => $usuario,
                'venta' => $valuesventa,
                'producto' => $producto,
                'code'=> 0,
            );

            return response()->json($response);
        }

    }

    public function comprarvarios(Request $request){

        $datapedido = $request->data;
        $id_cliente = $request->id_cliente;




        if(!isset($id_cliente)){
            $response = array(
                'status'=> 'fail',
                'msj'=> 'Producto no exite',
                'code'=> 5,
            );
            return response()->json($response);
        }
        $u = User::where('id', $id_cliente)->exists();

        if ($u==false) {
            $response = array(
                'status' => 'fail',
                'msj' => 'el producto no existe',
                'code' => 5
            );
            return response()->json($response);
        }else{

            $usuario= User::where('id',$id_cliente)->first();
            //$producto = Tbl_publicaciones::where('id', $id_publicacion)->first();


            $array = $datapedido;
            $horas = Carbon::now();
            $qr = str_random(11);
            foreach ($array as $valor) {
                $name = $valor['name'];
                $producto = $valor['producto'];
                $vendedor = $valor['vendedor'];

                $valuesventa = array(
                    'id_cliente'=>$usuario->id,
                    'id_vendedor'=> $vendedor,
                    'id_producto'=>$producto,
                    'fecha'=>$horas,
                    'status'=>'pedin',
                    'qr'=>$qr
                );
                $id2=db_user_cliente::insertGetId($valuesventa);


            }





            //$url=config('app.url')."/recuperaform?id=$id_user->id&email=$id_user->email";

            $mail_config = array('name_app' => 'Rapipana', 'subtitle' => 'Producto enviado','name' => $usuario->name,'to'=>$usuario->email);
            Mail::send('vendor.mail.sendtemplates.productvarios',$mail_config, function ($m) use ($mail_config) {
                $m->from('pedidos@proyectos2019.com', $mail_config['name_app']);
                $m->to($mail_config['to'])->subject($mail_config['subtitle']);
            });


//            $this->sendGCM();

            $mail_config2 = array('name_app' => 'Rapipana', 'subtitle' => '¡Alguien compro tus producto!','name' => $usuario->name,'to'=>'pedidos@proyectos2019.com');
            Mail::send('vendor.mail.sendtemplates.productvarios2',$mail_config2, function ($m) use ($mail_config2) {
                $m->from('pedidos@proyectos2019.com', $mail_config2['name_app']);
                $m->to($mail_config2['to'])->subject($mail_config2['subtitle']);
            });

            $values = array(
                'vendido'=>'process',
            );

//            Tbl_publicaciones::where('id', $id_publicacion)->update($values);

            $response = array(
                'status'=> 'success',
                'msj'=> 'Te enviamos un correo puede tardar unos minutos',
                'data' => $usuario,
                'venta' => $valuesventa,
                'producto' => $producto,
                'code'=> 0,
            );

            return response()->json($response);
        }

    }

    public function sendGCM($message, $id) {


        $url = 'https://fcm.googleapis.com/fcm/send';

        $fields = array (
            'registration_ids' => array (
                $id
            ),
            'data' => array (
                "message" => $message
            )
        );
        $fields = json_encode ( $fields );

        $headers = array (
            'Authorization: key=' . "YOUR_KEY_HERE",
            'Content-Type: application/json'
        );

        $ch = curl_init ();
        curl_setopt ( $ch, CURLOPT_URL, $url );
        curl_setopt ( $ch, CURLOPT_POST, true );
        curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );

        $result = curl_exec ( $ch );
        echo $result;
        curl_close ( $ch );
    }

}

