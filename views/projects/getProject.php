<?php
require_once '../../ng-admin/application/db.php'; // The mysql database connection script

$pageID = $_GET['pageID'];

//$query=mysql_query("SELECT * from tor_bookmarks") or die(mysql_error());
$query=mysql_query("SELECT * from tor_bookmarks WHERE id = {$pageID}") or die(mysql_error());
 
# Collect the results
while($obj = mysql_fetch_object($query)) {
 $arr[] = $obj;
}
 
# JSON-encode the response
echo $json_response = json_encode($arr);
?>

