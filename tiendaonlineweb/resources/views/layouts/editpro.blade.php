<body style="background-color: #ffffff" ng-controller="editController">
<input type="hidden" id="src_string" ng-init="inputId='{{$id}}'" ng-model="inputId">
<div class="container main-container layout-search"  >
    <div class="col-md-12 in-container">

        <div class="row">
            <div class="col-md-6 ">

                <div class="col-xs-12 col-md-12 contact-modal">
                    <div>
                        <h1 style="text-align: center; margin-bottom: 5px">Editar Publicación: @{{ titulo2 }}</h1><br/>


                        <form  ng-submit="editar();">
                            <div style="    border: solid 1px #ccc;">
                                <p>Datos Basicos del producto</p>
                                <fieldset><input name="titulo" type="text" placeholder="Titulo" required ng-model="titulo"></fieldset>
                                <fieldset><input name="precio" type="text" placeholder="Precio" required ng-model="precio"></fieldset>
                                <fieldset>
                                    <h5>Divisa:</h5></br>
                                    <select name="singleSelect" required id="singleSelect" ng-model="divisa">
                                        <option value="">---Please select---</option> <!-- not selected / blank option -->
                                        <option value="1">USD</option> <!-- interpolation -->
                                        <option value="2">EUR</option>
                                    </select><br>
                                </fieldset>
                                <fieldset>
                                    <textarea name="" required id="" cols="30" rows="5" placeholder="Descripción" ng-model="descripcione" class="ng-pristine ng-valid ng-empty ng-touched"></textarea>
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
                                    <input type="date"  name="date_init" min="2018-04-22"  placeholder="Fecha de Inicio" required ng-model="date_init"></fieldset>
                                <fieldset>
                                    <p>Fecha Final</p>
                                    <input type="date"  name="date_finish"  min="2018-04-22"
                                           placeholder="Fecha Final" required ng-model="date_finish"></fieldset>
                                <fieldset>

                                    <p>Hora de disponibilidad - Inicio</p>
                                    @{{hi}}
                                    <i  ng-click="edithi()"  class="far fa-edit"></i>
                                    <input name="hour_init" ng-show="hinicio==0" type="time"   ng-model="hour_init"
                                           placeholder="HH:mm:ss"   />
                                </fieldset>
                                <fieldset>
                                    <p>Hora de disponibilidad - Final</p>
                                    @{{hf}}
                                    <i ng-click="edithf()"  class="far fa-edit"></i>
                                    <input name="hour_finish" ng-show="hfinal==0" type="time"  placeholder="Final de disponibilidad Hora " ng-model="hour_finish">
                                </fieldset>

                                <fieldset>
                                    <p>Dias en los que el producto estara disponible</p>
                                    <div class="col-xs-12 col-md-1" style=" ">

                                    </div>
                                    <div class="col-xs-12 col-md-1" style="">
                                        <div>
                                            <P class="ptitulos">Lunes
                                                <input type="checkbox" name="lunes" ng-model="dia[0].status"
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
                                <button  class="button-contact" type="submit">Editar</button>
                            </fieldset>
                        </form>
                    </div>

                </div>
            </div>
            <div class="col-md-6">
                <div>
                    <h1 style="text-align: center; margin-top: 10%;">Cargar Imagenes</h1><br/><br/>
                    <fieldset><div class="dropzone" options="dzOptions" callbacks="dzCallbacks" methods="dzMethods" ng-dropzone></div></fieldset>
                </div>
                <div ng-show="destacado==0" >
                   <br>
                    <div style="text-align: center">
                        <p>¿Deseas destacar este producto?</p>
                        <p>Tiene un costo de 3 Euros</p>
                        <div id="paypal-button-container"></div>
                    </div>
                </div>
                <div ng-show="destacado==1" >
                    <br>
                    <div style="text-align: center">
                        <p>Tu producto ya esta entre los destacados</p>
                    </div>
                </div>
            </div>
        </div>




        <br><br><br><br>


    </div>
</div>

</body>
