<?php include 'cnx.php';   ?>
<html>
<head>
	<title>Ver Discos</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/main.css">

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

if ($_GET[modo]=='b') {
	$sql  = " select * from disco, categoria, interprete, sello";
	$sql .= " where disco.cod_cat = categoria.cod_cat";
	$sql .= " and disco.cod_i = interprete.cod_i";
	$sql .= " and disco.cod_s = sello.cod_s";

	if ($_POST[subbuscar])  {

		$_POST = clean($_POST);

		if ($_POST[txtpc])  {
			$sql .= " and ";
			$sql .= " ( categoria.desc_cat like '%$_POST[txtpc]%' or";
			$sql .= " interprete.desc_i like '%$_POST[txtpc]%' or ";
			$sql .= " sello.desc_s like '%$_POST[txtpc]%' or ";
			$sql .= " disco.precio_d like '%$_POST[txtpc]%' or ";
			$sql .= " disco.nom_d like '%$_POST[txtpc]%' ";
			$sql .= " )";
		}

		if ($_POST[selND])  {
			$sql .= " and disco.cod_d = '$_POST[selND]'";
		}

		if ($_POST[selNI])  {
			$sql .= " and interprete.cod_i = '$_POST[selNI]'";
		}

		if ($_POST[selNC])  {
			$sql .= " and categoria.cod_cat = '$_POST[selNC]'";
		}
	}

	$sql .= " order by fec_d desc";

} elseif ($_GET[modo]=='n')        {
	$sql  = " select * from disco, categoria, interprete, sello";
	$sql .= " where disco.cod_cat = categoria.cod_cat";
	$sql .= " and disco.cod_i = interprete.cod_i";
	$sql .= " and disco.cod_s = sello.cod_s";
	$sql .= " order by fec_d desc";

} elseif ($_GET[modo]=='v')        {
	$sql  = " select *, sum(pedido_d.cant_d) as K from disco, categoria, interprete, sello, pedido_d, pedido_m";
	$sql .= " where disco.cod_cat = categoria.cod_cat";
	$sql .= " and disco.cod_i = interprete.cod_i";
	$sql .= " and disco.cod_s = sello.cod_s";
	$sql .= " and disco.cod_d = pedido_d.cod_d";
	$sql .= " and pedido_m.cod_p = pedido_d.cod_p";
	$sql .= " and pedido_m.fin_p = 's'";
	$sql .= " group by disco.cod_d";
	$sql .= " order by K desc";

} elseif ($_GET[modo]=='i')        {
	$sql  = " select desc_i, sum(pedido_d.cant_d) as K";
	$sql .= " from disco, categoria, interprete, sello, pedido_d, pedido_m";
	$sql .= " where disco.cod_cat = categoria.cod_cat";
	$sql .= " and disco.cod_i = interprete.cod_i";
	$sql .= " and pedido_m.cod_p = pedido_d.cod_p";
	$sql .= " and disco.cod_s = sello.cod_s";
	$sql .= " and disco.cod_d = pedido_d.cod_d";
	$sql .= " and pedido_m.fin_p = 's'";
	$sql .= " group by disco.cod_i";
	$sql .= " order by K desc";
}

$res = mysql_query($sql);
if (mysql_num_rows($res)) {
     
	if ($_GET[modo]=='i')   {
		echo '<table class="table table-bordered" style="width: 80%;">';
		echo '<tr>';
		echo '<td>Artista</td>';
		echo '<td>Cantidad de discos vendidos</td>';
		echo '</tr>';
		while ($row = mysql_fetch_array($res))  {
			echo '<tr>';
			echo '<td>'.$row[desc_i].'</td>';
			echo '<td>'.$row[K].'</td>';
			echo '</tr>';
		}
		echo '<table>';
	} else                  {
		echo '<table class="table table-bordered" style="width: 80%;">';
		echo '<tr>';
		echo '<td>Disco</td>';
		echo '<td>Interprete</td>';
		echo '<td>Categoria</td>';
		echo '<td>Sello</td>';
		echo '<td>Precio</td>';
		echo '<td>comprar</td>';

		if ($_GET[modo]=='v')
			echo '<td>discos vendidos</td>';

		echo '</tr>';

		while ($row = mysql_fetch_array($res))  {
			echo '<tr>';
			echo '<td>'.$row[nom_d].'</td>';
			echo '<td>'.$row[desc_i].'</td>';
			echo '<td>'.$row[desc_cat].'</td>';
			echo '<td>'.$row[desc_s].'</td>';
			echo '<td>'.$row[precio_d].'</td>';
			echo '<td><a href="carrito.php?modo=c&cod_d='.$row[cod_d].'">comprar</a></td>';

			if ($_GET[modo]=='v')
				echo '<td>'.$row[K].'</td>';

			echo '</tr>';
		}

		echo '<table>';
     }
} else                          {
     echo 'No se encontraron resultados';
}

echo '<br /><a href="index.php">ir a inicio</a>';

?>
<br>
	</div>
</div>


</body>
</html>