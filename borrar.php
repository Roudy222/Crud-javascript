<?php
 include('js/conexion.php');
  
 
 $id=$_POST['id'];
 
 $connect->query("DELETE  FROM empleados WHERE id=".$id);
 
?>