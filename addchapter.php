<?php
session_start();
require_once('includes/detectlang.php');
require_once('includes/config.php');
require_once('includes/getdata.php');
$manga_id = $_GET['id'];
$sql2 = "select id,name,chuxi,congtac from manga where id = '".$manga_id."'";
$rs2 = mysqli_query($sql2);
while($row2 = mysqli_fetch_array($rs2)){
			$id = $row2['id'];
			$name = $row2['name'];
			$chuxi = $row2['chuxi'];
			$congtac = $row2['congtac'];
}
$lang_page_title="Đăng chapter mới của truyện ".$name;
if ( !$_GET['id']) {
$redirect_info = "Access denied";
include_once('templates/redirect.php');
}
else {
if ( !$_SESSION['user_id'] )
{
$redirect_info = "Bạn cần phải đăng nhập để tiếp tục.";
$_SESSION['previous'] = "addchapter?id={$manga_id}";
$custom_previous = "login";
require_once('templates/redirect.php');
}
else {
$no_per = 0;
$idCheck = explode(",",$congtac);
for($i=0;$i<count($idCheck);$i++){
		$idlan=$idCheck[$i];
		if (( $_SESSION['user_id'] == $chuxi  ) || ( $user['username'] == $idlan ) || ( $user['level'] == 10)) {
    		$no_per = 1;
		}
		else {
			$no_per = 0;
		}
}
if ($no_per == 0) {
$_SESSION['previous'] = "viewmanga?id={$manga_id}";
$redirect_info = "Bạn chưa được cấp quyền để đăng chapter cho truyện này.";
include_once('templates/redirect.php');
}
if ($no_per == 1) {
if (isset($_GET["act"])) {
    if ( $_GET['act'] == "do" ) {
	$chap = addslashes( $_POST['chap'] );
	$bosung = addslashes( $_POST['bosung'] );
	$download = addslashes( $_POST['download'] );
	$noidung = addslashes( $_POST['noidung'] );
	$way = addslashes( $_POST['way'] );
	$ngaydang = date("d/m/Y");
	if ((!$_POST['chap']) || (!$_POST['noidung'])) {
	$error_warn=1;
	$error_warn_in = $error_warn_in."<strong>CHÚ Ý:</strong> Bạn cần phải điền đầy đủ các thông tin bắt buộc.<br/>";
	include_once('templates/header.php');
	include('templates/addchapter.php');
	include_once('templates/footer.php');
	}
	else {
	$a=mysqli_query("INSERT INTO `chapter` (`chap`, `way`, `manga_id`, `ngaydang`, `bosung`, `download`, `noidung`) VALUES ('{$chap}', '{$way}', '{$manga_id}', '{$ngaydang}', '{$bosung}', '{$download}', '{$noidung}');");
	$b=mysqli_query("UPDATE `manga` SET `chapter_id`=(SELECT id FROM chapter ORDER BY id DESC LIMIT 1) WHERE `id`='{$manga_id}';");
	if (($a) && ($b)) {
	$custom_previous = "viewmanga?id={$manga_id}";
	$redirect_info = "Đã đăng chapter mới thành công.";
	require_once('templates/redirect.php');
	}
	else {
	$custom_previous = "addchapter?act=do&id={$_GET['id']}";
	$redirect_info = "Rất tiếc, đăng chapter mới thất bại. Xin vui lòng thử lại!";
	require_once('templates/redirect.php');
	}
	}
}
}
else {
include_once("templates/header.php");
include_once("templates/addchapter.php");
include_once("templates/footer.php");
}
}
}
}
?>
