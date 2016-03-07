<?php include 'cnx.php';   ?>
<html>
<head>
	<title>Alta de Discos</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
	<link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
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

if ($_POST[subgrabar]) {

	$_POST = clean($_POST);

	mysql_query('BEGIN WORK');

	if ($_POST[nombre]) {
		$res = mysql_query("select max(cod_d) as M from disco");
		$row = mysql_fetch_array($res);
		if ($row[M])
			$max = $row[M] +1;
		else
			$max = 1;

		$fecha = date("Y-m-d h:i:s");

		$sql = "insert into disco values (";
		$sql .= $max.", ";
		$sql .= "'".$_POST[nombre]."', ";
		$sql .= $_POST[interprete].", ";
		$sql .= $_POST[stock].", ";
		$sql .= $_POST[sello].", ";
		$sql .= $_POST[categoria].", ";
		$sql .= $_POST[precio].", ";
		$sql .= "'".$fecha."')";

		$res = mysql_query($sql);

		mysql_query('COMMIT');
	}
}

echo '<form method="POST" action="?">';

$res = mysql_query("select * from interprete order by desc_i asc");
while ($row = mysql_fetch_array($res))
     $select1 .= "<option value=$row[cod_i]>$row[desc_i]</option>";

$res = mysql_query("select * from categoria order by desc_cat asc");
while ($row = mysql_fetch_array($res))
     $select2 .= "<option value=$row[cod_cat]>$row[desc_cat]</option>";
     
$res = mysql_query("select * from sello order by desc_s asc");
while ($row = mysql_fetch_array($res))
     $select3 .= "<option value=$row[cod_s]>$row[desc_s]</option>";

echo '<table class="table table-bordered" style="width: 80%;">';
echo '<tr>';
echo '<td>Nombre</td><td><input type=text name=nombre></td>';
echo '</tr>';
echo '<tr>';
echo '<td>Stock inicial</td><td><input type=text name=stock></td>';
echo '</tr>';
echo '<tr>';
echo '<td>Precio</td><td><input type=text name=precio></td>';
echo '</tr>';
echo '<tr>';
echo '<td>Categoria</td><td><select name=categoria>'.$select2.'</select></td>';
echo '</tr>';
echo '<tr>';
echo '<td>Interprete</td><td><select name=interprete>'.$select1.'</select></td>';
echo '</tr>';
echo '<tr>';
echo '<td>Sello</td><td><select name=sello>'.$select3.'</select></td>';
echo '</tr>';
echo '<tr>';
echo '<td colspan="2"><input value="Dar de Alta" class="btn btn-primary" type="submit" name="subgrabar"></td>';
echo '</tr>';
echo '</table>';

echo '</form>';

?>
<br>
	</div>
</div>


</body>
</html>