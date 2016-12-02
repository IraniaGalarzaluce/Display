<?php
	session_start();
?>
<html>
<head>
    <meta charset="utf-8">
	<title>Irania</title>
    <link rel='stylesheet' type='text/css' href='estilo.css' />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js" charset="UTF-8"></script>
    <script type="text/javascript">
	    $(document).ready(function() {
	    	$('#add_more').click(function() {
	    		$(this).before($("<div/>", {
	    			id: 'filediv'
	    		}).fadeIn('slow').append($("<input/>", {
	    			name: 'image[]',
	    			type: 'file',
	    			id: 'image'
	    		}), $("<br/>")));
	    	});
	    });
    </script>
</head>
<body>
 	<ul>
  		<li><img src="logo.png"/></li>
  		<li><a href="LayoutUser.php">Inicio</a></li>
  		<li><a href="AlbumesUser.php" class="active">Mis Álbumes</a></li>
  		<li class="right"><a href="......">AVATAR</a></li>
	</ul>

<div style="padding:20px;margin-top:30px;">

<h1>Album </h1>

	<form id='registro' action="" method="post" enctype="multipart/form-data">

		Album name: <input type="text" name="albumName" id="album_Name"/><br/>
		<br/>

		Upload images:
		<div id="filediv">
		<input name="image[]" type="file" id="image"/>
		</div>

		<input type="button" id="add_more" class="upload" value="Add More Images"/>
		<input type="submit" value="Upload Images" name="submit" id="upload" class="upload"/>

	</form>

</div>
</body>
</html>

<?php

	if(isset($_POST['albumName'])){

		// $validextensions = array("jpeg", "jpg", "png");
		$user_dir = "albums/" . $_SESSION['username'];
		$album_name = $_REQUEST['albumName'];
		$target_dir = $user_dir . "/". $album_name;

		if (!file_exists($user_dir)) {
	   		mkdir($user_dir, 0777, true);
		}

		if (!file_exists($target_dir)) {
	   		mkdir($target_dir, 0777, true);
		}
		

		for ($i = 0; $i < count($_FILES['image']['name']); $i++) {

			$ext = explode('.', basename($_FILES['image']['name'][$i]));  
			$file_extension = end($ext); 
			$target_file = $target_dir . "/" . uniqid() . "." . $file_extension; 

			//$target_file = $target_dir . "/". basename($_FILES["image"]["name"][$i]);
			
			// if (($_FILES["file"]["size"][$i] < 100000)     // Approx. 100kb files can be uploaded.
			// 	&& in_array($file_extension, $validextensions)) {
			// 	if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $target_path)) {

			if (move_uploaded_file($_FILES["image"]["tmp_name"][$i], $target_file)){
				

			}
			else {
				echo "<script type='text/javascript'>
					alert('Ha ocurrido un error'); 
					</script>";
					die();
			}
		}

		echo "<script type='text/javascript'>
					alert('Álbum creado correctamente'); 
					</script>";
	}

?>