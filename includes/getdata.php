<?php
if (isset($_SESSION['user_id'])) {
  $sql_memdata = @mysqli_query($con, "SELECT * FROM members WHERE id='{$_SESSION['user_id']}'");
  $user = @mysqli_fetch_array( $sql_memdata );
}

function avatar($type,$data,$sex,$size) {
  $default = "image/noavatar/".$sex.".gif";
  if ($type==0) {
    return $default;
  }
  if ($type==1) {
    return $data;
  }
  if ($type==2) {
    $grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $data ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
    return $grav_url;
  }
}
?>
