<div class="overlay" style="display: none" ng-controller="modaladdresCoontroller">

    <div class="col-xs-12 col-md-6 contact-modal">
        <span class="close-modal" ng-click="closemodal();"><i class="fa fa-window-close" aria-hidden="true"></i></span>
        <div >
            <h1>Hola, Buscaremos los productos que esten cerca de ti.</h1>
            <h4 style='margin-top: 20px;'>Para esto te pediremos que nos proporciones tu Dirección.</h4>

            <form class="form-contact" ng-submit="enviar();" >
                <fieldset>
                    <input vs-google-autocomplete ng-model="address.name"
                    vs-place="address.place"
                    vs-place-id="address.components.placeId"
                    vs-street-number="address.components.streetNumber"
                    vs-street="address.components.street"
                    vs-city="address.components.city"
                    vs-state="address.components.state"
                    vs-country-short="address.components.countryCode"
                    vs-country="address.components.country"
                    vs-post-code="address.components.postCode"
                    vs-district="address.components.district"
                    vs-latitude="address.components.location.lat"
                    vs-longitude="address.components.location.long" type="text"
                    name="address"
                    id="address"
                    class="form-control" style="width: 100%" placeholder="Enter address">
                </fieldset>
                <button ng-if="address.components.location.lat" class="button-contact" type="submit">Continuar</button>
            </form>
            <fieldset>
            <div class="text-align: center">
                <div style="    border-bottom: solid 1px #afaeae; width: 50%; text-align: center; display: inline-block;"></div>
            </div>
            </fieldset>

            <a href="/ingresar"><button  class="button-contact" type="submit">Ya estoy registrado</button></a>
        </div>

    </div>
</div>
