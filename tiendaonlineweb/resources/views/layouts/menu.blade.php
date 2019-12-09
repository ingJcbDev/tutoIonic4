<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous">
</script>
<script>
    (function ($) {
        $(document).ready(function () {
            $('ul.dropdown-menu [data-toggle=dropdown]').on('click', function (event) {
                event.preventDefault();
                event.stopPropagation();
                $(this).parent().siblings().removeClass('open');
                $(this).parent().toggleClass('open');
            });
        });
    })(jQuery);
</script>

<nav class="navbar navbar-default" ng-controller="menuController">
    <div class="container-fluid" style="height: 100%;">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li ng-if="user.name"><a  href="/registrar">@{{'PUBLICAR' | translate}} @{{'ARTICULO' | translate}}</a></li>
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">@{{'CATEGORIA' | translate}}<b
                                class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li ng-repeat="cat in categorias"
                            ng-class="cat.subscat.length >0 ? 'dropdown dropdown-submenu' : 'dropdown'">
                            <a href="/categoria/@{{cat.parent}}" class="dropdown-toggle"
                               ng-mouseover="verSubmenu($event,this)">@{{cat.name}}</a>
                            <ul class="dropdown-menu" ng-if="cat.subscat.length >0">
                                <li ng-repeat="subcat in cat.subscat">
                                    <a href="/categoria/@{{subcat.id}}">@{{subcat.nombre}}</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li ng-if="user.name" class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">@{{ user.name }}<b
                                class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li   ng-class="cat.subscat.length >0 ? 'dropdown dropdown-submenu' : 'dropdown'">
                            <a href="/listar/@{{user.id}}" class="dropdown-toggle" >Mis compras</a>
                        </li>
                        <li   ng-class="cat.subscat.length >0 ? 'dropdown dropdown-submenu' : 'dropdown'">
                            <a href="/registrarusuario" class="dropdown-toggle" >Perfil</a>
                        </li>
                        <li   ng-class="cat.subscat.length >0 ? 'dropdown dropdown-submenu' : 'dropdown'">
                            <a ng-click="salir();" href="#" class="dropdown-toggle">@{{'SALIR' | translate}}</a>
                        </li>
                    </ul>
                </li>
                <li ng-if="!user.name"><a  href="/registrarusuario">Registrate</a></li>
                <li ng-if="user.name==null"><a href="/ingresar">@{{'INGRESAR' | translate}}</a></li>
                <li style="float: right; margin-top: 3%;">
                    <div  ng-click="changeLanguage('en_US');"><img style="width: 10%; float: right; cursor: pointer" src="/img/usa.png"></div>
                    <div  ng-click="changeLanguage('es_ES');"><img style="width: 10%; float: right; cursor: pointer" src="/img/esp.png"></div>
                </li>

                {{--<li><a href="/quienes">Quiénes Somos</a></li>--}}
                {{--<li><a href="javascript:void(0);" ng-click="openmodal();">Contacto</a></li>--}}
            </ul>
           {{-- <ul class="nav navbar-nav " style="float: right; width: 20%; margin-top: 20px;">
                    <li></li>

                   --}}{{-- <a style="cursor: pointer" ng-click="changeLanguage('en_US');"><img style="width: 10%;" src="img/usa.png"></a>
                    <a style="cursor: pointer" ng-click="changeLanguage('es_ES');"><img style="width: 10%;" src="img/esp.png"> </a>--}}{{--

            </ul>--}}
        </div><!--/.nav-collapse -->
    </div>
</nav>


<div>
    <div class="cat-menu-sub" ng-show="history.length>0">
        <ul>
            <li ng-repeat="cat in history">
                <ins>@{{cat.nombre}}</ins>
                <span ng-hide="$index+1==history.length"> > </span>
            </li>
        </ul>
    </div>

</div>
