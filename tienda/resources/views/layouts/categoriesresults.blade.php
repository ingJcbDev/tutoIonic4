<body style="background-image:url({{asset('img/back-results.jpg')}})" ng-controller="categorieController">
<input type="hidden" id="src_string" ng-init="inputSrc='{{$id}}'" ng-model="inputSrc">
<div class="container main-container layout-search">
    <div class="col-md-12 in-container">
        <div class="col-md-2">
            <div>
                <form action="/buscar" id="formulario-buscar">


                    <div class="input-group">
                        <input class="form-control" placeholder="Buscar" name="src" id="src" type="text"
                               placeholder="Buscar" autocomplete="off">
                        <span class="input-group-btn">
			        <button class="btn btn-default " type="submit"><span
                                class="glyphicon glyphicon-search"></span></button>
			      </span>
                    </div>


                </form>
            </div>

            <div ng-repeat="att in resultados.atributos track by $index" style="padding-left:2%;">
                <h4 class="parent-cat">@{{att.nombre}} </h4>
                <ul class="list-cat">
                    <li ng-repeat="a in resultados.valores[att.id] | unique:'valor'"
                        ng-init="filter_len = (resultados.valores[att.id] | filter: { id_atributo : att.id,valor:a.valor }).length">

                        <a href="javascript:void(0)" ng-click="filter(a.id_atributo,a.valor,{{$id}})">@{{a.valor}}
                            (@{{filter_len}})</a>

                    </li>
                </ul>
            </div>
            {{--<div class="logo-security-layout">--}}
            {{--<img src="/img/logo-seguro.png" style="width: 140px;" alt="">--}}
            {{--</div>--}}
        </div>
        <div class="col-md-10" style="    border-right: solid 1px #a4a5a7;">

            <div ng-if="resultados.publicaciones.data==null" class="text-center">No hay resultados</div>

            {{--<a style="margin-bottom: 15px" href="/publicacion/@{{publicacion.id_producto}}" ng-repeat="publicacion in resultados.publicaciones.data">--}}
                {{--<div class="col-md-12 item" style="border-bottom: solid;" >--}}
                    {{--<div class="precio-label-main">--}}
                        {{--<h5>Disponible: ahora</h5>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-4 col-xs-12 ">--}}
                        {{--<img style="width: 200px; height:245px" src="/@{{resultados.imagen[publicacion.id][0].ruta}}">--}}
                    {{--</div>--}}
                    {{--<div class="col-md-8 " style="height: 100%;">--}}
                        {{--<div>--}}
                            {{--<div>--}}
                                {{--<div class="movil"  style="width: 80%">--}}
                                    {{--<h1 style="  margin-top: 5px;">@{{publicacion.titulo | limitTo:20}}</h1>--}}
                                {{--</div>--}}
                                {{--<br/>--}}
                                {{--<p class="movil">@{{publicacion.descripcion | limitTo:150}}</p>--}}
                            {{--</div>--}}
                            {{--<div class="labels">--}}
                                {{--<h4  class="price movil">--}}
                                    {{--<span class="ng-scope">Tiempo medio de entrega 75 min</span>--}}
                                    {{--<span class="ng-binding ng-scope"></span>--}}
                                {{--</h4>--}}
                                {{--<h3 class="ng-binding">PRECIO:--}}
                                    {{--<span ng-if="publicacion.publicacion.tipo_moneda==2 && publicacion.publicacion.precio != 0">EUR</span>--}}
                                    {{--<span ng-if="publicacion.publicacion.tipo_moneda==1 && publicacion.publicacion.precio != 0">USD</span>--}}
                                    {{--<span ng-if="publicacion.publicacion.precio != 0">@{{publicacion.precio | formatPrice:0:'.':',':false}}</span>--}}
                                    {{--<span ng-if="publicacion.publicacion.precio ==0">A convenir</span></h3>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</a>--}}



            <a href="/publicacion/@{{publicacion.id_producto}}" ng-repeat="publicacion in resultados.publicaciones.data">
                <div class="col-md-4" ng-show="resultados.imagen[publicacion.id_producto][0].ruta.length>1">
                    <div class="item" style="background-image:url('/@{{resultados.imagen[publicacion.id_producto][0].ruta}}')">
                        <div class="labels">
                            <h3>@{{publicacion.titulo}}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" ng-show="resultados.imagen[publicacion.id][0].ruta.length>1">
                    <div class="item" style="background-image:url('/@{{resultados.imagen[publicacion.id][0].ruta}}')">
                        <div class="labels">
                            <h4 class="price">
                                <span ng-if="publicacion.tipo_moneda==2  && publicacion.precio != 0">USD</span>
                                <span ng-if="publicacion.tipo_moneda==1 && publicacion.precio != 0">USD</span>
                                <span ng-if=" publicacion.precio != 0 ">@{{publicacion.precio | formatPrice:0:'.':',':false}}</span>
                                <span ng-if="publicacion.precio == 0">A convenir</span>
                            </h4>
                            <h3>@{{publicacion.titulo}}</h3>
                        </div>
                    </div>
                </div>
            </a>
            <div class="col-md-12">
                <ul class="pagination" ng-if="resultados.pagination.last_page">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>

                    <li ng-repeat="n in [] | range:(resultados.pagination.last_page)" class="page-item"
                        ng-click="nextpage(n+1)"><a class="page-link" href="#">@{{n+1}}</a></li>

                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        {{--<div class="col-md-3">--}}
            {{--<div class="widget">--}}
                {{--<div class="sub-title">--}}
                    {{--<h3>Productos Destacados</h3>--}}
                {{--</div>--}}
                {{--<ul class="list-cat">--}}
                    {{--<li class="clearfix" ng-repeat="publicacion in publicaciones2 | limitTo : 3 ">--}}
                        {{--<a href="/publicacion/@{{publicacion.publicacion.id}}">--}}
                            {{--<figure><img style="width: 70%; border: solid 1px #a4a5a7;" src="/@{{publicacion.images[0].ruta}}" alt="Entry name"></figure>--}}
                            {{--<div class="product-content">--}}
                                {{--<h5><a href="#">@{{publicacion.publicacion.titulo}}</a></h5>--}}
                                {{--<p><span class="product-price">@{{publicacion.publicacion.precio | formatPrice:0:'.':',':false}}</span>  <span ng-if="publicacion.publicacion.tipo_moneda==2 && publicacion.publicacion.precio != 0">EUR</span></p>--}}
                            {{--</div><!-- End .entry-content -->--}}
                        {{--</a>--}}
                    {{--</li>--}}
                {{--</ul>--}}
            {{--</div><!-- End .widget -->--}}
        {{--</div>--}}
    </div>
</div>
</body>
