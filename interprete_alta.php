<?php include 'cnx.php';   ?>
<html>
<head>
	<title>Alta de Interpretes</title>
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

	$res = mysql_query("select max(cod_i) as M from interprete");
	$row = mysql_fetch_array($res);
	if ($row[M])
		$max = $row[M] +1;
	else
		$max = 1;

	if ($_POST[interprete])
		mysql_query("insert into interprete values (".$max.", '".$_POST[interprete]."')");

	mysql_query('COMMIT');
}

echo '<form method="POST" action="?">';

echo '<table class="table table-bordered" style="width: 80%;">';
echo '<tr>';
echo '<td>Nombre del Interprete</td><td><input type="text" id="interprete" name="interprete"></td>';
echo '</tr>';
echo '<tr>';
echo '<td colspan="2"><input class="btn btn-primary" value="Dar de Alta" type="submit" name="subgrabar"></td>';
echo '</tr>';
echo '</table>';

echo '</form>';

?>
<br>
	</div>
</div>


</body>
</html>