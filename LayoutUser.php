<?php
	session_start();
	if (!isset($_SESSION['username'])){
		header("location:Login.php");
	}
?>
<html>
<head>
    <meta charset="utf-8">
	<title>Irania</title>
    <link rel='stylesheet' type='text/css' href='estilo.css' />
</head>
<body>
 	<ul>
  		<li><img src="display.png"/></li>
  		<li><a href="LayoutUser.php" class="active">Inicio</a></li>
  		<li><a href="AlbumesUser.php">Mis Álbumes</a></li>
  		<li class="right"><a href="......">AVATAR</a></li>
	</ul>



</body>
</html>