var app = angular.module('agroFan', ['angular-loading-bar','angular.filter', 'ngCookies','thatisuday.dropzone','multipleSelect','720kb.socialshare','socialsharing','toastr','vsGoogleAutocomplete','pascalprecht.translate'])
/*Dropzone.autoDiscover = false;*/
Dropzone.autoDiscover = false;


app.factory('globalF', function ( $cookies, $location, $rootScope,$window) {

    // variable si quieres usar coordenandas o no;
    $rootScope.tipecoordenadas = false;

    // variable si quieres usar multiidioma o no;
    return {
        clear_cookie: function () {
            var cookies = $cookies.getAll();
            angular.forEach(cookies, function (v, k) {
                $cookies.remove(k);
            });
            $rootScope.session = false;
            $window.location.href = '/'

        },

		sessionopen: function () {
            var ck_session = $cookies.get('session');
            if (ck_session) {
                ck_session = JSON.parse(ck_session);
                $rootScope.session = {
                    login: true,
                    data_session: ck_session
                }
                //api_token.key = ck_session.data.key;
                // api_token.token = ck_session.data.token;
                return ck_session;
            } else {
                $rootScope.session = {
                    login: false,
                    data_session: null
                }
                var cookies = $cookies.getAll();
               /* angular.forEach(cookies, function (v, k) {
                    $cookies.remove(k);
                });
*/
                // $window.location.href = '/ingresar'
                // $location.path('/')
            }
        },
        validate_session: function () {
        	console.log("llego a validar al fin");
            var api_token = {};
            var ck_session = $cookies.get('session');
            if (ck_session) {
                ck_session = JSON.parse(ck_session);
                $rootScope.session = {
                    login: true,
                    data_session: ck_session
                }
                //api_token.key = ck_session.data.key;
                // api_token.token = ck_session.data.token;
                return ck_session;
            } else {
                $rootScope.session = {
                    login: false,
                    data_session: null
                }
                var cookies = $cookies.getAll();
              /*  angular.forEach(cookies, function (v, k) {
                    $cookies.remove(k);
                });*/
                $window.location.href = '/ingresar'
                //$location.path('/')
            }
        },
    };
})  .config(['$translateProvider', function($translateProvider){
    // Adding a translation table for the English language
    $translateProvider.translations('en_US', {
        "TITLE"     : "The purchase and sale portal made for people who do not like to wait.",
        "TUTO1"    : "Publish your days, weeks and delivery times. in that time buyers will be able to buy your products. You can repeat schedules if you post more ads.",
        "TUTO2" : "When the customer confirms the purchase, you will receive a push notification and an email on your smartphone confirming the buyer's information. This will be the moment in which you must take the product to the buyer's address.",
        "TUTO3" : "When you deliver the product, check it and make sure that the buyer confirms in the app that he has received it. This is important to calculate your average delivery time. Your buyers will not be more than 15km away. of your location.",
        "PUBLICAR"    : "Post",
        "ARTICULO" : "Article",
        "CATEGORIA"    : "Category",
        "SALIR"  : "Get Out",
        "MISPRODUCTOS"        : "My products",
        "INGRESAR" : "Enter",
        "NUEVOINGRESO" : "New revenue",
        "PRODUCTOSCERCA": "Products near you.",
        "NOHAY":"No products near your address come back later.",
        "TIEMPODEENTREGA":"Average delivery time",
        "QUENECESITAS":"What do you need ?",
        "PRODUCTODEST":"Featured Products",
        "PRECIO":"Price",
        "VERTODOS":"See all",
        "COMPRAR":"To buy",
        "DESCRIPCION":"Description",
        "VERTODASVENDEDOR":"See all seller's publications",
        "COMPARTIR":"Share",
        "PREGUNTASYRESP":"Questions and answers",
        "OPINIONESVENDEDOR":"Opinions about the seller?",
        "SIMILARES":"Similar publications",
        "CONTACTAR":"Contact",
        "ENVIAR":"SUBMIT",
        "ESTASSEGURO":"Are you sure you want to buy this product?",
        "TUPROLLEGA":"Your product will arrive soon",
        "PAGOREM":"Payment is cash on delivery"
    });
    // Adding a translation table for the Russian language
    $translateProvider.translations('es_ES', {
        "TITLE"     : "El portal de compra y venta hecho para la gente que no le gusta esperar.",
        "TUTO1"    : "Publica tus dias, semanas y horarios de entrega. en ese tiempo los compradores podrán comprar tus productos. puedes repetir horarios si publicas más anuncios.",
        "TUTO2" : "Cuando el cliente confirme la compra, tú recibirás una notificación push y un email en tu smartphone confirmándote los datos del comprador. Este será el momento en el que debes llevar el producto al domicilio del comprador.",
        "TUTO3" : "Cuando entregues el producto, cóbralo y segúrate de que el comprador confirma en la app que lo ha recibido. Esto es importante para calcular tu media de tiempo de entrega. Tus compradores no estarán a mas de 15km. de tu ubicación.",
        "PUBLICAR"    : "Publicar",
        "ARTICULO" : "Articulo",
        "CATEGORIA"     : "Categorias",
        "SALIR"  : "Salir",
        "MISPRODUCTOS"        : "Mis Productos.",
        "INGRESAR" : "Ingresar",
        "NUEVOINGRESO" : "Nuevos Ingresos",
        "PRODUCTOSCERCA": "Productos cerca de ti",
        "NOHAY":"No hay productos cerca de tu direccion vuelve mas tarde.",
        "TIEMPODEENTREGA":"Tiempo medio de entrega",
        "QUENECESITAS":"Que Necesitas",
        "PRODUCTODEST":"Productos Destacados",
        "PRECIO":"Precio",
        "VERTODOS":"Ver todos",
        "COMPRAR":"Comprar",
        "DESCRIPCION":"Descripción",
        "VERTODASVENDEDOR":"Ver todas las publicaciones del vendedor",
        "COMPARTIR":"Compartir",
        "PREGUNTASYRESP":"Preguntas y respuestas",
        "OPINIONESVENDEDOR":"¿Opiniones sobre el vendedor?",
        "SIMILARES":"Publicaciones Similares",
        "CONTACTAR":"Contactar",
        "ENVIAR":"ENVIAR",
        "ESTASSEGURO":"¿Estas seguro de que quieres comprar este producto?",
        "TUPROLLEGA":"Tu producto llegara pronto ",
        "PAGOREM":"El pago es contra reembolso"

    });
    // Tell the module what language to use by default
    $translateProvider.preferredLanguage('es_ES');
}])

    .config(
        function($fbProvider, $twtProvider) {
            $fbProvider.init("1654506184642978");
            $twtProvider.init()
                .trimText(true);
        })

.filter("formatPrice", function() {
  return function(price, digits, thoSeperator, decSeperator, bdisplayprice) {
    var i;
    digits = (typeof digits === "undefined") ? 2 : digits;
    bdisplayprice = (typeof bdisplayprice === "undefined") ? true : bdisplayprice;
    thoSeperator = (typeof thoSeperator === "undefined") ? "." : thoSeperator;
    decSeperator = (typeof decSeperator === "undefined") ? "," : decSeperator;
    price = price.toString();
    var _temp = price.split(".");
    var dig = (typeof _temp[1] === "undefined") ? "00" : _temp[1];

	
    if (bdisplayprice && parseInt(dig,10)===0) {
        dig = "-";
    } else {
        dig = dig.toString();
        if (dig.length > digits) {
            dig = (Math.round(parseFloat("0." + dig) * Math.pow(10, digits))).toString();
        }
        for (i = dig.length; i < digits; i++) {
            dig += "0";
        }
    }
if(digits == 0){
dig = '';
decSeperator= '';
}
    var num = _temp[0];
    var s = "",
        ii = 0;
    for (i = num.length - 1; i > -1; i--) {
        s = ((ii++ % 3 === 2) ? ((i > 0) ? thoSeperator : "") : "") + num.substr(i, 1) + s;
    }
    return s + decSeperator + dig;
}
})
.filter("displayprice", function() {
  return function(input,comma) {
    if (isNaN(parseFloat(input))) return "";
    comma = (typeof comma==='undefined') ? "." : ",";
    input = Math.round(parseFloat(input)*100)/100;
    var d = input.toString().split(".");
    if (d.length===1) return input+comma+"-";
    if (d[1].length<2) return input+"0";
    return input;
  }
})
.config(['cfpLoadingBarProvider', function(cfpLoadingBarProvider) {
	cfpLoadingBarProvider.includeSpinner = true;

}]);


app.controller('HomeController', ['$scope','$http','globalF','$rootScope','$cookies', function($scope,$http,globalF,$rootScope,$cookies) {
    $rootScope.publicaciones = [], respuesta='';
    var ck_session = globalF.sessionopen();
    console.log(ck_session);
    $scope.user= null;
    if(ck_session){
        $scope.user=ck_session.data;
    }
    var coo = $cookies.get('coordenadas');



    $scope.kokies =  function () {
        $('.overlay').css('display','block');
    }
    if(coo=='{}'){
       coo = null;
    }

    if( $rootScope.session.data_session  && $rootScope.tipecoordenadas == true){
        if($rootScope.session.data_session ){

            $http.post('/api/getcoordenadas',
                {
                    'latitude':$rootScope.session.data_session.data.latitude,
                    'longitude':$rootScope.session.data_session.data.longitude,
                }
            ).then(function(res){
                respuesta = res.data.resp;
                $rootScope.contada= res.data.contada;
                $rootScope.cerca='user';
                $rootScope.publicaciones = respuesta;
                console.log($scope.publicaciones);
                $scope.coordenadas = {
                    'latitude':$rootScope.latitud,
                    'longitude':$rootScope.longitud
                };
                var cordenadas = $scope.coordenadas;
                $cookies.put('coordenadas', cordenadas);

                $('.overlay').css('display','none');
            });
        }else{

            coo = JSON.parse(coo);
            $http.post('/api/getcoordenadas',
                {
                    'latitude':coo.latitude,
                    'longitude':coo.longitude,
                }
            ).then(function(res){
                respuesta = res.data.resp;
                $rootScope.contada= res.data.contada;
                $rootScope.cerca='kokies';
                $rootScope.publicaciones = respuesta;
                console.log($scope.publicaciones);
                $scope.coordenadas = {
                    'latitude':$rootScope.latitud,
                    'longitude':$rootScope.longitud
                };
                var cordenadas = JSON.stringify($scope.coordenadas);
                $cookies.put('coordenadas', cordenadas);

                $('.overlay').css('display','none');
            });
        }
    }else{
        $http.get('/api/features')
            .then(function(res){
                respuesta = res.data;
                $rootScope.cerca='none';
                $rootScope.publicaciones = respuesta;
                console.log($rootScope.publicaciones);
            });
    }





}]);

app.controller('menuController', ['$scope','$http','$rootScope','globalF','$translate', function($scope,$http,$rootScope,globalF,$translate) {
	respuesta='', $scope.categorias = [], $rootScope.history = [];

    var ck_session = globalF.sessionopen();
    console.log(ck_session);
    $scope.user= null;
    if(ck_session){
        $scope.user=ck_session.data;
    }

    $scope.changeLanguage = function (key) {
        $translate.use(key);
    };

	$scope.openmodal = function(){
		console.log("entro al modal");
		$('.overlay').css('display','block');
		$rootScope.titulopublicacion = '';
	}
    $scope.salir = function() {
        globalF.clear_cookie();
    };


    $http.get('/api/categorias')
	.then(function(res){
		respuesta = res.data;
            console.log(res);
		$scope.categorias = respuesta;
		console.log(respuesta);           
	});
	
	$scope.verSubmenu = function($event,e)
	{
		console.log(e);
		console.log($event.target)
		$($event.target).parent().siblings().removeClass('open');
			$($event.target).parent().toggleClass('open');
	}  

}]);

app.controller('categorieController', ['$scope','$http','$rootScope','globalF', function($scope,$http,$rootScope,globalF) {
	respuesta='', $scope.categorias = [],$scope.publicaciones_all=[],$scope.pag = '', $scope.resultados = [],$rootScope.history = [], $scope.attr2 = [], $scope.publicaciones = [];


    $scope.publicaciones2 = [], respuesta2='';
    var ck_session = globalF.sessionopen();
    console.log(ck_session);
    $scope.user= null;
    if(ck_session){
        $scope.user=ck_session.data;
    }

    $http.get('/api/features')
        .then(function(res){
            respuesta2 = res.data;
            $scope.publicaciones2= respuesta2;
            console.log($scope.publicaciones2);
        });


    $scope.nextpage = function(n){
		$http.get('/api/demo/'+$scope.inputSrc+'?page='+n)
		.then(function(res){
			respuesta = res.data;
			$scope.resultados = respuesta;     
		}); 
	}

	$scope.filter = function(id,valor,categoria){
		$http.get('/api/atributospublic/'+id+'/'+valor+'/' +categoria )
		.then(function(res){
			respuesta = res.data;
			$scope.resultados = respuesta;       
		});  	
	}

	$scope.$watch('inputSrc', function(id) {
		if (src) {
			$http.get('/api/categoria/'+id)
			.then(function(res){
				respuesta = res.data;
				console.log(respuesta);
				$scope.resultados=respuesta;
				$scope.publicaciones = respuesta.publicaciones;				
 
				$rootScope.history = respuesta.publicacion_categoria;
				
				if($scope.pag==''){
					$scope.pag = $scope.resultados.publicaciones.last_page;
				}				
				var aty = respuesta.atributos;
				for(a in respuesta.atributos){
					var arri = aty[a].publicaciones;
					for(b in arri){
		
							$scope.attr2.push({
										id_atributo:arri[b].pivot.id_atributo,
										parent_atributo:respuesta.atributos[arri[b].pivot.id_atributo].nombre,
										id_publicacion:arri[b].pivot.id_publicacion,
										valor:arri[b].pivot.valor_atributo
									});							
					}
				}




			});  		    	
		}
	});

/*NEWWWW*/
$scope.$watch('inputSrc', function(src) {
	if(src){
		$http.get('/api/demo/'+src)
		.then(function(res){
			respuesta = res.data;
		
			$scope.resultados = respuesta;   
			$rootScope.history = respuesta.publicacion_categoria;      
		});  
	};
});

/*FIN NEWWWW*/

}]);

app.controller('newsleterController', ['$scope','$http','toastr', function($scope,$http,toastr) {
	respuesta='', $scope.categorias = [], $scope.resultados = [], $scope.nesleter_=false;
	$scope.openmodal = function(){
		$('.overlay').css('display','block');
	}
	$scope.sendnew = function(){
			$http.post(
			'/api/newsleter',
				{
				    'mail':$scope.mailnewsleter
				}
			).then(function(res){ 
				$scope.nesleter_=true;

			}); 
	}


    $scope.enviar = function(id){

        $scope.enviar_msj = 'Enviando...';
        $http.post(
            '/admin/mensajes',
            {
                'nombre':$scope.nombre,
                'email':$scope.email,
                'id_publicacion':1,
                'apellido':$scope.nombre,
                'telefono':$scope.telefono,
                'descripcion':$scope.descripcion
            }
        ).then(function(res){
            $scope.send = true;
            toastr.success('Mensaje enviado');
            $scope.enviar_msj = 'Enviar';
        });
    }

	$http.get('/api/categorias')
	.then(function(res){
		respuesta = res.data;
		$scope.categorias = respuesta;         
	});  	

}]);

app.controller('SearchController', ['$scope','$http', function($scope,$http) {
	$scope.resultados = [], respuesta='',$scope.pag = '', $scope.attr = [], $scope.attr2=[], $scope.attr_tmp = [], tmp='',$scope.found=false;
	
	$scope.nextpage = function(n){
		$http.get('/api/buscar/'+$scope.inputSrc+'?page='+n)
		.then(function(res){
			respuesta = res.data;
			$scope.resultados = respuesta;   

		}); 
	}

	$scope.filter = function(id,valor,src){
		$http.get('/api/atributospublic/src/'+id+'/'+valor+'/'+src)
		.then(function(res){
			respuesta = res.data;
			$scope.resultados = respuesta;       
		});  	
	}

	$scope.$watch('inputSrc', function(src) {
		if (src) {
			$http.get('/api/buscar/'+src)
			.then(function(res){
				$scope.found=false
				respuesta = res.data;

				console.log(respuesta);
				$scope.resultados = respuesta; 
				$scope.attr = respuesta.atributos;
				if($scope.pag==''){
					$scope.pag = $scope.resultados.publicaciones.last_page;
				}
				
				var aty = respuesta.atributos;
				for(a in respuesta.atributos){
					var arri = aty[a].publicaciones;
					for(b in arri){
		
							$scope.attr2.push({
										id_atributo:arri[b].pivot.id_atributo,
										parent_atributo:respuesta.atributos[arri[b].pivot.id_atributo].nombre,
										id_publicacion:arri[b].pivot.id_publicacion,
										valor:arri[b].pivot.valor_atributo
									});							
					}
				}

				if(respuesta.publicaciones.data.length<1){
					$scope.found=true;
				}
					console.log($scope.attr);
			});  		    	
		}
	});




}]);

app.controller('PublicacionController', ['$scope','$http','$rootScope','globalF','Socialshare','$fb', '$twt', function($scope,$http,$rootScope,globalF,Socialshare,$fb, $twt) {
	$scope.publicacion = [], respuesta='',zoom=false, $scope.imgmain = '',$scope.recomendados = [],$scope.recomendados_publi = [], $rootScope.titulopublicacion = '';


    $scope.publicaciones2 = [], respuesta2='';
    var ck_session = globalF.sessionopen();
    console.log(ck_session);
    $scope.user= null;
    if(ck_session){
        $scope.user=ck_session.data;
    }

    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.12&appId=302481046906408&autoLogAppEvents=1';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));


    $http.get('/api/features')
        .then(function(res){
            respuestaaa = res.data;
            $scope.publicaciones = respuestaaa;
            console.log($scope.publicaciones);
        });






    $scope.chan = function(rut){
		$scope.imgmain = rut
	}
	$scope.openmodal = function(id,nombre,precio){
		$('.overlay').css('display','block');
		$scope.id_prod_hid = id;
        $scope.data_nombre = nombre;
        $scope.data_precio = precio;
        console.log($scope.data_recio);
        console.log($scope.data_nombre);
	}
	$scope.zoom = function(){
		console.log('zom');
	}

	$(".miniaturas").delegate("img", "click", function ( event ) {
		console.log('hover');
		$('#main_img').ezPlus();
	});
	$('#main_img').hover(function(){
		$('#main_img').ezPlus();
	});
	$scope.$watch('inputId', function(id) {
	    $rootScope.idpro=id;
		if (id) {
			$http.get('/api/publicaciones/'+id)
			.then(function(res){
				respuesta = res.data;
				$scope.hora = res.data.features;
				$scope.publicacion = respuesta; 
				$scope.imgmain = respuesta.publicacion_imagen[0].ruta; 
				console.log(respuesta);
				$rootScope.history = respuesta.publicacion_categoria;

				
				/*RECOMENDADOS*/
					$http.get('/api/recomendados/'+$scope.publicacion.publicacion_categoria[0].id)
					.then(function(res){
						respuesta = res.data;
						$scope.recomendados = respuesta;
						console.log(respuesta);
			
						for(var i = 0;i<5;i++){
	
							$http.get('/api/publicaciones/'+$scope.recomendados[i].id_producto)
							.then(function(res){
								$scope.recomendados_publi.push(res.data);
								console.log($scope.recomendados_publi);          
							}); 						

						}

					}); 				
				/*FIN*/				
			});  		    	
		}
	});



    $scope.face = function(rut){

        console.log($scope.imgmain);
        $fb.feed({
            name: "Apatxee",
            description: "descripcion del producto",
            caption: "APA.",
            picture: "https://apatxee.com/upload/6c8ec1125d985ab056705a05ee519e81.jpg",
            link: "https://apatxee.com/publicacion/"+$rootScope.idpro
        });
    }
}]);

app.controller('modalCoontroller', ['$scope','$http','globalF','$rootScope','toastr', function($scope,$http,globalF,$rootScope,toastr) {
  //  var ck_session = globalF.validate_session();


    $scope.sessionactiva=false;
    if($rootScope.session.data_session){
        $scope.sessionactiva=true;
    }

    $scope.enviar_msj='Comprar' ,$scope.publicacion = [], respuesta='',zoom=false, $scope.imgmain = '', $scope.send=false;
	$scope.closemodal = function(){
		$('.overlay').css('display','none');

		$scope.send=false;
		$scope.nombre='';
		$scope.email='';
		$scope.nombre='';
		$scope.telefono='';
		$scope.descripcion='';
	}

	$scope.addcar = function (id, name, precio) {
        console.log(name, precio);
	    var data2 = {producto: id, vendedor : $rootScope.session.data_session.data.id, name: name, precio: precio}
        var car = localStorage.getItem('car');
        if(car) {
            var data =  JSON.parse(car);
            data.push( data2 );
        } else  {
            var data = [];
            data.push( data2 );
        }
        localStorage.setItem('car', JSON.stringify(data));
        localStorage.setItem('idcar', JSON.stringify($rootScope.session.data_session.data.id));
        toastr.success('Agregado al carrito correctamente', 'Existo');

    }

	$scope.enviar = function(id){

		$scope.enviar_msj = 'Espera, Procesando el pedido...';
           $http.post(
                '/admin/comprar',
                    {
                        'id_publicacion':id,
                        'id_cliente':$rootScope.session.data_session.data.id,
                    }
                ).then(function(res){
                    console.log(res);
                    $scope.datavendedor = res.data.producto;
                	$scope.send = true;
					$scope.enviar_msj = 'Continuar';
            });
	}
}]);

app.controller('modaladdresCoontroller', ['$scope','$http','globalF', '$cookies','$rootScope', function($scope,$http,globalF,$cookies,$rootScope) {

    var coo = $cookies.get('coordenadas');
    console.log(coo);
    $scope.options = {
        types: ['(cities)'],
        componentRestrictions: { country: 'ESP' }
    };

    $rootScope.address = {
        name: '',
        place: '',
        components: {
            placeId: '',
            streetNumber: '',
            street: '',
            city: '',
            state: '',
            countryCode: '',
            country: '',
            postCode: '',
            district: '',
            location: {
                lat: '',
                long: ''
            }
        }
    };


    console.log($rootScope.latitud);

    if(coo=='{}'){
        coo = null;
    }
    if( $rootScope.session.data_session || coo  || $rootScope.tipecoordenadas == false){
        $('.overlay').css('display','none');
    }else{
        $('.overlay').css('display','block');
    }



    $scope.enviar_msj='Comprar' ,$scope.publicacion = [], respuesta='',zoom=false, $scope.imgmain = '', $scope.send=false;
    $scope.closemodal = function(){
        $('.overlay').css('display','none');

        $scope.send=false;
        $scope.nombre='';
        $scope.email='';
        $scope.nombre='';
        $scope.telefono='';
        $scope.descripcion='';
    }

    $scope.enviar = function(id){
        $rootScope.latitud = $rootScope.address.components.location.lat;
        $rootScope.longitud = $rootScope.address.components.location.long;


        if($rootScope.latitud && $rootScope.longitud){

            $http.post('/api/getcoordenadas',
                {
                    'latitude':$rootScope.latitud,
                    'longitude':$rootScope.longitud,
                }
            ).then(function(res){
                    respuesta = res.data.resp;
                    $rootScope.contada= res.data.contada;
                    $rootScope.cerca='kokies';
                    $rootScope.publicaciones = respuesta;
                    console.log($scope.publicaciones);
                    $scope.coordenadas = {
                        'latitude':$rootScope.latitud,
                        'longitude':$rootScope.longitud
                    };
                        var cordenadas = JSON.stringify($scope.coordenadas);
                        $cookies.put('coordenadas', cordenadas);

                    $('.overlay').css('display','none');
                });
        }
       /* var latitude = $cookies.get('latitude');
        var longitude = $cookies.get('longitude');*/
        /*$scope.enviar_msj = 'Comprando...';
        $http.post(
            '/admin/mensajes',
            {
                'nombre':$scope.nombre,
                'email':$scope.email,
                'id_publicacion':id,
                'apellido':$scope.nombre,
                'telefono':$scope.telefono,
                'descripcion':$scope.descripcion
            }
        ).then(function(res){
            $scope.send = true;
            $scope.enviar_msj = 'Enviar';
        });*/
    }

}]);

//ingresar
app.controller('ingresaController', ['$scope','$http','$rootScope','$cookies','globalF','$location','$window','toastr', function($scope,$http,$rootScope, $cookies, globalF, $location,$window,toastr) {
	$scope.registro="menu de registro";

      // var ck_session = globalF.sessionopen();

    var datosec = $cookies.get('session');

        $rootScope.session = {
			 login: false,
			 data_session: null
		 }





    $scope.ingresar = function(id){
    	console.log($scope.email);
        console.log($scope.password);

        $http.post('/api/login',
            {
                'email':$scope.email,
                'password':$scope.password,
            }
        ).then(function(res){
        	console.log(res);

            if (res.data.status =='success') {
                console.log(res);

                var obj_session = JSON.stringify(res.data);
                //api_token.key = res.data.key=;
                //api_token.token = res.data.token;

                $cookies.put('session', obj_session);
                $rootScope.session.login = true;
                $rootScope.session.data_session = res.data;

                $window.location.href = '/'


            }else{
                toastr.error('Credenciales incorrectas', 'Error');
            }
            // $scope.send = true;
            // $scope.enviar_msj = 'Enviar';
        });


    };


	console.log($scope.registro);
}]);


app.controller('ingresaController', ['$scope','$http','$rootScope','$cookies','globalF','$location','$window','toastr', function($scope,$http,$rootScope, $cookies, globalF, $location,$window,toastr) {
    $scope.registro="menu de registro";


    var data = $cookies.get('session');
    $scope.productoscompras = [];
    if(data) {
        // $scope.obj_session = JSON.stringify(data.data);
        $scope.obj_session2 = JSON.parse(data);
        $scope.obj_session2= $scope.obj_session2.data;

        if($scope.obj_session2) {
            $http.get('/api/productoscompras/'+$scope.obj_session2.id +'?id='+ $scope.obj_session2.id )
                .then(function(res){
                    $scope.productoscompras = res.data;
                });
        }

    }



    $scope.editar = function(nombre,apellido,email,telefono, direccion){
        console.log(nombre);

            $http.put('/api/datosuser',
                {
                    'email':email,
                    'nombre': nombre,
                    'telefono':telefono,
                    'direccion':direccion,
                    'apellido':apellido,
                    'id': $scope.obj_session2.id
                }
            ).then(function(res){
                console.log(res);
                toastr.success('Editado correctamente', 'Success');
                if (res.data.status =='success') {

                }else{
                    toastr.error('Credenciales incorrectas', 'Error');
                }
                // $scope.send = true;
                // $scope.enviar_msj = 'Enviar';
            });
    }

    // var ck_session = globalF.sessionopen();

    $scope.publicaciones2 = [], respuesta2='';
    $http.get('/api/features')
        .then(function(res){
            respuestaaa = res.data;
            $scope.publicaciones = respuestaaa;
            console.log($scope.publicaciones);
        });

    $scope.iputre=false;
    $scope.olvide = function(id){
        if($scope.iputre==true){
            $scope.iputre=false;
        }else{
            $scope.iputre=true;
        }
    };
    $scope.emailr="";
    $scope.recuperar = function(email){
        $scope.emailr=email;
        $http.post('api/recupera',
            {
                'email':$scope.emailr,
            }
        ).then(function(res){
            console.log(res);

            if (res.data.status =='success') {
                console.log(res);
                toastr.success('Te enviamos un correo Para recuperar tu password');
            }else{
                toastr.error('el correo no existe');
            }
            // $scope.send = true;
            // $scope.enviar_msj = 'Enviar';
        });

    };


    var datosec = $cookies.get('session');

    $rootScope.session = {
        login: false,
        data_session: null
    }

    $scope.ingresar = function(email,pass){
        console.log($scope.email);
        console.log($scope.password);

        $http.post('/api/login',
            {
                'email':email,
                'password':pass,
            }
        ).then(function(res){
            console.log(res);

            if (res.data.status =='success') {
                console.log(res);

                var obj_session = JSON.stringify(res.data);
                //api_token.key = res.data.key=;
                //api_token.token = res.data.token;

                $cookies.put('session', obj_session);
                $rootScope.session.login = true;
                $rootScope.session.data_session = res.data;

                $window.location.href = '/'
            }else{
                toastr.error('Credenciales incorrectas', 'Error');
            }
            // $scope.send = true;
            // $scope.enviar_msj = 'Enviar';
        });


    };


    // registrar

    $scope.registra = function(nombre,apellido,email,telefono,password,password2, direccion) {

        if(password == password2) {
            $http.post('/api/datosuser',
                {
                    'email':email,
                    'password':password,
                    'nombre': nombre,
                    'telefono':telefono,
                    'direccion':direccion,
                    'apellido':apellido,
                }
            ).then(function(res){
                console.log(res);

                if (res.data.status =='success') {
                    toastr.success('Registrado correctamente', 'Success');
                    $window.location.href = '/ingresar'
                }else{
                    toastr.error(res.data.msj, 'Error');
                }
                // $scope.send = true;
                // $scope.enviar_msj = 'Enviar';
            });
        }else {
            toastr.error('Passwords diferentes', 'Error');
        }



    }

    console.log($scope.registro);
}]);


//agregar producto
app.controller('productoController', ['$scope','$http','$rootScope','$cookies','globalF','$location','$window','toastr', function($scope,$http,$rootScope, $cookies, globalF, $location,$window,toastr) {
    $scope.registro="menu de registro";

var ck_session = globalF.validate_session();
     //imagen
    $scope.dia="";
    $rootScope.id_pro="";
    $scope.values_add = {};
    $http.get('/api/listarcate').then(function(res){
        console.log(res);
        if (res.status ==200) {
            $scope.categoriaslist=res.data.categorias;
            console.log(res);
        }
    });
    $scope.suiche=1;

        $scope.dia=[{"day":"Monday","status":"false"},
                    {"day":"Tuesday","status":"false"},
                    {"day":"Wednesday","status":"false"},
                    {"day":"Thursday","status":"false"},
                    {"day":"Friday","status":"false"},
                    {"day":"Saturday","status":"false"},
                    {"day":"Sunday","status":"false"}];

    $scope.ingresar = function(id){
        //hora de inicio
        var horaini = new Date($scope.hour_init);
        $scope.hih=horaini.getHours();
        $scope.him=horaini.getMinutes();
        var horainicio =  $scope.hih +':'+$scope.him+':'+'00'

        //hora final
        var horaf = new Date($scope.hour_finish);
        $scope.hfh=horaf.getHours();
        $scope.hfm=horaf.getMinutes();
        var horaifinal =  $scope.hfh +':'+$scope.hfm+':'+'00'

        console.log($scope.dia);



        $http.post('/api/addproducto',
            {
                'titulo':$scope.titulo,
                'precio':$scope.precio,
                'descripcion':$scope.descripcion,
                'categoria':$scope.categoria,
                'divisa':$scope.divisa,
                'id_user':ck_session.data.id,
                'date_init':$scope.date_init,
                'date_finish':$scope.date_finish,
                'hour_init':horainicio,
                'hour_finish':horaifinal,
                'dais':$scope.dia
            }
        ).then(function(res){
            console.log(res);
            if (res.data.status =='success') {

                $rootScope.datattributos= res.data.data;
                $rootScope.id_pro=res.data.id;
                $scope.suiche=2;
                console.log($rootScope.id_pro);
            }
        });
    };
    console.log($rootScope.id_pro);

    $scope.dzOptions = {
        url : '/api/upload',
        paramName : 'photo',
        params:{id:$rootScope.id_pro,
            act:'addpro'
        },
        maxFilesize : '4',
        acceptedFiles : 'image/jpeg, images/jpg, image/png',
        addRemoveLinks : true,
        id_publi:'12',
        /*data: {
            username: $scope.username,
            file: file,
            id_usr:$rootScope.id_user,
            type:'market'
        }*/
    };

    $scope.dzCallbacks = {
        'addedfile' : function(file){
            $scope.dzOptions.params.id = $rootScope.id_pro;
            $scope.newFile = file;
        },
        'success' : function(file, xhr){
            console.log( xhr.data);
            if(xhr.status=='success'){
                $scope.suiche=3;
            }
        },
    };
    $scope.dzMethods = {};
    $scope.removeNewFile = function(){
        $scope.dzMethods.removeFile($scope.newFile); //We got $scope.newFile from 'addedfile' event callback
    }

    $scope.attrs = function(id){
        $scope.suiche=4;
        console.log($rootScope.datattributos);

        $http.post('/api/listarattr',{attr:$rootScope.datattributos}).then(function(res){
            console.log(res);
                $scope.attrs=res.data.atributos;
                $rootScope.arreglo=res.data.atributos;
                console.log($scope.attrs);
        });


    }
    $scope.link="";
    $scope.ingresarattr=function () {

        console.log($rootScope.arreglo);

        $http.post('/api/addattr',{id_pro: $rootScope.id_pro, attr:$rootScope.arreglo}).then(function(res){
            console.log(res);

            if(res.data.status=='success'){
                $scope.suiche=5;
                toastr.success('Registro exitoso');
                $scope.link=$rootScope.id_pro;
            }
            /* $scope.attrs=res.data.atributos;
             console.log($scope.attrs);*/
        });


    }
    paypal.Button.render({
        braintree: braintree,
        client: {
            sandbox: paypal.request.get('/demo/checkout/api/braintree/client-token/'),
            production: '<insert production auth key>'
        },
        env: 'sandbox',
        payment: function(data, actions) {
            return actions.payment.create({
                payment: {
                    transactions: [
                        {
                            amount: { total: '3.00', currency: 'EUR' }
                        }
                    ]
                }
            });
        },
        onAuthorize: function(data, actions) {
            return actions.payment.execute().then(function() {

                $http.post('/api/destacar',{id_pro: $rootScope.id_pro}).then(function(res){
                    console.log(res);

                    if(res.data.status=='success'){
                        toastr.success('Producto destacado exitosamente');
                        $scope.suiche=6;
                        $scope.link=$rootScope.id_pro;
                    }
                    /* $scope.attrs=res.data.atributos;
                     console.log($scope.attrs);*/
                });
            });
        }
    }, '#paypal-button-container');

    $scope.verpro = function () {
        $window.location.href = '/publicacion/'+$scope.link;
    }

    console.log($scope.registro);
}]);

//listar productos por cliente
app.controller('productolistController', ['$scope','$http','$rootScope','$cookies','globalF','$location','$window', function($scope,$http,$rootScope, $cookies, globalF, $location,$window) {

    $scope.publicaciones = [], respuesta='';
    var ck_session = globalF.sessionopen();
    console.log(ck_session);
    $scope.user= null;
    if(ck_session){
        $scope.user=ck_session.data;
    }
    $scope.$watch('inputId', function(id) {
        if (id) {
            $http.get('/api/productosusr/'+id)
                .then(function(res){
                    respuesta = res.data;
                    $scope.publicaciones = respuesta;
                    console.log($scope.publicaciones);
                    $scope.user=respuesta[0].user;
                    $scope.username=$scope.user.name;
                });
        }
    });
}]);


//listar productos de un vendedor
app.controller('listaController', ['$scope','$http','$rootScope','$cookies','globalF','$location','$window','toastr', function($scope,$http,$rootScope, $cookies, globalF, $phtion,$window,toastr) {

    var ck_session = globalF.validate_session();
    $scope.publicaciones = [], respuesta='';
    console.log(ck_session);
    $scope.user= null;
    if(ck_session){
        $scope.user=ck_session.data;
    }


    $rootScope.datacar = [];
    var car = localStorage.getItem('car');
    var idcar = localStorage.getItem('idcar');
    if(car && idcar == $rootScope.session.data_session.data.id) {
        $rootScope.datacar = JSON.parse(car);
    }

    $scope.comprar = function(){
        $scope.enviar_msj = 'Espera, Procesando el pedido...';
        $http.post(
            '/admin/comprarvarios',
            {
                'id_cliente':$rootScope.session.data_session.data.id,
                data: $rootScope.datacar
            }
        ).then(function(res){
            console.log(res);
            localStorage.clear();
            $rootScope.datacar = {};
            $scope.enviar_msj = 'Listo tu producto esta en camino';
            toastr.success('Pedido exitoso');
        });
    }

    $scope.vaciarcar =function () {
        localStorage.clear();
        $rootScope.datacar = {};
    }

    $scope.$watch('inputId', function(id) {
        if (id) {
            if($scope.user.id == id){
                $http.get('/api/productosusr/'+id)
                    .then(function(res){
                        respuesta = res.data;
                        $scope.publicaciones = respuesta;
                        console.log($scope.publicaciones);
                        $scope.user=respuesta[0].user;
                        $scope.username=$scope.user.name;
                    });
            }
        }
    });

    $scope.edit =function (idpro) {
        console.log(idpro);
        $window.location.href = '/editpro/'+idpro;
    }
    $scope.delete =function (idpro) {
        console.log(idpro);
        $http.delete('/api/deletepro/'+idpro).then(function(res){
                respuesta = res.data;
                $scope.publicaciones = respuesta;
                toastr.error('Eliminado exitosamente', 'se elimino con exito');
                $scope.$watch('inputId', function(id) {
                    if (id) {
                        if($scope.user.id == id){
                            $http.get('/api/productosusr/'+id)
                                .then(function(res){
                                    respuesta = res.data;
                                    $scope.publicaciones = respuesta;
                                    console.log($scope.publicaciones);
                                    $scope.user=respuesta[0].user;
                                    $scope.username=$scope.user.name;
                                });
                        }
                    }
                });
            });

    }
}]);

app.controller('editController', ['$scope','$http','$rootScope','$cookies','globalF','$location','$window','toastr', function($scope,$http,$rootScope, $cookies, globalF, $location,$window, toastr) {

    var ck_session = globalF.validate_session();
    $scope.publicaciones = [], respuesta='';
    console.log(ck_session);
    $scope.user= null;
    if(ck_session){
        $scope.user=ck_session.data;
    }
    $http.get('/api/listarcate').then(function(res){
        console.log(res);
        if (res.status ==200) {
            $scope.categoriaslist=res.data.categorias;
            console.log(res);
        }
    });
        $scope.hinicio=1;
        $scope.hfinal=1;

    $scope.edithi =function () {
        $scope.hinicio=0;
    }
    $scope.edithf =function () {
        $scope.hfinal=0;
    }

    $scope.$watch('inputId', function(id) {
        if (id) {
            $http.get('/api/editarpro/'+id)
                .then(function(res){
                    respuesta = res.data;
                    $rootScope.id_pro=id;
                    $scope.publicaciones = respuesta;
                    $scope.divisa =  $scope.publicaciones.data.tipo_moneda;
                    $scope.destacado = $scope.publicaciones.data.destacado;;
                    $scope.titulo = $scope.publicaciones.data.titulo;
                    $scope.titulo2 = $scope.publicaciones.data.titulo;
                    $scope.precio= $scope.publicaciones.data.precio;
                    $scope.descripcione= $scope.publicaciones.data.descripcion;
                    $scope.categoria= res.data.categorias.categorias;
                    $scope.date_init = new Date($scope.publicaciones.data.date_init);
                    $scope.date_finish= new Date($scope.publicaciones.data.date_finish);
                    $scope.hi = $scope.publicaciones.data.hour_init;
                    $scope.hf =$scope.publicaciones.data.hour_finish;
                    $scope.dia=$scope.publicaciones.data.dais;
                    $scope.dia= JSON.parse($scope.dia);
                });
        }
    });

    $scope.editar = function(id){
        //hora de inicio
        if($scope.hour_init){
            var horaini = new Date($scope.hour_init);
            $scope.hih=horaini.getHours();
            $scope.him=horaini.getMinutes();
            var horainicio =  $scope.hih +':'+$scope.him+':'+'00'
        }
        if($scope.hour_finish){
            var horaf = new Date($scope.hour_finish);
            $scope.hfh=horaf.getHours();
            $scope.hfm=horaf.getMinutes();
            var horaifinal =  $scope.hfh +':'+$scope.hfm+':'+'00'
        }
        console.log($scope.dia);
        $http.put('/api/addproducto',
            {
                'id':$rootScope.id_pro,
                'titulo':$scope.titulo,
                'precio':$scope.precio,
                'descripcion':$scope.descripcione,
                'divisa':$scope.divisa,
                'categoria':$scope.categoria,
                'id_user':ck_session.data.id,
                'date_init':$scope.date_init,
                'date_finish':$scope.date_finish,
                'hour_init':horainicio,
                'hour_finish':horaifinal,
                'dais':$scope.dia
            }
        ).then(function(res){
            console.log(res);
            if (res.data.status =='success') {
                console.log(res);
                toastr.success('Se edito correctamente', 'Exito');
             /*   $rootScope.datattributos= res.data.data;
                $rootScope.id_pro=res.data.id;
                $scope.suiche=2;*/
                console.log($rootScope.id_pro);
            }
        });
    };

    $scope.dzOptions = {
        url : '/api/upload',
        paramName : 'photo',
        params:{id:$rootScope.id_pro,
            act:'addpro'
        },
        maxFilesize : '4',
        acceptedFiles : 'image/jpeg, images/jpg, image/png',
        addRemoveLinks : true,
        id_publi:'12',
        /*data: {
            username: $scope.username,
            file: file,
            id_usr:$rootScope.id_user,
            type:'market'
        }*/
    };

    $scope.dzCallbacks = {
        'addedfile' : function(file){
            $scope.dzOptions.params.id = $rootScope.id_pro;
            $scope.newFile = file;
        },
        'success' : function(file, xhr){
            console.log( xhr.data);
            if(xhr.status=='success'){
                $scope.suiche=3;
            }
        },
    };
    $scope.dzMethods = {};
    $scope.removeNewFile = function(){
        $scope.dzMethods.removeFile($scope.newFile); //We got $scope.newFile from 'addedfile' event callback
    }
    paypal.Button.render({
        braintree: braintree,
        client: {
            sandbox: paypal.request.get('/demo/checkout/api/braintree/client-token/'),
            production: '<insert production auth key>'
        },
        env: 'sandbox',
        payment: function(data, actions) {
            return actions.payment.create({
                payment: {
                    transactions: [
                        {
                            amount: { total: '3.00', currency: 'EUR' }
                        }
                    ]
                }
            });
        },
        onAuthorize: function(data, actions) {
            return actions.payment.execute().then(function() {

                $http.post('/api/destacar',{id_pro: $rootScope.id_pro}).then(function(res){
                    console.log(res);

                    if(res.data.status=='success'){
                        $scope.suiche=6;
                        $scope.link=$rootScope.id_pro;
                    }
                    /* $scope.attrs=res.data.atributos;
                     console.log($scope.attrs);*/
                });
            });
        }
    }, '#paypal-button-container');


    $scope.edit =function (idpro) {

        console.log(idpro);
        $window.location.href = '/editpro/'+idpro;
    }
}]);


