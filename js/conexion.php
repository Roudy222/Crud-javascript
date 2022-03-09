<?php
$connect = new mysqli("localhost","root","","empleados");
if(!$connect){
    echo "falla de conexion";

    exit();
}

?>