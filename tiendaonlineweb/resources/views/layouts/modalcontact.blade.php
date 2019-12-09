<div class="overlay" style="display:none" ng-controller="modalCoontroller">
	
	<div class="col-xs-12 col-md-6 contact-modal">
		<span ng-if="send!=true" class="close-modal" ng-click="closemodal();"><i class="fa fa-window-close" aria-hidden="true"></i></span>
		<span  class="close-modal" ng-if="send==true"> <a href="/"><i class="fa fa-window-close" aria-hidden="true"></i></a></span>
		<div style="margin-top: 5%;" ng-if="sessionactiva==true">
			<div ng-if="send!=true">
				<h1>@{{ "ESTASSEGURO" | translate }}</h1>
			<h4 style='margin-top: 20px;'>@{{ "TUPROLLEGA" | translate }}</h4>
			<p>@{{ "PAGOREM" | translate }} </p>



			<form class="form-contact" ng-submit="enviar(id_prod_hid);">
				<input type="hidden" name="id_product"  ng-model="id_prod_hid">

				<fieldset>
						<button ng-if="send==false" class="button-contact" type="submit">@{{"COMPRAR" | translate}}</button>
				</fieldset>
			</form>
				<hr>
			<form class="form-contact" ng-submit="addcar(id_prod_hid,data_nombre, data_precio);">
				<input type="hidden" name="data_nombre"  ng-model="data_nombre">
				<input type="hidden" name="data_precio"  ng-model="data_precio">
				<input type="hidden" name="id_product"  ng-model="id_prod_hid">
				<fieldset >
					<button ng-if="send==false" class="button-contact" type="submit">Agregar al carrito</button>
				</fieldset>
			</form>
			</div>
			<div ng-if="send==true">
				<fieldset>

					<h1>Felicidades tu producto esta en camino</h1>
					<h4 style='margin-top: 20px;'>Te enviamos un correo con los datos del vendedor.</h4>
					<br>
					<div  class="col-xs-12 col-md-6">
						<h4>Datos del vendedor</h4>
						<table class="table table-striped">
							<thead>
							<tr>
								<th style="text-align: center">Nombre</th>
								<th style="text-align: center">email</th>
								<th style="text-align: center">Tel</th>
							</tr>
							</thead>
							<tbody>
							<tr>
								<td> @{{ datavendedor.name }} @{{ datavendedor.apellido }}</td>
								<td> @{{ datavendedor.email }}</td>
								<td> @{{ datavendedor.telefono }}</td>
							</tr>
							</tbody>
						</table>
					</div>
					<div class="col-xs-12 col-md-6 ">
						<h4>Datos del Producto</h4>
						<table class="table table-striped">
							<thead>
							<tr>
								<th style="text-align: center">Nombre</th>
								<th style="text-align: center">Precio</th>
							</tr>
							</thead>
							<tbody>
							<tr>
								<td>@{{ datavendedor.titulo }}</td>
								<td>@{{ datavendedor.precio }}</td>
							</tr>
							</tbody>
						</table>
					</div>
				</fieldset>
				<fieldset>
					<a href="/"><button class="button-contact" type="submit">@{{enviar_msj}}</button></a>
				</fieldset>
			</div>
		</div>
		<div style="margin-top: 5%;" ng-if="sessionactiva==false">
			<h1>¿No te has registrao aun?</h1>
			<h4 style='margin-top: 20px;'>Para poder comprar este producto tienes que registrarte o iniciar sesion</h4>
			<p>Para registrarte tienes que descargar la aplicación.</p>
			<a href="/registrarusuario" ><button  class="button-contact" type="submit">Registrarse</button></a>
			{{--<a href="/registrarusuario" target="_blank"></a><button ng-if="send==false" class="button-contact" type="submit">Registrarse</button>--}}
			<fieldset>
				<div class="text-align: center">
					<div style="    border-bottom: solid 1px #afaeae; width: 50%; text-align: center; display: inline-block;"></div>
				</div>
			</fieldset>
			<a href="/ingresar"><button  class="button-contact" type="submit">Ya estoy registrado</button></a>
		</div>
		{{--<div   >--}}
		{{--<h1>Contactar @{{titulopublicacion | limitTo:20}}</h1>--}}
		{{--<h4 style='--}}
    {{--margin-top: 20px;--}}
{{--'>Matias Mussetta |Tel: 03472-15447836 | Marcos Juárez - Cordoba</h4>--}}

		{{--<form class="form-contact" ng-submit="enviar(id_prod_hid);">--}}

			{{--<input type="hidden" name="id_product"  ng-model="id_prod_hid">--}}
			{{--<fieldset><input type="text" placeholder="Nombre" ng-model="nombre"></fieldset>--}}
			{{--<fieldset><input type="text" placeholder="Email" ng-model="email"></fieldset>--}}
			{{--<fieldset><input type="text" placeholder="Telefono" ng-model="telefono"></fieldset>--}}
			{{--<fieldset>--}}
				{{--<textarea name="" id="" cols="30" rows="5" placeholder="Mensaje" ng-model="descripcion"></textarea>--}}
			{{--</fieldset>--}}
			{{--<fieldset>--}}
				{{--<button ng-if="send==false" class="button-contact" type="submit">@{{enviar_msj}}</button>--}}
				{{--<span ng-if="send==true" style="font-size: 1.4em;">Mensaje Enviado!</span>--}}
			{{--</fieldset>--}}
		{{--</form>--}}
		{{--</div>--}}
	</div>
</div>
