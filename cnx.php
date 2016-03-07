<?php

$cnx = mysql_connect("127.0.0.1", "root", "root") or die("Error en la conexion");
$db = mysql_select_db("bddiscos");

session_start();

function clean($s) {
	if (is_array($s)) {
		foreach($s as $c => $v) {
			$s[$c] = mysql_real_escape_string($v);
		}
	} else $s = mysql_real_escape_string($s);
	
	return $s;
}

?>