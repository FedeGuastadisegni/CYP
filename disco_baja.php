<?php include 'cnx.php';   ?>
<html>
<head>
	<title>Baja de Discos</title>
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

if ($_GET[b_cod_d]) {
     $_GET = clean($_GET);

     $sql = "delete from disco where cod_d=".$_GET[b_cod_d];
     $res = mysql_query($sql);
}

$sql  = " select * from disco, categoria, interprete, sello";
$sql .= " where disco.cod_cat = categoria.cod_cat";
$sql .= " and disco.cod_i = interprete.cod_i";
$sql .= " and disco.cod_s = sello.cod_s";
$sql .= " order by fec_d desc";

$res = mysql_query($sql);

if (mysql_num_rows($res))    {
     echo '<table class="table table-bordered" style="width: 80%;">';
     echo '<tr>';
     echo '<td>Disco</td>';
     echo '<td>Interprete</td>';
     echo '<td>Categoria</td>';
     echo '<td>Sello</td>';
     echo '<td>Precio</td>';
     echo '<td></td>';
     echo '</tr>';

     while ($row = mysql_fetch_array($res))  {
          echo '<tr>';
          echo '<td>'.$row[nom_d].'</td>';
          echo '<td>'.$row[desc_i].'</td>';
          echo '<td>'.$row[desc_cat].'</td>';
          echo '<td>'.$row[desc_s].'</td>';
          echo '<td>'.$row[precio_d].'</td>';
           echo '<td><a href="disco_baja.php?b_cod_d='.$row[cod_d].'">dar de baja</a></td>';
          echo '</tr>';
     }

     echo '<table>';
} else                          {
     echo 'No se encontraron discos';
}

?>
<br>
     </div>
</div>


</body>
</html>
