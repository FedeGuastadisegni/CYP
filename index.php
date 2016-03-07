<?php include 'cnx.php';   ?>
<html class="no-js">
<head>
	<title>Venta de Discos</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:700' rel='stylesheet' type='text/css'>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/main.css">

    <script src="js/vendor/modernizr-2.6.2.min.js"></script>
    <script src="js/vendor/bootstrap.js"></script>
    <script src="js/vendor/bootstrap.min.js"></script>
    <script src="js/vendor/jquery-1.11.1.min.js"></script>
</head>
<body>

<div id="wrapper" align="center">
	<div id="content" class="row">
        	<section>
        		<a style="text-decoration:none;" href="index.php">
                    <div id="cabeceraB" class="header">Tienda de Discos</div>
                </a>
        	</section>
        	<nav class="navbar navbar-default ajuste" align="center">
            	<div class="collapse navbar-collapse navbar-ex1-collapse" align="center">
                	<ul class="nav navbar-nav" align="center">
                    	<li><a href='buscador.php'>Buscador</a></li>
                    	<li><a href='carrito.php'>Ver Carrito</a></li>
                    	<li><a href='verdiscos.php?modo=n'>Novedades</a></li>
                    	<li><a href='verdiscos.php?modo=v'>Los Discos mas vendidos</a></li>
                    	<li><a href='verdiscos.php?modo=i'>Los artistas mas vendidos</a></li>
                	</ul>

                    
		<?php if ((isset($_SESSION['username'])))
		{
			if($_GET['logout']=="1"){
		$_SESSION['login'] = "";
		@session_destroy();
		header("Location: index.php");

	}
			echo '<ul class="nav navbar-nav navbar-right"> <li>';
            echo '<div style="color:blue; padding: 15px 10px 5px 50px;">';
            echo "Hola ". $_SESSION['username']." </div></li>";
			echo '<li><a href="?logout=1">LogOut</a></li>';
            echo '</ul>';


			
		}
		else
		{?>
			<ul class="nav navbar-nav navbar-right"> 
			<li><a href="login.php">Login</a></li>
			<li><a href="alta_usuarios.php">Registrarse</a></li>
			</ul>
			
		<?php }?>
        </nav>
        	</div>

		<section id="miSlide" class="carousel slide" style="width: 96.8%;">
                <ol class="carousel-indicators">
                    <li data-target="#miSlide" data-slide-to="0" class="active"></li>
                    <li data-target="#miSlide" data-slide-to="1"></li>
                    <li data-target="#miSlide" data-slide-to="2"></li>
                </ol>

                <div class="carousel-inner">
                    <div class="item active">
                        <img src="img/img1-1.jpg" class="adaptar">
                    </div>
                    <div class="item">
                        <img src="img/img2-2.jpg" class="adaptar">
                    </div>
                    <div class="item">
                        <img src="img/img3-3.jpg" class="adaptar">
                    </div>
                </div>

                <a href="#miSlide" class="left carousel-control" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>

                <a href="#miSlide" class="right carousel-control" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>

            </section>

            <section class="color1 ajuste2" style="width:96.8%;">
            	<div>
            		"Como músico estoy orgulloso de haber aprendido a tocar música sin tomar clases de ningun profesor."
			<br/>
			"Tienes que hacer las Cosas que sientes que son correctas y, en ocasiones, debes arriesgarte."
			<br/ > Dave Eric Grohl.
			<br/>
			"Puedes tenerlo todo en el mundo y ser el hombre más solo en el mundo. Y es el tipo más amargo de soledad, el éxito me ha hecho un ídolo y tener millones de libras. Pero esto me ha impedido tener una cosa que necesitamos: Cariño, una relación estable".
			<br/ > Freddie Mercury.
            	</div>
        	</section>
	</div>
</div>

<footer class="color3">
    <div class="footer">
        <div class="col-sm-4 color3">
            Conceptos y paradigmas de lenguajes de programación.
        </div>
        <div class="col-sm-4 color3" align="center">
            <a href="http://www.unla.edu.ar/" style="text-decoration:none;" class="footfont">Universidad Nacional de Lanús<img src="img/unla.png" class="footimg" alt=""></a>
        </div>
        <div class="col-sm-4 color3" align="right">
            Rodriguez Nahuel, Valenzuela Gabriel, Zitterkopf Carlos.
        </div>
    </div>
</footer>

<script src="js/vendor/bootstrap.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.1.min.js"><\/script>')</script>

        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X');ga('send','pageview');
        </script>

</body>
</html>