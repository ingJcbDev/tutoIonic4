{{--<body style="background-image:url({{asset('img/back-results.jpg')}});background-size: 100%" ng-controller="HomeController">--}}

<body style="background-color: #fff; background-size: 100%;" ng-controller="HomeController">

<div class="container">
<!-- <div class="search-box">
			<form action="/buscar">
			<span>
				<input type="text" name="src" autocomplete="off" id="src" placeholder="¿Que precisa tu campo?">
				<button type="submit" class="icon-search"><img src="{{asset('img/icon-search.png')}}" alt=""></button>
			</span>
			</form>
		</div> -->
    <div class="row" style="margin-top:162px;margin-bottom:60px;">
        <div class="col-md-6" style="padding-top:5%;">
            <form action="/buscar">
                <div class="input-group">

                    <input type="" class="form-control" style="height: 50px;     font-size: 18px;"
                           placeholder="@{{ 'QUENECESITAS' | translate }}" name="src" autocomplete="off" id="src">
                    <span class="input-group-btn">
			        <button class="btn btn-default "
                            style="height: 50px; color:#ffffff;     width: 63px;  background-color: #971a13;     font-size: 30px;"
                            type="submit"><span class="glyphicon glyphicon-search"></span></button>
			      </span>
                </div>
            </form>
        </div>
        <div class="col-md-3">

        </div>
        <div class="col-md-3" style="text-align:center;    ">
            {{--<a href="#">--}}
                {{--<img class="logomovil"  src="{{asset('img/playstore.png')}}" alt="">--}}
            {{--</a>--}}
            {{--<a href="#">--}}
                {{--<img class="logomovil"  src="{{asset('img/ios.png')}}" alt="">--}}
            {{--</a>--}}
        </div>
    </div>
    <div class="row">
        <div class="title-box">
            <h2>@{{'TITLE' | translate}}</h2>
        </div>
        <div class="center">
            <div class="grid-products container tablabas">
                <div class="grid-products col-md-4 col-xs-12 container">
                    <img class="imgbas"  src="{{asset('img/apatxee1.png')}}" alt="">
                    <p style="font-weight: 600; margin: 5%;">@{{'TUTO1' | translate}}</p>
                </div>
                <div class="grid-products col-md-4 col-xs-12 container">
                    <img class="imgbas"  src="{{asset('img/apatxee2.png')}}" alt="">
                    <p style="font-weight: 600; margin: 5%;">@{{'TUTO2' | translate}}</p>
                </div>
                <div class="grid-products col-md-4 col-xs-12 container">
                    <img class="imgbas"  src="{{asset('img/apatxee3.png')}}" alt="">
                    <p style="font-weight: 600; margin: 5%;">@{{'TUTO3' | translate}}</p>
                </div>
            </div>

        </div>
        <div class="grid-products container">
            <div class="grid-products col-md-9 col-xs-12 container">
                <div class="sub-title">
                    <h3 ng-if="cerca!='kokies' && cerca!='user'">@{{ 'NUEVOINGRESO' | translate }}</h3>
                    <h3 ng-if="cerca=='kokies' || cerca=='user'"><i class="fa fa-map-marker-alt"></i> @{{contada}} @{{ 'PRODUCTOSCERCA' | translate }}
                        <i ng-if="cerca=='kokies'"  ng-click="kokies();" title="¿Quieres cambiar tu ubicación?" style="float: right; cursor: pointer" class="fa fa-compass"></i>
                    </h3>
                </div>
                <div ng-if="contada==0" style="text-align: center"> <br>
                    <br><h1>@{{ 'NOHAY' | translate }} </h1></div>

                <a style="margin-bottom: 15px" href="/publicacion/@{{publicacion.publicacion.id}}" ng-if="publicacion.publicacion.area=='yes' && publicacion.publicacion.vendido=='no'" ng-repeat="publicacion in publicaciones">
                    <div class="col-md-12 item" style="border-bottom: solid;">
                        <div class="precio-label-main">
                            <h5>@{{publicacion.publicacion.horario}}</h5>
                        </div>
                        <div class="col-md-4 col-xs-12 ">
                            <img style="width: 220px; height: 220px" src="/@{{publicacion.images[0].ruta}}">
                        </div>
                        <div class="col-md-8 " style="height: 100%;">
                            <div>
                                <div  >
                                    <div class="movil"  style="width: 80%">
                                        <h1 style="  margin-top: 5px;">@{{publicacion.publicacion.titulo}}</h1>
                                    </div>
                                    <br/>
                                    <p class="movil">@{{publicacion.publicacion.descripcion | limitTo:300}}</p>
                                </div>
                                <div class="labels">
                                    <h4  class="price movil">
                                       <span class="ng-scope">@{{ 'TIEMPODEENTREGA' | translate }} 75 min</span>
                                       <span class="ng-binding ng-scope"></span>

                                    </h4>
                                    <h3 class="ng-binding">@{{ 'PRECIO' | translate }}:
                                        <span ng-if="publicacion.publicacion.tipo_moneda==2 && publicacion.publicacion.precio != 0">$</span>
                                        <span ng-if="publicacion.publicacion.tipo_moneda==1 && publicacion.publicacion.precio != 0">USD</span>
                                        <span ng-if="publicacion.publicacion.precio != 0">@{{publicacion.publicacion.precio | formatPrice:0:'.':',':false}}</span>
                                        <span ng-if="publicacion.publicacion.precio ==0">A convenir</span></h3>
                                </div>
                            </div>
                        </div>

                    </div>
                </a>
            </div>
            <aside class="col-md-3 movil sidebar" style="background-color: rgba(164, 165, 167, 0.3);  border-left: solid 1px #a4a5a7; margin-top: -10px; margin-bottom: -10px; height: 100%; border-bottom: solid 1px #a4a5a7;
                 border-right: solid 1px #a4a5a7;">
                <div class="widget">
                    <div class="col-md-12">
                        <div class="sub-title col-md-9">
                            <h3>@{{ 'PRODUCTODEST' | translate }} </h3>
                        </div>
                        <div style="font-size: 10px;line-height: 1;" class="sub-title col-md-3 center">
                            <a href="/destacado"><i class="fa fa-trophy"></i>@{{ 'VERTODOS' | translate }} </a>
                        </div>
                    </div>
                        <div>
                            <div>
                                <ul class="list-cat">
                                    <li class="clearfix" ng-repeat="publicacion in publicaciones" ng-if="publicacion.publicacion.destacado=='1'">
                                        <a href="/publicacion/@{{publicacion.publicacion.id}}">
                                            <h5>@{{publicacion.publicacion.horario}}</h5>
                                            <figure><img style="width: 70%; border: solid 1px #a4a5a7;" src="@{{publicacion.images[0].ruta}}" alt="Entry name"></figure>
                                            <div class="product-content">
                                                <h5><a href="#">@{{publicacion.publicacion.titulo}}</a></h5>
                                                <p><span class="product-price">@{{publicacion.publicacion.precio | formatPrice:0:'.':',':false}}</span>
                                                    <span ng-if="publicacion.publicacion.tipo_moneda==2 && publicacion.publicacion.precio != 0">$</span>
                                                    <span ng-if="publicacion.publicacion.tipo_moneda==1 && publicacion.publicacion.precio != 0">USD</span>
                                                </p>
                                            </div><!-- End .entry-content -->
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- End .widget -->
                </div>
                <div style="border-top: solid 1px #a4a5a7; text-align: center">
                    <a href="/destacado"><i class="fa fa-trophy"></i>@{{ 'VERTODOS' | translate }}</a>
                </div>
            </aside>

        </div>

    </div>
</div>
</body>
