<?php
session_start();
require_once('includes/detectlang.php');
require_once('language/'.$usinglang.'/lang_editprofile.php');
require_once('includes/config.php');
require_once('includes/getdata.php');
if ( !$_SESSION['user_id'] )
{ 
$redirect_info = $lang_please_login;
$_SESSION['previous'] = "profile";
$custom_previous = "login";
require_once('templates/redirect.php');
}
else {
if (isset($_GET["act"])) { 
	if ( $_GET['act'] == "updateprofile" ) {
	$realname = addslashes( $_POST['realname'] );
	$country = addslashes( $_POST['country'] );
    $birthday = addslashes( $_POST['birthday'] );	
	$timezone = addslashes( $_POST['timezone'] );
	$sex = addslashes( $_POST['sex'] );
	$homepage = addslashes( $_POST['homepage'] );
	$hoppy = addslashes( $_POST['hoppy'] );
	$occupation = addslashes( $_POST['occupation'] );
	$more = addslashes( $_POST['more'] );
	function check_email($email) {
    if (strlen($email) == 0) return false;
    if (eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$", $email)) return true;
    return false;
}
	if (! $_POST['sex'] || ! $_POST['realname'] || ! $_POST['country'] || ! $_POST['birthday'])
    {
        $miss_error=1;
    }	
	if (!ereg("^[0-9]+/[0-9]+/[0-9]{2,4}",$_POST['birthday']))
    {
		$birth_error=1;
    }	
		
	if (($miss_error==1) || ($birth_error==1)) {
	$error_warn=1;
	if ($miss_error =="1")  {
				$error_warn_in = $error_warn_in."<strong>{$lang_error}:</strong>{$lang_blank_error}<br/>";
	}
	if ($birth_error =="1")  {
				$error_warn_in = $error_warn_in."<strong>{$lang_error}:</strong>{$lang_invalid_birthday}<br/>";
	}	
	include_once('templates/header.php');
	include('templates/editprofile_do.php');
	include_once('templates/footer.php');
	}
	else {
	$a=mysqli_query("
	UPDATE `{$db_name}`.`members` SET 
	`realname`='{$realname}',
	`country`='{$country}',
	`birthday`='{$birthday}',
	`timezone`='{$timezone}',
	`sex`='{$sex}',
	`homepage`='{$homepage}',
	`hoppy`='{$hoppy}',
	`occupation`='{$occupation}',
	`more`='{$more}' WHERE `id`='{$_SESSION['user_id']}'
	");
    if ($a) {
	$custom_previous ="profile";
	$redirect_info = $lang_successful_updateprofile;
	require_once('templates/redirect.php');
	}
	else {
	$custom_previous ="profile";
	$redirect_info = $lang_fail_updateprofile;
	require_once('templates/redirect.php');
	}
	}
	}
}
else {
include_once('templates/header.php');
include('templates/editprofile.php');
include_once('templates/footer.php');
}
}
?>