<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('logout', 'Auth\LoginController@logout');
Route::get('admin/home', function () {
	return view('home');
});
Route::get('/', function () {
	return view('welcome');
});

Route::resource('admin/categoria', 'CategoriaController');
Route::resource('admin/publicaciones', 'PublicacionesController');
Route::resource('admin/atributo', 'AtributosController');
Route::resource('admin/usuarios', 'UsuariosController');

Route::get('admin/categoria/{id}/atributos', 'CategoriaController@getAtributos');
Route::post('admin/categoria/{id}/atributos', 'CategoriaController@storeAtributos');
Route::delete('admin/categoria/{id}/atributos/{idatr}', 'CategoriaController@deleteAtributos');
Route::get('admin/categoria/{id}/atributos/{idatr}/edit', 'CategoriaController@editAtributos');
Route::patch('admin/categoria/{id}/atributos/{idatr}', 'CategoriaController@updateAtributos');
Route::post('admin/categoria/{id}/atributos/addAtributos', 'CategoriaController@addAtributos');

Route::get('admin/publicaciones/{id}/imagen', 'PublicacionesController@imagen');
Route::post('admin/publicaciones/{id}/imagen', 'PublicacionesController@guardarImg');
Route::delete('admin/publicaciones/{id}/imagen', 'PublicacionesController@deleteImg');
Route::get('admin/publicaciones/{id}/atributos', 'PublicacionesController@atributos');
Route::get('admin/publicaciones/{id}/atributos/{idcate}', 'PublicacionesController@atributosMostrar');
Route::get('admin/publicaciones/{id}/atributos/valores/{idvalor}', 'PublicacionesController@valoresMostrar');
Route::post('admin/publicaciones/{id}/atributos/addAtr', 'PublicacionesController@agregarAtributos');
Route::get('admin/publicaciones/{id}/atributos/{idAtr}/borrar', 'PublicacionesController@borrarAtributos');

Route::post('admin/publicaciones/{id}/atributos/addAtr2', 'PublicacionesController@agregarAtributos2');
/* Route mensajes */
Route::get('admin/mensajes', 'MensajesController@index');
Route::get('admin/mensajes/{id}', 'MensajesController@show');
Route::get('admin/mensajes/{id}/responder', 'MensajesController@responder');
Route::get('admin/mensajes/{id}/borrar', 'MensajesController@borrar');

Route::get('admin/pruebacontact', 'CrearMensajesController@create');
Route::post('admin/mensajes', 'CrearMensajesController@store');
Route::post('admin/comprar', 'CrearMensajesController@comprar');

Route::post('admin/comprarvarios', 'CrearMensajesController@comprarvarios');


Route::get('/categoria/{cat}/{child}','CategoriaController@hijo');

Route::get('/buscar/{src}','SearchController@buscar');


Route::get('/buscar','SearchController@buscar_form');

Route::get('/{author}/{product}-{id_product}','SingleController@singlewithuser');

Route::get('/{product}-{id_product}','SingleController@single');


Route::get('/buscar/{src}',function($src){
	return view('results', ['src' => $src]);
});

Route::get('/categoria/{id}',function($id){
	return view('category', ['id' => $id]);
});

Route::get('/publicacion/{id}',function($id){
	return view('item', ['id' => $id]);
});

Route::get('/quienes',function(){
	return view('about');
});
Route::get('/ingresar',function(){
    return view('ingresar');
});

Route::get('/registrar',function(){
    return view('producto');
});
Route::get('/registrarusuario',function(){
    return view('registeruser');
});
Route::get('/destacado',function(){
    return view('destacado');
});
Route::get('/listarpro/{id}',function($id){
    return view('produtlist',['id'=>$id]);
});

Route::get('/listar/{id}',function($id){
    return view('lista',['id'=>$id]);
});

Route::get('/editpro/{id}',function($id){
    return view('editpro',['id'=>$id]);
});

Route::get('/buscar','SearchController@buscar_form');

/*API*/
Route::get('/api/features','ProductsController@features');
Route::post('api/getcoordenadas','ProductsController@getcordenadas');
Route::get('/api/productosusr/{id}','ProductsController@productuser');


Route::post('api/buscarm/{src}','ProductsController@buscarm');


Route::get('/api/productoscompras/{id}','ProductsController@producventa');
Route::get('/api/getdataventas/{id}','ProductsController@getdataventa');

Route::get('/api/movimientos','ProductsController@getmovimientos');








Route::get('/api/search/{src}','SearchController@buscar');

Route::get('/img/{id}','MediaController@image');

/* API´s Carlos*/
Route::get('api/buscar/{buscar}', 'ApiS@search2');
Route::get('api/buscar/{buscar}/{page}', 'SearchController@buscarApi');

Route::get('api/categorias', 'ApiS@categoriasAll');
Route::get('api/categorias/{id}', 'ApiS@categoriasId');
Route::get('api/recomendados/{id}', 'ApiS@recomendados');
Route::get('api/categoria/{id}', 'ApiS@productscat');
Route::post('api/categoriamovil/{id}', 'ApiS@productscatmovil');
Route::get('api/publicaciones', 'ApiS@publicacionesAll');
Route::get('api/publicaciones/{id}', 'ApiS@publicacionesId');

Route::get('api/demo/{id}', 'ApiS@attr2');

Route::post('api/newsleter', 'ApiS@newsleter');
Route::get('api/atributospublic/{id}/{valor}', 'ApiS@atriPublic2');
Route::get('api/atributospublic/{id}/{valor}/{categoria}', 'ApiS@atriPublic2');
Route::get('api/atributospublic/src/{id}/{valor}/{src}', 'ApiS@atriPublic2src');
Route::post('api/login/', 'loginController@login');
Route::post('api/addproducto', 'ApiS@addproducto');
Route::put('api/addproducto','Apis@editpro');
Route::get('api/listarcate', 'ApiS@listarcategorias');
Route::post('api/listarattr', 'ApiS@listarattr');
Route::post('api/addattr', 'ApiS@addattr');
Route::delete('api/deletepro/{id}', 'ApiS@deletepro');



Route::post('api/destacar', 'ApiS@destacar');


//user
Route::post('api/datosuser', 'RegisterUser@datosuser');
Route::get('api/datosuser', 'RegisterUser@getuser');
Route::put('api/datosuser', 'RegisterUser@putuser');




Route::post('/api/upload','MediaController@upload');
Route::post('/api/uploadp','MediaController@profileupload');


//recupera pass
Route::get('/recuperaform','loginController@recuperaform');
Route::post('/confirpass','loginController@cambiarpass');
Route::get('/recuperada','loginController@cambiarpass');
Route::post('api/recupera','loginController@recupera');

Route::get('/confir','loginController@confir');

Route::get('api/editarpro/{id}','Apis@traerpro');


