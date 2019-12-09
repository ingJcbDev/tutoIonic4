<body style="background-color: #ffffff" ng-controller="productoController">

<div class="container main-container layout-search"  >
    <div class="col-md-12 in-container">

        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-8 ">

                <div class="col-xs-12 col-md-12 contact-modal">
                    <div ng-show="suiche==1">
                        <h1 style="text-align: center; margin-bottom: 5px">Ingresar Publicación</h1><br/>



                        <form class="form-contact" ng-submit="ingresar();">
                            <div style="    border: solid 1px #ccc;">
                                <p>Datos Basicos del producto</p>
                                <fieldset><input type="text" placeholder="Titulo" required ng-model="titulo"></fieldset>
                                <fieldset><input type="text" placeholder="Precio" required ng-model="precio"></fieldset>
                                <fieldset>
                                    <h5>Divisa:</h5></br>
                                    <select name="singleSelect" required id="singleSelect" ng-model="divisa">
                                        <option value="">---Please select---</option> <!-- not selected / blank option -->
                                        <option value="1">USD</option> <!-- interpolation -->
                                        <option value="2">EUR</option>
                                    </select><br>
                                </fieldset>
                                <fieldset>
                                    <textarea name="" required id="" cols="30" rows="5" placeholder="Descripción" ng-model="descripcion" class="ng-pristine ng-valid ng-empty ng-touched"></textarea>
                                </fieldset>
                                <fieldset>
                                    <h5>Categorias:</h5></br>
                                    <multiple-autocomplete ng-model="categoria"
                                                           object-property="datosextra"
                                                           before-select-item="selectItemCallback"
                                                           after-select-item="selectItemCallback"
                                                           before-remove-item="removeItemCallback"
                                                           after-remove-item="removeItemCallback"
                                                           suggestions-arr="categoriaslist">
                                    </multiple-autocomplete>
                                </fieldset>

                            </div>
                            <div style="    border: solid 1px #ccc;">
                                <fieldset>
                                    <h3>Horario del producto</h3>
                                    <p>Fecha de Inicio</p>
                                    <input type="date"  min="2018-04-22"  placeholder="Fecha de Inicio" required ng-model="date_init"></fieldset>
                                <fieldset>
                                    <p>Fecha Final</p>
                                    <input type="date"  min="2018-04-22"
                                           placeholder="Fecha Final" required ng-model="date_finish"></fieldset>
                                <fieldset>
                                    <p>Hora de disponibilidad - Inicio</p>
                                    <input type="time"  name="input" ng-model="hour_init"
                                           placeholder="HH:mm:ss"  required />
                                    </fieldset>
                                <fieldset>
                                    <p>Hora de disponibilidad - Final</p>
                                    <input type="time" placeholder="Final de disponibilidad Hora " ng-model="hour_finish"></fieldset>

                                <fieldset>
                                    <p>Dias en los que el producto estara disponible</p>
                                    <div class="col-xs-12 col-md-1" style=" ">

                                    </div>
                                    <div class="col-xs-12 col-md-1" style="">
                                        <div>
                                            <P class="ptitulos">Lunes
                                                <input type="checkbox" ng-model="dia[0].status"
                                                       ng-true-value="'true'" ng-false-value="'false'">
                                            </P>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-1" style=" margin-left: 3%">
                                        <div>
                                            <P class="ptitulos">Martes
                                                <input type="checkbox" ng-model="dia[1].status"
                                                       ng-true-value="'true'" ng-false-value="'false'">
                                            </P>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-1" style="margin-left: 3%">
                                        <div>
                                            <P class="ptitulos">Miercoles
                                                <input type="checkbox" ng-model="dia[2].status"
                                                       ng-true-value="'true'" ng-false-value="'false'">
                                            </P>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-1" style=" margin-left: 3%">
                                        <div>
                                            <P class="ptitulos">Jueves
                                                <input type="checkbox" ng-model="dia[3].status"
                                                       ng-true-value="'true'" ng-false-value="'false'">
                                            </P>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-1" style=" margin-left: 3%">
                                        <div>
                                            <P class="ptitulos">Viernes
                                                <input type="checkbox" ng-model="dia[4].status"
                                                       ng-true-value="'true'" ng-false-value="'false'">
                                            </P>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-1" style=" margin-left: 3%">
                                        <div>
                                            <P class="ptitulos">Sabado
                                                <input type="checkbox" ng-model="dia[5].status"
                                                       ng-true-value="'true'" ng-false-value="'false'">
                                            </P>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-1" style=" margin-left: 3%">
                                        <div>
                                            <P class="ptitulos">Domingo
                                                <input type="checkbox" ng-model="dia[6].status"
                                                       ng-true-value="'true'" ng-false-value="'false'">
                                            </P>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>

                            <fieldset>
                                <button  class="button-contact" type="submit">Siguiente</button>
                            </fieldset>
                        </form>
                    </div>
                    <div ng-show="suiche==2 || suiche==3 " >
                        <h1> Cargar Imagenes del producto</h1><br/><br/>
                        <fieldset><div class="dropzone" options="dzOptions" callbacks="dzCallbacks" methods="dzMethods" ng-dropzone></div></fieldset>
                    </div>
                    <div ng-show="suiche==3">
                        <fieldset>
                            <button ng-click="attrs()" class="button-contact" type="submit">Siguiente</button>
                        </fieldset>
                    </div>
                    <div ng-show="suiche==4">
                        <h1 style="text-align: center">Atributos del producto</h1>

                        <form class="form-contact" ng-submit="ingresarattr();">
                            <div ng-repeat="at in attrs track by $index">
                                    <label>@{{ at.nombre }}</label>
                                    <fieldset><input type="text" placeholder="@{{ at.nombre }}" required name="valor" ng-model="arreglo[$index].datoform"></fieldset>

                            </div>
                            <fieldset>
                                <button  class="button-contact" type="submit">Siguiente</button>
                            </fieldset>
                        </form>
                    </div>
                    <div ng-show="suiche==5 || suiche==6 ">
                        <h1 style="text-align: center">Producto agregado Correctamente</h1>
                        <p>tu producto ya fue registrado exitosamente, desde este momento los clientes podran verlo</p>
                        <div ng-if="suiche!=6">
                            <p>¿Deseas destacar este producto?</p>
                            <p>Tiene un costo de 3 Euros</p>
                            <div id="paypal-button-container"></div>
                        </div>
                        <div ng-if="suiche==6">
                            <H3>Felicidades Tu Producto ahora sera mas visible para tus clientes </H3>
                            <p>Producto destacado correctamente</p>
                        </div>

                            <fieldset>
                                <button ng-click="verpro()" class="button-contact" type="submit">Ver Producto</button>
                            </fieldset>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
            </div>
        </div>




        <br><br><br><br>


    </div>
</div>

</body>
