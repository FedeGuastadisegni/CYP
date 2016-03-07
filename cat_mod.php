<?php include 'cnx.php';   ?>
<html>
<head>
	<title>Modificacion de Categorias</title>
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

$_POST = clean($_POST);
$_GET = clean($_GET);

if ($_POST[subgrabar]) {
     $sql =  " update categoria set";
     $sql .= " desc_cat = '".$_POST[categoria]."'";
     $sql .= " where cod_cat = ".$_POST[cod_cat];

     $res = mysql_query($sql);
     $_GET[cod_cat]='';
}

if ($_GET[cod_cat]) {

	$sql = "select * from categoria where cod_cat = ".$_GET[cod_cat];
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);

	echo '<form method=POST action="?">';

	echo '<table class="table table-bordered" style="width:80%">';
	echo '<tr>';
	echo '<td>Nombre de categoria</td><td><input type=text name=categoria value="'.$row[desc_cat].'"></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td colspan="2"><input class="btn btn-primary" value="Modificar" type="submit" name="subgrabar"></td>';
	echo '</tr>';
	echo '</table>';

	echo '<input type=hidden name=cod_cat value='.$row[cod_cat].'>';

	echo '</form>';

} else {
     
	$sql = "select * from categoria order by desc_cat asc";
	$res = mysql_query($sql);

	if (mysql_num_rows($res)>0)     {
		echo '<table class="table table-bordered" style="width:80%">';
		echo '<tr><td>Nombre de categoria</td><td>Ver detalle</td></tr>';
		while ($row = mysql_fetch_array($res)) {
			echo '<tr>';
			echo '<td>'.$row[desc_cat].'</td><td><a href=cat_mod.php?cod_cat='.$row[cod_cat].'>Ver detalle</a></td>';
			echo '</tr>';
		}
		echo '</table>';
	} else                          {
		echo 'no hay categorias disponibles';
	}
}

?>
		<br>
	</div>
</div>

</body>
</html>
