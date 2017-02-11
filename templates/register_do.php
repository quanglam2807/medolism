<?php
echo "<form class=\"form-horizontal\" action=\"register?act=do\" method=\"post\">                                                                             ";
echo "<div class=\"control-group\">                                                                                                        ";
echo "	<label>{$lang_username}:</label>                                                                                                  ";
echo "	<div class=\"controls docs-input-sizes\">                                                                                                         ";
echo "		<input type=\"text\" name=\"username\" value=\"{$username}\" maxlength=\"36\">                                                                                 ";
echo "		<p class=\"help-block\">{$lang_user_help1}</p>                                                            ";
echo "		<p class=\"help-block\">{$lang_user_help2}</p>                                                            ";
echo "	</div>                                                                                                                      ";
echo "</div>                                                                                                                        ";
echo "<div class=\"control-group\">                                                                                                        ";
echo "	<label>{$lang_password}:</label>                                                                                           ";
echo "	<div class=\"controls docs-input-sizes\">                                                                                                         ";
echo "		<input type=\"password\" name=\"password\" value=\"\">                                                                             ";
echo "		<p class=\"help-block\">{$lang_pass_help}</p>                                                            ";
echo "	</div>                                                                                                                      ";
echo "</div>                                                                                                                        ";
echo "<div class=\"control-group\">                                                                                                        ";
echo "	<label>{$lang_re_password}:</label>                                                                                           ";
echo "	<div class=\"controls docs-input-sizes\">                                                                                                         ";
echo "		<input type=\"password\" name=\"verify_password\" value=\"\">                                                                      ";
echo "	</div>                                                                                                                      ";
echo "</div>                                                                                                                        ";
echo "<div class=\"control-group\">                                                                                                        ";
echo "	<label>{$lang_email}:</label>                                                                                                       ";
echo "	<div class=\"controls docs-input-sizes\">                                                                                                         ";
echo "		<input type=\"text\" name=\"email\" value=\"{$email}\">                                                                                    ";
echo "		<p class=\"help-block\">{$lang_email_help1}</p>         ";
echo "		<p class=\"help-block\">{$lang_email_help2}</p>         ";
echo "	</div>                                                                                                                      ";
echo "</div>                                                                                                                        ";
echo "<div class=\"control-group\">                                                                                                        ";
echo "	<label>{$lang_full_name}:</label>                                                                                              ";
echo "	<div class=\"controls docs-input-sizes\">                                                                                                         ";
echo "		<input type=\"text\" name=\"realname\" value=\"{$realname}\">                                                                                 ";
echo "	</div>                                                                                                                      ";
echo "</div>                                                                                                                        ";
echo "<div class=\"control-group\">                                                                                                        ";
echo "	<label>{$lang_sex}:</label>                                                                                              ";
echo "	<div class=\"controls docs-input-sizes\">                                                                                                         ";
?>
<div class="btn-group" data-toggle-name="sex" data-toggle="buttons-radio" >
<button type="button" value="1" class="btn btn-small<?php if ($sex==1) { echo ' btn-primary active'; } ?>" data-toggle="button"><?php echo $lang_male; ?></button>
<button type="button" value="2" class="btn btn-small<?php if ($sex==2) { echo ' btn-primary active'; } ?>" data-toggle="button"><?php echo $lang_female; ?></button>
<button type="button" value="0" class="btn btn-small<?php if ($sex==0) { echo ' btn-primary active'; } ?>" data-toggle="button"><?php echo $lang_othersex; ?></button>
</div>
<input type="hidden" name="sex" value="<?php echo $sex; ?>" />
<?php
echo "	</div>";
echo "</div>";                                                                                                                      
echo "<div class=\"control-group\">                                                                                                        ";
echo "	<label>{$lang_location}:</label>                                                                                                    ";
echo "	<div class=\"controls docs-input-sizes\">                                                                                                         ";
echo "		<select name=\"country\">                                                                                                       ";
$sql_country = @mysqli_query($con, "SELECT printable_name FROM country");
while ($ct = @mysqli_fetch_array( $sql_country )) {
if ($country == $ct['printable_name']) {
echo "<option value=\"{$ct['printable_name']}\" selected=\"selected\">{$ct['printable_name']}</option>                                                                          ";
}
else {
echo "<option value=\"{$ct['printable_name']}\">{$ct['printable_name']}</option>                                                                          ";
}
}
echo "		</select>                                                                                                                     ";
echo "	</div>                                                                                                                      ";
echo "</div>                                                                                                                        ";
echo "<div class=\"control-group\">  
	<label>{$lang_timezone}:</label>
	<div class=\"controls docs-input-sizes\">
		<select name=\"timezone\">
";
$sql_timezone = @mysqli_query($con, "SELECT * FROM timezone");
while ($tz = @mysqli_fetch_array( $sql_timezone )) {
if ($timezone == $tz['id']) {
echo "<option value=\"{$tz['id']}\" selected=\"selected\">{$tz['name']}</option>                                                                          ";
}
else {
echo "<option value=\"{$tz['id']}\">{$tz['name']}</option>                                                                          ";
}
}
echo"
		</select>
		</div>
	</div>
";
echo "<div class=\"control-group\">                                                                                                        ";
echo "	<label>{$lang_birthday}:</label>                                                                                                    ";
echo "	<div class=\"controls docs-input-sizes\">                                                                                                         ";
echo "		<input type=\"text\" class=\"datepicker\" name=\"birthday\" value=\"{$birthday}\">                                                                                 ";
echo "		<p class=\"help-block\">DD/MM/YY (e.g. '31/12/2011')</p>                                                            ";
echo "	</div>                                                                                                                      ";
echo "</div>                                                                                                                        ";
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
echo "<div class=\"form-actions\">                                                                                                         ";
echo "<input type=\"submit\" name=\"submit\" class=\"btn btn-primary\" value=\"{$lang_create_account}\">                                             ";
echo "<button type=\"reset\" class=\"btn\">{$lang_cancel}</button>                                                                              ";
echo "</div>                                                                                                                        ";
echo "</form>                                                                                                                       ";
echo "</div>                                                                                                                        ";
echo "                                                                                                                              ";
?>