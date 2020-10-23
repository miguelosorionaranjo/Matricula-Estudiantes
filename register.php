<?php require_once 'db_con.php'; 
	session_start();
	if (isset($_POST['register'])) {
		$name = $_POST['name'];
		$apellido = $_POST['apellido'];
		$email = $_POST['email'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$c_password = $_POST['c_password'];

		$photo = explode('.', $_FILES['photo']['name']);
		$photo= end($photo);
		$photo_name= $username.'.'.$photo;

		$input_error = array();
		if (empty($name)) {
			$input_error['name'] = "Debe ingresar el Nombre";
		}
		if (empty($apellido)) {
			$input_error['apellido'] = "Debe ingresar el Apellido";
		}
		if (empty($email)) {
			$input_error['email'] = "Debe ingresar un Correo";
		}
		if (empty($username)) {
			$input_error['username'] = "Debe ingresar un nombre de usuario";
		}
		if (empty($password)) {
			$input_error['password'] = "Debe ingresar una contraseña";
		}
		if (empty($photo)) {
			$input_error['photo'] = "Debe ingresar una Fotografía";
		}

		if (!empty($password)) {
			if ($c_password!==$password) {
				$input_error['notmatch']="Ha ingresado mal la contraseña!";
			}
		}

		if (count($input_error)==0) {
			$check_email= mysqli_query($db_con,"SELECT * FROM `users` WHERE `email`='$email';");

			if (mysqli_num_rows($check_email)==0) {
				$check_username= mysqli_query($db_con,"SELECT * FROM `users` WHERE `username`='$username';");
				if (mysqli_num_rows($check_username)==0) {
					if (strlen($username)>7) {
						if (strlen($password)>7) {
								$password = sha1(md5($password));
							$query = "INSERT INTO `users`(`name`, `apellido`, `email`, `username`, `password`, `photo`, `status`) VALUES ('$name', '$apellido', '$email', '$username', '$password','$photo_name','inactivo');";
									$result = mysqli_query($db_con,$query);
								if ($result) {
									move_uploaded_file($_FILES['photo']['tmp_name'], 'images/'.$photo_name);
									header('Location: register.php?insert=sucess');
								}else{
									header('Location: register.php?insert=error');
								}
						}else{
							$passlan="Esta contraseña debe contener al menos 8 caracteres";
						}
					}else{
						$usernamelan= 'Este nombre de usuario debe contener al menos 8 caracteres';
					}
				}else{
					$username_error="Este usuario ya Existe";
				}
			}else{
				$email_error= "El correo existe actualmente";
			}
			
		}
		
	}

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Registro de Usuarios</title>
  </head>
  <body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
    <a class="navbar-brand" href="#">Hidden brand</a>
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item ">
        <a class="nav-link" href="login.php">Inicio </a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="register.php">Registro de Usuarios <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li>
    </ul>
    
  </div>
</nav>


<div style="height: 20px;"></div>

<div class="container"  >
      <div class="row">
          <div class="col-lg-12">
          <div class="card shadow-lg p-3 mb-5 bg-white ">
      <div class="card-body">
      <form id="task-form" method="post" class="needs-validation" novalidate>
                <div class="form-row">
                <div class="container">
</div>      
            </form>
      </div>  
  </div>
          <!-- TABLE  -->
          
		  
			


			<div class="container"><br>
          <h1 class="text-center">Registro de Usuarios</h1><hr><br>
          <div class="d-flex justify-content-center">
          	<?php 
          		if (isset($_GET['insert'])) {
          			if($_GET['insert']=='sucess'){ echo '<div role="alert" aria-live="assertive" aria-atomic="true" align="center" class="toast alert alert-success fade hide" data-delay="2000">Tus datos han sido ingresados exitósamente</div>';}
          		}
          	;?>
          </div>
          <div class="row animate__animated animate__pulse">
            <div class="col-md-8 offset-md-2">
             	<form method="POST" enctype="multipart/form-data">
				  <div class="form-group row">
				    <div class="col-sm-6">
					<label for="nombre">Nombre:</label>
				      <input type="text" class="form-control" value="<?= isset($name)? $name:'' ?>" name="name" placeholder="Nombre" id="inputEmail3"><?= isset($input_error['name'])? '<label for="inputEmail3" class="error">'.$input_error['name'].'</label>':'';  ?>
				    </div>
					<div class="col-sm-6">
					<label for="apellido">Apellido:</label>
				      <input type="text" class="form-control" value="<?= isset($apellido)? $apellido:'' ?>" name="apellido" placeholder="Apellido" id="inputEmail3"><?= isset($input_error['apellido'])? '<label for="inputEmail3" class="error">'.$input_error['apellido'].'</label>':'';  ?>
				    </div>
				    <div class="col-sm-6">
					<label for="email">Correo:</label>
				      <input type="email" class="form-control" value="<?= isset($email)? $email:'' ?>" name="email" placeholder="Correo" id="inputEmail3"><?= isset($input_error['email'])? '<label class="error">'.$input_error['email'].'</label>':'';  ?>
				      <?= isset($email_error)? '<label class="error">'.$email_error.'</label>':'';  ?>
				    </div>
				  </div>
				  <div class="form-group row">
				  	<div class="col-sm-4">
					  <label for="username">Nombre de Usuario:</label>
				      <input type="text" name="username" value="<?= isset($username)? $username:'' ?>" class="form-control" id="inputPassword3" placeholder="Usuario"><?= isset($input_error['usrname'])? '<label class="error">'.$input_error['username'].'</label>':'';  ?><?= isset($username_error)? '<label class="error">'.$username_error.'</label>':'';  ?><?= isset($usernamelan)? '<label class="error">'.$usernamelan.'</label>':'';  ?>
				    </div>
				    <div class="col-sm-4">
					<label for="password">Contraseña:</label>
				      <input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Contraseña"><?= isset($input_error['password'])? '<label class="error">'.$input_error['password'].'</label>':'';  ?> <?= isset($passlan)? '<label class="error">'.$passlan.'</label>':'';  ?>  
				    </div>
				    <div class="col-sm-4">
					<label for="c_password">Repetir Contraseña:</label>
				      <input type="password" name="c_password" class="form-control" id="inputPassword3" placeholder="Confirmar Contraseña"><?= isset($input_error['notmatch'])? '<label class="error">'.$input_error['notmatch'].'</label>':'';  ?> <?= isset($passlan)? '<label class="error">'.$passlan.'</label>':'';  ?>
				    </div>
				  </div>
				  <div class="row">
				  	<div class="col-sm-3"><label for="photo">Escoge tu fotografía</label></div>
				  	<div class="col-sm-9">
				      <input type="file" id="photo" name="photo" class="form-control" id="inputPassword3" >
				      <br>
				    </div>
				  </div>
				  <div class="text-center">
				      <button type="submit" name="register" class="btn btn-success">Registro</button>
				    </div>
				  </div>
				</form>
            </div>
          </div>
              <p alig="center">Si tienes una cuenta de acceso administrativo, puedes <a href="login.php">Ingresar Aquí</a></p>
    </div>



          </div>  
          </div> 
      </div>                  
  </div>
  








 
		
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script type="text/javascript">
    	$('.toast').toast('show')
    </script>
  </body>
</html>