<html>
<head>
     <title>Login</title>
     <link rel="stylesheet" type="text/css" href="styles.css">
     <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:700' rel='stylesheet' type='text/css'>
     <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
          </section><br><br>
          <?php 

include 'cnx.php';

if ($_POST['sublogin']) {

     $_POST = clean($_POST);

     $res = mysql_query("select * from usuario where nick_u = '$_POST[txtu]' and pass_u = '$_POST[txtp]'");
     if (mysql_num_rows($res)) {
          $row = mysql_fetch_array($res);
          $_SESSION[registrado] = $row[cod_u];
	$_SESSION['username'] = $row[nick_u];
     } else                      {
          $mensaje = '<br />nombre de usuario / contraseña incorrectos<br /><br />';
     }
}

if ($_SESSION['registrado']) {
     $admin = mysql_query("select nick_u from usuario where  pass_u = '$_POST[txtp]' and privilegio = 1;");
     if(mysql_num_rows($admin)){
        header("location: menu_adm.php");
     }else{
        header("location: index.php");
     }
      exit;
} else {
     echo '<html>';
     echo '<head>';
     echo '       <title>Registro de Usuarios</title>';
     echo '       <link rel="stylesheet" type="text/css" href="styles.css">';
     echo '</head>';

     echo '<body>';
     
     echo $mensaje;
     echo '<form method="POST" action="login.php">';
     echo '<table class="table table-bordered" style="width: 80%;">';
     echo '<tr>';
     echo '<td>Ingrese su nombre de usuario:</td>';
     echo '<td><input type="text" id="txtu" name="txtu" value="'.$_POST['txtu'].'"></td>';
     echo '</tr>';
     echo '<tr>';
     echo '<td>Ingrese su contraseña:</td>';
     echo '<td><input type="password" id="txtp" name="txtp" value="'.$_POST['txtp'].'"></td>';
     echo '</tr>';
     echo '<tr>';
     echo '<td colspan="2"><input type="submit" id="sublogin" class="btn btn-primary" name="sublogin" value="login"></td>';
     echo '</tr>';
     echo '<table>';
     echo '</form>';
     echo '<br /><a href="index.php">ir a inicio</a>';
     echo '</body>';
     echo '</html>';
}

?>


</body>
</html>

