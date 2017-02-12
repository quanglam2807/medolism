<?php
session_start();
require_once('includes/detectlang.php');
require_once('includes/config.php');
require_once('includes/getdata.php');
if (!isset($_SESSION['user_id'])) {
	$redirect_info = "Bạn cần phải đăng nhập để tiếp tục.";
	$_SESSION['previous'] = "editmanga";
	$custom_previous = "login";
	require_once('templates/redirect.php');
} else if ( !$_GET['id']) {
	$redirect_info = "Access denied";
	include_once('templates/redirect.php');
} else {
	$id = $_GET['id'];
	$sql = @mysqli_query($con, "SELECT * FROM manga WHERE id='{$id}'");
	$row = @mysqli_fetch_array($sql);
	$chuxi = $row['chuxi'] ;
	if (!isset($_POST['submit'])) {
		$name = $row['name'] ;
		$tacgia = $row['tacgia'] ;
    $status = $row['status'] ;
		$xxx = $row['xxx'] ;
		$theloai = $row['cats'] ;
		$chuthich = $row['chuthich'] ;
		$nguon = $row['nguon'] ;
		$tenkhac = $row['tenkhac'] ;
		$congtac = $row['congtac'] ;
	} else {
		$name = addslashes( $_POST['name'] );
		$tacgia = addslashes( $_POST['tacgia'] );
    $status = addslashes( $_POST['status'] );
		$xxx = addslashes( $_POST['xxx'] );
		foreach ($_POST['cats'] as $value){
			$theloai .=  $value . ",";
		}
		$anhbia = addslashes( $_POST['anhbia'] );
		$chuthich = addslashes( $_POST['chuthich'] );
		$nguon = addslashes( $_POST['nguon'] );
		$tenkhac = addslashes( $_POST['tenkhac'] );
		$congtac = addslashes( $_POST['congtac'] );
	}
	$no_per = 0;
	$idCheck = explode(";",$congtac);
	for ($i=0; $i<count($idCheck); $i++) {
		$idlan=$idCheck[$i];
		if ($no_per==0) {
			if (( $_SESSION['user_id'] == $chuxi  ) || ( $user['username'] == $idlan ) || ( $user['level'] == 10)) {
    		$no_per = 1;
			} else {
				$no_per = 0;
			}
		}
	}
	if ($no_per == 0) {
		$_SESSION['previous'] = "viewmanga?id={$id}";
		$redirect_info = "Bạn chưa được cấp quyền để chỉnh sửa truyện này.";
		include_once('templates/redirect.php');
	} else {
		$idCheck = explode(",",$theloai);
		$lang_page_title = "Chỉnh sửa truyện ".$name;
		if (isset($_POST['submit'])) {
			if ( $_POST['delete']==1 ) {
				unset($_SESSION['delmaid2']);
				$_SESSION['delmaid2'] = $id;
				$a=mysqli_query("DELETE FROM manga WHERE `id`='{$id}'");
				$b=mysqli_query("DELETE FROM chapter WHERE `manga_id`='{$id}'");
				if (($a) && ($b)) {
					$custom_previous = "list";
					$redirect_info = "Đã xóa truyện thành công.";
					require_once('templates/redirect.php');
				} else {
					$custom_previous = "editchapter?id={$id}";
					$redirect_info = "Rất tiếc, xóa thất bại, xin vui lòng thử lại!";
					require_once('templates/redirect.php');
				}
			} else {
				if ((!$_POST['name']) || (!$_POST['tacgia']) || (!$_POST['status']) || (!$_POST['cats']) || (!$_POST['chuthich']) || (($_POST['imgmode']==2)
				&& (($row['imgmode']==2) || ($row['imgmode']==1)) && ((!$_POST['smallimg']) || (!$_POST['bigimg']))) || (($row['imgmode']==2)
				&& ($_POST['imgmode']==1) && ((!$_FILES["bigimg"]["name"]) || (!$_FILES["smallimg"]["name"])))) {
					$error_warn=1;
					$error_warn_in = $error_warn_in."<strong>CHÚ Ý:</strong> Bạn cần phải điền đầy đủ các thông tin bắt buộc.<br/>";
					include_once('templates/header.php');
					include('templates/addmanga.php');
					include_once('templates/footer.php');
				} else {
					if ($_POST['imgmode']==1) {
						if ($_FILES["bigimg"]["name"]) {
							if ($row['imgmode']==1) {
  							unlink($row['bigimg']);
							}
							$random=md5(uniqid(rand()));
							$ext = pathinfo($_FILES["bigimg"]["name"], PATHINFO_EXTENSION);
							$bigimg = "uploads/bigimg/".$random.".".$ext;
							move_uploaded_file($_FILES["bigimg"]["tmp_name"],$bigimg);
						}
						if ($_FILES["smallimg"]["name"]) {
							if ($row['imgmode']==1) {
  							unlink($row['smallimg']);
							}
							$random2=md5(uniqid(rand()));
							$ext2 = pathinfo($_FILES["smallimg"]["name"], PATHINFO_EXTENSION);
							$smallimg = "uploads/smallimg/".$random2.".".$ext2;
							move_uploaded_file($_FILES["smallimg"]["tmp_name"],$smallimg);
						}
					}
					if ($_POST['imgmode']==2) {
						if ($row['imgmode']==1) {
  						unlink($row['smallimg']);
  						unlink($row['bigimg']);
						}
						$bigimg = $_POST['bigimg'];
						$smallimg = $_POST['smallimg'];
					}
					$marTViet = array(
						"à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă",
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
						"Đ"
				);
				$marKoDau = array(
					"a","a","a","a","a","a","a","a","a","a","a"
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
					"D"
				);
				$kodau1=str_replace($marTViet, $marKoDau, $name);
				$kodau2=str_replace($marTViet, $marKoDau, $tenkhac);
				$a=mysqli_query($con, 
					"UPDATE `manga` SET
						`status`='{$status}',
						`name`='{$name}',
						`tenkhac`='{$tenkhac}',
						`namekodau`='{$kodau1}',
						`tenkhackodau`='{$kodau2}',
						`nguon`='{$nguon}',
						`cats`='{$theloai}',
						`congtac`='{$congtac}',
						`xxx`='{$xxx}',
						`chuthich`='{$chuthich}',
						`tacgia`='{$tacgia}',
						`bigimg`='{$bigimg}',
						`smallimg`='{$smallimg}',
						`imgmode`='{$_POST['imgmode']}'
					WHERE `id`='{$id}'"
				);
    		if ($a) {
					$redirect_info = "Đã chỉnh sửa truyện thành công.";
					require_once('templates/redirect.php');
				} else {
					$custom_previous = "editmanga?act=do";
					$redirect_info = "Rất tiếc, chỉnh sửa truyện thất bại. Xin vui lòng thử lại!";
					require_once('templates/redirect.php');
				}
			}
		}
	} else {
		include_once('templates/header.php');
		include('templates/editmanga.php');
		include_once('templates/footer.php');
	}
}
}
?>
