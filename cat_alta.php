<?php include 'cnx.php';   ?>
<html>
<head>
	<title>Alta de Categorias</title>
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

include 'menu.php';

if ($_POST[subgrabar]) {

	$_POST = clean($_POST);

	if ($_POST[categoria]) {
		mysql_query('BEGIN WORK');

		$sql = "select max(cod_cat) as M from categoria";
		$res = mysql_query($sql);
		$row = mysql_fetch_array($res);
		if ($row[M]>0)
		$max = $row[M] +1;
		else
		$max = 1;

		$sql = "insert into categoria values (";
		$sql .= $max.", ";
		$sql .= "'".$_POST[categoria]."') ";
		$res = mysql_query($sql);

		mysql_query('COMMIT');
	}
}


echo '<form method=POST action="?">';
echo '<table class="table table-bordered" style="width:80%">';
echo '<tr>';
echo '<td>Nombre de categoria</td><td><input type="text" id="categoria" name="categoria"></td>';
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
</html>
