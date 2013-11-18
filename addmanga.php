<?
session_start();
require_once('includes/detectlang.php');
$lang_page_title="Đăng truyện";
require_once('includes/config.php');
require_once('includes/getdata.php');
if ( !$_SESSION['user_id'] )
{ 
$redirect_info = "Bạn cần phải đăng nhập để tiếp tục.";
$_SESSION['previous'] = "addmanga";
$custom_previous = "login";
require_once('templates/redirect.php');
}
else {
if (isset($_GET["act"])) { 
	if ( $_GET['act'] == "do" ) {
	if ((!$_POST['name']) || (!$_POST['tacgia']) || (!$_POST['status']) || (!$_POST['cats']) || (!$_POST['chuthich']) || (!$_POST['nguon']) || (($_POST['imgmode']==1) && ((!$_FILES["bigimg"]["name"]) || (!$_FILES["smallimg"]["name"]))) || (($_POST['imgmode']==2) && ((!$_POST['bigimg']) || (!$_POST['smallimg'])))) {
	$error_warn=1;
	$error_warn_in = $error_warn_in."<strong>CHÚ Ý:</strong> Bạn cần phải điền đầy đủ các thông tin bắt buộc.<br/>";
	include_once('templates/header.php');
	include('templates/addmanga.php');
	include_once('templates/footer.php');
	}
	else if (
(
($_FILES["bigimg"]["type"] != "image/gif") || 
($_FILES["bigimg"]["type"] != "image/jpeg") ||
($_FILES["bigimg"]["type"] != "image/pjpeg") || 
($_FILES["bigimg"]["type"] != "image/png")
) 
&& (
($_FILES["smallimg"]["type"] != "image/gif") || 
($_FILES["smallimg"]["type"] != "image/jpeg") ||
($_FILES["smallimg"]["type"] != "image/pjpeg") || 
($_FILES["smallimg"]["type"] != "image/png")
)
&& ($_FILES["bigimg"]["size"] > 2097153)
&& ($_FILES["smallimg"]["size"] > 2097153)
) {
	$error_warn_in = $error_warn_in."<strong>CHÚ Ý:</strong> Ảnh chỉ hỗ trợ định dạng GIF,PNG và JPG với dung lương tối đa 2Mb.<br/>";
	include_once('templates/header.php');
	include('templates/addmanga.php');
	include_once('templates/footer.php');
}
	else {
	$name = addslashes( $_POST['name'] );
	$tacgia = addslashes( $_POST['tacgia'] );
    $status = addslashes( $_POST['status'] );	
	$xxx = addslashes( $_POST['xxx'] );
	foreach ($_POST['cats'] as $value){
		$theloai .=  $value . ",";
	}
	$chuthich = addslashes( $_POST['chuthich'] );
	$chuxi = addslashes( $_SESSION['user_id'] );
	$nguon = addslashes( $_POST['nguon'] );
	$tenkhac = addslashes( $_POST['tenkhac'] );
	$congtac = addslashes( $_POST['congtac'] );	
	$ngaydang = date("d/m/Y");	
if ($_POST['imgmode']==1) 
{
$random=md5(uniqid(rand()));
$random2=md5(uniqid(rand()));
$ext = pathinfo($_FILES["bigimg"]["name"], PATHINFO_EXTENSION);
$ext2 = pathinfo($_FILES["smallimg"]["name"], PATHINFO_EXTENSION);
$bigimg = "uploads/bigimg/".$random.".".$ext;
$smallimg = "uploads/smallimg/".$random2.".".$ext2;
move_uploaded_file($_FILES["bigimg"]["tmp_name"],$bigimg);
move_uploaded_file($_FILES["smallimg"]["tmp_name"],$smallimg);
}
if ($_POST['imgmode']==2) {
$bigimg = $_POST['bigimg'];
$smallimg = $_POST['smallimg'];
}
$new = @mysql_query("SELECT MAX(id) as max FROM `manga`");
$new = @mysql_fetch_array($new);
$new = $new['max']+1;
$marTViet=array("à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă",
"ằ","ắ","ặ","ẳ","ẵ","è","é","ẹ","ẻ","ẽ","ê","ề"
,"ế","ệ","ể","ễ",
"ì","í","ị","ỉ","ĩ",
"ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ"
,"ờ","ớ","ợ","ở","ỡ",
"ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ",
"ỳ","ý","ỵ","ỷ","ỹ",
"đ",
"À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă"
,"Ằ","Ắ","Ặ","Ẳ","Ẵ",
"È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ",
"Ì","Í","Ị","Ỉ","Ĩ",
"Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ"
,"Ờ","Ớ","Ợ","Ở","Ỡ",
"Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ",
"Ỳ","Ý","Ỵ","Ỷ","Ỹ",
"Đ");

$marKoDau=array("a","a","a","a","a","a","a","a","a","a","a"
,"a","a","a","a","a","a",
"e","e","e","e","e","e","e","e","e","e","e",
"i","i","i","i","i",
"o","o","o","o","o","o","o","o","o","o","o","o"
,"o","o","o","o","o",
"u","u","u","u","u","u","u","u","u","u","u",
"y","y","y","y","y",
"d",
"A","A","A","A","A","A","A","A","A","A","A","A"
,"A","A","A","A","A",
"E","E","E","E","E","E","E","E","E","E","E",
"I","I","I","I","I",
"O","O","O","O","O","O","O","O","O","O","O","O"
,"O","O","O","O","O",
"U","U","U","U","U","U","U","U","U","U","U",
"Y","Y","Y","Y","Y",
"D");
$kodau1=str_replace($marTViet,$marKoDau,$name);
$kodau2=str_replace($marTViet,$marKoDau,$tenkhac);	
	$a=mysql_query("INSERT INTO `{$db_name}`.`manga` (`status`, `name`, `tenkhac`, `namekodau`, `tenkhackodau`, `nguon`, `cats`, `chuxi`, `congtac`, `xxx`, `chuthich`, `tacgia`, `bigimg`, `smallimg`, `imgmode`, `ngaydang`) VALUES ('{$status}', '{$name}', '{$tenkhac}', '{$kodau1}', '{$kodau2}', '{$nguon}', '{$theloai}', '{$chuxi}', '{$congtac}', '{$xxx}', '{$chuthich}', '{$tacgia}', '{$bigimg}', '{$smallimg}', '{$_POST['imgmode']}', '{$ngaydang}')");
    if ($a) {
	$custom_previous = "viewmanga?id=".$new;
	$redirect_info = "Đã đăng truyện thành công, tuy nhiên bạn cần phải đợi xét duyệt từ BQT.";
	require_once('templates/redirect.php');
	}
	else {
	$custom_previous = "addmanga?act=do";
	$redirect_info = "Rất tiếc, đăng truyện thất bại. Xin vui lòng thử lại!";
	require_once('templates/redirect.php');
	}	
	}
	}
	}
else {
	include_once('templates/header.php');
	include('templates/addmanga.php');
	include_once('templates/footer.php');
}
}

?>	