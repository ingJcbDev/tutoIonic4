<H1>Recupera tu contraseña</H1>

<?php
$id = $_GET["id"];
$email = $_GET["email"];
?>

{{--
{{$datauser}}
{{$pass}}--}}

Hola {{$user->name}}
<form id="search-form" role="form" action = "confirpass" method = "post"  enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="pass">Nueva Contraseña</label>
        <input required  type="password" name="pass"  id="password"  class="form-control" placeholder="Ingrese Nueva Password">
        <input required  type="hidden" name="id"  value="{{$id}}"  class="form-control" >
        <input required  type="hidden" name="email"  value="{{$email}}"  class="form-control">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Repetir Contraseña</label>
        <input required maxlength="200" id="confirm_password" type="password" name="rpass"  class="form-control" placeholder="Repetir contraseña">
    </div>
    <div class="box-footer">
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</form>

<script>
    var password = document.getElementById("password"),confirm_password = document.getElementById("confirm_password");

    function validatePassword(){
        if(password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Las Contraseñas no coinsiden");
        }else {
            confirm_password.setCustomValidity('');
        }
    }
    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
</script>