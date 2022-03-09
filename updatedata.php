<?php
//conexion
include('js/conexion.php');
$id = $_POST['id'];
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
    $queryResult=$connect->query("UPDATE empleados SET nombre='"
    .$nombre."', correo='".$correo."', estado='".$estado."' 
    WHERE id='".$id."'");

    if ($queryResult) {
        $result['crearEmpleado']="Actualizacion de datos ha hecho exitosamente";
    }else {
        $result['crearEmpleado']="falla de actualizacion de datos";
    }
}

echo json_encode($result);
?>