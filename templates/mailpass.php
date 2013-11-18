<?																					
echo "<ul class=\"nav nav-tabs\" data-tabs=\"tabs\">";
echo"<li class=\"firsttabs\"><a href=\"profile\">{$lang_profile}</a></li>";
echo"<li class=\"active\"><a href=\"#\">{$lang_emailandpass}</a></li>";
echo"<li class=\"\"><a href=\"avatar\">{$lang_avatar}</a></li>";
echo"</ul>";
echo "<div class=\"pill-content\">";
echo "<div class=\"active\">																						";
echo "	<form class=\"form-horizontal\"action=\"mailpass?act=update\" method=\"post\">                                            ";
echo "		<div class=\"control-group\">                                                                              ";
echo "			<label>{$lang_usepass}:</label>                                                                  ";
echo "			<div class=\"controls docs-input-sizes\">                                                                             ";
echo "				<input type=\"password\" name='usepass' value=''>                                                 ";
echo "				<p class=\"help-block\">{$lang_usepass_help}</p>                                        ";
echo "			</div>	                                                                                        ";
echo "		</div>                                                                                              ";
echo "
<div class=\"page-header\">
<h2 style=\"padding-left: 10px;\"> {$lang_newpass}</h2> 
</div>                                                                                        ";
echo "		<div class=\"control-group\">                                                                              ";
echo "			<label>{$lang_type_newpass}:</label>                                                                  ";
echo "			<div class=\"controls docs-input-sizes\">                                                                             ";
echo "				<input type=\"password\" name=\"newpass\" value=\"\">                                                 ";
?>
<p class="help-block">Mật khẩu phải từ 8 ký tự trở lên</p>
<?
echo "			</div>	                                                                                        ";
echo "		</div>                                                                                              ";
echo "		<div class=\"control-group\">                                                                              ";
echo "			<label>{$lang_retype_newpass}:</label>                                                                  ";
echo "			<div class=\"controls docs-input-sizes\">                                                                             ";
echo "				<input type=\"password\" name=\"retype_newpass\" value=\"\">                                                 ";
echo "			</div>	                                                                                        ";
echo "		</div>                                                                                              ";
echo "
<div class=\"page-header\">
<h2 style=\"padding-left: 10px;\"> {$lang_newemail}</h2> 
</div>                                                                                        ";
echo "		<div class=\"control-group\">                                                                              ";
echo "			<label>{$lang_type_newemail}:</label>                                                                  ";
echo "			<div class=\"controls docs-input-sizes\">                                                                             ";
if ( $_GET['act'] == "update" ) {
echo "				<input type=\"text\" name=\"newemail\" value=\"{$newemail}\">";
}
else {
echo "				<input type=\"text\" name=\"newemail\" value=\"{$user['email']}\">                                                 ";
}
echo "			</div>	                                                                                        ";
echo "		</div>                                                                                              ";
echo "		<div class=\"control-group\">                                                                              ";
echo "			<label>{$lang_retype_email}:</label>                                                                  ";
echo "			<div class=\"controls docs-input-sizes\">                                                                             ";
if ( $_GET['act'] == "update" ) {
echo "				<input type=\"text\" name=\"retype_newemail\" value=\"{$renewemail}\">                                                 ";
}
else {
echo "				<input type=\"text\" name=\"retype_newemail\" value=\"{$user['email']}\">";
}
echo "			</div>	                                                                                        ";
echo "		</div>                                                                                              ";
echo "		<div class=\"form-actions\">                                                                               ";
echo "			<input type=\"submit\" name=\"submit\" class=\"btn btn-primary\" value=\"{$lang_updateprofile}\">           ";
echo "			<button type=\"reset\" class=\"btn\">{$lang_cancel}</button>                                        ";
echo "		</div>                                                                                              ";
echo "	</form>                                                                                                 ";
echo "</div>                                                                                                    ";
echo "</div>";
echo "</div>";
?>