<?php

/**
 *      Medolism
 */

$lang = array(
	"alert" => "ALERT",
	"page_title" => "Login",
	"username" => "Username",
	"password" => "Password",
	"lost_pass" => "Don't remember your password or username?",
	"remember" => "Remember",
	"invalid_user_pass" => " Please fill out username or password field.",
	"wrong_user_pass" => "Username or password is incorect.",		
	"welcome_back" => "{$username}, Welcome back to Medolism. You have successfully logged in at Medolism.",
	"fail_login" => "Sorry! Login failed. Please try again...",
	"alert_5_times" => "You have used {$_SESSION['5_times']} out of 5 login attempts. After all 5 have been used, you will be unable to login for 15 minutes.",
	"5_times" => "You have used up your failed login quota! Please wait 15 minutes before trying again.",
);
extract($lang, EXTR_PREFIX_ALL, "lang");

?>