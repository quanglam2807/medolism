<?php

/**
 *      Medolism
 */

$lang = array (
	"page_title" => "Register",
	// Error
	"wrong_captcha" => " The reCAPTCHA wasn't entered correctly.",
	"wrong_length2" => " Password must be longer than 8 characters.",
	"wrong_length" => " Username must be longer than 8 characters and shorter than 36 characters.",
	"wrong_symbol" => " You can only use letters, number and periods for username.",
	"blank_error" => " Please fill out all of required fields.",
	"duplicate" => " Your username has been taken by another user.",
	"duplicate_email" => " Your email has been taken by another user.",
	"invalid_email" => " Your email is invalid.",
	"invalid_birthday" => " Invalid date format.",
	"password_do_not_match" => " Passwords do not match.",
	// Redirect
	"successful_register" => "You have successfully registered an account at Medolism.",
	"fail_register" => "Sorry! Registration failed. Please try again...",
	"already_login" => "Access denied",
	// UI
	"username" => "Username",
	"user_help1" => "You can only use letters, number and periods for username.",
	"user_help2" => "Username must be longer than 8 characters and shorter than 36 characters.",
	"password" => "Choose a password",
	"re_password" => "Re-enter password",
	"pass_help" => "Password must be longer than 8 characters.",
	"email_help1" => "<b>Medolism</b> recommend using a <a href='http://gmail.com'>Gmail</a> account.",
	"email_help2" => "Please enter a valid e-mail address. All e-mails from the system will be sent to this address. The e-mail address is not made public and will only be used if you wish to receive a new password or wish to receive certain news or notifications by e-mail.",
	"email" => "Email",
	"full_name" => "Your full name",
	"location" => "Country",
	"sex" => "Gender",
	"birthday" => "Birthday",
	"captcha_help" => "This question is for testing whether you are a human visitor and to prevent automated spam submissions.",
	"captcha" => "Image Verification by reCAPTCHA",
	"timezone" => "Timezone",
	"create_account" => "Create my account",
	"cancel" => "Reset fields",
	// Gender
	"male" => "Male",
	"female" => "Female",
	"othersex" => "Other",
);
extract($lang, EXTR_PREFIX_ALL, "lang");

?>