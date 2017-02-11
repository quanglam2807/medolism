<?php
session_start();
require_once('includes/detectlang.php');
require_once('language/'.$usinglang.'/lang_editprofile.php');
require_once('includes/config.php');
require_once('includes/getdata.php');
if ( !$_SESSION['user_id'] )
{ 
$redirect_info = $lang_please_login;
$custom_previous = "login";
$_SESSION['previous'] = "mailpass";
require_once('templates/redirect.php');
}
else {
if (isset($_GET["act"])) { 
	if ( $_GET['act'] == "update" ) {
	$usepass = md5(md5( addslashes( $_POST['usepass'] )));
	$newpass = md5(md5(addslashes( $_POST['newpass'] )));
    $renewpass = md5(md5(addslashes( $_POST['retype_newpass'] )));	
	$newemail = addslashes( $_POST['newemail'] );
    $renewemail = addslashes( $_POST['retype_newemail'] );	
	function check_email($newemail) {
    if (strlen($newemail) == 0) return false;
    if (eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$", $newemail)) return true;
    return false;
	}
	if ( $usepass != $user['password'] ) {
    	$user_error=1;
	}
	if (!check_email($newemail))
    {
		$mail_error=1;
    }
	if (( ! $_POST['newemail'] ) && ( ! $_POST['renewemail'] ))
	{
		$newemail = $user['email'];
	}
	if ( $newemail != $renewemail ) {
		$nmmail=1;
	}
	if(strlen($_POST['newpass']) < 8) {
      $length2=1;
	}
	if (( mysqli_num_rows(mysqli_query("SELECT email FROM members WHERE email='$newemail'"))>0) && ($newemail != $user['email']))
    {
		$mail2_error=1;
    }	
	if (( ! $_POST['newpass'] ) && ( ! $_POST['renewpass'] ))
	{
		$newpass = $user['password'];
	}
	else {
	if ( $newpass != $renewpass ) {
		$nmpass=1;
	}	
	}
	if (($mail_error==1) || ($nmmail==1) || ($nmpass==1) || ($mail2_error==1) || ($user_error==1)) {
	include_once('templates/header.php');
	echo "<div class=\"alert alert-error fade in\">";
	echo "   <a class=\"close\" href=\"#\"  data-dismiss=\"alert\" >&times;</a>";
	if ($mail2_error =="1")  {
				echo"<strong>{$lang_error}:</strong>{$lang_duplicate_email}<br/>";
	}
	if ($length2 =="1")  {
				echo"<strong>{$lang_error}:</strong> Mật khẩu phải có tối thiểu 8 ký tự.<br/>";
	}
	if ($mail_error =="1")  {
				echo"<strong>{$lang_error}:</strong>{$lang_invalid_email}<br/>";
	}
	if ($nmmail =="1")  {
				echo"<strong>{$lang_error}:</strong>{$lang_email_do_not_match}<br/>";
	}	
	if ($nmpass =="1")  {
				echo"<strong>{$lang_error}:</strong>{$lang_password_do_not_match}<br/>";
	}
	if ($user_error =="1")  {
				echo"<strong>{$lang_error}:</strong>{$lang_wrong_user_pass}<br/>";
	}
	echo "</div>";
	include('templates/mailpass.php');
	include_once('templates/footer.php');	
	}
	else {
	$a=mysqli_query("
	UPDATE `{$db_name}`.`members` SET 
	`password`='{$newpass}',
	`email`='{$newemail}'
	WHERE `id`='{$_SESSION['user_id']}'
	");
	if ($a) {
	$custom_previous = "mailpass";
	$redirect_info = $lang_successful_updatemailpass;
	require_once('templates/redirect.php');
	}
	else {
	$custom_previous = "mailpass";
	$redirect_info = $lang_fail_updatemailpass;
	require_once('templates/redirect.php');
	} 
	}
	}
}
else {

include_once('templates/header.php');
include('templates/mailpass.php');
include_once('templates/footer.php');
}
}
?>