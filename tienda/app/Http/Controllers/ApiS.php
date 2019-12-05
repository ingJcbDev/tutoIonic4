<?php

namespace App\Http\Controllers;

use App\db_imagenes;
use App\Tbl_Categoria;
use App\Tbl_newsleter;
use App\Tbl_publicaciones;
use App\TblAtributosGlobales;
use App\TblCategoriaAtributos;
use App\TblPublicacionAtributosGlobales;
use App\TblPublicacionCategoria;
use App\TblPublicacionImagenes;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;
use DB;


class ApiS extends Controller
{
    public function categoriasAll(){
        $categorias = array();
        $categorias_all=Tbl_Categoria::all();
 
            foreach ($categorias_all as $cat) {
                if($cat->id_padre == 0){

                $categorias[] = array(
                        'parent'=>$cat->id,
                        'name'=>$cat->nombre,
			'id_padre'=>$cat->id_padre,
                        'subscat'=>Tbl_Categoria::where('id_padre',$cat->id)->get(),
                        );
            }
        }
            
        return response()->json($categorias);
    }

    public function categoriasId($id){
        $categorias = Tbl_Categoria::find($id);
        $atrCate = $categorias->categoriaAtributos;

        foreach ($atrCate as $atributos){
            $atr = TblAtributosGlobales::find($atributos->id);
            $atr->atrGlobalValores;

            //array_push($categorias, 'atr', $atr);
        }
        dd($categorias);

    }

    public function publicacionesAll(){
        $publicacion = Tbl_publicaciones::paginate(12);
        return $publicacion;
    }

    public function publicacionesId($id){

        $date1 = Carbon::now()->toDateTimeString();
        $horas = Carbon::now();
        $horaac=$horas->toTimeString();

        $publicaciones = Tbl_publicaciones::find($id);
        ////

        $resultado = [];
        $features = Tbl_publicaciones::find($id);


            $date = $horas->format('l');
            $horabaseini = new Carbon($features->hour_init);
            $horabasefin = new Carbon($features->hour_finish);

            $jArr = json_decode($features->dais);

            foreach ($jArr as $di){
                if($di->day==$date){
                    if($di->status==false){
                        $features->setAttribute('disponible','no');
                        $features->setAttribute('horario','No disponible');
                    }else{
                        $features->setAttribute('fachahoy',$horas);
                        $features->setAttribute('diahoy',$date);

                        $horaaaaat = $horabaseini->toTimeString() < $horas->toTimeString();
                        $horafin =   $horabasefin->toTimeString() > $horas->toTimeString();

                        if ($horaaaaat == false ){
                            $fechaEmision = Carbon::parse($features->hour_init);
                            $diasDiferencia = $fechaEmision->diffInHours($horas);
                            $features->setAttribute('disponible','no');
                            $features->setAttribute('horario',' Disponible en '.$diasDiferencia. ' horas');
                        }elseif ($horafin == false ){
                            $fechaEmision = Carbon::parse($features->hour_init);
                            $diasDiferencia = $fechaEmision->diffInHours($horas);
                            $features->setAttribute('disponible','no');
                            $features->setAttribute('horario',' Disponible en '.$diasDiferencia. ' horas');
                        }elseif($carbon = new Carbon($features->date_finish) <= $date1  ){
                            $fechaEmision = Carbon::parse($features->date_finish);
                            $diasDiferencia = $fechaEmision->diffInHours($horas);
                            $features->setAttribute('disponible','no');
                            $features->setAttribute('horario','No disponible');
                        }elseif ($carbon = new Carbon($features->date_init) >= $date1  ){
                            $fechaEmision = Carbon::parse($features->date_init);
                            $diasDiferencia = $fechaEmision->diffInHours($horas);
                            $features->setAttribute('disponible','no');
                            $features->setAttribute('horario','Disponible en '.$diasDiferencia. ' horas');
                        }else{
                            $features->setAttribute('disponible','ahora');
                            $features->setAttribute('horario',' Disponible Ahora');
                        }
                    }
                }
            }

        ////
        ///
        $publicaciones->features = $features;
        $publicaciones->publicacionImagen;
        $publicaciones->publicacionCategoria;
        $publicaciones->publicacionAtributos;
        return $publicaciones;
    }

    public function recomendados($id){
        $recomendados = TblPublicacionCategoria::where('id_categoria',$id)->orderBy('created_at','DESC')->take(4)->get();
        return response()->json($recomendados);
    }

    public function productscat($id){
          $publicaciones = array();
	$id_categorias = array();
	$atributos = [];


        $date1 = Carbon::now()->toDateTimeString();
        $horas = Carbon::now();
        $horaac=$horas->toTimeString();


        $id = DB::table('tbl_categoria')->where('id',$id)->first();

     	if($id->id_padre == 0){
	
	        $categohijas = DB::table('tbl_categoria')->where('id_padre',$id->id)->get();
	
        foreach(  $categohijas  as $ch){
        $id_categorias[] = $ch->id;
        }
        }else{
        $id_categorias[0] = $id->id;
        }

        $cat_attr = DB::table('tbl_publicaciones')->join('tbl_publicacion_categoria', 'id_producto', '=', 'tbl_publicaciones.id')->whereIn('id_categoria',$id_categorias)->get();
        foreach ($cat_attr as $key) {
            $publi_attr = DB::table('tbl_publicaciones')->where('id',$key->id_producto)->get();

            foreach ($publi_attr as $pattr) {
                $publicaciones['publicaciones'][$key->id]=$pattr;
                $attr_ = DB::table('tbl_publicacion_atributos_globales')->where('id_publicacion',$key->id_producto)->get();
                $publicaciones['valores_'][$key->id] = $attr_;             
                
                foreach ($attr_ as $at_) {
                    $valor_ = DB::table('tbl_atributos_globales')->where('id',$at_->id_atributo)->first();
                    $publicaciones['atributos'][$at_->id_atributo] = $valor_;    
                }
          
           }

           $publicaciones['imagen'][$key->id]=DB::table('tbl_publicacion_imagenes')->where('id_publicacion',$key->id_producto)->get();
        }

        foreach ($publicaciones['valores_'] as $key) {
            foreach ($key as $value) {
                $publicaciones['valores'][$value->id_atributo][]=array(
                    'id_publicacion' => $value->id_publicacion,
                    'valor' => $value->valor_atributo,
                    'id_atributo' => $value->id_atributo,
                    'cat' => $id
                    );
            }
        }


        $publicaciones['publicaciones'] =DB::table('tbl_publicaciones')->join('tbl_publicacion_categoria', 'id_producto', '=', 'tbl_publicaciones.id')->whereIn('id_categoria',$id_categorias)->whereDate('date_finish','>=',$date1)->whereDate('date_init','<=',$date1)->
        whereTime('hour_init', '<=', $horaac)->whereTime('hour_finish', '>=', $horaac)->paginate(6);
        $publicaciones['pagination'] =DB::table('tbl_publicaciones')->join('tbl_publicacion_categoria', 'id_producto', '=', 'tbl_publicaciones.id')->whereIn('id_categoria',$id_categorias)->whereDate('date_finish','>=',$date1)->whereDate('date_init','<=',$date1)->
        whereTime('hour_init', '<=', $horaac)->whereTime('hour_finish', '>=', $horaac)->paginate(6);
	
	//$publicaciones['atributos']

        return response()->json($publicaciones);
    
    /*

        $main_cat = array();
        //$publicaciones = TblPublicacionCategoria::where('id_categoria',$id)->get();
        $id = Tbl_Categoria::where('nombre',$slug)->first();
        $id = $id->id;
        $publicaciones = TblPublicacionCategoria::where('id_categoria',$id)->paginate(6);
        $allCategorias = Tbl_Categoria::where('id',$id)->get();
        if($allCategorias[0]->id_padre!=0){
            $main_cat[] = Tbl_Categoria::where('id',$allCategorias[0]->id_padre)->first();
            $main_cat[] = $allCategorias[0];            

        }else{
            $main_cat[] = $allCategorias[0];
        }

        $imagen = [];
        $attr = [];
        $publi_single = [];
        $categoria = [];

        $publicImag = [];
        $atributos = [];

        foreach ($publicaciones as $publicacione) {
            $id = $publicacione->id_producto;
            $pubfill[] = Tbl_publicaciones::find($id);
            //$publi_single[] = Tbl_publicaciones::find($id);
            //$publi_single[] = Tbl_publicaciones::where('id',$id)->orderBy('created_at','DESC')->first();
            $publi_single[] = Tbl_publicaciones::where('id',$id)->orderBy('created_at','DESC')->first();
            $publicImag[$id] = Tbl_publicaciones::find($id);
            $attr[$id] = $publicImag[$id]->publicacionAtributos;
            $imagen[$id] = $publicImag[$id]->publicacionImagen;
            $categoria[$id] = $publicImag[$id]->publicacionCategoria;


        }

        /* foreach ($attr as $key => $value) {
            $attri_tmp[]=array(
                'id_p'=>$key,
                'attr'=>$value
            );
            foreach ($value as $values){
                //echo $values;
                $atributos[$values->id] = TblAtributosGlobales::find($values->id);
                $atributos[$values->id]->publicaciones;
            }

        }

        $array = array_reverse(array_sort($publi_single, function ($value) {
            return $value['created_at'];
        }));

        $paginator = new Paginator($array, 2, 10);
        //$paginator = Paginator::make($array, count($array), 2);
        $page = Input::get('page', 1);
        $perPage = 2;
        $offset = ($page * $perPage) - $perPage;

        $publicaciones = array(
            'last_page'=>$publicaciones->lastPage()
            );
        $publicaciones['data'] = $pubfill;

        $buscar = [
            //"publicaciones" => $publi_single,
            "publicaciones" => $publicaciones,
            //"publicaciones" => $paginator,
            'imagen' => $imagen,
            //'publicacion_atributos' => $attr,
            'atributos' => $atributos,
            //'publicacion_categoria' => $categoria
            'publicacion_categoria' => $main_cat
        ];
        return $buscar;

        //return $publicImag;
*/
    }



    public function productscatmovil($id, Request $request){

        $publicaciones = array();
        $id_categorias = array();
        $atributos = [];
        $date1 = Carbon::now()->toDateTimeString();
        $horas = Carbon::now();
        $horaac=$horas->toTimeString();

        $latitude = $request->latitude;
        $longitude = $request->longitude;


        $id = DB::table('tbl_categoria')->where('id',$id)->first();

        if($id->id_padre == 0){
            $categohijas = DB::table('tbl_categoria')->where('id_padre',$id->id)->get();
            foreach(  $categohijas  as $ch){
                $id_categorias[] = $ch->id;
            }
        }else{
            $id_categorias[0] = $id->id;
        }

//        foreach ($cat_attr as $key) {
//            $publi_attr = DB::table('tbl_publicaciones')->where('id',$key->id_producto)->get();
//
//            foreach ($publi_attr as $pattr) {
//                $publicaciones['publicaciones'][$key->id]=$pattr;
//                $attr_ = DB::table('tbl_publicacion_atributos_globales')->where('id_publicacion',$key->id_producto)->get();
//                $publicaciones['valores_'][$key->id] = $attr_;
//
//                foreach ($attr_ as $at_) {
//                    $valor_ = DB::table('tbl_atributos_globales')->where('id',$at_->id_atributo)->first();
//                    $publicaciones['atributos'][$at_->id_atributo] = $valor_;
//                }
//
//            }
//
//            $publicaciones['imagen'][$key->id]=DB::table('tbl_publicacion_imagenes')->where('id_publicacion',$key->id_producto)->get();
//        }
//
//        foreach ($publicaciones['valores_'] as $key) {
//            foreach ($key as $value) {
//                $publicaciones['valores'][$value->id_atributo][]=array(
//                    'id_publicacion' => $value->id_publicacion,
//                    'valor' => $value->valor_atributo,
//                    'id_atributo' => $value->id_atributo,
//                    'cat' => $id
//                );
//            }
//        }

        $features = DB::table('tbl_publicaciones')
            ->join('tbl_publicacion_categoria', 'id_producto', '=', 'tbl_publicaciones.id')
            ->join('users', 'tbl_publicaciones.id_user','=','users.id')
            ->select('tbl_publicaciones.*','users.latitude','users.longitude')
            ->orderBy('tbl_publicaciones.id', 'DESC')
            ->whereDate('date_finish','>=',$date1)
            ->whereDate('date_init','<=',$date1)
            ->whereIn('id_categoria',$id_categorias)
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


            $diasdis='[{"day":"Monday","status":"true"},{"day":"Tuesday","status":"true"},{"day":"Wednesday","status":"true"},{"day":"Thursday","status":"true"},
            {"day":"Friday","status":"true"},{"day":"Saturday","status":"false"},{"day":"Sunday","status":"true"}]';


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


    
    public function newsleter(Request $request){
        $input = $request->all();
        Tbl_newsleter::create($input);
    }

    public function atriPublic($id, $valor){
        $atr = TblPublicacionAtributosGlobales::where([
            ['id_atributo', '=', $id],
            ['valor_atributo', '=', $valor]
        ])->get();

        $atr_pagination =         $atr = TblPublicacionAtributosGlobales::where([
            ['id_atributo', '=', $id],
            ['valor_atributo', '=', $valor]
        ])->paginate(6);

        $publicAtributos = [];
        $imagen = [];
        $attr = [];
        $atributos = [];
        $pubfill = [];

        foreach ($atr as $atrPublic){
            $idAtr = $atrPublic->id;
            $publicAtributosValores = TblPublicacionAtributosGlobales::find($idAtr);
            $publicAtributos[] = $publicAtributosValores->atributosPublicaciones;

        }
        foreach ($publicAtributos as $publicacione) {
            $id = $publicacione->id;
            $pubfill[] = Tbl_publicaciones::find($id);
            //$publicacione->publicacionImagenId($id);
            $publicImag = Tbl_publicaciones::find($id);
            $attr[$id] = $publicImag->publicacionAtributos;
            $imagen[$id] = $publicImag->publicacionImagen;
            //$imagen = $publicImag->publicacionImagen;
        }

        foreach ($attr as $key => $value) {
            $attri_tmp[]=array(
                'id_p'=>$key,
                'attr'=>$value
            );
            foreach ($value as $values){
                //echo $values->id;
                $atributos[$values->id] = TblAtributosGlobales::find($values->id);
                $atributos[$values->id]->publicaciones;
            }

        }

        //$atr->atributosPublicaciones;
        $publicAtributos = array();
        $publicAtributos['data'] = $pubfill;
        $buscar = [
            "publicaciones" => $publicAtributos,
            'imagen' => $imagen,
            //'atributos' => $attri_tmp,
            'atributos' => $atributos,
            //'categorias' => $categorias
        ];

        return $buscar;
    }

    public function attr2($id){
        $publicaciones = array();
        $id = DB::table('tbl_categoria')->where('id',$id)->first();
        if($id->id_padre!=0){
            $publicaciones['publicacion_categoria'][] = DB::table('tbl_categoria')->where('id',$id->id_padre)->first();
            $publicaciones['publicacion_categoria'][] = $id;
        }else{
            $publicaciones['publicacion_categoria'][] = $id;
        }
        
        $cat_attr = DB::table('tbl_publicacion_categoria')->where('id_categoria',$id->id)->get();
        foreach ($cat_attr as $key) {
            $publi_attr = DB::table('tbl_publicaciones')->where('id',$key->id_producto)->get();
            foreach ($publi_attr as $pattr) {
                $publicaciones['publicaciones'][$key->id_producto]=$pattr;
                $attr_ = DB::table('tbl_publicacion_atributos_globales')->where('id_publicacion',$key->id_producto)->get();
                $publicaciones['valores_'][$key->id_producto] = $attr_;             
                
                foreach ($attr_ as $at_) {
                    $valor_ = DB::table('tbl_atributos_globales')->where('id',$at_->id_atributo)->first();
                    $publicaciones['atributos'][$at_->id_atributo] = $valor_;    
                }
          
           }

           $publicaciones['imagen'][$key->id_producto]=DB::table('tbl_publicacion_imagenes')->where('id_publicacion',$key->id_producto)->get();
        }

        foreach ($publicaciones['valores_'] as $key) {
            foreach ($key as $value) {
                $publicaciones['valores'][$value->id_atributo][]=array(
                    'id_publicacion' => $value->id_publicacion,
                    'valor' => $value->valor_atributo,
                    'id_atributo' => $value->id_atributo,
                    'cat' => $slug
                    );
            }
        }
        $publicaciones['publicaciones'] = DB::table('tbl_publicacion_categoria')->where('id_categoria',$id->id)->paginate(6);
        $publicaciones['pagination'] = DB::table('tbl_publicacion_categoria')->where('id_categoria',$id->id)->paginate(6);
        return response()->json($publicaciones);
    }

    public function atriPublic2($id_attr,$valor,$categoria){
        $publicaciones = array();
       // $id = DB::table('tbl_categoria')->where('id',$categoria)->first();

        $cat_attr = DB::table('tbl_publicacion_categoria')->where('id_categoria',$categoria)->get();


        foreach ($cat_attr as $key) {
            $publi_attr = DB::table('tbl_publicaciones')->where('id',$key->id_producto)->get();//aqui descartar los


	
            foreach ($publi_attr as $pattr) {
                $exist_ = DB::table('tbl_publicacion_atributos_globales')
                ->where('id_atributo',$id_attr)
                ->where('valor_atributo',$valor)
                ->exists();

                if($exist_){
                $publi_ = DB::table('tbl_publicacion_atributos_globales')
                ->where('id_atributo',$id_attr)
                ->where('valor_atributo',$valor)
                ->get();



                foreach ($publi_ as $ke_) {
                    $publicaciones['publicaciones'][$ke_->id_publicacion]=DB::table('tbl_publicaciones')->join('tbl_publicacion_categoria', 'id_producto', '=', 'tbl_publicaciones.id')->where('tbl_publicaciones.id',$ke_->id_publicacion)->first();
                }
                
                
            }




                $attr_ = DB::table('tbl_publicacion_atributos_globales')->where('id_publicacion',$key->id_producto)->get();
	


                $publicaciones['valores_'][$key->id_producto] = $attr_;             
             
                foreach ($attr_ as $at_) {
                    $valor_ = DB::table('tbl_atributos_globales')->where('id',$at_->id_atributo)->first();
                    $publicaciones['atributos'][$at_->id_atributo] = $valor_;    
                }
            }
           

           $publicaciones['imagen'][$key->id_producto]=DB::table('tbl_publicacion_imagenes')->where('id_publicacion',$key->id_producto)->get();
        }

        foreach ($publicaciones['valores_'] as $key) {
            foreach ($key as $value) {
                $publicaciones['valores'][$value->id_atributo][]=array(
                    'id_publicacion' => $value->id_publicacion,
                    'valor' => $value->valor_atributo,
                    'id_atributo' => $value->id_atributo,
                    'cat' => $categoria
                    );
            }
        }
        $publicaciones['publicaciones']['data']=$publicaciones['publicaciones'];
        return response()->json($publicaciones);
    } 

    public function search2($src){
        $publicaciones = array();

        $date1 = Carbon::now()->toDateTimeString();
        $horas = Carbon::now();
        $horaac=$horas->toTimeString();

        $id = DB::table('tbl_categoria')->where('nombre',$src)->first();
        $cat_attr = DB::table('tbl_publicaciones')->where('titulo','LIKE','%'.$src.'%')->
            whereDate('date_finish','>=',$date1)->whereDate('date_init','<=',$date1)->
            whereTime('hour_init', '<=', $horaac)->whereTime('hour_finish', '>=', $horaac)->get();
        foreach ($cat_attr as $key) {
            $publi_attr = DB::table('tbl_publicaciones')->where('id',$key->id)->get();
            foreach ($publi_attr as $pattr) {
                $publicaciones['publicaciones'][$key->id]=$pattr;
                $attr_ = DB::table('tbl_publicacion_atributos_globales')->where('id_publicacion',$key->id)->get();
                $publicaciones['valores_'][$key->id] = $attr_;             
                
                foreach ($attr_ as $at_) {
                    $valor_ = DB::table('tbl_atributos_globales')->where('id',$at_->id_atributo)->first();
                    $publicaciones['atributos'][$at_->id_atributo] = $valor_;    
                }
          
           }

           $publicaciones['imagen'][$key->id]=DB::table('tbl_publicacion_imagenes')->where('id_publicacion',$key->id)->get();
        }
        foreach ($publicaciones['valores_'] as $key) {
            foreach ($key as $value) {
                $publicaciones['valores'][$value->id_atributo][]=array(
                    'id_publicacion' => $value->id_publicacion,
                    'valor' => $value->valor_atributo,
                    'id_atributo' => $value->id_atributo,
                    'cat' => $src
                    );
            }
        }
        $publicaciones['publicaciones'] =DB::table('tbl_publicaciones')->where('titulo','LIKE','%'.$src.'%')->paginate(6);
        $publicaciones['pagination'] = DB::table('tbl_publicaciones')->where('titulo','LIKE','%'.$src.'%')->paginate(6);
        return response()->json($publicaciones);
    }

    public function atriPublic2src($id_attr,$valor,$src){
        $publicaciones = array();
        $cat_attr = DB::table('tbl_publicaciones')->where('titulo','LIKE','%'.$src.'%')->get();
        foreach ($cat_attr as $key) {
            $publi_attr = DB::table('tbl_publicaciones')->where('id',$key->id)->get();//aqui descartar los
            foreach ($publi_attr as $pattr) {
                $exist_ = DB::table('tbl_publicacion_atributos_globales')
                ->where('id_atributo',$id_attr)
                ->where('valor_atributo',$valor)
                ->exists();
                if($exist_){
                $publi_ = DB::table('tbl_publicacion_atributos_globales')
                ->where('id_atributo',$id_attr)
                ->where('valor_atributo',$valor)
                ->get();
                foreach ($publi_ as $ke_) {
                    $publicaciones['publicaciones'][$ke_->id_publicacion]=DB::table('tbl_publicaciones')->where('id',$ke_->id_publicacion)->first();
                }
                
                
            }
                $attr_ = DB::table('tbl_publicacion_atributos_globales')->where('id_publicacion',$key->id)->get();
                $publicaciones['valores_'][$key->id] = $attr_;             
                
                foreach ($attr_ as $at_) {
                    $valor_ = DB::table('tbl_atributos_globales')->where('id',$at_->id_atributo)->first();
                    $publicaciones['atributos'][$at_->id_atributo] = $valor_;    
                }
            }
           

           $publicaciones['imagen'][$key->id]=DB::table('tbl_publicacion_imagenes')->where('id_publicacion',$key->id)->get();
        }

        foreach ($publicaciones['valores_'] as $key) {
            foreach ($key as $value) {
                $publicaciones['valores'][$value->id_atributo][]=array(
                    'id_publicacion' => $value->id_publicacion,
                    'valor' => $value->valor_atributo,
                    'id_atributo' => $value->id_atributo,
                    'cat' => $src
                    );
            }
        }
        $publicaciones['publicaciones']['data']=$publicaciones['publicaciones'];
        return response()->json($publicaciones);
    }

    public function addproducto(Request $request){

        $titulo = $request->titulo;
        $precio = $request->precio;
        $descripcion = $request->descripcion;
        $categoria = $request->categoria;
        $user = $request->id_user;
        $fecha_ini = $request->date_init;
        $fecha_fini = $request->date_finish;
        $h_ini = $request->hour_init;
        $h_fin = $request->hour_finish;
        $day = $request->dais;
        $divisa = $request->divisa;

        //$jarr = json_encode($day);
        $jarr = json_encode($day);


        $fecha_inicio = new Carbon($fecha_ini);
        $fecha_final = new Carbon($fecha_fini);

        $values = array(
            'titulo'=>$titulo,
            'id_user'=>$user,
            'precio'=>$precio,
            'descripcion'=>$descripcion,
            'estado'=>'activo',
            'tipo_moneda'=>$divisa,
            'date_finish'=>$fecha_final,
            'date_init'=>$fecha_inicio,
            'hour_init'=>$h_ini,
            'hour_finish'=>$h_fin,
            'dais'=>$jarr
        );

        $id=Tbl_publicaciones::insertGetId($values);

        if($categoria){
            foreach ($categoria as $cate){
                $values2 = array(
                    'id_categoria' => $cate['id'],
                    'id_producto' => $id,
                    'estado' => 'activa'
                );
                $id2=TblPublicacionCategoria::insertGetId($values2);

               /* $attglo=TblCategoriaAtributos::all();
                foreach ($attglo as $cate2){
                    $values2 = array(
                        'id_categoria' => $cate['id'],
                        'id_atributo' => $cate2->id,
                        'estado' => 'activa'
                    );
                    $cate2->setAttribute('attrglobal', $values2 );
                }*/
            }
        }
        $response = array(
            'status' => 'success',
            'msj' => 'Producto agregado',
            'data' => $categoria,
            'id'=>$id,
            'valores' => $values,
            'code' => 0,
        );

        return response()->json($response);
    }
    public function editpro(Request $request){

        $titulo = $request->titulo;
        $precio = $request->precio;
        $descripcion = $request->descripcion;
        $categoria = $request->categoria;
        $user = $request->id_user;
        $fecha_ini = $request->date_init;
        $fecha_fini = $request->date_finish;
        $h_ini = $request->hour_init;
        $h_fin = $request->hour_finish;
        $day = $request->dais;
        $id= $request->id;
        $divisa = $request->divisa;
        //$jarr = json_encode($day);
        $jarr = json_encode($day);


        $fecha_inicio = new Carbon($fecha_ini);
        $fecha_final = new Carbon($fecha_fini);

        $values = array(
            'titulo'=>$titulo,
            'id_user'=>$user,
            'precio'=>$precio,
            'descripcion'=>$descripcion,
            'estado'=>'activo',
            'tipo_moneda'=>$divisa,
            'date_finish'=>$fecha_final,
            'date_init'=>$fecha_inicio,
            'hour_init'=>$h_ini,
            'hour_finish'=>$h_fin,
            'dais'=>$jarr,

        );

        Tbl_publicaciones::where('id', $id)->update($values);

        TblPublicacionCategoria::where('id_producto', $id)->delete();

        if($categoria){
            foreach ($categoria as $cate){
                $values2 = array(
                    'id_categoria' => $cate['id'],
                    'id_producto' => $id,
                    'estado' => 'activa'
                );
                $id2=TblPublicacionCategoria::insertGetId($values2);
            }
        }

        $response = array(
            'status' => 'success',
            'msj' => 'Producto editado',
            'data' => $categoria,
            'id'=>$id,
            'valores' => $values,
            'code' => 0,
        );

        return response()->json($response);

    }

    public function deletepro(Request $request){

        $id = $request->id;
        TblPublicacionAtributosGlobales::where('id_publicacion', $id)->delete();
        TblPublicacionCategoria::where('id_producto', $id)->delete();
        TblPublicacionImagenes::where('id_publicacion', $id)->delete();
        Tbl_publicaciones::where('id', $id)->delete();



        $response = array(
            'status' => 'success',
            'msj' => 'Eliminado correctamente',
            'id'=>$id,
            'code' => 0,
        );
        return response()->json($response);

    }

    public function listarcategorias(Request $request){

        $publicaciones = Tbl_publicaciones::all();
        $categorias = Tbl_Categoria::all();


        foreach ($categorias as $ca){
            if($ca->id_padre>0){
                $dato=Tbl_Categoria::where('id',$ca->id_padre)->first();
                $ca->setAttribute('datosextra', $dato->nombre.' ==> '.$ca->nombre );
            }else{
                $ca->setAttribute('datosextra', $ca->nombre);
            }
        }
        $data=[
            'categorias'=>$categorias,
        ];
        return response()->json($data);
    }
    public function listarattr(Request $request){
        $attr = $request->attr;
        $atributos= array(
            'estado' => 'activa'
        );
        $atributo= array();
        foreach ($attr as $ca){

            $dato=TblCategoriaAtributos::where('id_categoria',$ca['id'])->get();
            $atv=count($dato);
            if($atv>0){
                foreach ($dato as $ca2){
                    $dato2=TblAtributosGlobales::where('id',$ca2->id_atributo)->first();
                    if($dato2){

                            $atributo[] = $dato2;
                    }
                }
            }
        }

        $atributo = array_values(array_unique($atributo));

        $response = array(
            'status' => 'success',
            'msj' => 'lista',
            'atributos'=> $atributo,
            'data'=> $attr,
            'code' => 0,
        );

        return response()->json($response);
    }

    public function addattr(Request $request){

        $attr = $request->attr;
        $id_pro = $request->id_pro;


        if($attr){
            foreach ($attr as $cate){
                $values2 = array(
                    'id_publicacion' => $id_pro,
                    'id_atributo' => $cate['id'],
                    'valor_atributo' => $cate['datoform']
                );
                $id2=TblPublicacionAtributosGlobales::insertGetId($values2);
            }
        }
        $response = array(
            'status' => 'success',
            'msj' => 'Producto agregado',
            'data' => $attr,
            'code' => 0,
        );
        return response()->json($response);
    }
    public function destacar(Request $request){

        $id_pro = $request->id_pro;
        if (!isset($id_pro)) {
            $response = array(
                'status' => 'fail',
                'msj' => 'Producto No Encontrado',
                'code' => 5,
            );
            return response()->json($response);
        }
        $values = array(
            'destacado' => '1',
        );
        Tbl_publicaciones::where('id', $id_pro)->update($values);
        $response = array(
            'status' => 'success',
            'msj' => 'Producto destacado exitosamente',
            'code' => 0,
        );
        return response()->json($response);
    }

    //llamar producto a editar
    public function traerpro(Request $request){

        //$jarr = json_encode($day);
       /* $jarr = json_encode($day);*/


        $id_pro = $request->id;
        if (!isset($id_pro)) {
            $response = array(
                'status' => 'fail',
                'msj' => 'Producto No Encontrado',
                'code' => 5,
            );
            return response()->json($response);
        }

        $data=Tbl_publicaciones::where('id',$id_pro)->first();

        $catt=TblPublicacionCategoria::where('id_producto',$id_pro)->get();

        $categorias  = DB::table('tbl_categoria')
            ->join('tbl_publicacion_categoria', 'tbl_publicacion_categoria.id_categoria','=','tbl_categoria.id')
            ->where('tbl_publicacion_categoria.id_producto',$id_pro)
            ->select('tbl_categoria.*')
            ->get();

            foreach ($categorias as $ca){
                if($ca->id_padre>0){
                    $dato=Tbl_Categoria::where('id',$ca->id_padre)->first();

                    $ca->datosextra = ($dato->nombre.' ==> '.$ca->nombre );
                }else{
                    $ca->datosextra = ($ca->nombre);
                }
            }
        $data2=[
            'categorias'=>$categorias,
        ];

        $response = array(
            'status' => 'success',
            'msj' => 'Producto agregado',
            'categorias'=>$data2,
            'data' => $data,
            'id'=>$request->id,
            'code' => 0,
        );

        return response()->json($response);
    }

    //editar
    public function editarpro(Request $request){

        $titulo = $request->titulo;
        $precio = $request->precio;
        $descripcion = $request->descripcion;
        $categoria = $request->categoria;
        $user = $request->id_user;
        $fecha_ini = $request->date_init;
        $fecha_fini = $request->date_finish;
        $h_ini = $request->hour_init;
        $h_fin = $request->hour_finish;
        $day = $request->dais;

        //$jarr = json_encode($day);
        $jarr = json_encode($day);


        $fecha_inicio = new Carbon($fecha_ini);
        $fecha_final = new Carbon($fecha_fini);

        $values = array(
            'titulo'=>$titulo,
            'id_user'=>$user,
            'precio'=>$precio,
            'descripcion'=>$descripcion,
            'estado'=>'activo',
            'tipo_moneda'=>2,
            'date_finish'=>$fecha_final,
            'date_init'=>$fecha_inicio,
            'hour_init'=>$h_ini,
            'hour_finish'=>$h_fin,
            'dais'=>$jarr
        );

        $id=Tbl_publicaciones::insertGetId($values);

        if($categoria){
            foreach ($categoria as $cate){
                $values2 = array(
                    'id_categoria' => $cate['id'],
                    'id_producto' => $id,
                    'estado' => 'activa'
                );
                $id2=TblPublicacionCategoria::insertGetId($values2);

                /* $attglo=TblCategoriaAtributos::all();
                 foreach ($attglo as $cate2){
                     $values2 = array(
                         'id_categoria' => $cate['id'],
                         'id_atributo' => $cate2->id,
                         'estado' => 'activa'
                     );
                     $cate2->setAttribute('attrglobal', $values2 );
                 }*/
            }
        }
        $response = array(
            'status' => 'success',
            'msj' => 'Producto agregado',
            'data' => $categoria,
            'id'=>$id,
            'valores' => $values,
            'code' => 0,
        );

        return response()->json($response);
    }



}
