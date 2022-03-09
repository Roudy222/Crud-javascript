<?php
// codigo de llamar la conexion
 include('js/conexion.php');

 //conectar an  la base de datos 
 $queryResult = $connect->query("SELECT * FROM empleados");
 $result=array();
// mostrar los elementos de la base
 while ($fetchData=$queryResult->fetch_assoc()){
     $result[]=$fetchData;
 }
 // mostrar en javascript los datos de la base
   echo json_encode($result);
?>