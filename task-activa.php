<?php
  include('db_con.php');

  
if(isset($_POST['name'])) { 
  $name = $_POST['name'];
  $query = "UPDATE users SET status = if(activo='inactivo', 'activo', 'inactivo') WHERE id = '$id'";
  $result = mysqli_query($connection, $query);
  if (!$result) {
    die('Consulta Fallida.');
  }
  echo "Cambios Realizados con Éxito";  
}
?>