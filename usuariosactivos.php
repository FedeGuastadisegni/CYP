<?php include 'cnx.php';   ?>
<html>
<head>
	<title>Usuarios mas activos</title>
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

$sql = "select count(*) as C, nick_u from pedido_m, usuario where pedido_m.cod_u=usuario.cod_u group by usuario.cod_u order by C desc";
$res = mysql_query($sql);
if (mysql_num_rows($res)) {

     echo '<table class="table table-bordered" style="width: 80%;">';
     echo '<tr>';
     echo '<td>Usuario</td>';
     echo '<td>Pedidos realizados</td>';

     while ($row = mysql_fetch_array($res))    {
          echo '<tr>';
          echo '<td>'.$row[nick_u].'</td>';
          echo '<td>'.$row[C].'</td>';
     }

     echo '</table>';
}   else                        {
     echo 'no se produjeron ventas';
}

?>
<br>
     </div>
</div>


</body>
</html>