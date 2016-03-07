<?php include 'cnx.php';   ?>
<html>
<head>
	<meta charset="utf-8">
	<title>Carrito de compras</title>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="styles.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/main.css">
</head>
<body>
	<meta charset="utf-8">

	<div id="wrapper" align="center">
	<div id="content" class="row">
        	<section>
        		<a style="text-decoration:none;" href="index.php">
                    <div id="cabeceraB" class="header">Tienda de Discos</div>
                </a>
        	</section><br>
        	<?php

if ($_SESSION[registrado])  {

	$_POST = clean($_POST);
	$_GET = clean($_GET);

	if ($_POST[subactualizar])    {
	
		//¿hay stock?
		for ($c=1; $c<$_POST[cant_items]; $c++) {
			$temp1 = 'cod'.$c;
			$temp2 = 'can'.$c;

			$res = mysql_query("select * from disco where cod_d='".$_POST["$temp1"]."' and cant_d >= '".$_POST["$temp2"]."'");
			if (mysql_num_rows($res)) {
				//hay stock
				mysql_query("update pedido_d set cant_d='".$_POST["$temp2"]."' where cod_p='".$_POST[cod_p]."' and cod_d='".$_POST["$temp1"]."'");
			} else                          {
				$mensaje = 'no hay stock disponible para algunos discos';
			}
		}

		 header("location: ?");
		 exit;
	}

	if ($_GET[modo]=='e') {
		mysql_query("delete from pedido_d where cod_p = '$_GET[cod_p]' and cod_d = '$_GET[cod_d]'");
	} elseif ($_GET[modo]=='t') {

		mysql_query("BEGIN WORK");

		$mensaje = '';
		$res = mysql_query("select * from pedido_d where cod_p='".$_GET[cod_p]."'");
		while ($row = mysql_fetch_array($res)) {
			
			//¿hay stock?
			$res_c = mysql_query("select * from disco where cod_d='".$row[cod_d]."' and cant_d >= '".$row[cant_d]."'");
			if (!mysql_num_rows($res_c)) {
				$mensaje = 'no hay stock disponible para algunos discos';
			}
		}

		mysql_data_seek($res, 0);

		if (!$mensaje) {
			while ($row= mysql_fetch_array($res))   {
				mysql_query("update disco set cant_d = cant_d - '".$row[cant_d]."' where cod_d = '".$row[cod_d]."'");
			}

			mysql_query("update pedido_m set fin_p = 's' where cod_p='".$_GET[cod_p]."'");
			$mensaje = 'Pedido confirmado. Gracias por su compra.';
		}

		mysql_query("COMMIT");

	} elseif ($_GET[modo]=='c') {
          
		if ($_GET[cod_d]) {
               
			//¿hay stock?
			$res = mysql_query("select * from disco where cod_d='".$_GET[cod_d]."' and cant_d > '0'");
			if (mysql_num_rows($res))     {
                   
				//¿pedido nuevo o en curso?
				$res = mysql_query("select * from pedido_m where fin_p = 'n' and cod_u='".$_SESSION[registrado]."'");
				if (mysql_num_rows($res)) {
					$row = mysql_fetch_array($res);
					//pedido en curso
					
					//¿ya habia seleccionado ese disco?
					$res = mysql_query("select * from pedido_d where cod_p = '".$row[cod_p]."' and cod_d = '".$_GET[cod_d]."'");
					if (mysql_num_rows($res)) {
						$mensaje = 'el disco ya estaba seleccionado';
					} else {
						//agrego el disco
						mysql_query("insert into pedido_d values ($row[cod_p], $_GET[cod_d], 1)");
					}
				} else {
					//pedido nuevo
					$res = mysql_query("select max(cod_p) as M from pedido_m");
					$row = mysql_fetch_array($res);
					if ($row[M]) {
						$max = $row[M] +1;
					} else {
						$max = 1;
					}

					$fecha = date("Y-m-d h:i:s");

					//creo el pedido
					mysql_query("insert into pedido_m values ('$max', '$_SESSION[registrado]', '$fecha', 'n')");

					//agrego el disco
					mysql_query("insert into pedido_d values ('$max', '$_GET[cod_d]', '1')");
				}

			} else
				$mensaje = 'el disco que pidio no esta en stock<br />';
		}
	}

	$sql  = " select nom_d, pedido_d.cod_p, desc_i, precio_d, pedido_d.cant_d, disco.cod_d";
	$sql .= " from pedido_m, pedido_d, disco, interprete, usuario";
	$sql .= " where pedido_m.cod_p = pedido_d.cod_p";
	$sql .= " and disco.cod_i = interprete.cod_i";
	$sql .= " and pedido_m.cod_u = usuario.cod_u";
	$sql .= " and pedido_m.cod_u = usuario.cod_u";
	$sql .= " and usuario.cod_u=".$_SESSION[registrado];
	$sql .= " and pedido_d.cod_d = disco.cod_d";
	$sql .= " and pedido_m.fin_p = 'n'";

	$res = mysql_query($sql);

	echo $mensaje;

	echo '<form method="POST">';

	echo '<table class="table table-bordered" style="width: 80%;">';
	echo '<tr>';
	echo '<td>Disco </td>';
	echo '<td>Interprete</td>';
	echo '<td>Precio</td>';
	echo '<td>Cantidad</td>';
	echo '<td>Eliminar</td>';
	echo '</tr>';
     
	if (mysql_num_rows($res)) {
		$c=1;
		while ($row = mysql_fetch_array($res))   {
			echo '<tr>';
			echo '<td>'.$row[nom_d].'</td>';
			echo '<td>'.$row[desc_i].'</td>';
			echo '<td>'.$row[precio_d].'</td>';
			echo '<td><input type="text" id="can'.$c.'" name="can'.$c.'" value="'.$row[cant_d].'"></td>';
			echo '<td><a href=carrito.php?modo=e&cod_d='.$row[cod_d].'&cod_p='.$row[cod_p].'>Eliminar</a></td>';
			echo '<tr>';
			echo '<input type="hidden" id="cod'.$c.'" name="cod'.$c.'" value="'.$row[cod_d].'" />';

			$cod_p = $row[cod_p];
			$total += $row[precio_d] * $row[cant_d];
			$c++;
		}
	
		echo '<tr><td colspan="5">Total: '.round($total, 2).'</td></tr>';
		echo '<tr><td colspan="5"><input type="submit" class="btn btn-primary" id="subactualizar" name="subactualizar" value="Actualizar Cantidades"></td></tr>';
		echo '<tr><td colspan="5"><a href=carrito.php?modo=t&cod_p='.$cod_p.'>Terminar Pedido</a></td></tr>';
	} else {
		echo '<tr><td colspan="5">No hay productos cargados</td></tr>';
	}

	echo '</table>';
	
	echo '<input type="hidden" id="cant_items" name="cant_items" value="'.$c.'" />';
	echo '<input type="hidden" id="cod_p" name="cod_p" value="'.$cod_p.'" />';
	echo '</form>';

	echo '<br /><a href="index.php">ir a inicio</a>';

} else {
     header("location: login.php");
	 exit;
}

?>
<br>
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
</body>
</html>
