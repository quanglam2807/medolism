<?php

/**
 *      Medolism
 */

$lang = array(
	"page_title" => "Quên mật khẩu hay tên đăng nhập?",
	"wrong_captcha" => " Ảnh xác nhận bạn nhập không đúng.",
	"wrong_email" => " Email bạn nhập không có trong dữ liệu.",
	"blank_email" => " Bạn cần điền đầy đủ các thông tin.",
	"invalid_email" => " Email bạn nhập không hợp lệ.",
	"email" => "Email của bạn",
	"resetpass_help" => "Nếu bạn quên tên tài khoản và mật khẩu, bạn có thể yêu cầu gửi tên tài khoản và mật khẩu tới email của bạn.",
	"captcha" => "Ảnh xác nhận",
	"captcha_help" => "Mã xác nhận giúp hệ thống kiểm tra bạn có phải là người hay không và ngăn chặn các hệ thống tự động spam",
	"fail_resetpass" => "Sorry! Requesting password/username failed. Please try again",
	"success_resetpass" => "Tên đăng nhập và mật khẩu đã được gửi đến email của bạn...",
	"request_pass" => "Yêu cầu tên đăng nhập/mật khẩu",
	// Mail
	"resetpass_subject" => "Mật khẩu mới tại {$site_name}",
	"resetpass_subject" => "
	{$member['username']} thân mến,
	Như bạn yêu cầu, Medolism đã tạo mật khẩu mới cho bạn. Thông tin tài khoản của bạn:
	Username: {$member['username']}
	Password: {$$emailpassword}
	Để thay đổi mật khẩu, bạn vui lòng truy cập: {$page_url}/profile?do=editpassword
	Chúc bạn vui vẻ, 
	{$site_name}
	",
);
extract($lang, EXTR_PREFIX_ALL, "lang");

?>