<?php

namespace App\Http\Controllers;

use App\TblContactoPublicacion;
use Illuminate\Http\Request;
use App\db_user_cliente;

class MensajesController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
//        $contactos = db_user_cliente::all();

        $contactos  = db_user_cliente::join('users', 'producto_ventas.id_cliente','=','users.id')
            ->join('tbl_publicaciones', 'producto_ventas.id_producto','=','tbl_publicaciones.id')
            ->select('users.name','users.apellido','users.telefono','users.email','tbl_publicaciones.titulo','tbl_publicaciones.precio','producto_ventas.*')
            ->orderBy('producto_ventas.id', 'DESC')
            ->get();


        return view('mensajes.mensaje', compact('contactos'));
    }
    
    public function show($id){
        $contacto = db_user_cliente::find($id);

        if ($contacto->status == 'pedin') {

//            $contacto->update([
//                'status' => 'complete'
//            ]);

            $val = array(
                'status'=>'complete',
            );
            db_user_cliente::where('id', $id)->update($val);


        }
        $contactos  = db_user_cliente::join('users', 'producto_ventas.id_cliente','=','users.id')
            ->join('tbl_publicaciones', 'producto_ventas.id_producto','=','tbl_publicaciones.id')
            ->select('users.name','users.apellido','users.telefono','users.email','tbl_publicaciones.titulo','tbl_publicaciones.precio','producto_ventas.*')
            ->orderBy('producto_ventas.id', 'DESC')
            ->get();
        return view('mensajes.mensaje', compact('contactos'));
    }

    public function responder($id){
        $contacto = TblContactoPublicacion::find($id);
        
        return view('mensajes.responder', compact('contacto'));
    }

    public function borrar($id){
        $contacto = TblContactoPublicacion::find($id);
        $contacto->update([
            'estado' => 'inactivo'
        ]);

        return redirect('admin/mensajes');
    }
}
