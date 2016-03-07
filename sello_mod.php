<?php include 'cnx.php';   ?>
<html>
<head>
	<title>Modificacion de Sellos Discograficos</title>
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

if ($_POST[subgrabar])     {
     $sql =  " update sello set";
     $sql .= " desc_s = '".$_POST[sello]."'";
     $sql .= " where cod_s = ".$_POST[cod_s];

     $res = mysql_query($sql);
     $_GET[cod_s]='';
}

if ($_GET[cod_s]) {

     $sql = "select * from sello where cod_s = ".$_GET[cod_s];
     $res = mysql_query($sql);
     $row = mysql_fetch_array($res);
     
     echo '<form method=POST action="?">';

     echo '<table class="table table-bordered" style="width: 80%;">';
     echo '<tr>';
     echo '<td>Nombre del sello</td><td><input type=text name=sello value="'.$row[desc_s].'"></td>';
     echo '</tr>';
     echo '<tr>';
     echo '<td colspan="2"><input class="btn btn-primary" value="Modificar" type="submit" name="subgrabar"></td>';
     echo '</tr>';
     echo '</table>';
     
     echo '<input type=hidden name=cod_s value='.$row[cod_s].'>';

     echo '</form>';

} else {
     
     $sql = "select * from sello order by desc_s asc";
     $res = mysql_query($sql);
     
     if (mysql_num_rows($res)>0)     {
          echo '<table class="table table-bordered" style="width: 80%;">';
          echo '<tr><td>Nombre del Sello</td><td>ver detalle</td></tr>';
          while ($row = mysql_fetch_array($res)) {
               echo '<tr>';
               echo '<td>'.$row[desc_s].'</td><td><a href=sello_mod.php?cod_s='.$row[cod_s].'>ver detalle</a></td>';
               echo '</tr>';
          }
          echo '</table>';
     } else                          {
          echo 'no hay sellos disponibles';
     }
}

?>
<br>
     </div>
</div>

</body>
</html>
