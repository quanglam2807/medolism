<?
require_once("includes/config.php");
$new = @mysql_query("SELECT MAX(id) as max FROM `manga`");
$new = @mysql_fetch_array($new);
echo $new = $new['max']+1;
?>