<?php

if ((!empty($_POST['curso'])  && isset($_POST['curso']) && isset($_POST['DNI']) && !empty($_POST['DNI']))  && isset($_POST['apellido_nombre']) && !empty($_POST['apellido_nombre'])) {
    //dni tomado por el post
    $dni = trim(ucfirst($_POST['DNI']));
    //tomar email para verificar si tiene @
    $email = trim(ucfirst($_POST['email']));
    $posicion_arroba = strpos($email, "@");
    //tomar la fecha del sistema
    $fecha = DATE('d-m-Y h:i:s');
    //datos tomados del por el metodo post para el nombre y apellido
    $apellido_nombre = trim(ucfirst($_POST['apellido_nombre']));
    //obtenemos la posicion de la coma colocada entre el apellido y nombre
    $posicion_coma = strpos($apellido_nombre, ",");
    //division del nombre y el apellido por el metodo de , y un espacio
    $apellido = substr(ucwords($apellido_nombre), 0, $posicion_coma);
    $nombre = substr(ucwords($apellido_nombre), ($posicion_coma + 1));
    //datos tomados por el metodo post
    $localidad = trim(ucfirst($_POST['localidad']));
    $telefono = trim(ucfirst($_POST['telefono']));
    $contacto = trim(ucfirst($_POST['contacto']));
    $newLocalidad = trim(ucfirst($_POST['otra_localidad']));
    $newCurso = trim(ucfirst($_POST['otro_curso']));
    $bandera=0;
    if ( ($posicion_coma > 1) && (strlen($dni) > 6) && (strlen($dni) < 9) ) {
        //insertando los datos a base
         require_once 'conexion.php';
         $conexion = conectarBD();
        // saber si exite el dni ingresado.
        $con_dni = "SELECT dni FROM tb_inscripto WHERE dni='$dni';";
        $resul_dni = pg_query($conexion, $con_dni);
        $cantidad_dni_registrados = pg_num_rows($resul_dni);

        if ($telefono != "" && strlen($telefono)>2 && $email != "" && strlen($email)>2){
            if($newLocalidad != "" && strlen($newLocalidad)>2){
                $query_newLocalidad = "INSERT INTO tb_localidad (nombrelocalidad) VALUES ('$newLocalidad');";
                $resultado_newLocalidad = pg_query($conexion, $query_newLocalidad);
                
                $con_localidad4 = "SELECT idlocalidad FROM tb_localidad WHERE nombrelocalidad='$resultado_newLocalidad';";
                $resul_localidad4 = pg_query($conexion, $con_localidad4);
                $row_localidad_new4 = ; //Aca se debe cambiar el recurso por el id para guardarlo abajo, ya esta todo echo solo pone eso.

                $bandera = 1;
            }
            if ( $cantidad_dni_registrados == 0 ){
                if($bandera == 0){
                    $query_persona = "INSERT INTO tb_inscripto (dni, nombreinscripto, apellido, telefono, email, localidad, contacto) VALUES ('$dni','$nombre','$apellido', '$telefono','$email', '$localidad', '$contacto');";
                    $resultado_persona = pg_query($conexion, $query_persona);
                    foreach($_POST['curso'] as $curso) {
                        $query_personaxcurso = "INSERT INTO tb_inscriptoxcurso (inscripto, curso, fecha) VALUES ('$dni','$curso','$fecha');";
                        $resultado_personaxcurso = pg_query($conexion, $query_personaxcurso);
                    }
                }
                if($bandera == 1){
                    $query_persona = "INSERT INTO tb_inscripto (dni, nombreinscripto, apellido, localidad, contacto) VALUES ('$dni','$nombre','$apellido', '$row_localidad_new4', '$contacto');";
                    $resultado_persona = pg_query($conexion, $query_persona);
                    foreach($_POST['curso'] as $curso) {
                        $query_personaxcurso = "INSERT INTO tb_inscriptoxcurso (inscripto, curso, fecha) VALUES ('$dni','$curso','$fecha');";
                        $resultado_personaxcurso = pg_query($conexion, $query_personaxcurso);
                    }
                }
            } else {
                foreach($_POST['curso'] as $curso) {
                    $query_personaxcurso = "INSERT INTO tb_inscriptoxcurso (inscripto, curso, fecha) VALUES ('$dni','$curso','$fecha');";
                    $resultado_personaxcurso = pg_query($conexion, $query_personaxcurso);
                }
            }
            if($newCurso != "" && strlen($newCurso)>2){
                $query_newCurso = "INSERT INTO tb_cursoinscripto (nombrecurso) VALUES ('$newCurso');";
                $resultado_newCurso = pg_query($conexion, $query_newCurso);
                $con_curso4 = "SELECT idcurso FROM tb_cursoinscripto WHERE nombrecurso='$resultado_newCurso';";
                $resul_curso4 = pg_query($conexion, $con_curso4);
                $row_curso_new4 = ; // Aca se debe cambiar el recurso por el id para guardarlo abajo, ya esta todo echo solo pone eso.
                
                $query_personaxcurso = "INSERT INTO tb_inscriptoxcurso (inscripto, curso, fecha) VALUES ('$dni','$row_curso_new4','$fecha');";
                $resultado_personaxcurso = pg_query($conexion, $query_personaxcurso);
                 
            }
        }

        if ($telefono == "" && $email != "" && strlen($email)>2){
            if($newLocalidad != "" && strlen($newLocalidad)>2){
                $query_newLocalidad = "INSERT INTO tb_localidad (nombrelocalidad) VALUES ('$newLocalidad');";
                $resultado_newLocalidad = pg_query($conexion, $query_newLocalidad);
                
                $con_localidad4 = "SELECT idlocalidad FROM tb_localidad WHERE nombrelocalidad='$resultado_newLocalidad';";
                $resul_localidad4 = pg_query($conexion, $con_localidad4);
                $row_localidad_new4 = ; //Aca se debe cambiar el recurso por el id para guardarlo abajo, ya esta todo echo solo pone eso.

                $bandera = 1;
            }
            if ( $cantidad_dni_registrados == 0 ){
                if($bandera == 0){
                    $query_persona = "INSERT INTO tb_inscripto (dni, nombreinscripto, apellido, email, localidad, contacto) VALUES ('$dni','$nombre','$apellido', '$email', '$localidad', '$contacto');";
                    $resultado_persona = pg_query($conexion, $query_persona);
                    foreach($_POST['curso'] as $curso) {
                        $query_personaxcurso = "INSERT INTO tb_inscriptoxcurso (inscripto, curso, fecha) VALUES ('$dni','$curso','$fecha');";
                        $resultado_personaxcurso = pg_query($conexion, $query_personaxcurso);
                    }
                }
                if($bandera == 1){
                    $query_persona = "INSERT INTO tb_inscripto (dni, nombreinscripto, apellido, localidad, contacto) VALUES ('$dni','$nombre','$apellido', '$row_localidad_new4', '$contacto');";
                    $resultado_persona = pg_query($conexion, $query_persona);
                    foreach($_POST['curso'] as $curso) {
                        $query_personaxcurso = "INSERT INTO tb_inscriptoxcurso (inscripto, curso, fecha) VALUES ('$dni','$curso','$fecha');";
                        $resultado_personaxcurso = pg_query($conexion, $query_personaxcurso);
                    }
                }
            } else {
                foreach($_POST['curso'] as $curso) {
                    $query_personaxcurso = "INSERT INTO tb_inscriptoxcurso (inscripto, curso, fecha) VALUES ('$dni','$curso','$fecha');";
                    $resultado_personaxcurso = pg_query($conexion, $query_personaxcurso);
                }
            }
            if($newCurso != "" && strlen($newCurso)>2){
                $query_newCurso = "INSERT INTO tb_cursoinscripto (nombrecurso) VALUES ('$newCurso');";
                $resultado_newCurso = pg_query($conexion, $query_newCurso);
                $con_curso4 = "SELECT idcurso FROM tb_cursoinscripto WHERE nombrecurso='$resultado_newCurso';";
                $resul_curso4 = pg_query($conexion, $con_curso4);
                $row_curso_new4 = ; // Aca se debe cambiar el recurso por el id para guardarlo abajo, ya esta todo echo solo pone eso.
                
                $query_personaxcurso = "INSERT INTO tb_inscriptoxcurso (inscripto, curso, fecha) VALUES ('$dni','$row_curso_new4','$fecha');";
                $resultado_personaxcurso = pg_query($conexion, $query_personaxcurso);
                 
            }
        }

        if ($email == "" && $telefono != "" && strlen($telefono)>2){
            if($newLocalidad != "" && strlen($newLocalidad)>2){
                $query_newLocalidad = "INSERT INTO tb_localidad (nombrelocalidad) VALUES ('$newLocalidad');";
                $resultado_newLocalidad = pg_query($conexion, $query_newLocalidad);
                
                $con_localidad4 = "SELECT idlocalidad FROM tb_localidad WHERE nombrelocalidad='$resultado_newLocalidad';";
                $resul_localidad4 = pg_query($conexion, $con_localidad4);
                $row_localidad_new4 = ; //Aca se debe cambiar el recurso por el id para guardarlo abajo, ya esta todo echo solo pone eso.

                $bandera = 1;
            }
            if ( $cantidad_dni_registrados == 0 ){
                if($bandera == 0){
                    $query_persona = "INSERT INTO tb_inscripto (dni, nombreinscripto, apellido, telefono, localidad, contacto) VALUES ('$dni','$nombre','$apellido', '$telefono', '$localidad', '$contacto');";
                    $resultado_persona = pg_query($conexion, $query_persona);
                    foreach($_POST['curso'] as $curso) {
                        $query_personaxcurso = "INSERT INTO tb_inscriptoxcurso (inscripto, curso, fecha) VALUES ('$dni','$curso','$fecha');";
                        $resultado_personaxcurso = pg_query($conexion, $query_personaxcurso);
                    }
                }
                if($bandera == 1){
                    $query_persona = "INSERT INTO tb_inscripto (dni, nombreinscripto, apellido, localidad, contacto) VALUES ('$dni','$nombre','$apellido', '$row_localidad_new4', '$contacto');";
                    $resultado_persona = pg_query($conexion, $query_persona);
                    foreach($_POST['curso'] as $curso) {
                        $query_personaxcurso = "INSERT INTO tb_inscriptoxcurso (inscripto, curso, fecha) VALUES ('$dni','$curso','$fecha');";
                        $resultado_personaxcurso = pg_query($conexion, $query_personaxcurso);
                    }
                }
            } else {
                foreach($_POST['curso'] as $curso) {
                    $query_personaxcurso = "INSERT INTO tb_inscriptoxcurso (inscripto, curso, fecha) VALUES ('$dni','$curso','$fecha');";
                    $resultado_personaxcurso = pg_query($conexion, $query_personaxcurso);
                }
            }
            if($newCurso != "" && strlen($newCurso)>2){
                $query_newCurso = "INSERT INTO tb_cursoinscripto (nombrecurso) VALUES ('$newCurso');";
                $resultado_newCurso = pg_query($conexion, $query_newCurso);
                $con_curso4 = "SELECT idcurso FROM tb_cursoinscripto WHERE nombrecurso='$resultado_newCurso';";
                $resul_curso4 = pg_query($conexion, $con_curso4);
                $row_curso_new4 = ; // Aca se debe cambiar el recurso por el id para guardarlo abajo, ya esta todo echo solo pone eso.
                
                $query_personaxcurso = "INSERT INTO tb_inscriptoxcurso (inscripto, curso, fecha) VALUES ('$dni','$row_curso_new4','$fecha');";
                $resultado_personaxcurso = pg_query($conexion, $query_personaxcurso);
                 
            }
        }

        if ($email == "" && $telefono == ""){
            
            if($newLocalidad != "" && strlen($newLocalidad)>2){
                $query_newLocalidad = "INSERT INTO tb_localidad (nombrelocalidad) VALUES ('$newLocalidad');";
                $resultado_newLocalidad = pg_query($conexion, $query_newLocalidad);
                
                $con_localidad4 = "SELECT idlocalidad FROM tb_localidad WHERE nombrelocalidad='$resultado_newLocalidad';";
                $resul_localidad4 = pg_query($conexion, $con_localidad4);
                $row_localidad_new4 = ; //Aca se debe cambiar el recurso por el id para guardarlo abajo, ya esta todo echo solo pone eso.

                $bandera = 1;
            }
            if ( $cantidad_dni_registrados == 0 ){
                if($bandera == 0){
                    $query_persona = "INSERT INTO tb_inscripto (dni, nombreinscripto, apellido, localidad, contacto) VALUES ('$dni','$nombre','$apellido', '$localidad', '$contacto');";
                    $resultado_persona = pg_query($conexion, $query_persona);
                    foreach($_POST['curso'] as $curso) {
                        $query_personaxcurso = "INSERT INTO tb_inscriptoxcurso (inscripto, curso, fecha) VALUES ('$dni','$curso','$fecha');";
                        $resultado_personaxcurso = pg_query($conexion, $query_personaxcurso);
                    }
                }
                if($bandera == 1){
                    $query_persona = "INSERT INTO tb_inscripto (dni, nombreinscripto, apellido, localidad, contacto) VALUES ('$dni','$nombre','$apellido', '$row_localidad_new4', '$contacto');";
                    $resultado_persona = pg_query($conexion, $query_persona);
                    foreach($_POST['curso'] as $curso) {
                        $query_personaxcurso = "INSERT INTO tb_inscriptoxcurso (inscripto, curso, fecha) VALUES ('$dni','$curso','$fecha');";
                        $resultado_personaxcurso = pg_query($conexion, $query_personaxcurso);
                    }
                }
                 
            } else {
                foreach($_POST['curso'] as $curso) {
                    $query_personaxcurso = "INSERT INTO tb_inscriptoxcurso (inscripto, curso, fecha) VALUES ('$dni','$curso','$fecha');";
                    $resultado_personaxcurso = pg_query($conexion, $query_personaxcurso);
                    
                }
            }
            if($newCurso != "" && strlen($newCurso)>2){
                $query_newCurso = "INSERT INTO tb_cursoinscripto (nombrecurso) VALUES ('$newCurso');";
                $resultado_newCurso = pg_query($conexion, $query_newCurso);
                $con_curso4 = "SELECT idcurso FROM tb_cursoinscripto WHERE nombrecurso='$resultado_newCurso';";
                $resul_curso4 = pg_query($conexion, $con_curso4);
                $row_curso_new4 = ; // Aca se debe cambiar el recurso por el id para guardarlo abajo, ya esta todo echo solo pone eso.
                
                $query_personaxcurso = "INSERT INTO tb_inscriptoxcurso (inscripto, curso, fecha) VALUES ('$dni','$row_curso_new4','$fecha');";
                $resultado_personaxcurso = pg_query($conexion, $query_personaxcurso);
                 
            }
        }
       
    }   else {
        echo "Verifique haber colocado una coma con en espacio para dividir el Apellido del Nombre o la longitud del DNI sea correcta";
    }

}   else {
    echo "Verifique haber colocado una coma con en espacio para dividir el Apellido del Nombre o cualquier otro campo ingresado correctamente";
}