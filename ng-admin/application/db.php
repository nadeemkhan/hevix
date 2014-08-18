<?php 
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'texpos_umain');
define('DB_PASSWORD', '[CVGDgD@[Z6z');
define('DB_DATABASE', 'texpos_toropanov');
$connection = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or die(mysql_error());
$database = mysql_select_db(DB_DATABASE) or die(mysql_error());
?>