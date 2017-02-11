<?php
  require_once("includes/config.php");
  $new = @mysqli_query($con, "SELECT MAX(id) as max FROM `manga`");
  $new = @mysqli_fetch_array($new);
  echo $new = $new['max']+1;
?>
