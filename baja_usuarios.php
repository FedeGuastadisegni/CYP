<?php include 'cnx.php';   ?>
<html class="no-js">
<head>
	<title>Baja usuarios</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
  <link rel="stylesheet" href="css/bootstrap.css">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:700' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="css/main.css">

	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Baja usuarios</title>
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
$_POST = clean($_POST);

if ($_POST[subgrabar])     {
     for ($i=1; $i<=$_POST[cant]; $i++)   {
          $temp = 'check'.$i;
          if ($_POST["$temp"]) { //atencion a las comillas dobles
              $sql = "delete from usuario where cod_u = ".$_POST["$temp"];
               $res = mysql_query($sql);
          }
     }
}

$sql = "select * from usuario order by cod_u asc";
$res = mysql_query($sql);

if (mysql_num_rows($res))    {
     echo '<form action="?" method=POST>';
     echo '<table class="table table-bordered" style="width: 50%;">';
     echo '<thead><tr><th>Nombre</th><th style="width:60%;">Dar de baja</th></tr></thead>';
     echo '<tbody>';

     $c=1;
     while ($row = mysql_fetch_array($res))  {
          echo '<tr>';
          echo '<td>'.$row[nick_u].'</td>';
          echo '<td><input type=checkbox name=check'.$c.' value='.$row[cod_u].'></td>';
          echo '</tr>';
          $c++;
     }
     echo '<input type=hidden name=cant value='.$c.'>';
     echo '<tr>';
     echo '<td colspan="2"><input value="Dar de Baja" class="btn btn-primary" type="submit" name="subgrabar"></td>';
     echo '</tr>';
     echo '</tbody>';
     echo '</table>';
     echo '</form>';
} else                          {
     echo 'No se encontraron usuarios';
}

?><br>
  </div>
</div>
</body>
</html>