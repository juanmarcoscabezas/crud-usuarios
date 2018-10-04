<?php
$crud = $_GET['action'];

include './conexion.php';

if($crud == "get"){
      $sql= "SELECT * FROM test";
      $rs = mysqli_query($conn, $sql);
      $array = array();
      if ($rs) {
          $array = array();
          while ($fila = mysqli_fetch_assoc($rs)) {	
              $array[] = array_map('utf8_encode', $fila);
          }
          $res = json_encode($array, JSON_NUMERIC_CHECK);
      }else{
          $res = null;
          echo mysqli_error($conn);
      }
      mysqli_close($conn);
      echo $res;
}

if($crud == "post"){
    $postData = json_decode(file_get_contents('php://input'),true);
    $nombre = $postData['nombre'];
    $correo = $postData['correo'];

    $sql1 = "INSERT INTO test (nom,correo) VALUES('$nombre','$correo')";
    $rs1 = mysqli_query($conn, $sql1);
  
    $sql= "SELECT * FROM test";
    $rs = mysqli_query($conn, $sql);
    $array = array();
    if ($rs) {
        $array = array();
        while ($fila = mysqli_fetch_assoc($rs)) {	
            $array[] = array_map('utf8_encode', $fila);
        }
        $res = json_encode($array, JSON_NUMERIC_CHECK);
    }else{
        $res = null;
        echo mysqli_error($conn);
    }
    mysqli_close($conn);
    echo $res;
}

if($crud == "update"){
    $postData = json_decode(file_get_contents('php://input'),true);
    $id = $postData['id'];
    $nombre = $postData['nombre'];
    $correo = $postData['correo'];

    $sql1 = "UPDATE test SET nom = '$nombre', correo = '$correo' WHERE id=$id";
    $rs1 = mysqli_query($conn, $sql1);

    $sql= "SELECT * FROM test";
    $rs = mysqli_query($conn, $sql);
    $array = array();
    if ($rs) {
        $array = array();
        while ($fila = mysqli_fetch_assoc($rs)) {	
            $array[] = array_map('utf8_encode', $fila);
        }
        $res = json_encode($array, JSON_NUMERIC_CHECK);
    }else{
        $res = null;
        echo mysqli_error($conn);
    }
    mysqli_close($conn);
    echo $res;
}

if($crud == "delete"){
    $postData = json_decode(file_get_contents('php://input'),true);
    $id = $postData['id'];

    $sql1 = "DELETE FROM test WHERE id=$id";
    $rs1 = mysqli_query($conn, $sql1);
  
    $sql= "SELECT * FROM test";
    $rs = mysqli_query($conn, $sql);
    $array = array();
    if ($rs) {
        $array = array();
        while ($fila = mysqli_fetch_assoc($rs)) {	
            $array[] = array_map('utf8_encode', $fila);
        }
        $res = json_encode($array, JSON_NUMERIC_CHECK);
    }else{
        $res = null;
        echo mysqli_error($conn);
    }
    mysqli_close($conn);
    echo $res;
}
?>