<?php

require 'conexion.php';
$conexion = conectarBD();
$numeroinscripto = trim(ucfirst($_POST['valor']));


$query_dni = "SELECT dni FROM tb_inscripto WHERE tb_inscripto.dni='$numeroinscripto'";
$resul_dni = pg_query($conexion, $query_dni);
$resultado_dni = pg_fetch_result($resul_dni,'dni');

if($numeroinscripto == $resultado_dni){
    $query_nombre = "SELECT nombreinscripto FROM tb_inscripto WHERE tb_inscripto.dni='$numeroinscripto'";
    $resul_nombre = pg_query($conexion, $query_nombre);
    $resultado_nombre = pg_fetch_result($resul_nombre,'nombreinscripto');
    
    $query_apellido = "SELECT apellido FROM tb_inscripto WHERE tb_inscripto.dni='$numeroinscripto'";
    $resul_apellido = pg_query($conexion, $query_apellido);
    $resultado_apellido = pg_fetch_result($resul_apellido,'apellido');
    
    $query_localidad = "SELECT localidad FROM tb_inscripto WHERE tb_inscripto.dni='$numeroinscripto'";
    $resul_localidad = pg_query($conexion, $query_localidad);
    $resultado_localidad = pg_fetch_result($resul_localidad,'localidad');
    
    $query_telefono = "SELECT telefono FROM tb_inscripto WHERE tb_inscripto.dni = '$numeroinscripto'";
    $resul_telefono = pg_query($conexion, $query_telefono);
    $resultado_telefono = pg_fetch_result($resul_telefono,'telefono');
    
    $query_email = "SELECT email FROM tb_inscripto WHERE tb_inscripto.dni = '$numeroinscripto'";
    $resul_email = pg_query($conexion, $query_email);
    $resultado_email = pg_fetch_result($resul_email,'email');
    
    $query_contacto = "SELECT contacto FROM tb_inscripto WHERE tb_inscripto.dni = '$numeroinscripto'";
    $resul_contacto = pg_query($conexion, $query_contacto);
    $resultado_contacto = pg_fetch_result($resul_contacto,'contacto');

    if($resultado_contacto == 'f'){
        $resultado_contacto = 'false';
    } else {
        $resultado_contacto = 'true';
    }
    
    // union del apellido con el nombre para mostrar.
    $nombreinscripto = $resultado_apellido . ", " . $resultado_nombre;
    
    // array con todos los resultados.
    $resultados = array('nombre' => $nombreinscripto, 'localidad' => $resultado_localidad, 'telefono' => $resultado_telefono, 'email' => $resultado_email, 'contacto' => $resultado_contacto);
    echo json_encode($resultados);
}