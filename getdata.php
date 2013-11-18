<?php
if ($_SESSION['user_id']) {
$sql_memdata = @mysql_query("SELECT * FROM members WHERE id='{$_SESSION['user_id']}'");
$user = @mysql_fetch_array( $sql_memdata );
if ( !$user['avatar'] ) {
$user_avatar="image/noavatar/".$user['sex'].".gif";
}
else {
$user_avatar=$user['avatar'];
}
}
?>