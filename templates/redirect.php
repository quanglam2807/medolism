<?php
session_start();
require_once('includes/config.php');
if (!$custom_previous) {
if (!$_SESSION['previous']) {
$previous_page = $page_url.'/';
}
else {
$previous_page = $_SESSION['previous'];
}
}
else {
$previous_page = $custom_previous;
}
require_once('language/'.$usinglang.'/lang_redirect.php');
echo "<html>																																															";
echo "	<head>                                                                                                                                                                                          ";
echo "		<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\" />";
echo "		<meta HTTP-EQUIV=\"REFRESH\" content=\"1000000000000000000; url={$previous_page}\">";
echo "		<link rel=\"stylesheet\" type=\"text/css\" href=\"templates/bootstrap.min2.0.2.css\" />   ";
echo "		<title>Medolism - {$lang_page_title}</title>                                                                                                                      ";
echo "	</head>                                                                                                                                                                                         ";
echo " 	<body>";
echo "<div class='modal-backdrop'></div>";
echo "
          <div id='redirect_info' class='modal'>
            <div class='modal-header'>
              <h3>Redirect...</h3>
            </div>
            <div class='modal-body'>
              <p>{$redirect_info}</p>    
			  <p>{$lang_redirect_in}</p>			  
            </div>
            <div class='modal-footer'>
              <a href='{$previous_page}' class='btn'>{$lang_click_here_if_not_redirect}</a>
            </div>
          </div>
";
echo "	</body>";
echo "</html>";
?>