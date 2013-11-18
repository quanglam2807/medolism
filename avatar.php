<?php
session_start();
require_once('includes/detectlang.php');
require_once('language/'.$usinglang.'/lang_editprofile.php');
require_once('includes/config.php');
require_once('includes/getdata.php');
if (($_GET['avaway']==1) || ($_GET['avaway']==2))  {
$avaway = $_GET['avaway'];
}
else {
$avaway = 0;
}
if ( !$_SESSION['user_id'] )
{ 
$redirect_info = $lang_please_login;
$custom_previous = "login";
$_SESSION['previous'] = "avatar";
require_once('templates/redirect.php');
}
else {
if ($avaway==0) {
	include_once('templates/header.php');
?>
<ul data-tabs="tabs" class="nav nav-tabs">
<li class="firsttabs"><a href="profile">Hồ sơ</a></li>
<li><a href="mailpass">Email &amp; Mật khẩu</a></li>
<li class="active"><a href="#">Ảnh đại diện</a></li>
</ul>
<div class="pill-content">
<div class="active">
<div class="row" style="margin-bottom: 30px; margin-left:0">
<div style="width:326px;text-align:center;float:left;">
<a class="thumbnail" style="width: 250px; margin-left: 28px;" href="avatar?avaway=1"> 
<img src="image/upload.png" style="width: 250px;">
<div class="caption">
<h4>UPLOAD ẢNH TỪ MÁY TÍNH</h4>
</div>
</a>
</div>
<div style="width: 328px; text-align: center; float: left; "> 
<div style="width: 250px; margin-left: 39px;" class="thumbnail">
<div class="caption">
<h4>AVATAR HIỆN TẠI</h4>
</div>
<img src="<? echo avatar($user['avatartype'],$user['avatar'],$user['sex'],250); ?>" style="width:250px;"></div>
</div>
<div style="width:326px;text-align:center;float:left;">
<a style="width: 250px; margin-left: 38px; margin-bottom:10px;" class="thumbnail" data-toggle="modal" href="#type2">
<img src="image/gravatar.jpg" style="width: 250px;">
<div class="caption">
<h4>SỬ DỤNG GRAVATAR</h4>
</div>
</a>
<p><a href="http://gravatar.com">Gravatar là gì?</a></p>

</div>
</div>
</div>
</div>
<div id="type2" class="modal hide fade">
            <div class="modal-header">
              <a class="close" data-dismiss="modal">×</a>
              <h3>Sử dụng Gravatar</h3>
            </div>
			<form class="form-horizontal" method="post" action="avatar?act=successful&avaway=2">
            <div class="modal-body">    
<div class="control-group">                                                                                            	<label>Email Gravatar:</label>                                                                                	<div class="controls docs-input-sizes">                                                                                             		<input type="text" value="<? if ($user['avatartype']==2) { echo $user['avatar']; } ?>" name="avatar">
<p class="help-block">Nhập email của tài khoản <a href="http://gravatar.com">Gravatar</a> bạn đang sử dụng. </p>                                                                         	</div>                                                                                                          </div>			
	    </div>
            <div class="modal-footer">
              <a href="#" class="btn" data-dismiss="modal">Đóng</a>
              <input type="submit" name="submit" value="Cập nhật" class="btn btn-primary">
            </div>
</form>
</div>
<?
	include_once('templates/footer.php');
}
else {
if ($avaway==1) {
if (isset($_GET["act"])) { 
	if ( $_GET['act'] == "successful" ) {
$new_avatar = addslashes( $_POST['new_avatar'] );
$a=mysql_query("
	UPDATE `{$db_name}`.`members` SET 
	`avatar`='{$new_avatar}',
	`avatartype`='1' WHERE `id`='{$_SESSION['user_id']}'
");
foreach (glob("uploads/avatar/".$_SESSION['user_id']."/*") as $delete_files) {
if (($delete_files != $_POST['new_avatar']) && ($delete_files != "uploads/avatar/".$_SESSION['user_id']."/index.html")) {
   unlink($delete_files);
}
}
foreach (glob("uploads/avatarcache/".$_SESSION['user_id']."/*") as $delete2_files) {
if ($delete2_files != "uploads/avatarcache/".$_SESSION['user_id']."/index.html") {
   unlink($delete2_files);
}
}
if ($a) {
$redirect_info = $lang_upload_done;
$custom_previous = "avatar";
$_SESSION['previous'] = "avatar";
require_once('templates/redirect.php');
}
}
}
else {
if (isset($_POST['file'])) {
	$random=md5(uniqid(rand()));
	$avatarname=substr($random, 0, 20);
	if ((($_FILES["file"]["type"] == "image/gif") || ($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/pjpeg") || ($_FILES["file"]["type"] == "image/png")) && ($_FILES["file"]["size"] <= 2097153))
	{
	if ($_FILES["file"]["error"] > 0) {
	$error_warn=1;
	$error_warn_in = $error_warn_in."<strong>{$lang_error}:</strong>{$_FILES["file"]["error"]}<br/>";
	include_once('templates/header.php');
	include('templates/avatar.php');
	include_once('templates/footer.php');
	}
	else {
	$ext = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
	$final_name = $avatarname.".".$ext;
	$avatarcache_dir = 'uploads/avatarcache/'.$_SESSION['user_id'];
	if (file_exists($avatarcache_dir)) {
	} 
	else {
    mkdir($avatarcache_dir, 0777);
	copy("uploads/index.html", $avatarcache_dir."/index.html");
	}
	move_uploaded_file($_FILES["file"]["tmp_name"],$avatarcache_dir . "/" . $final_name);
	if (file_exists($avatarcache_dir . "/" . $final_name)) {
	$cropimagesrc=$avatarcache_dir . "/" . $final_name;
	$avatar_dir = 'uploads/avatar/'.$_SESSION['user_id'];
	if (file_exists($avatar_dir)) {
	} 
	else {
    mkdir($avatar_dir, 0777);
	copy("uploads/index.html", $avatar_dir."/index.html");
	}
	include_once('templates/header.php');
	include_once('templates/avatar2.php');
	include_once('templates/footer.php');
	}
	else {
	$redirect_info = $lang_fail_upload;
	$custom_previous = "avatar";
	require_once('templates/redirect.php');
	}
	}
	}
	else {
	$error_warn=1;
    if ( !$_FILES["file"]["name"] ) {
				$error_warn_in = $error_warn_in."<strong>{$lang_error}:</strong>{$lang_plese_select_file}<br/>";
    }
	if ($_FILES["file"]["size"] > 2097152)  {
    			$error_warn_in = $error_warn_in."<strong>{$lang_error}:</strong>{$lang_too_much_large}<br/>";
    }
	if (!(($_FILES["file"]["type"] == "image/gif") || ($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/pjpeg") || ($_FILES["file"]["type"] == "image/png"))) {
				$error_warn_in = $error_warn_in."<strong>{$lang_error}:</strong> {$lang_not_support_type}<br/>";
	}	
	include_once('templates/header.php');
	include('templates/avatar.php');
	include_once('templates/footer.php');
	}
}
else {
include_once('templates/header.php');
include_once('templates/avatar.php');
include_once('templates/footer.php');
}
}
}
else {
if ( $_POST['submit'] ) {
function check_email($email) {
    if (strlen($email) == 0) return false;
    if (eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$", $email)) return true;
    return false;
}
    if (!check_email($_POST['avatar']))
    {
		$error_warn=1;
		$error_warn_in = $error_warn_in."<strong>{$lang_error}:</strong>Email bạn nhập không hợp lệ.<br/>";
	include_once('templates/header.php');
?>
<ul data-tabs="tabs" class="nav nav-tabs">
<li class="firsttabs"><a href="profile">Hồ sơ</a></li>
<li><a href="mailpass">Email &amp; Mật khẩu</a></li>
<li class="active"><a href="#">Ảnh đại diện</a></li>
</ul>
<div class="pill-content">
<div class="active">
<form class="form-horizontal" method="post" action="avatar?act=successful&avaway=2">
<div class="control-group">                                                                                            	<label>Email Gravatar:</label>                                                                                	<div class="controls docs-input-sizes">                                                                                             		<input type="text" value="<? if ($user['avatartype']==2) { echo $user['avatar']; } ?>" name="avatar">
<p class="help-block">Nhập email của tài khoản <a href="http://gravatar.com">Gravatar</a> bạn đang sử dụng. </p>                                                                         	</div>                                                                                                          </div>			</div>
<div class="form-actions">                                                                                             <input type="submit" value="Cập nhật" class="btn btn-primary" name="submit">                             <button class="btn" type="reset">Hủy</button>                                                          </div>
</form>
</div>
<?
	include_once('templates/footer.php');
	}
	else {
	$a=mysql_query("
	UPDATE `{$db_name}`.`members` SET 
	`avatar`='{$_POST['avatar']}',
	`avatartype`='2' WHERE `id`='{$_SESSION['user_id']}'
");
if ($a) {
$redirect_info = "Cập nhật avatar thành công";
$custom_previous = "avatar";
$_SESSION['previous'] = "avatar";
require_once('templates/redirect.php');
}
else {
$redirect_info = "Cập nhật avatar thất bại. Xin vui lòng thử lại!";
$custom_previous = "avatar";
$_SESSION['previous'] = "avatar";
require_once('templates/redirect.php');
}
	}
}
else {
?>
Access Denied
<?
}
}
}
}
?>