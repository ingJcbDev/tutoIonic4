<body style="background-color: #FFFFFF" ng-controller="listaController">
<input type="hidden" id="src_string" ng-init="inputId='{{$id}}'" ng-model="inputId">
<div class="container main-container layout-search"  >
    <div class="col-md-12 in-container">
        <div class="row">
            <div ng-if="user.tipe == '2'" class="grid-products container">
                <div class="grid-products col-md-12 col-xs-12 container">
                    <div class="container">
                        <h2>Lista de productos publicados por: @{{username}}</h2>
                        <p>Aqui estan tus productos registrados</p>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Descripcion</th>
                                <th>Precio</th>
                                <th>Opciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr  ng-repeat="publicacion in publicaciones" >
                                <td>@{{publicacion.publicacion.titulo}}</td>
                                <td>@{{publicacion.publicacion.descripcion | limitTo:35}} </td>
                                <td>@{{publicacion.publicacion.precio  | formatPrice:0:'.':',':false}}</td>
                                <td><i ng-click="edit(publicacion.publicacion.id)" class="far fa-edit botonselet"></i>

                                    <i ng-click="delete(publicacion.publicacion.id)" class="far fa-trash-alt botonselet"></i></td>
                            </tr>
                            </tbody>
                        </table>
                        <div style="width: 100%; border-bottom: solid 1px #111111"></div>
                    </div>
                </div>

            </div>
            <div class="grid-products container">
                    <button ng-if="datacar.length>0" style="float: right; width: 200px"  ng-click="vaciarcar()"  class="button-contact " >Vaciar Carro</button>
                <div class="grid-products col-md-12 col-xs-12 container">
                    <div class="container">
                        <h2>Carrito de compras</h2>
                        <p>Aqui estan tus productos agregados</p>
                        <div  ng-if="datacar.length<=0"  style="text-align: center">
                                      <h1> Carrito vacio</h1>
                        </div>
                        <table  ng-if="datacar.length>0" class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Descripcion</th>
                                <th>Precio</th>
                                {{--<th>Opciones</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            <tr  ng-repeat="publicacion in datacar" >
                                <td>@{{publicacion.producto}}</td>
                                <td>@{{publicacion.name | limitTo:35}} </td>
                                <td>@{{publicacion.precio  | formatPrice:0:'.':',':false}} $</td>
                                {{--<td><i ng-click="edit(publicacion.publicacion.id)" class="far fa-edit botonselet"></i>--}}

                                    {{--<i ng-click="delete(publicacion.publicacion.id)" class="far fa-trash-alt botonselet"></i></td>--}}
                            </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
                <div ng-if="enviar_msj" class="col-md-6 in-container">
                    <h1>@{{enviar_msj}}</h1>
                </div>
                <div ng-if="!enviar_msj" class="col-md-6 in-container">
                    <button ng-if="datacar.length > 0" ng-click="comprar()" class="button-contact ng-binding ng-scope">Comprar</button>
                </div>


            </div>
        </div>
    </div>
</div>
</body>
