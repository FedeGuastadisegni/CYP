<?php include 'cnx.php';   ?>
<html>
<head>
	<title>Modificacion de Disco</title>
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

$_GET = clean($_GET);
$_POST = clean($_POST);

if ($_POST[subgrabar]) {
     if ($_POST[nombre]) {
          $sql = "update disco set";
          $sql .= " nom_d = '".$_POST[nombre]."', ";
          $sql .= " cod_i = ".$_POST[interprete].", ";
          $sql .= " cant_d = ".$_POST[stock].", ";
          $sql .= " cod_s = ".$_POST[sello].", ";
          $sql .= " cod_cat = ".$_POST[categoria].", ";
          $sql .= " precio_d = ".$_POST[precio];
          $sql .= " where cod_d = ".$_POST[cod_d];

          $res = mysql_query($sql);
     }

     $_GET[cod_d]=$_POST[cod_d];
}

if ($_GET[cod_d]) {
     
     $sql_d  = " select * from disco, categoria, interprete, sello";
     $sql_d .= " where disco.cod_cat = categoria.cod_cat";
     $sql_d .= " and disco.cod_i = interprete.cod_i";
     $sql_d .= " and disco.cod_s = sello.cod_s";
     $sql_d .= " and disco.cod_d = ".$_GET[cod_d];
     $sql_d .= " order by fec_d desc";

     $res_d = mysql_query($sql_d);
     $row_d = mysql_fetch_array($res_d);
     
     echo '<form method=POST action="?">';
 
     $res = mysql_query("select * from interprete order by desc_i asc");
     while ($row = mysql_fetch_array($res))  {
          if ($row[cod_i]==$row_d[cod_i])
               $select1 .= "<option selected value=$row[cod_i]>$row[desc_i]</option>";
          else
               $select1 .= "<option value=$row[cod_i]>$row[desc_i]</option>";
     }

     $res = mysql_query("select * from categoria order by desc_cat asc");
     while ($row = mysql_fetch_array($res))  {
          if ($row[cod_cat]==$row_d[cod_cat])
               $select2 .= "<option selected value=$row[cod_cat]>$row[desc_cat]</option>";
          else
               $select2 .= "<option value=$row[cod_cat]>$row[desc_cat]</option>";
     }

     $res = mysql_query("select * from sello order by desc_s asc");
     while ($row = mysql_fetch_array($res))  {
          if ($row[cod_cat]==$row_d[cod_cat])
               $select3 .= "<option selected value=$row[cod_s]>$row[desc_s]</option>";
          else
               $select3 .= "<option value=$row[cod_s]>$row[desc_s]</option>";
     }

     echo '<table class="table table-bordered" style="width: 80%;">';
     echo '<tr>';
     echo '<td>Nombre</td><td><input type=text name=nombre value="'.$row_d[nom_d].'"></td>';
     echo '</tr>';
     echo '<tr>';
     echo '<td>Stock inicial</td><td><input type=text name=stock value="'.$row_d[cant_d].'"></td>';
     echo '</tr>';
     echo '<tr>';
     echo '<td>Precio</td><td><input type=text name=precio value="'.$row_d[precio_d].'"></td>';
     echo '</tr>';
     echo '<tr>';
     echo '<td>Categoria</td><td><select name=categoria>'.$select2.'</select></td>';
     echo '</tr>';
     echo '<tr>';
     echo '<td>Interprete</td><td><select name=interprete>'.$select1.'</select></td>';
     echo '</tr>';
     echo '<tr>';
     echo '<td>Sello</td><td><select name=sello>'.$select3.'</select></td>';
     echo '</tr>';
     echo '<tr>';
     echo '<td colspan="2"><input class="btn btn-primary" value=Modificar type="submit" name="subgrabar"></td>';
     echo '</tr>';
     echo '</table>';

     echo '<input type=hidden name=cod_d value='.$row_d[cod_d].'>';

     echo '</form>';
} else    {
     $sql  = " select * from disco, categoria, interprete, sello";
     $sql .= " where disco.cod_cat = categoria.cod_cat";
     $sql .= " and disco.cod_i = interprete.cod_i";
     $sql .= " and disco.cod_s = sello.cod_s";
     $sql .= " order by fec_d desc";

     $res = mysql_query($sql);

     if (mysql_num_rows($res)>0)    {
          echo '<table class="table table-bordered" style="width: 80%;">';
          echo '<tr>';
          echo '<td>Disco</td>';
          echo '<td>Interprete</td>';
          echo '<td>Categoria</td>';
          echo '<td>Sello</td>';
          echo '<td>Precio</td>';
          echo '<td>dar de baja</td>';
          echo '</tr>';

          while ($row = mysql_fetch_array($res))  {
               echo '<tr>';
               echo '<td>'.$row[nom_d].'</td>';
               echo '<td>'.$row[desc_i].'</td>';
               echo '<td>'.$row[desc_cat].'</td>';
               echo '<td>'.$row[desc_s].'</td>';
               echo '<td>'.$row[precio_d].'</td>';
               echo '<td><a href="disco_mod.php?cod_d='.$row[cod_d].'">ver detalle</a></td>';
               echo '</tr>';
          }

          echo '<table>';
     } else                          {
          echo 'No se encontraron discos';
     }
}

?>
<br>
     </div>
</div>


</body>
</html>