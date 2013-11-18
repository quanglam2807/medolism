<?
echo "<form class=\"form-horizontal\"action=\"login?act=do\" method=\"post\">                                                        ";
echo "	<div class=\"control-group\">                                                                              ";
echo "		<label>{$lang_username}:</label>                                                                        ";
echo "		<div class=\"controls docs-input-sizes\">                                                                             ";
echo "			<input type=\"text\" name=\"username\" value=\"{$username}\">                                                ";
echo "		</div>                                                                                          ";
echo "	</div>                                                                                              ";
echo "	<div class=\"control-group\">                                                                              ";
echo "		<label>{$lang_password}:</label>                                                                        ";
echo "		<div class=\"controls docs-input-sizes\">                                                                             ";
echo "			<input type=\"password\" name=\"password\" value=\"\">                                            ";
echo "		</div>                                                                                          ";
echo "	</div>                                                                                              ";
echo "	<div class=\"control-group\">  ";
echo " 		<div class=\"remember\"><input type=\"checkbox\" name=\"remember\"> {$lang_remember}</div>";
echo "	</div>                                                                                          ";
echo "	<div class=\"form-actions\">                                                                               ";
echo "		<input type=\"submit\" name=\"submit\" class=\"btn btn-primary\" value=\"{$lang_login}\">                          ";
echo "<losepass><a href=\"resetpass\">{$lang_lost_pass}</a></losepass>";
echo "	</div>                                                                                              ";
echo "</form>                                                                                               ";
echo "</div>                                                                                                ";
echo "                                                                                                      ";
?>