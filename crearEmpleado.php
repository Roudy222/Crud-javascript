<?php
//conexion
include('js/conexion.php');

$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$estado = $_POST['estado'];

$result['crearEmpleado']="";

if($nombre=="") {
    $result['crearEmpleado']="Nuevo Empleado se creo exitosamente";
}elseif ($correo=="") {
    $result['crearEmpleado']="Nuevo Correo se creo exitosamente";
}elseif ($estado=="") {
    $result['crearEmpleado']="Nuevo Estado se creo exitosamente";
}else {
    $queryResult=$connect->query("INSERT INTO empleados(nombre,correo,estado)
    VALUES('".$nombre."','".$correo."','".$estado."')");

    if ($queryResult) {
        $result['crearEmpleado']="Los datos se ha creado exitosamente";
    }else {
        $result['crearEmpleado']="falla de creacion de datos en la base";
    }
}

echo json_encode($result);
?>