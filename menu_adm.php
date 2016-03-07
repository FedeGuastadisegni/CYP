<?php include 'cnx.php';   ?>
<html>
	<head>
	<title>Menu Administrador</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
	<link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>

	<div id="wrapper" align="center">
	<div id="content" class="row">
        	<section>
        		<a style="text-decoration:none;" href="index.php">
                    <div id="cabeceraB" class="header">Tienda de Discos</div>
                </a>
        	</section><br>

 	<?php
		include 'menu.php';
	?>
</body>

</html>