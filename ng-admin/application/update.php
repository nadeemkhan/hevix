<?php
require_once 'db.php'; // The mysql database connection script
if(isset($_GET['pageID'])){
$pageID = $_GET['pageID'];

$name = $_GET['name'];
$description = $_GET['description'];

$query=mysql_query("UPDATE tor_bookmarks SET name='$name', description='$description' where id='$pageID'") or die(mysql_error());
while($obj = mysql_fetch_object($query)) {
 $arr[] = $obj;
}
$json_response = json_encode($arr);
}
?>