<footer ng-controller="newsleterController">
<div class="container footer-padding">
	<div class="col-md-6 col-xs-12 footer-element-padding">
		{{--<div>--}}
			{{--<b>Ciudad:</b>--}}
		{{--</div>--}}

		<div>
			tu DIRECCION</br>
			TUS DATOS</br>
			Teusaquillo</br>
			TU CALLE, ETC
		</div>
	</div>
	<div class="col-md-3 col-xs-12 footer-element-padding">
		<ul>
			<li><b>@{{ 'CATEGORIA' | translate }}</b></li>
			<li ng-repeat="cat in categorias"><a href="/categoria/@{{cat.parent}}">@{{cat.name}}</a></li>
		</ul>
	</div>
	<div class="col-md-3 col-xs-12 footer-element-padding">

		<p><b>@{{ 'CONTACTAR' | translate }} </b></p>
		<form style="color: #0c0c0c" class="form-contact" ng-submit="enviar(id_prod_hid);">

		<input type="hidden" name="id_product"  ng-model="id_prod_hid">
		<fieldset><input style="border-radius: 8px; margin: 1px;" type="text" placeholder="Nombre" ng-model="nombre"></fieldset>
		<fieldset><input style="border-radius: 8px; margin: 1px;" type="text" placeholder="Email" ng-model="email"></fieldset>
		<fieldset>
		<textarea name=""  style="border-radius: 8px; margin: 1px;" id="" cols="30" rows="5" placeholder="Mensaje" ng-model="descripcion"></textarea>
			<button  class="button-contact" type="submit">@{{ 'ENVIAR' | translate }}</button>
		</fieldset>
		</form>
		<span ng-if="send==true" style="font-size: 1.4em;">Mensaje Enviado!</span>

		{{--<ul>--}}
			{{--<li><b>ApaTxee</b></li>--}}
			{{--<li><a href="/quienes">Quienes Somos</a></li>--}}
			{{--<li><a href="javascript:void(0);" ng-click="openmodal();">Contacto</a></li>--}}
		{{--</ul>--}}
	</div>
</div>
</footer>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script data-require="angular-socialsharing@*" data-semver="0.1.0" src="https://rawgit.com/pasupulaphani/angular-socialsharing/master/dist/angular-socialsharing.min.js"></script>
<script src="https://js.braintreegateway.com/web/3.11.0/js/client.min.js"></script>
<script src="https://js.braintreegateway.com/web/3.11.0/js/paypal-checkout.min.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
<script src="{{asset('js/pagination.js')}}"></script>
<script>
	$(function(){
		$(".pagination").rPage();
	});
</script>

