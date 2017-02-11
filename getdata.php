<?php
if ($_SESSION['user_id']) {
$sql_memdata = @mysqli_query($con, "SELECT * FROM members WHERE id='{$_SESSION['user_id']}'");
$user = @mysqli_fetch_array( $sql_memdata );
if ( !$user['avatar'] ) {
$user_avatar="image/noavatar/".$user['sex'].".gif";
}
else {
$user_avatar=$user['avatar'];
}
}
?>
