<?php include 'cnx.php';   ?>
<html>
<head>
	<title>Baja de Interpretes</title>
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

$_POST = clean($_POST);

if ($_POST[subgrabar])     {
     for ($i=1; $i<=$_POST[cant]; $i++)   {
          $temp = 'check'.$i;
          if ($_POST["$temp"]) { //atencion a las comillas dobles
              $sql = "delete from interprete where cod_i = ".$_POST["$temp"];
               $res = mysql_query($sql);
          }
     }
}

$sql = "select * from interprete order by desc_i asc";
$res = mysql_query($sql);

if (mysql_num_rows($res))    {
     echo '<form action="?" method=POST>';
     echo '<table class="table table-bordered" style="width: 80%;">';
     echo '<tr><td>Nombre</td><td>dar de baja</td></tr>';

     $c=1;
     while ($row = mysql_fetch_array($res))  {
          echo '<tr>';
          echo '<td>'.$row[desc_i].'</td>';
          echo '<td><input type=checkbox name=check'.$c.' value='.$row[cod_i].'></td>';
          echo '</tr>';
          $c++;
     }
     echo '<input type=hidden name=cant value='.$c.'>';
     echo '<tr>';
     echo '<td colspan="2"><input class="btn btn-primary" value="Dar de Baja" type="submit" name="subgrabar"></td>';
     echo '</tr>';
     echo '</table>';
     echo '</form>';
} else                          {
     echo 'No se encontraron interpretes';
}

?>
<br>
     </div>
</div>


</body>
</html>