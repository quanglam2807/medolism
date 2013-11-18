<?php
session_start();
//Language
require_once('includes/detectlang.php');
require_once('language/'.$usinglang.'/lang_login.php');
// Tải file mysql.php lên
require_once('includes/config.php');
if ( !$_SESSION['user_id'] )
{ 
    if (isset($_GET["act"])) { 
    if ( $_GET['act'] == "do" ) {
        // Dùng hàm addslashes() để tránh SQL injection, dùng hàm md5() để mã hóa password
        $username = addslashes( $_POST['username'] );
        $password = md5(md5( addslashes( $_POST['password'] ) ));
        // Lấy thông tin của username đã nhập trong table members
        $sql_query = @mysql_query("SELECT id, username, password, level, realname FROM members WHERE username='{$username}'");
        $member = @mysql_fetch_array( $sql_query );
    	//Cookie
    	//Check error
    	if(!$_POST['username'] || !$_POST['password']){
          $blank_error=1;
    	}
    	if ( @mysql_num_rows( $sql_query ) <= 0 ) {
    		$user_error=1;
		}
		else {
    		if ( $password != $member['password'] ) {
    		$user_error=1;
			}
		}
    	if(($blank_error==1) || ($user_error==1)) {
			$error_warn=1;
			if ($blank_error =="1")  {
    			$error_warn_in = $error_warn_in."<strong>{$lang_error}:</strong> {$lang_invalid_user_pass}<br/>";
    		}
			else {
    		if ($user_error =="1")  {
    			$error_warn_in = $error_warn_in."<strong>{$lang_error}:</strong> {$lang_wrong_user_pass}<br/>";
    		}	
			}
    		include_once('templates/header.php');
    		include('templates/login.php');
			include_once('templates/footer.php');
    	}
    	else {
    	$_SESSION['user_id'] = $member['id'];
    	if(isset($_POST['remember'])){
    		setcookie("user_id", $_SESSION['user_id'], time()+60*60*24*COOKIE_TIME_OUT, "/");
    	}
		if ($_SESSION['user_id']) {
		$redirect_info = $lang_welcome_back;
    	include_once('templates/redirect.php');
		}
		else {
		$custom_previous = "login?ac=do";
		$redirect_info = $lang_fail_login;
    	include_once('templates/redirect.php');
    	}
		}
    }
	}
    else {
    include_once('templates/header.php');
    include('templates/login.php');
	include_once('templates/footer.php');
    }
}
else {
$redirect_info = "Access denied";
include_once('templates/redirect.php');
}

?>
		