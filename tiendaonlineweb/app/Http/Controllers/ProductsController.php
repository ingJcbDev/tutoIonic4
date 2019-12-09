<?php

namespace App\Http\Controllers;

use App\tblhorario;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\db_products;
use App\db_imagenes;
use DB;

class ProductsController extends Controller
{
	public function features(){
		$resultado = [];

        $date1 = Carbon::now()->toDateTimeString();
        $horas = Carbon::now();
        $horaac=$horas->toTimeString();



        $features = db_products::orderBy('id', 'DESC')->get();

        /* $features  = DB::table('tbl_publicaciones')
          ->join('users', 'tbl_publicaciones.id_user','=','users.id')
          ->select('tbl_publicaciones.*','users.latitude','users.longitude')
          ->orderBy('tbl_publicaciones.id', 'DESC')
          ->get();*/


        foreach ($features as $fea){

            $fea->setAttribute('area','yes');

            $date = $horas->format('l');
            $horabaseini = new Carbon($fea->hour_init);
            $horabasefin = new Carbon($fea->hour_finish);


            $diasdis='[{"day":"Monday","status":"true"},{"day":"Tuesday","status":"true"},{"day":"Wednesday","status":"true"},{"day":"Thursday","status":"true"},
            {"day":"Friday","status":"true"},{"day":"Saturday","status":"false"},{"day":"Sunday","status":"true"}]';


            $jArr = json_decode($fea->dais);

            foreach ($jArr as $di){
                if($di->day==$date){
                    if($di->status==false){
                        $fea->setAttribute('disponible','no');
                        $fea->setAttribute('horario','No disponible');
                    }else{
                        $fea->setAttribute('fachahoy',$horas);
                        $fea->setAttribute('diahoy',$date);

                        $horaaaaat = $horabaseini->toTimeString() < $horas->toTimeString();
                        $horafin =   $horabasefin->toTimeString() > $horas->toTimeString();


                        if ($horaaaaat == false ){
                            $fechaEmision = Carbon::parse($fea->hour_init);
                            $diasDiferencia = $fechaEmision->diffInHours($horas);
                            $fea->setAttribute('disponible','no');
                            $fea->setAttribute('horario',' Disponible en '.$diasDiferencia. ' horas');
                        }elseif ($horafin == false ){
                            $fechaEmision = Carbon::parse($fea->hour_init);
                            $diasDiferencia = $fechaEmision->diffInHours($horas);
                            $fea->setAttribute('disponible','no');
                            $fea->setAttribute('horario',' Disponible en '.$diasDiferencia. ' horas');
                        }elseif($carbon = new Carbon($fea->date_finish) < $date1  ){
                            $fechaEmision = Carbon::parse($fea->date_finish);
                            $diasDiferencia = $fechaEmision->diffInHours($horas);
                            $fea->setAttribute('disponible','no');
                            $fea->setAttribute('horario','No disponible');
                        }elseif ($carbon = new Carbon($fea->date_init) > $date1  ){
                            $fechaEmision = Carbon::parse($fea->date_init);
                            $diasDiferencia = $fechaEmision->diffInHours($horas);
                            $fea->setAttribute('disponible','no');
                            $fea->setAttribute('horario','Disponible en '.$diasDiferencia. ' horas');
                        }else{
                            $fea->setAttribute('disponible','ahora');
                            $fea->setAttribute('horario',' Disponible Ahora');
                        }
                        /*$fea::whereDate('date_finish','>=',$date1)->whereDate('date_init','<=',$date1)->
                        whereTime('hour_init', '<=', $horaac)->whereTime('hour_finish', '>=', $horaac)->get();*/
                    }
                    }
                }
            }


//        $features = db_products::orderBy('updated_at', 'ASC')->take(8)->get();

		foreach ($features as $fea) {

			$img = db_imagenes::where('id_publicacion',$fea->id)->get();

			$resultado[] = array(
				'publicacion' => $fea, 
				'images' => $img
				);
		}

		
		return response()->json($resultado);
	}

    public function getcordenadas(Request $request){
        $resultado = [];

        $date1 = Carbon::now()->toDateTimeString();
        $horas = Carbon::now();
        $horaac=$horas->toTimeString();

        $latitude = $request->latitude;
        $longitude = $request->longitude;


        //$features = DB::table('tbl_publicaciones')->orderBy('id', 'DESC')->get();


        //$features = db_products::orderBy('id', 'DESC')->get();

        $features  = db_products::join('users', 'tbl_publicaciones.id_user','=','users.id')
            ->select('tbl_publicaciones.*','users.latitude','users.longitude')
            ->orderBy('tbl_publicaciones.id', 'DESC')
            ->whereDate('date_finish','>=',$date1)
            ->whereDate('date_init','<=',$date1)
            ->where('tbl_publicaciones.vendido','no')
            ->get();


        $contadorpro=0;
        foreach ($features as $fea){

            $latitude1 =$fea->latitude;
            $longitude1 =$fea->longitude;
            $latitude2 =$latitude;
            $longitude2 =$longitude;

                $earth_radius = 6371;

                $dLat = deg2rad( $latitude2 - $latitude1 );
                $dLon = deg2rad( $longitude2 - $longitude1 );

                $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * sin($dLon/2) * sin($dLon/2);
                $c = 2 * asin(sqrt($a));
                $d = $earth_radius * $c;


            if( $d < 15 ) {
                $fea->setAttribute('area','yes');
                $contadorpro = $contadorpro+1;
            } else {
                $fea->setAttribute('area','no');
            }


            $date = $horas->format('l');
            $horabaseini = new Carbon($fea->hour_init);
            $horabasefin = new Carbon($fea->hour_finish);


            $diasdis='[{"day":"Monday","status":"true"},{"day":"Tuesday","status":"true"},{"day":"Wednesday","status":"true"},{"day":"Thursday","status":"true"},
            {"day":"Friday","status":"true"},{"day":"Saturday","status":"false"},{"day":"Sunday","status":"true"}]';


            $jArr = json_decode($fea->dais);

            foreach ($jArr as $di){
                if($di->day==$date){
                    if($di->status==false){
                        $fea->setAttribute('disponible','no');
                        $fea->setAttribute('horario','No Disponible');
                    }else{
                        $fea->setAttribute('fachahoy',$horas);
                        $fea->setAttribute('diahoy',$date);

                        $horaaaaat = $horabaseini->toTimeString() < $horas->toTimeString();
                        $horafin =   $horabasefin->toTimeString() > $horas->toTimeString();


                        if ($horaaaaat == false ){
                            $fechaEmision = Carbon::parse($fea->hour_init);
                            $diasDiferencia = $fechaEmision->diffInHours($horas);
                            $fea->setAttribute('disponible','no');
                            $fea->setAttribute('horario',' Disponible en '.$diasDiferencia. ' h');
                        }elseif ($horafin == false ){
                            $fechaEmision = Carbon::parse($fea->hour_init);
                            $diasDiferencia = $fechaEmision->diffInHours($horas);
                            $fea->setAttribute('disponible','no');
                            $fea->setAttribute('horario',' Disponible en '.$diasDiferencia. ' h');
                        }elseif($carbon = new Carbon($fea->date_finish) < $date1  ){
                            $fechaEmision = Carbon::parse($fea->date_finish);
                            $diasDiferencia = $fechaEmision->diffInHours($horas);
                            $fea->setAttribute('disponible','no');
                            $fea->setAttribute('horario','No disponible 2');
                        }elseif ($carbon = new Carbon($fea->date_init) > $date1  ){
                            $fechaEmision = Carbon::parse($fea->date_init);
                            $diasDiferencia = $fechaEmision->diffInHours($horas);
                            $fea->setAttribute('disponible','no');
                            $fea->setAttribute('horario','Disponible en '.$diasDiferencia. ' h');
                        }else{
                            $fea->setAttribute('disponible','ahora');
                            $fea->setAttribute('horario',' Disponible Ahora');
                        }
                        /*$fea::whereDate('date_finish','>=',$date1)->whereDate('date_init','<=',$date1)->
                        whereTime('hour_init', '<=', $horaac)->whereTime('hour_finish', '>=', $horaac)->get();*/
                    }
                }
            }
        }


//        $features = db_products::orderBy('updated_at', 'ASC')->take(8)->get();

        foreach ($features as $fea) {

            $img = db_imagenes::where('id_publicacion',$fea->id)->get();

            $resultado[] = array(
                'publicacion' => $fea,
                'images' => $img
            );
        }

        $resultados = array(
            'resp' => $resultado,
            'contada' => $contadorpro,
        );



        return response()->json($resultados);
    }
    public function buscarm(Request $request, $src){

        $resultado = [];

        $date1 = Carbon::now()->toDateTimeString();
        $horas = Carbon::now();
        $horaac=$horas->toTimeString();

        $latitude = $request->latitude;
        $longitude = $request->longitude;

        $features  = db_products::join('users', 'tbl_publicaciones.id_user','=','users.id')
            ->select('tbl_publicaciones.*','users.latitude','users.longitude')
            ->orderBy('tbl_publicaciones.id', 'DESC')
            ->whereDate('date_finish','>=',$date1)
            ->whereDate('date_init','<=',$date1)
            ->where('titulo', 'LIKE', "%$src%")
            ->where('tbl_publicaciones.vendido','no')
            ->get();

        $contadorpro=0;
        foreach ($features as $fea){

            $latitude1 =$fea->latitude;
            $longitude1 =$fea->longitude;
            $latitude2 =$latitude;
            $longitude2 =$longitude;

            $earth_radius = 6371;

            $dLat = deg2rad( $latitude2 - $latitude1 );
            $dLon = deg2rad( $longitude2 - $longitude1 );

            $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * sin($dLon/2) * sin($dLon/2);
            $c = 2 * asin(sqrt($a));
            $d = $earth_radius * $c;


            if( $d < 15 ) {
                $fea->area='yes';
                $contadorpro = $contadorpro+1;
            } else {
                $fea->area='no';
            }

            $date = $horas->format('l');
            $horabaseini = new Carbon($fea->hour_init);
            $horabasefin = new Carbon($fea->hour_finish);


            $jArr = json_decode($fea->dais);

            foreach ($jArr as $di){
                if($di->day==$date){
                    if($di->status==false){
                        $fea->disponible='no';
                        $fea->disponible='No Disponible';
                    }else{
                        $fea->fachahoy=$horas;
                        $fea->diahoy=$date;
                        $horaaaaat = $horabaseini->toTimeString() < $horas->toTimeString();
                        $horafin =   $horabasefin->toTimeString() > $horas->toTimeString();
                        if ($horaaaaat == false ){
                            $fechaEmision = Carbon::parse($fea->hour_init);
                            $diasDiferencia = $fechaEmision->diffInHours($horas);
                            $fea->disponible='no';
                            $fea->horario = ' Disponible en '.$diasDiferencia. ' h';
                        }elseif ($horafin == false ){
                            $fechaEmision = Carbon::parse($fea->hour_init);
                            $diasDiferencia = $fechaEmision->diffInHours($horas);
                            $fea->disponible='no';
                            $fea->horario = ' Disponible en '.$diasDiferencia. ' h';
                        }elseif($carbon = new Carbon($fea->date_finish) < $date1  ){
                            $fechaEmision = Carbon::parse($fea->date_finish);
                            $diasDiferencia = $fechaEmision->diffInHours($horas);
                            $fea->disponible = 'no';
                            $fea->horario = 'No disponible 2';
                        }elseif ($carbon = new Carbon($fea->date_init) > $date1){
                            $fechaEmision = Carbon::parse($fea->date_init);
                            $diasDiferencia = $fechaEmision->diffInHours($horas);
                            $fea->disponible='no';
                            $fea->horario ='Disponible en '.$diasDiferencia. ' h';
                        }else{
                            $fea->disponible ='ahora';
                            $fea->horario = 'Disponible Ahora';
                        }
                        /*$fea::whereDate('date_finish','>=',$date1)->whereDate('date_init','<=',$date1)->
                        whereTime('hour_init', '<=', $horaac)->whereTime('hour_finish', '>=', $horaac)->get();*/
                    }
                }
            }
        }


//        $features = db_products::orderBy('updated_at', 'ASC')->take(8)->get();

        if (count($features)>0) {
            foreach ($features as $fea) {
                $img = db_imagenes::where('id_publicacion',$fea->id)->get();
                $resultado[] = array(
                    'publicacion' => $fea,
                    'images' => $img
                );
            }
            $resultados = array(
                'resp' => $resultado,
                'contada' => $contadorpro,
            );
        }else{
            $resultados = array(
                'resp' => [],
                'contada' => $contadorpro,
            );
        }
        return response()->json($resultados);

    }


    public function productuser($id){

        $resultado = [];

        $date1 = Carbon::now()->toDateTimeString();
        $horas = Carbon::now();
        $horaac=$horas->toTimeString();

        $user= User::where('id',$id)->first();
        $features = db_products::where('id_user',$id)->orderBy('updated_at', 'ASC')->get();
        foreach ($features as $fea){



            $date = $horas->format('l');
            $horabaseini = new Carbon($fea->hour_init);
            $horabasefin = new Carbon($fea->hour_finish);


            $diasdis='[{"day":"Monday","status":"true"},{"day":"Tuesday","status":"true"},{"day":"Wednesday","status":"true"},{"day":"Thursday","status":"true"},
            {"day":"Friday","status":"true"},{"day":"Saturday","status":"false"},{"day":"Sunday","status":"true"}]';


            $jArr = json_decode($fea->dais);

            foreach ($jArr as $di){
                if($di->day==$date){
                    if($di->status==false){
                        $fea->setAttribute('disponible','no');
                        $fea->setAttribute('horario','No Disponible');
                    }else{
                        $fea->setAttribute('fachahoy',$horas);
                        $fea->setAttribute('diahoy',$date);

                        $horaaaaat = $horabaseini->toTimeString() < $horas->toTimeString();
                        $horafin =   $horabasefin->toTimeString() > $horas->toTimeString();


                        if ($horaaaaat == false ){
                            $fechaEmision = Carbon::parse($fea->hour_init);
                            $diasDiferencia = $fechaEmision->diffInHours($horas);
                            $fea->setAttribute('disponible','no');
                            $fea->setAttribute('horario',' Disponible en '.$diasDiferencia. ' h');
                        }elseif ($horafin == false ){
                            $fechaEmision = Carbon::parse($fea->hour_init);
                            $diasDiferencia = $fechaEmision->diffInHours($horas);
                            $fea->setAttribute('disponible','no');
                            $fea->setAttribute('horario',' Disponible en '.$diasDiferencia. ' h');
                        }elseif($carbon = new Carbon($fea->date_finish) < $date1  ){
                            $fechaEmision = Carbon::parse($fea->date_finish);
                            $diasDiferencia = $fechaEmision->diffInHours($horas);
                            $fea->setAttribute('disponible','no');
                            $fea->setAttribute('horario','No disponible 2');
                        }elseif ($carbon = new Carbon($fea->date_init) > $date1  ){
                            $fechaEmision = Carbon::parse($fea->date_init);
                            $diasDiferencia = $fechaEmision->diffInHours($horas);
                            $fea->setAttribute('disponible','no');
                            $fea->setAttribute('horario','Disponible en '.$diasDiferencia. ' h');
                        }else{
                            $fea->setAttribute('disponible','ahora');
                            $fea->setAttribute('horario',' Disponible Ahora');
                        }
                        /*$fea::whereDate('date_finish','>=',$date1)->whereDate('date_init','<=',$date1)->
                        whereTime('hour_init', '<=', $horaac)->whereTime('hour_finish', '>=', $horaac)->get();*/
                    }
                }
            }
        }


//        $features = db_products::orderBy('updated_at', 'ASC')->take(8)->get();

        foreach ($features as $fea) {

            $img = db_imagenes::where('id_publicacion',$fea->id)->get();

            $resultado[] = array(
                'publicacion' => $fea,
                'images' => $img,
                'user'=>$user


            );

        }



        return response()->json($resultado);
    }

    public function producventa($id){

        $resultado = [];

        $date1 = Carbon::now()->toDateTimeString();
        $horas = Carbon::now();
        $horaac=$horas->toTimeString();

        $user= User::where('id',$id)->first();


        $productos  = DB::table('producto_ventas')
            ->join('tbl_publicaciones', 'tbl_publicaciones.id','=','producto_ventas.id_producto')
            ->join('users', 'users.id','=','producto_ventas.id_vendedor')
            ->where('producto_ventas.id_cliente',$id)
            ->where('producto_ventas.status','=','pedin')
            ->select('tbl_publicaciones.*','producto_ventas.fecha','producto_ventas.status','users.name' )
            ->get();

//

        foreach ($productos as $fea) {
            $img = db_imagenes::where('id_publicacion',$fea->id)->get();
            $resultado[] = array(
                'publicacion' => $fea,
                'images' => $img,
                'user'=>$user


            );

        }
        return response()->json($resultado);
    }
    public function getdataventa($id){

        $resultado = [];

        $date1 = Carbon::now()->toDateTimeString();
        $horas = Carbon::now();
        $horaac=$horas->toTimeString();

        $user= User::where('id',$id)->first();




        $productos  = DB::table('producto_ventas')
            ->join('tbl_publicaciones', 'tbl_publicaciones.id','=','producto_ventas.id_producto')
            ->join('users', 'users.id','=','producto_ventas.id_cliente')
            ->where('producto_ventas.id_vendedor',$id)
            ->where('producto_ventas.status','=','pedin')
            ->select('tbl_publicaciones.*','producto_ventas.fecha','producto_ventas.status','users.id AS clienteid','users.name AS clientename',
                'users.direccion AS clienteaddres', 'users.latitude AS clientelatitud','users.longitude AS clientelongitud','users.telefono AS clientetelefono',
                'users.email AS clienteemail')
            ->get();


//

        foreach ($productos as $fea) {
            $img = db_imagenes::where('id_publicacion',$fea->id)->get();
            $resultado[] = array(
                'publicacion' => $fea,
                'images' => $img,
                'user'=>$user


            );

        }



        return response()->json($resultado);
    }

}
