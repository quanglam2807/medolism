<?
session_start();
require_once('includes/detectlang.php');
require_once('includes/config.php');
require_once('includes/getdata.php');
$chapter_id = $_GET['id'];
$sql2 = "select * from chapter where id = '".$chapter_id."'";
$rs2 = mysql_query($sql2);
while($row2 = mysql_fetch_array($rs2)){
			$manga_id = $row2['manga_id'];
if ( !$_POST['submit'] ) {
			$noidung = $row2['noidung'];
			$chap = $row2['chap'];
			$way = $row2['way'];
			$bosung = $row2['bosung'];
			$download = $row2['download'];
}
else {
	$chap = addslashes( $_POST['chap'] );
	$bosung = addslashes( $_POST['bosung'] );
	$download = addslashes( $_POST['download'] );
	$noidung = addslashes( $_POST['noidung'] );
	$way = addslashes( $_POST['way'] );
}
}
$sql3 = "select id,name,chuxi,congtac from manga where id = '".$manga_id."'";
$rs3 = mysql_query($sql3);
while($row3 = mysql_fetch_array($rs3)){
			$id = $row3['id'];
			$name = $row3['name'];
			$chuxi = $row3['chuxi'];
			$congtac = $row3['congtac'];
}
$lang_page_title="Sửa chapter {$chap} của truyện ".$name;
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
$idCheck = explode(";",$congtac);
for($i=0;$i<count($idCheck);$i++){
		$idlan=$idCheck[$i];
if ($no_per==0) {
		if (( $_SESSION['user_id'] == $chuxi  ) || ( $user['username'] == $idlan ) || ( $user['level'] == 10)) {
    		$no_per = 1;
		}
		else {
			$no_per = 0;
		}
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
	if ( $_POST['delete']==1 ) {
	unset($_SESSION['delmaid']);
	$_SESSION['delmaid'] = $manga_id;
	$a=mysql_query("DELETE FROM chapter WHERE `id`='{$chapter_id}'");
	if ($a) {
	$custom_previous = "viewmanga?id={$_SESSION['delmaid']}";
	$redirect_info = "Đã xóa chapter thành công.";
	require_once('templates/redirect.php');
	}
	else {
	$custom_previous = "editchapter?id={$chapter_id}";
	$redirect_info = "Rất tiếc, xóa thất bại, xin vui lòng thử lại!";
	require_once('templates/redirect.php');
	}	
	}
	else {
	if ((!$_POST['chap']) || (!$_POST['noidung'])) {
	$error_warn=1;
	$error_warn_in = $error_warn_in."<strong>CHÚ Ý:</strong> Bạn cần phải điền đầy đủ các thông tin bắt buộc.<br/>";
	include_once('templates/header.php');
	include('templates/editchapter.php');
	include_once('templates/footer.php');	
	}
	else {
	$a=mysql_query("UPDATE `chapter` SET `chap`='{$chap}',`way`='{$way}',`bosung`='{$bosung}',`download`='{$download}',`noidung`='{$noidung}' WHERE `id`='{$chapter_id}'");
	if ($a) {
	$custom_previous = "viewmanga?id={$manga_id}";
	$redirect_info = "Đã sửa chapter thành công.";
	require_once('templates/redirect.php');
	}
	else {
	$custom_previous = "editchapter?id={$chapter_id}";
	$redirect_info = "Rất tiếc, sửa chapter mới thất bại. Xin vui lòng thử lại!";
	require_once('templates/redirect.php');
	}
	}	
	}
}
}
else {
include_once("templates/header.php");	
include_once("templates/editchapter.php");	
include_once("templates/footer.php");	
}
}
}
}
?>
