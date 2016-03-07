<?php include 'cnx.php';   ?>
<html>
<head>
	<title>Baja de Sellos Discograficos</title>
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
     for ($i=1; $i<=$_POST[cant]; $i++)   {
          $temp = 'check'.$i;
          if ($_POST["$temp"]) { //atencion a las comillas dobles
              $sql = "delete from sello where cod_s = ".$_POST["$temp"];
               $res = mysql_query($sql);
          }
     }
}

$sql = "select * from sello order by desc_s asc";

$res = mysql_query($sql);

if (mysql_num_rows($res)) {
     echo '<form action="?" method=POST>';
     echo '<table class="table table-bordered" style="width: 80%;">';
     echo '<tr><td>Nombre</td><td>dar de baja</td></tr>';

     $c=1;
     while ($row = mysql_fetch_array($res))  {
          echo '<tr>';
          echo '<td>'.$row[desc_s].'</td>';
          echo '<td><input type=checkbox name=check'.$c.' value='.$row[cod_s].'></td>';
          echo '</tr>';
          $c++;
     }
     echo '<input type=hidden name=cant value='.$c.'>';
     echo '<tr>';
     echo '<td colspan="2"><input class="btn btn-primary" value="Dar de Baja" type="submit" name="subgrabar"></td>';
     echo '</tr>';
     echo '</table>';
     echo '</form>';
} else {
     echo 'No se encontraron sellos';
}
?>
<br>
     </div>
</div>

</body>
</html>
