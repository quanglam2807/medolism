<?php

/**
 *      Medolism
 */

$lang = array(
	"page_title" => "Reset Password",
	"wrong_captcha" => " The reCAPTCHA wasn't entered correctly.",
	"wrong_email" => " The email you entered is incorect.",
	"blank_email" => " Please fill out all of required fields.",
	"invalid_email" => " The email you entered is invalid.",
	"email" => "Your email",
	"resetpass_help" => "If you have forgotten your username or password, you can request to have your username and password emailed to you.",
	"captcha" => "Image Verification by reCAPTCHA",
	"captcha_help" => "This question is for testing whether you are a human visitor and to prevent automated spam submissions.",
	"request_resetpass" => "Request Username / Password Now",
	"fail_resetpass" => "Sorry! Requesting password/username failed. Please try again",
	"success_resetpass" => "Your username and your password have been sent to you by email. You will now be returned to where you were.",
	"request_pass" => "Request Username/Password",
	// Mail
	"resetpass_subject" => "Your new password for {$site_name}",
	"resetpass_subject" => "
	Dear {$member['username']},
	As you requested, your password has now been reset. Your new details are as follows:
	Username: {$member['username']}
	Password: {$$emailpassword}
	To change your password, please visit this page: {$page_url}/profile?do=editpassword
	All the best, 
	{$site_name}
	",
);
extract($lang, EXTR_PREFIX_ALL, "lang");

?>