<?php
$servidor = "localhost";    //Servidor
$usuario = "root";          //Usuario
$clave = "";                //Clave
$bd = "crud-usuarios";		//Base de datos

  $conn=mysqli_connect($servidor,$usuario,$clave, $bd);
      
  if(mysqli_connect_errno()){
      echo mysqli_connect_error();
      /*$array = array();
      $array["error"] = mysqli_connect_error();
      $res = json_encode($array, JSON_NUMERIC_CHECK);
      echo $res;*/
      exit(0);
  }
?>