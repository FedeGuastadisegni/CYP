<?php include 'cnx.php';   ?>
<html class="no-js">
<head>
	<title>Alta usuario</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:700' rel='stylesheet' type='text/css'>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Alta usuario</title>
</head>
<body>
	<div id="wrapper" align="center">
	<div id="content" class="row">
        	<section>
        		<a style="text-decoration:none;" href="index.php">
                    <div id="cabeceraB" class="header">Tienda de Discos</div>
                </a>
        	</section><br><br>
        	<?php
    if ($_POST['subgrabar']) {

	$_POST = clean($_POST);

	if ($_POST['nick_u']) {
		mysql_query('BEGIN WORK');

		$sql = "select max(cod_u) as M from usuario";
		$res = mysql_query($sql);
		$row = mysql_fetch_array($res);
		if ($row['M']>0)
		$max = $row['M'] +1;
		else
		$max = 1;
		$pri = 0;

		$sql = ("insert into usuario values (".$max.", '".$_POST['nick_u']."', '".$_POST['pass_u']."', ".$pri.")");
		$res = mysql_query($sql);

		mysql_query('COMMIT');
	}
}


echo '<form method=POST action="?">';
echo '<table class="table table-bordered" style="width: 50%;">';
echo '<tr>';
echo '<td>Nombre usuario</td><td><input type="text" id="nick_u" name="nick_u"></td>';
echo '</tr>';
echo '<tr>';
echo '<tr>';
echo '<td>Contraseña usuario</td><td><input type="password" name="pass_u"></td>';
echo '</tr>';
echo '<tr>';
echo '<td colspan="2"><input class="btn btn-primary" value="Registrar" type="submit" name="subgrabar"></td>';
echo '</tr>';
echo '</table>';
echo '</form>';

?><br>  	
	</div>
</div>
</body>
    

</html>
