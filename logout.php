<?php
session_start();
require_once('includes/detectlang.php');
require_once('language/'.$usinglang.'/lang_logout.php');
if ( !$_SESSION['user_id'] ) {
$redirect_info = $lang_not_yet_login;
include_once('templates/redirect.php');
}
else {
unset($_SESSION['user_id']);
$_SESSION = array();
session_destroy();
if(isset($_COOKIE['user_id'])){
   setcookie("user_id", "", time()-60*60*24*100, "/");
}
if ( !$_SESSION['user_id'] ) {
$redirect_info = $lang_succesful_logout;
include_once('templates/redirect.php');
}
else {
$redirect_info = $lang_fail_logout;
include_once('templates/redirect.php');
}
}
?>
