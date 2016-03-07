<?php include 'cnx.php';   ?>
<html>
<head>
	<title>Alta de Sellos Discograficos</title>
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

if ($_POST[subgrabar])     {
     mysql_query('BEGIN WORK');

     $sql = "select max(cod_s) as M from sello";
     $res = mysql_query($sql);
     $row = mysql_fetch_array($res);
     if ($row[M]>0)
         $max = $row[M] +1;
     else
         $max = 1;

     $sql = "insert into sello values (";
     $sql .= $max.", ";
     $sql .= "'".$_POST[sello]."') ";

     $res = mysql_query($sql);

     mysql_query('COMMIT');
}

echo '<form method=POST action="?">';

echo '<table class="table table-bordered" style="width: 80%;">';
echo '<tr>';
echo '<td>Nombre del Sello</td><td><input type=text name=sello></td>';
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
