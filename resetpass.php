<?php
session_start();
require_once('includes/detectlang.php');
require_once('language/'.$usinglang.'/lang_resetpass.php');
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
    $email = addslashes( $_POST['email'] );
	
	// SQL
	$sql_query = @mysqli_query($con, "SELECT * FROM members WHERE email='{$email}'");
	$member = @mysqli_fetch_array( $sql_query );
	
	// Check username
	if (!$resp->is_valid) {
    // What happens when the CAPTCHA was entered incorrectly
		$captcha=1;
	}
    // Kiểm tra email nay co hop le ko
    if (!check_email($email))
    {
		$mail_error=1;
    }
	
	else if ( @mysqli_num_rows( $sql_query ) <= 0 ) {
		$no_email=1;
	}				
	
	if (($mail_error==1) || ($no_email==1) || ($captcha==1)) {
	$error_warn=1;
				if ($captcha =="1")  {
						$error_warn_in = $error_warn_in."<strong>{$lang_error}:</strong>{$lang_wrong_captcha}<br/>";
				}
				if ($no_email =="1")  {
						$error_warn_in = $error_warn_in."<strong>{$lang_error}:</strong>{$lang_wrong_email}<br/>";
				}
				if ($mail_error =="1")  {
						$error_warn_in = $error_warn_in."<strong>{$lang_error}:</strong>{$lang_invalid_email}<br/>";
				}
	include_once('templates/header.php');			
	include_once('templates/resetpass.php');
	include_once('templates/footer.php');
	}
	else {
			//Generate a RANDOM MD5 Hash for a password
			$random_password=md5(uniqid(rand()));
			//Take the first 8 digits and use them as the password we intend to email the user
			$emailpassword=substr($random_password, 0, 10);
			//Encrypt $emailpassword in MD5 format for the database
			$newpassword = md5(md5($emailpassword));
			$a=mysqli_query("UPDATE `{$db_name}`.`members` SET `password` = '{$newpassword}' WHERE `email` = '{$email}' ");	
			if ($a) {
			$subject = "Mật khẩu mới tại Medolism"; 
			$message = "
	{$member['username']} thân mến,
	Như bạn yêu cầu, Medolism đã tạo mật khẩu mới cho bạn. Thông tin tài khoản của bạn:
	Username: {$member['username']}
	Password: {$emailpassword}
	Để thay đổi mật khẩu, bạn vui lòng truy cập: 
	{$page_url}/mailpass
	Chúc bạn vui vẻ, 
	{$site_name}
			";
			$from = "Medolism";
			if(mail($email, $subject, $message, $from)){
				$redirect_info = $lang_success_resetpass;
				include_once('templates/redirect.php');
			}
			else {
				$custom_previous = "resetpass?ac=do";
				$redirect_info = $lang_fail_resetpass."1";
				include_once('templates/redirect.php');
			}
			}
			else {
				$custom_previous = "resetpass?ac=do";
				$redirect_info = $lang_fail_resetpass."2";
				include_once('templates/redirect.php');
			}
	}
}
}	
else {
include_once('templates/header.php');
include_once('templates/resetpass.php');
include_once('templates/footer.php');
}
}
else {
$redirect_info = "Access denied";
require_once('templates/redirect.php');
}




?>
