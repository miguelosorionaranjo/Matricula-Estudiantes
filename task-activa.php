<?php
 $corepage = explode('/', $_SERVER['PHP_SELF']);
 $corepage = end($corepage);
 if ($corepage!=='index.php') {
   if ($corepage==$corepage) {
     $corepage = explode('.', $corepage);
    header('Location: index.php?page='.$corepage[0]);
  }
 }
 $id = base64_decode($_GET['id']);

 if(isset($_POST['id'])) { 
  $id = $_POST['id'];
  $query = "UPDATE users SET status = if(activo='inactivo', 'activo', 'inactivo') WHERE id = '$id'";
  $result = mysqli_query($db_con,$query);
			$row = mysqli_fetch_array($result);
 
      if (mysqli_query($db_con,$query)) {
        $datainsert['insertsucess'] = '<p style="color: green;">Usuario activado</p>';
        header('Location: index.php?page=user-profile&edit=success');
      }
  echo "Cambios Realizados con Éxito";  
}
?>