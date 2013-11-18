<?php

/**
 *      Medolism
 */

$lang = array (
	"page_title" => "Đăng ký",
	// Error
	"wrong_captcha" => " Mã xác nhận bạn nhập không đúng.",
	"wrong_length2" => " Mật khẩu phải có ít nhất 8 ký tự.",
	"wrong_length" => " Tên đăng nhập phải có từ 8-36 ký tự.",
	"wrong_symbol" => " Bạn chỉ được phép sử dụng mẫu tự alphabet, số và dấu chấm trong tên đăng nhập.",
	"blank_error" => " Bạn cần phải điền đầy đủ các thông tin.",
	"duplicate" => " Tên đăng nhập bạn chọn đã có người khác sử dụng.",
	"duplicate_email" => " Email bạn chọn đã có người khác sử dụng.",
	"invalid_email" => " Email bạn nhập không hợp lệ.",
	"invalid_birthday" => " Ngày sinh bạn nhập không hợp lệ.",
	"password_do_not_match" => " Mật khẩu bạn chọn và mật khẩu xác nhận không trùng khớp với nhau.",
	// Redirect
	"successful_register" => "Xin chúc mừng! Bạn đã đăng ký thành công.",
	"already_login" => "Access denied",
	"fail_register" => "Rất tiếc! Đăng ký thất bại. Xin vui lòng thử lại...",
	// UI
	"username" => "Tên đăng nhập",
	"user_help1" => "Bạn có thể sử dụng các mẫu tự alphabet, chữ số và dấu chấm.",
	"user_help2" => "Tên đăng nhập phải có từ 8-36 ký tự",
	"password" => "Chọn mật khẩu",
	"re_password" => "Xác nhận mật khẩu",
	"pass_help" => "Mật khẩu phải từ 8 ký tự trở lên",
	"email_help1" => "Bạn nên sử dụng tài khoản <a href='http://gmail.com'>Gmail</a>.",
	"email_help2" => "Xin nhập địa chỉ email hợp lệ của bạn. Mọi thông tin từ hệ thống của Medolism sẽ được gửi đến địa chỉ này. Email của bạn sẽ được giữ bí mật và chỉ được dùng để nhận thông tin hay mật khẩu mới từ Medolism",
	"email" => "Email (Thư điện tử)",
	"full_name" => "Tên hiển thị",
	"location" => "Quốc gia",
	"birthday" => "Ngày sinh",
	"sex" => "Giới tính",
	"captcha_help" => "Mã xác nhận giúp hệ thống kiểm tra bạn có phải là người hay không và ngăn chặn các hệ thống tự động spam.",
	"captcha" => "Mã xác nhận",
	"timezone" => "Múi giờ",
	"create_account" => "Tạo tài khoản",
	"cancel" => "Làm lại",
	//Gender
	"male" => "Nam",
	"female" => "Nữ",
	"othersex" => "Khác",
);
extract($lang, EXTR_PREFIX_ALL, "lang");

?>