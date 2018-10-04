<?php
$servidor = "mysql1005.mochahost.com";    //Servidor
$usuario = "hruiz76_juan";          //Usuario
$clave = "juan123";                //Clave
$bd = "hruiz76_juan";		//Base de datos

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