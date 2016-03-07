<?php include 'cnx.php';   ?>
<html>
<head>
	<title>Ventas por mes</title>
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

$res = mysql_query("select month(fec_p) as M, year(fec_p) as A, count(*) as C from pedido_m group by year(fec_p), month(fec_p) order by fec_p desc");
if (mysql_num_rows($res)) {
     
     $mes[1]='Enero';
     $mes[2]='Febrero';
     $mes[3]='Marzo';
     $mes[4]='Abril';
     $mes[5]='Mayo';
     $mes[6]='Junio';
     $mes[7]='Julio';
     $mes[8]='Agosto';
     $mes[9]='Septiembre';
     $mes[10]='Octubre';
     $mes[11]='Noviembre';
     $mes[12]='Diciembre';
     
     echo '<table class="table table-bordered" style="width: 80%;">';
     echo '<tr>';
     echo '<td>Mes</td>';
     echo '<td>Año</td>';
     echo '<td>Ventas</td>';

     while ($row = mysql_fetch_array($res)) {
          echo '<tr>';
          echo '<td>'.$mes[$row[M]].'</td>';
          echo '<td>'.$row[A].'</td>';
          echo '<td>'.$row[C].'</td>';
     }

     echo '</table>';
}   else {
     echo 'no se produjeron ventas';
}

?>
<br>
     </div>
</div>


</body>
</html>