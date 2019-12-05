<?php

namespace App\Http\Controllers;

use App\TblPublicacionImagenes;
use App\User;
use Illuminate\Http\Request;
use App\db_imagenes;
use Storage;

class MediaController extends Controller
{
	public function image($id){
		$img = db_imagenes::where('id',$id)->get();
	}
    public function upload(Request $request){

        $path = public_path();
        $imageName = time(microtime(true));
        $id_publi = $request->id;
        $files = $request->file('photo');
        $type = $request->type;



        if(!isset($files)){
            $response = array(
                'status' => 'fail',
                'msj' => 'File vacio',
                'code' => 0,
            );
            return response()->json($response);
        }


        $tmp_name = md5(($files->getClientOriginalName()).$imageName.'.'.($files->getClientOriginalExtension()));

        $files->move($path.'/upload', $tmp_name.'.'.$files->getClientOriginalExtension());


        $id=TblPublicacionImagenes::insertGetId(
            [
                'id_publicacion' => $id_publi,
                'ruta' => 'upload/'.$tmp_name.'.'.$files->getClientOriginalExtension(),
                'estado' => 'activo'
            ]
        );
        $data_attached = TblPublicacionImagenes::where('id',$id)->first();
        //editar si paso id

        if($type=='nivel'){
            $buscar = db_nivel::where('id',$id_publi)->first();
            $archivo = db_attached::where('id',$buscar->id_img)->first();

            db_nivel::where('id',$id_publi)->update(['id_img'=> $data_attached->id]);
        }

        $status = array(
            'status' => 'success',
            'id' => $id,
            'data' => config('app.url').'/'.$data_attached->ruta
        );
        return response()->json($status);
    }
    public function profileupload(Request $request){

        $path = public_path();
        $imageName = time(microtime(true));
        $id_publi = $request->id;
        $files = $request->file('photo');
        $type = $request->type;

        if(!isset($files)){
            $response = array(
                'status' => 'fail',
                'msj' => 'File vacio',
                'code' => 0,
            );
            return response()->json($response);
        }


        $tmp_name = md5(($files->getClientOriginalName()).$imageName.'.'.($files->getClientOriginalExtension()));

        $files->move($path.'/upload', $tmp_name.'.'.$files->getClientOriginalExtension());


        $id=TblPublicacionImagenes::insertGetId(
            [
                'ruta' => 'upload/'.$tmp_name.'.'.$files->getClientOriginalExtension(),
                'estado' => 'activo'
            ]
        );
        $data_attached = TblPublicacionImagenes::where('id',$id)->first();
        //editar si paso id
        User::where('id',$id_publi)->update(['avatar'=> $data_attached->id]);
        $user = User::where('id',$id_publi)->first();
        $status = array(
            'status' => 'success',
            'id' => $id,
            'data' => config('app.url').'/'.$data_attached->ruta,
            'user' => $user
        );
        return response()->json($status);
    }
}
