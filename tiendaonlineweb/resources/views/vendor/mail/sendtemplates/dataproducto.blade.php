<table style="max-width: 600px; padding: 10px; margin:0 auto; border-collapse: collapse; background-color:#ececec;">
    <tr>
        <!--<td style="background-color: #ecf0f1; text-align: left; padding: 0">
            <a href="http://ziim.es/">
                <img width="20%" style="display:block; margin: 1.5% 3%" src="https://s25.postimg.org/wzynm5oov/ziim.jpg">
            </a>
        </td>-->
    </tr>

    <tr>
        <td style="padding: 0"><a href="#"><img style="padding: 0; display: block" src="http://rapipana.proyectos2019.com/img/rapipanaemail.png" width="100%"></a></td>
    </tr>

    <tr>
        <td>
            <div style="color: #34495e; margin: 4% 10% 2%; text-align: justify;font-family: sans-serif";>
                <h2 style="color: #d31720; margin: 0 0 7px" align="center">Felicidades tu producto ya esta en camino</h2>
                <h2>Hola {{$name}}</h2>
                <h4>Ya te enviamos tu:  <label style="font-weight: bold"> {{$vendedor->titulo}} </label></h4>
                <table>
                    <tr>
                        <td>
                            <h3>Los datos del vendedor son los siguientes:</h3>
                            Nombre: {{$vendedor->name}} <br>
                            Email: {{$vendedor->email}} <br>
                            Telefono: {{$vendedor->telefono}}<br>

                        </td>
                    </tr>
                </table>
                <p>No olvides que el pago se acuerda con el vendedor el monto que debes pagar es de : {{$vendedor->precio}} EUR </p>

                <p>Estamos aquí para ayudarte cuando lo necesites. </p>
                <br>
            </div>
            <!-- <div style="width: 100%;margin:20px 0; display: inline-block;text-align: center">
                  <img src="https://s25.postimg.org/g1tzp9wwv/landing-ziim.png" height="66" style="width: 599px;">

              </div>-->
            <!-- <DIV STYLE="position: relative; top:-140px; left:325px; visibility:visible z-index:1">
<IMG SRC="https://s25.postimg.org/ij5qwm1en/descarga.png">
</div> -->

            <p style="color: #b3b3b3;font-size: 12px;text-align: center;margin: 12px 0 0;">2018 Todos los derechos reservados</p>

        </td>
    </tr>
</table>