<?php
require_once 'db.php'; // The mysql database connection script

$query=mysql_query("SELECT * from tor_bookmarks") or die(mysql_error());
 
# Collect the results
while($obj = mysql_fetch_object($query)) {
 $arr[] = $obj;
}
 
# JSON-encode the response
echo $json_response = json_encode($arr);
?>