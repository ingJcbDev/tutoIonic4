<body style="background-color: #FFFFFF" ng-controller="HomeController">

<div class="container main-container layout-search"  >
    <div class="col-md-12 in-container">
        <div class="row">
            <div class="grid-products container">
                <div class="grid-products col-md-12 col-xs-12 container">
                    <div class="sub-title">
                        <h3>@{{ 'PRODUCTODEST' | translate }}<i class="fa fa-trophy"></i></h3>
                    </div>
                    <a style="margin-bottom: 15px" href="/publicacion/@{{publicacion.publicacion.id}}"  ng-if="publicacion.publicacion.destacado==1" ng-repeat="publicacion in publicaciones">
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
                                            <span class="ng-scope">Tiempo medio de entrega 75 min</span>
                                            <span class="ng-binding ng-scope"></span>

                                        </h4>
                                        <h3 class="ng-binding">PRECIO:
                                            <span ng-if="publicacion.publicacion.tipo_moneda==2 && publicacion.publicacion.precio != 0">EUR</span>
                                            <span ng-if="publicacion.publicacion.tipo_moneda==1 && publicacion.publicacion.precio != 0">USD</span>
                                            <span ng-if="publicacion.publicacion.precio != 0">@{{publicacion.publicacion.precio | formatPrice:0:'.':',':false}}</span>
                                            <span ng-if="publicacion.publicacion.precio ==0">A convenir</span></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>