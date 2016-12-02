<html>
<head>
	<meta charset="utf-8">
	<title>Irania</title>
	<link rel='stylesheet' type='text/css' href='estilo.css' />
	<script type="text/javascript">

		function fotoDinamica(im){
			if (im.files && im.files[0]){
				var reader = new FileReader();
				reader.onload = function(){
					var output = document.getElementById('avatar');
					output.src = reader.result;
				};
				reader.readAsDataURL(im.files[0]);
			}
		}

	</script>
</head>
<body>
	<ul>
		<li><img src="logo.png"/></li>
		<li><a href="Layout.html">Inicio</a></li>
		<li class="right"><a href="Registro.php" class="active">Registrarse</a></li>
		<li class="right"><a href="Login.php">Login</a></li>
	</ul>

<div style="padding:20px;margin-top:30px;">
<h1> REGISTO </h1>

	<form id='registro' name='registro' action='Registro.php' method="post" enctype="multipart/form-data">
	
		Nombre(*): <input type="text" id="nombre" name="Nombre" required><br>
		
    	Apellidos(*): <input type="text" id="apellidos" name="Apellidos" required pattern="[a-zA-Z]+(\s)+[a-zA-Z]+"><br>

    	Username(*): <input type="text" id="username" name="Username" required><br> 
    	<!-- AJAX PARA VER SI EXISTE DICHO USERNAME -->
		
    	Direccion de correo(*): <input type="email" id="correo" name="Correo" required placeholder="you@youremail.com"> <br>
    	<!-- AJAX PARA VER SI DICHO EMAIL YA SE HA REGISTRADO -->

    	Contraseña(*): <input type="password" id="password" name="Password" required placeholder="Minimo 6 caracteres" pattern=".{6,}"> <br>
    	<!-- AJAX PARA VER SI LA CONTRASEÑA ES SEGURA??? -->

    	Repita la contraseña(*): <input type="password" id="password2" name="Password2" required placeholder="Minimo 6 caracteres" pattern=".{6,}"> <br>
    	<!-- VER SI LAS CONTRASEÑAS SON IGUALES -->
		
		Avatar (Opcional): <input type="file" id="imagen" name="imagen" accept="image/*" onchange="fotoDinamica(this)" onload="this.value=null"> <br/>

		<p> <img src = "avatar.png" id = "avatar" width="150" height="250"> </p>
		<br/>
		
		<p align="center">
   		<input type="submit" value="REGISTRARSE" name="submit"> 
		&nbsp;
		&nbsp;
		<input type="reset" value="BORRAR" name="reset">
		</p>
		
	</form>
	</div>

</body>
</html>

<?php

	if(isset($_POST['Nombre'])){

		$link = mysqli_connect("localhost", "root", "", "display");
		//$link = mysqli_connect("mysql.hostinger.es", "u531741362_admin", "iratiania", "u531741362_dp");

		function validarExpresion($variable, $expresion){
			$validar = array(
					 "options" => array("regexp"=>$expresion)
				);
			if(!filter_var($variable, FILTER_VALIDATE_REGEXP, $validar)){
				return false;
			}
			else{
				return true;
			}
		}
		
		function validaRequerido($valor){
			if(trim($valor) == ''){
				return false;
			}
			else{
				return true;
			}
		}
		
		if (!validaRequerido($_POST['Nombre'])) {
			echo "<script type='text/javascript'>
			alert('Es obligatorio introducir el nombre'); 
			</script>";
			die();
		}
		if(!validaRequerido($_POST['Apellidos'])){
			echo "<script type='text/javascript'>
			alert('Es obligatorio introducir los apellidos'); 
			</script>";
			die();
		}
		if(!validarExpresion($_POST['Apellidos'], '/^[a-zA-Z]+(\s)+[a-zA-Z]+$/')){
			echo "<script type='text/javascript'>
			alert('Debes introducir dos apellidos'); 
			</script>";
			die();
		}
		if(!validaRequerido($_POST['Username'])){
			echo "<script type='text/javascript'>
			alert('Es obligatorio introducir un username'); 
			</script>";
			die();
		}

		if(!validaRequerido($_POST['Correo'])){
			echo "<script type='text/javascript'>
			alert('Es obligatorio introducir un email'); 
			</script>";
			die();
		}
		if(!validarExpresion($_POST['Correo'], '/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,4})$/')){
			echo "<script type='text/javascript'>
			alert('El email no es válido.'); 
			</script>";
			die();
		}
		
		if(!validaRequerido($_POST['Password'])){
			echo "<script type='text/javascript'>
			alert('Es obligatorio introducir una contraseña'); 
			</script>";
			die();
		}

		if(!validaRequerido($_POST['Password2'])){
			echo "<script type='text/javascript'>
			alert('Es obligatorio repetir la contraseña'); 
			</script>";
			die();
		}

		if(!validarExpresion($_POST['Password'], '/^.{6,}$/')){
			echo "<script type='text/javascript'>
			alert('La contraseña debe tener al menos 6 caracteres'); 
			</script>";
			die();
		}

		$pass = $_POST['Password'];
		$pass2 = $_POST['Password2'];

		if($pass!=$pass2){
			echo "<script type='text/javascript'>
			alert('Las contraseñas no coinciden. Vuelva a intentarlo por favor.'); 
			</script>";
			die();
		}

		$username = $_POST['Username'];

		$target_dir = "avatares/";

		$ext = explode('.', basename($_FILES['imagen']['name'][$i]));   // Explode file name from dot(.)
		$file_extension = end($ext); // Store extensions in the variable.
		$target_file = $target_dir . $username . "." . $file_extension; 
		
		if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
			$file = basename($_FILES["imagen"]["name"]);
		} 
		else {
			$file = "avatar.jpg";
		}

		$passEnc = sha1($_POST['Password']);

		$sql="INSERT INTO usuario VALUES ('$username', '$_POST[Nombre]', '$_POST[Apellidos]', '$_POST[Correo]','$passEnc', '$file' )";

		if (!mysqli_query($link ,$sql)){
			die('Error: ' . mysqli_error($link));
		}
		echo "<script type='text/javascript'>
			alert('Usuario registrado correctamente!!'); 
			</script>";

		mysqli_close($link);


	}

?>