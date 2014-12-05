<?php
require_once 'db.php'; // The mysql database connection script
// if(isset($_GET['task'])){
$name = $_GET['name'];
$description = $_GET['description'];

$query=mysql_query("INSERT INTO tor_bookmarks(name,description) VALUES ('$name', '$description')") or die(mysql_error());
// }
?>