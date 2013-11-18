<?php	
echo "
<form class=\"form-horizontal\" action=\"resetpass?act=do\" method=\"post\">
<div class=\"control-group\">  
	<label>{$lang_email}:</label>	
	<div class=\"controls docs-input-sizes\">	
";
if ( $_GET['act'] == "do" ) {
echo "<input type=\"text\" name=\"email\" value=\"{$email}\">";
}
else {
echo "<input type=\"text\" name=\"email\">";
}
echo "
	<p class=\"help-block\">{$lang_resetpass_help}</p>
	</div>
</div>
";
echo "<div class=\"control-group\">  ";
echo "	<label>{$lang_captcha}:</label>";
echo "	<div class=\"controls docs-input-sizes\">";
echo "	<div style=\"width:400px;\"> ";
echo " <script type=\"text/javascript\">
 var RecaptchaOptions = {
    theme : 'clean'
 };
 </script>
";
echo recaptcha_get_html($publickey);
echo "	</div>";
echo "		<p class=\"help-block\">{$lang_captcha_help}</p>         ";
echo "	</div>";
echo "</div>";
echo "
<div class=\"form-actions\">
<input type=\"submit\" name=\"submit\" class=\"btn btn-primary\" value=\"{$lang_request_pass}\">
</div>
</form>
</div>
";
?>

