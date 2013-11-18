<?php
if (!$_SESSION['language']) {
$usinglang = 'vi-vn'; 
}
else {
$usinglang = $_SESSION['language'];
}
require_once('language/'.$usinglang.'/lang_common.php');
?>