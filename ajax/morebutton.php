<?php
require_once('../includes/config.php'); 
$ft = $_GET['ft'];
$id = $_GET['id'];
$page = intval($_GET['page']);
if ($ft==1) {
if ($id>0) {
$sql_count123 = @mysqli_query($con, "SELECT COUNT(*) FROM manga WHERE xxx<16 AND `cats` like '%,{$id},%' OR `cats` like '{$id},%' OR `cats` like '%,{$id}'");
}
else {
$sql_count123 = @mysqli_query($con, "SELECT COUNT(*) FROM manga WHERE xxx<16");
}
}
else {
if ($id>0) {
$sql_count123 = @mysqli_query($con, " SELECT COUNT(*) FROM manga WHERE `manga_id` like '%,{$id},%' OR `manga_id` like '{$id},%' OR `manga_id` like '%,{$id}'");
}
else {
$sql_count123 = @mysqli_query($con, "SELECT COUNT(*) FROM manga");
}
}
$count123 = @mysqli_fetch_array( $sql_count123 );
$pagesum = ceil($count123['0']/10);
if ($page<$pagesum) {
$nextpage=$page+1;
?>
<div style="margin: auto; text-align: center;"><a onclick="more(<?php echo $ft; ?>,<?php echo $nextpage; ?>,<?php echo $id; ?>)" style="width: 620px;" class="btn btn-success">XEM THÊM</a></div>
<?php
}
?>
