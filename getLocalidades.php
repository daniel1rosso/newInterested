<?php

require 'conexion.php';
$conexion = conectarBD();
$query = "SELECT * FROM tb_localidad";
$resultado = pg_query($conexion, $query);

$html = "<option value=0>Selecciona</option>";
echo $html;
while ($row = pg_fetch_assoc($resultado)) {
    $html = "<option value='" . $row['idlocalidad'] . "'>" . $row['nombrelocalidad'] . "</option>";
    echo $html;
}