<?php

/**
 *      Medolism
 */

$lang = array(
	"alert" => "CẢNH BÁO",
	"page_title" => "Đăng nhập",
	"username" => "Tên đăng nhập",
	"password" => "Mật khẩu",
	"lost_pass" => "Quên mật khẩu hay tên đăng nhập?",
	"remember" => "Ghi nhớ",
	"invalid_user_pass" => "Bạn cần phải nhập tên đăng nhập và mật khẩu đầy đủ.",
	"wrong_user_pass" => "Tên đăng nhập hoặc mật khẩu không đúng.",		
	"welcome_back" => "Xin chào {$username}! Bạn đã đăng nhập thành công.",
	"fail_login" => "Rất tiếc! Đăng nhập thất bại. Xin vui lòng thử lại...",
	"alert_5_times" => "Bạn đã sử dụng {$_SESSION['5_times']} của 5 lần đăng nhập. Sau 5 lần đăng nhập sai, tài khoản của bạn sẽ bị \"treo\" 15 phút.",
	"5_times" => "Bạn đã sai mật khẩu quá 5 lần! Bạn cần phải đợi 15 phút để tiếp tục đăng nhập.",
);
extract($lang, EXTR_PREFIX_ALL, "lang");

?>