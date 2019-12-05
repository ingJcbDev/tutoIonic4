
<body style="background-image:url({{asset('img/back-results.jpg')}})" ng-controller="PublicacionController">
	<input type="hidden" id="src_string" ng-init="inputId='{{$id}}'" ng-model="inputId">
	<div class="container main-container layout-search">
		<div class="col-md-12 in-container">


			<div class="col-md-9" style="border-right: solid 1px #a4a5a7;">
				<div class="col-md-6">
					<div class="gallery">
						<div class="precio-label-main">
							<span ng-if="publicacion.tipo_moneda==2 && publicacion.precio != 0">$</span>
							<span ng-if="publicacion.tipo_moneda==1 && publicacion.precio != 0">USD</span>
							<span ng-if=" publicacion.precio != 0 ">@{{publicacion.precio | formatPrice:0:'.':',':false}} </span>
							<span ng-if="publicacion.precio == 0" >A convenir </span>
						</div>
						{{--<div class="precio-label-main2">--}}

							{{--<span>@{{hora.horario}} </span>--}}
						{{--</div>--}}



						<img class="main-img" id="main_img" ezp-options="{scrollZoom: true, easing: true,zoomType:Lens}"  ng-src="/@{{imgmain}}" alt="">
						<ul class="miniaturas col-md-12">
							<li ng-click="chan(thum.ruta)" class="col-md-3" ng-repeat="thum in publicacion.publicacion_imagen">
								<img src="/@{{thum.ruta}}" alt="">
							</li>
						</ul>
					</div>
				</div>
				<div class="col-md-6">
					<h2>@{{publicacion.titulo}}</h2>

					<button ng-if="publicacion.vendido=='no' && hora.horario == 'No disponible'" class="button-contact">@{{hora.horario}}</button>
					<button ng-if="publicacion.vendido=='no' && hora.horario!= 'No disponible'" class="button-contact" ng-click="openmodal({{$id}},publicacion.titulo,publicacion.precio);">@{{ 'COMPRAR' | translate }}</button>
					<h3 class="sub-title-item">@{{ 'DESCRIPCION' | translate }} </h3>
					<p class="descripcion-item">@{{publicacion.descripcion | limitTo:550}}</p>
					{{--<h3 class="sub-title-item">Caracteristicas</h3>--}}
					<br/>
					<div>
						<div class="col-md-12">
							<div class="col-md-6" ng-repeat="att in publicacion.publicacion_atributos">
								<h5 class="sub-title-description">@{{att.nombre}}</h5>
								<p>@{{att.pivot.valor_atributo}}</p>
							</div>
						</div>
					</div>
					<p style="text-align: center"><a href="/listarpro/@{{publicacion.id_user}}">@{{ 'VERTODASVENDEDOR' | translate }}</a></p>
					<div class="col-md-8">
						 <p style="margin-top: 15%;"> <i class="fa fa-clock"></i> Tiempo medio de entrega 75 Min</p>
					</div>
					<div class="col-md-4">
						@{{ 'COMPARTIR' | translate }}:
						<div style="float: right">

							<div  ng-click="face(thum.ruta)">
								<i style="font-size: 35px;" class="fab fa-facebook-square"></i>
							</div>
							&nbsp;
							<div>
								<a href="#"
								   socialshare
								   socialshare-provider="email"
								   socialshare-url="http://apatxee.com"
								   socialshare-text="Este producto es lo maximo"
								   socialshare-popup-height="800"
								   socialshare-popup-width="800">
									<i style="font-size: 32px;" class="fas fa-envelope"></i>
								</a>
							</div>
						</div>
					</div>






				</div>
				<div class="col-md-12">
					<br>
				<hr>
					{{--<h3>@{{ 'PREGUNTASYRESP' | translate }} </h3>--}}
					{{--<p>@{{ 'OPINIONESVENDEDOR' | translate }}</p>--}}
					{{--<div id="fb-root"></div>--}}
					{{--<div class="fb-comments" width="100%" data-href="https://apatxee.com/publicacion/@{{user.id}}" data-numposts="5"></div>--}}
				</div>
			</div>
			<aside class="col-md-3 sidebar">
				<div class="widget">
					<div class="col-md-12">
						<div class="sub-title col-md-9">
							<h3>@{{ 'PRODUCTODEST' | translate }}</h3>
						</div>
						<div style="font-size: 10px;line-height: 1;" class="sub-title col-md-3 center">
							<a href="/destacado"><i class="fa fa-trophy"></i>@{{ 'VERTODOS' | translate }}</a>
						</div>
					</div>

					<ul class="list-cat">
					<li class="clearfix" ng-repeat="publicacion in publicaciones" ng-if="publicacion.publicacion.destacado=='1'">
						<a href="/publicacion/@{{publicacion.publicacion.id}}">
							<h5>@{{publicacion.publicacion.horario}}</h5>
							<figure><img style="width: 70%; border: solid 1px #a4a5a7;" src="/@{{publicacion.images[0].ruta}}" alt="Entry name"></figure>
							<div class="product-content">
								<h5><a href="#">@{{publicacion.publicacion.titulo}}</a></h5>
								<p><span class="product-price">@{{publicacion.publicacion.precio | formatPrice:0:'.':',':false}}</span>  <span ng-if="publicacion.publicacion.tipo_moneda==2 && publicacion.publicacion.precio != 0">EUR</span></p>
							</div><!-- End .entry-content -->
						</a>
					</li>
					</ul>



					{{--<ul class="list-cat">--}}
						{{--<li class="clearfix" ng-repeat="publicacion in recomendados_publi " ng-if="publicacion.destacado=='1'">--}}
							{{--<a href="/publicacion/@{{publicacion.id}}">--}}

								{{--<figure><img style="width: 70%; border: solid 1px #a4a5a7;" src="/@{{publicacion.publicacion_imagen[0].ruta}}" alt="Entry name"></figure>--}}
								{{--<div class="product-content">--}}
									{{--<h5><a href="#">@{{publicacion.titulo}}</a></h5>--}}
									{{--<p><span class="product-price">@{{publicacion.precio | formatPrice:0:'.':',':false}}</span>  <span ng-if="publicacion.tipo_moneda==2 && publicacion.precio != 0">EUR</span></p>--}}
								{{--</div><!-- End .entry-content -->--}}
							{{--</a>--}}
						{{--</li>--}}
					{{--</ul>--}}
				</div><!-- End .widget -->
			</aside>


			<div class="col-md-12">
				<h3 class="sub-title-item">@{{ 'SIMILARES' | translate }} </h3>
				<a ng-repeat="i in recomendados_publi" href="/publicacion/@{{i.id}}"><div class="col-md-3">
					<div class="item" style="background-image:url('/@{{i.publicacion_imagen[0].ruta}}')">
						<div class="labels">
							<h4 class="price">
							<span ng-if="i.tipo_moneda==2">$</span>
							<span ng-if="i.tipo_moneda==1">USD</span>
							<span class="ng-binding">@{{i.precio | formatPrice:0:'.':',':false}}</span>
							</h4>
							<h3 class="ng-binding">@{{i.titulo}}</h3>
						</div>
					</div>
				</div>
			</a></div>
		</div>

	</div>
</body>
