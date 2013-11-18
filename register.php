<?
session_start();
require_once('includes/detectlang.php');
require_once('language/'.$usinglang.'/lang_register.php');
require_once('includes/config.php');
if ( !$_SESSION['user_id'] )
{ 
require_once('includes/recaptchalib.php');
$publickey = "6Lc4Bc8SAAAAAJLaJiTq4hd-o_4pGWs29rjoJYdl";
$privatekey = "6Lc4Bc8SAAAAACEO2WPDIFrBup3fI6GnpNL9bjV4";
function check_email($email) {
    if (strlen($email) == 0) return false;
    if (eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$", $email)) return true;
    return false;
}
$resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

if (isset($_GET["act"])) { 
if ( $_GET['act'] == "do" )
{
    // Dùng hàm addslashes() để tránh SQL injection, dùng hàm md5() để mã hóa password
    $username = addslashes( $_POST['username'] );
    $password = md5(md5( addslashes( $_POST['password'] ) ) );
    $verify_password = md5(md5( addslashes( $_POST['verify_password'] ) ) );
    $email = addslashes( $_POST['email'] );
    $realname = addslashes( $_POST['realname'] );
	$country = addslashes( $_POST['country'] );
    $birthday = addslashes( $_POST['birthday'] );	
	$timezone = addslashes( $_POST['timezone'] );
	$sex = addslashes( $_POST['sex'] );
	
	// Check username
	if ( ! $_POST['sex'] || ! $_POST['username'] || ! $_POST['password'] || ! $_POST['verify_password'] || ! $_POST['email'] || ! $_POST['realname'] || ! $_POST['country'] || ! $_POST['birthday'])
    {
        $miss_error=1;
    }	
	else {
	if (!$resp->is_valid) {
    // What happens when the CAPTCHA was entered incorrectly
		$captcha=1;
	}
	if(preg_match('/[^A-Za-z0-9]./',$username))
	{
		$symbol=1;
	}
	if((strlen($_POST['user']) > 36) && (strlen($_POST['user']) < 8)){
      $length=1;
	}
	if(strlen($_POST['password']) < 8) {
      $length2=1;
	}
	// Kiểm tra mật khẩu
	if ( $password != $verify_password )
    {
		$pass_error=1;
    }
    // Kiểm tra username nay co nguoi dung chua
    if ( mysql_num_rows(mysql_query("SELECT username FROM members WHERE username='$username'"))>0)
    {
        $userdup_error=1;
    }	
	// Kiểm tra email có bị trùng
    if ( mysql_num_rows(mysql_query("SELECT email FROM members WHERE email='$email'"))>0)
    {
		$mail2_error=1;
    }	
    // Kiểm tra email nay co hop le ko
    if (!check_email($email))
    {
		$mail_error=1;
    }
	// Kiểm tra ngày sinh
    if (!ereg("^[0-9]+/[0-9]+/[0-9]{2,4}",$_POST['birthday']))
    {
		$birth_error=1;
    }	
	}
	if (($miss_error==1) || ($userdup_error==1) || ($mail_error==1) || ($birth_error==1) || ($pass_error==1) || ($symbol==1) || ($length==1) || ($captcha==1) || ($length2==1)){
	$error_warn=1;
	if ($captcha =="1")  {
				$error_warn_in = $error_warn_in."<strong>{$lang_error}:</strong>{$lang_wrong_captcha}<br/>";
	}
	if ($length2 =="1")  {
				$error_warn_in = $error_warn_in."<strong>{$lang_error}:</strong>{$lang_wrong_length2}<br/>";
	}
	if ($length =="1")  {
				$error_warn_in = $error_warn_in."<strong>{$lang_error}:</strong>{$lang_wrong_length}<br/>";
	}
	if ($symbol =="1")  {
				$error_warn_in = $error_warn_in."<strong>{$lang_error}:</strong>{$lang_wrong_symbol}<br/>";
	}
	if ($miss_error =="1")  {
				$error_warn_in = $error_warn_in."<strong>{$lang_error}:</strong>{$lang_blank_error}<br/>";
	}
	if ($userdup_error =="1")  {
				$error_warn_in = $error_warn_in."<strong>{$lang_error}:</strong>{$lang_duplicate}<br/>";
	}
	if ($mail2_error =="1")  {
				$error_warn_in = $error_warn_in."<strong>{$lang_error}:</strong>{$lang_duplicate_email}<br/>";
	}
	if ($mail_error =="1")  {
				$error_warn_in = $error_warn_in."<strong>{$lang_error}:</strong>{$lang_invalid_email}<br/>";
	}
	if ($birth_error =="1")  {
				$error_warn_in = $error_warn_in."<strong>{$lang_error}:</strong>{$lang_invalid_birthday}<br/>";
	}	
	if ($pass_error =="1")  {
				$error_warn_in = $error_warn_in."<strong>{$lang_error}:</strong>{$lang_password_do_not_match}<br/>";
	}	
	include_once('templates/header.php');
	include('templates/register_do.php');
	include_once('templates/footer.php');
	}
	else {
	$a=mysql_query("INSERT INTO `{$db_name}`.`members` (`username`, `password`, `email`, `realname`, `country`, `birthday`, `timezone`, `sex`) VALUES ('{$username}', '{$password}', '{$email}', '{$realname}', '{$country}', '{$birthday}', '{$timezone}', '{$sex}')");
    if ($a) {
	$sql_query = @mysql_query("SELECT id WHERE username='{$username}'");
    $member = @mysql_fetch_array( $sql_query );
	$_SESSION['user_id'] = $member['id'];
	$redirect_info = $lang_successful_register;
	$custom_previous = "login";
	require_once('templates/redirect.php');
	}
	else {
	$custom_previous = "register?act=do";
	$redirect_info = $lang_fail_register;
	require_once('templates/redirect.php');
	}
	}
	
}
}
else {
include_once('templates/header.php');
include_once('templates/register.php');
include_once('templates/footer.php');
}
}
else {
$redirect_info = $lang_already_login;
require_once('templates/redirect.php');
}




?>
