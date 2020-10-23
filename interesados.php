<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <title>Formulario Interesados</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="css/estilos.css">
    
    <link rel="icon" href="/photos/UTN.ico">

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>

</head>

<body>
    <form action="./procesar.php" method="POST" name="frmInteresados">
        <div class="row fondo">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <h1 class="text-center text-uppercase">Formulario Interesados</h1>
            </div>
        </div>
        <div class="container" id="general">
            <br>
            <div class="form-group">
                <div class="shadow p-3 mb-5 bg-white col-md-6 rounded" style="text-align: center;">
                    <label> <h4> *DNI </h4> </label>
                    <center>
                        <input class="form-control" style="width:200px" type="number" name="DNI" id="DNI" onBlur="dnii();" require placeholder="Ingrese DNI"/>
                    </center>
                </div>
                <div class="shadow p-3 mb-5 bg-white col-md-6 rounded" style="text-align: center;">
                    <label><h4> *Apellido, Nombre </h4></label>
                    <center>
                        <input class="form-control" style="width:200px" type="text" name="apellido_nombre" id="apellido_nombre" required placeholder="Ingrese Apellido, Nombre"
                        />
                    </center>
                </div>
                <div class="shadow p-3 mb-5 bg-white col-md-6 rounded" style="text-align: center;">
                    <label><h4> Localidad </h4></label>
                    <center>
                        <select class="form-control" style="width:200px" name="localidad" id="localidad"></select>
                    </center>
                </div>
                <div class="shadow p-3 mb-5 bg-white col-md-6 rounded" style="text-align: center;">
                    <label> <h4> Otra localidad </h4> </label>
                    <center>
                        <input class="form-control" style="width:200px" type="text" name="otra_localidad" id="otra_localidad" placeholder="Ingrese Localidad"
                        />
                    </center>
                </div>
                <div class="shadow p-3 mb-5 bg-white col-md-6 rounded" style="text-align: center;">
                    <label><h4> Telefono </h4></label>
                    <center>
                        <input class="form-control" style="width:200px" type="tel" name="telefono" id="telefono" placeholder="Ingrese Telefono" />                        <label>
                    </center>
                </div>
                <div class="shadow p-3 mb-5 bg-white col-md-6 rounded" style="text-align: center;">
                    <label><h4> Email </h4></label>
                    <center>
                        <input class="form-control" style="width:200px" type="text" name="email" id="email" placeholder="Ingrese E-Mail" />
                    </center>
                </div>
                <!--Con el valor booleano false devuelvo el personal y con el valor true devuelvo la referencia de telefono-->
                <div class="shadow p-3 mb-5 bg-white col-md-6 rounded" style="text-align: center;">
                    <label><h4> Contacto </h4> </label>
                    <br>

                    <div class="radio-inline">
                        <center>
                            <label for="contacto"><input type="radio" checked="checked" name="contacto" value="false">Personal</label>
                        </center>
                    </div>
                    <div class="radio-inline">
                        <center>
                            <label for="contacto"><input type="radio" name="contacto" value="true">Telefono</label>
                        </center>
                    </div>
                </div>

            </div>
            <div class="shadow p-3 mb-5 bg-white col-md-6 rounded" style="text-align: center;">
                <label><h4> *Curso </h4></label>
                <br>
                <select class="selectpicker" style="width:200px" id="curso" name="curso[]" title="cursos" multiple>
                    <?php
                        require 'conexion.php';
                        $conexion = conectarBD();
                        $query = "SELECT * FROM tb_cursoinscripto";
                        $resultado = pg_query($conexion, $query);
                        while ($row = pg_fetch_assoc($resultado)) {
                        $html = "<option  value=" . $row['idcurso'] . " > " . $row['nombrecurso'] . " </option>";
                        echo $html;
                    }
                    ?>
                </select>
            </div>
            <div class="shadow p-3 mb-5 bg-white col-md-6 rounded" style="text-align: center;">
                <label><h4> Otro curso </h4> </label>
                <br>
                <center>
                    <input class="form-control" style="width:200px" type="text" name="otro_curso" id="otro_curso" placeholder="Ingrese Curso"
                    />
                </center>
            </div>
        </div>

        </div>

        <br>
        <div class="modal-footer">
            <input class="btn-save btn btn-primary btn-sm" type="submit" name="enviar" value="Enviar" />
        </div>
        <h6>Al sacar el foco del campo dni y el numero ingresado ya exite, se llenaran los campos con los datos ya registrados.</h6>
        <h6>La tecla tab se utiliza para cambiar de campos en el llenado del formulario.</h6>
        <h6>La tecla enter se acepta el formulario de donde te encuentres posicionado.</h6>
        <h6>Los combobox tambien se pueden desplegar y navegar dentro de ellos con las felchas del teclado. La seleccion de algo en el interior del combo se hace con la tecla espacio.</h6>
    </form>
    <script type="text/javascript">

    </script>
</body>

<script type="text/javascript">
    //llenado del combo de localidad con ajax
    $('#localidad').ready(function () {
        $.ajax({
            method: "POST",
            url: "getLocalidades.php"
        }).done(function (msg) {
            $('#localidad').html(msg);
            $('#localidad').show();
        });
    });
</script>
<script>
    //llenado aumtomatico de los campos si se encuentra registrado el dni ingresado.
    function dnii() {
        var valor = document.getElementById("DNI").value;
        if (valor.length > 6 & valor.length < 9) {
            $.ajax({
                method: "POST",
                url: "getDni.php",
                data: { valor: valor },
                dataType: "json",
                success: function (respuesta) {
                    document.getElementById('apellido_nombre').value = respuesta['nombre'];
                    document.getElementById('localidad').value = respuesta['localidad'];
                    document.getElementById('telefono').value = respuesta['telefono'];
                    document.getElementById('email').value = respuesta['email'];
                    document.getElementById('contacto').checked = respuesta['contacto'];
                    document.getElementById('curso').checked = respuesta['curso'];
                }
            });
        } else {
            alert("Colocar un DNI con la cantidad de digitos valida.");
        }
    }
</script>

</html>