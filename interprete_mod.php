<?php include 'cnx.php';   ?>
<html>
<head>
	<title>Modificacion de Interpretes</title>
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
$_GET = clean($_GET);

if ($_POST[subgrabar]) {
     $sql =  " update interprete set";
     $sql .= " desc_i = '".$_POST[interprete]."'";
     $sql .= " where cod_i = ".$_POST[cod_i];

     $res = mysql_query($sql);
     $_GET[cod_i]='';
}

if ($_GET[cod_i]) {

     $sql = "select * from interprete where cod_i = ".$_GET[cod_i];
     $res = mysql_query($sql);
     $row = mysql_fetch_array($res);
     
     echo '<form method=POST action="?">';

     echo '<table class="table table-bordered" style="width: 80%;">';
     echo '<tr>';
     echo '<td>Nombre del interprete</td><td><input type=text name=interprete value="'.$row[desc_i].'"></td>';
     echo '</tr>';
     echo '<tr>';
     echo '<td colspan="2"><input class="btn btn-primary" value="Modificar" type="submit" name="subgrabar"></td>';
     echo '</tr>';
     echo '</table>';
     
     echo '<input type=hidden name=cod_i value='.$row[cod_i].'>';

     echo '</form>';

} else {
     
     $sql = "select * from interprete order by desc_i asc";
     $res = mysql_query($sql);
     
     if (mysql_num_rows($res)>0)     {
          echo '<table class="table table-bordered" style="width: 80%;">';
          echo '<tr><td>Nombre del interprete</td><td>ver detalle</td></tr>';
          while ($row = mysql_fetch_array($res)) {
               echo '<tr>';
               echo '<td>'.$row[desc_i].'</td><td><a href=interprete_mod.php?cod_i='.$row[cod_i].'>ver detalle</a></td>';
               echo '</tr>';
          }
          echo '</table>';
     } else                          {
          echo 'no hay interprete disponibles';
     }
}

?>
<br>
     </div>
</div>


</body>
</html>