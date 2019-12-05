<body style="background-image:url({{asset('img/back-results.jpg')}})" ng-controller="ingresaController">

<div class="container main-container layout-search"  >
    <div class="col-md-12 in-container">

        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-7" style="margin-top: 5%">
                <h1 ng-if="iputre==false"  style="text-align: center">Ingresar</h1>
                <h1 ng-if="iputre==true"  style="text-align: center">Recuperar</h1>
                <div class="col-xs-12 col-md-12 contact-modal">
                    <form ng-if="iputre==false" class="form-contact" ng-submit="ingresar(email,password);">
                        <fieldset><input type="email" placeholder="Email" required ng-model="email"></fieldset>
                        <fieldset><input type="password" placeholder="Password" required  ng-model="password"></fieldset>
                        <fieldset>
                            <button  class="button-contact" type="submit">Ingresar</button>
                        </fieldset>
                    </form>
                    <form ng-if="iputre==true" class="form-contact" ng-submit="recuperar(emailr);">
                        <fieldset><input type="email" placeholder="Email" name="emailr" required ng-model="emailr"></fieldset>
                        <fieldset>

                            <button  class="button-contact" type="submit">Recuperar</button>
                        </fieldset>
                    </form>
                    <p  ng-if="iputre==false" style="cursor: pointer" ng-click="olvide()" >¿Olvido su contraseña?</p>
                    <p  ng-if="iputre==true" style="cursor: pointer" ng-click="olvide()" >Ingresar</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="widget">
                    <div class="sub-title">
                        <h3>@{{ 'PRODUCTODEST' | translate }}</h3>
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
                </div><!-- End .widget -->
            </div>
        </div>




      <br><br><br><br>


    </div>
</div>
</body>
