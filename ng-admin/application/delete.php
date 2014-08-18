<?php
require_once 'db.php'; // The mysql database connection script

if(isset($_GET['pageID'])){
$pageID = $_GET['pageID'];

$query=mysql_query("DELETE FROM `tor_bookmarks` WHERE id='$pageID'") or die(mysql_error());



# Collect the results
while($obj = mysql_fetch_object($query)) {
 $arr[] = $obj;
}

$json_response = json_encode($arr);
}
?>

<!-- mysql_query("DELETE FROM `table` WHERE id=`$id`"); -->