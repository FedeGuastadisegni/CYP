<?php include 'cnx.php';   ?>
<html>
<head>
	<title>Buscador</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:700' rel='stylesheet' type='text/css'>

	<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/main.css">
</head>
<body>


<div id="wrapper" align="center">
	<div id="content" class="row">
			<section>
				<a style="text-decoration:none;" href="index.php">
                    <div id="cabeceraB" class="header">Tienda de Discos</div>
                </a>
			</section><br>
				<div class="header">Bienvenido al buscador de discos</div><br>

					<form method="POST" action="verdiscos.php?modo=b">
					<table class="table table-bordered" style="width: 80%;">
						<tr>
						<td style="font-size: 150%">Por palabra clave</td>
						<td>
							<div class="col-xs-6"><input type="text" id="txtpc" name="txtpc" class="form-control input-sm"></div>
						</td>
						</tr>

						<tr>
						<td style="font-size: 110%">Nombre disco</td>
						<td>
						<?php

						$select = '-';
						$res = mysql_query("select * from disco order by nom_d");
						if (mysql_num_rows($res)) {
							$select = '<select id="selND" name="selND">';
							$select .= '<option value=0 selected>Todos los discos</option>';

							while ($row = mysql_fetch_array($res))
								$select .= "<option value='$row[cod_d]'>$row[nom_d]</option>";

							$select .= '</select>';
						}

						echo $select;

						?>
						</td>
						</tr>

						<tr>
						<td style="font-size: 110%">Artista</td>
						<td>
						<?php

						$select = '-';
						$res = mysql_query("select * from interprete order by desc_i");
						if (mysql_num_rows($res)) {
							$select = '<select id="selNI" name="selNI">';
							$select .= '<option value=0 selected>Todos los artistas</option>';

							while ($row = mysql_fetch_array($res))
								$select .= "<option value='$row[cod_i]'>$row[desc_i]</option>";

							$select .= '</select>';
						}

						echo $select;

						?>
						</td>
						</tr>

						<tr>
						<td style="font-size: 110%">Categoria</td>
						<td>
						<?php

						$select = '-';
						$res = mysql_query("select * from categoria order by desc_cat");
						if (mysql_num_rows($res)) {
							$select = '<select id="selNC" name="selNC">';
							$select .= '<option value=0 selected>Todos las categorias</option>';

							while ($row = mysql_fetch_array($res))
								$select .= "<option value='$row[cod_cat]'>$row[desc_cat]</option>";

							$select .= '</select>';
						}

						echo $select;

						?>
						</td>
						</tr>

						<tr>
						<td colspan="2"><input class="btn btn-primary" type="submit" id="subbuscar" name="subbuscar"></td>
						</tr>
					</table>
					</form>
			</section>
	</div>
</div>
<footer class="color3">
    <div class="footer">
        <div class="col-sm-4 color3">
            Conceptos y paradigmas de lenguajes de programación.
        </div>
        <div class="col-sm-4 color3" align="center">
            <a href="http://www.unla.edu.ar/" style="text-decoration:none;" class="footfont">Universidad Nacional de Lanús<img src="img/unla.png" class="footimg" alt=""></a>
        </div>
        <div class="col-sm-4 color3" align="right">
            Rodriguez Nahuel, Valenzuela Gabriel, Zitterkopf Carlos.
        </div>
    </div>
</footer>

</body>

</html>
