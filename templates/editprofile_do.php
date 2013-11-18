<?
echo "<ul class=\"nav nav-tabs\" data-tabs=\"tabs\">";
echo"<li class=\"active firsttabs\"><a href=\"#profile\">{$lang_profile}</a></li>";
echo"<li><a href=\"mailpass\">{$lang_emailandpass}</a></li>";
echo"<li class=\"\"><a href=\"avatar\">{$lang_avatar}</a></li>";
echo"</ul>";
echo "<div class=\"pill-content\">";
echo "<div class=\"active\">";
echo "<form class=\"form-horizontal\" action=\"profile?act=updateprofile\" method=\"post\">                                                   ";
echo "
<div class=\"page-header\">
<h2 style=\"padding-left: 10px;\"> {$lang_required}</h2> 
</div>                                                                                        ";
echo "<div class=\"control-group\">                                                                                            ";            
echo "	<label>{$lang_full_name}:</label>                                                                                ";                  
echo "	<div class=\"controls docs-input-sizes\">                                                                                             ";            
echo "		<input type=\"text\" name=\"realname\" value=\"{$realname}\">                                                                         ";                                                                 
echo "	</div>                                                                                                          ";            
echo "</div>                                                                                                            ";            
echo "<div class=\"control-group\">                                                                                                        ";
echo "	<label>{$lang_sex}:</label>                                                                                              ";
echo "	<div class=\"controls docs-input-sizes\">                                                                                                  ";
?>
<div class="btn-group" data-toggle-name="sex" data-toggle="buttons-radio" >
<button type="button" value="1" class="btn btn-small<?php if ($sex==1) { echo ' btn-primary active'; } ?>" data-toggle="button"><? echo $lang_male; ?></button>
<button type="button" value="2" class="btn btn-small<?php if ($sex==2) { echo ' btn-primary active'; } ?>" data-toggle="button"><? echo $lang_female; ?></button>
<button type="button" value="0" class="btn btn-small<?php if ($sex==0) { echo ' btn-primary active'; } ?>" data-toggle="button"><? echo $lang_othersex; ?></button>
</div>
<input type="hidden" name="sex" value="<? echo $sex; ?>" />
<?php
echo "	</div>";
echo "</div>";  
echo "<div class=\"control-group\">                                                                                                        ";
echo "	<label>{$lang_location}:</label>                                                                                                    ";
echo "	<div class=\"controls docs-input-sizes\">                                                                                                         ";
echo "<select name=\"country\">                                                                                                     ";
$sql_country = @mysql_query("SELECT printable_name FROM country");
while ($ct = @mysql_fetch_array( $sql_country )) {
if ($country == $ct['printable_name']) {
echo "<option value=\"{$ct['printable_name']}\" selected=\"selected\">{$ct['printable_name']}</option>                                                                          ";
}
else {
echo "<option value=\"{$ct['printable_name']}\">{$ct['printable_name']}</option>                                                                          ";
}
}
echo "</select>                                                                                                                     ";
echo "	</div>                                                                                                                      ";
echo "</div>                                                 ";
echo "<div class=\"control-group\">                                                                                            ";            
echo "	<label>{$lang_birthday}:</label>                                                                                ";           
echo "	<div class=\"controls docs-input-sizes\">                                                                                             ";            
echo "		<input type=\"text\" class=\"datepicker\" name=\"birthday\" value=\"{$birthday}\">                                                                         ";
echo "		<p class=\"help-block\">DD/MM/YY (e.g. '31/12/2011')</p>";
echo "	</div>                                                                                                          ";            
echo "</div>                                                                                                            ";                                                                                
echo "<div class=\"control-group\">                                                                                            ";
echo "	<label>{$lang_timezone}:</label>                                                                                ";
echo "	<div class=\"controls docs-input-sizes\">                                                                                             ";
echo "<select name=\"timezone\">                                                                                          ";
$sql_timezone = @mysql_query("SELECT * FROM timezone");
while ($tz = @mysql_fetch_array( $sql_timezone )) {
if ($timezone == $tz['id']) {
echo "<option value=\"{$tz['id']}\" selected=\"selected\">{$tz['name']}</option>                                                                          ";
}
else {
echo "<option value=\"{$tz['id']}\">{$tz['name']}</option>                                                                          ";
}
}
echo "</select>                                                                                                         ";
echo "		</div>                                                                                                      ";
echo "</div>                                                                                                            ";                  
echo "
<div class=\"page-header\">
<h2 style=\"padding-left: 10px;\"> {$lang_additional}</h2>
</div>                                                                                        ";
echo "<div class=\"control-group\">                                                                                            ";            
echo "	<label>{$lang_homepage}:</label>                                                                                ";           
echo "	<div class=\"controls docs-input-sizes\">                                                                                             ";            
echo "		<input type=\"text\" name=\"homepage\" value=\"{$user['homepage']}\">                                                                         ";
echo "		<p class=\"help-block\">{$lang_homepage_help}</p>";
echo "	</div>                                                                                                          ";            
echo "</div>                                                                                                            ";                
echo "<div class=\"control-group\">                                                                                            ";            
echo "	<label>{$lang_hoppy}:</label>                                                                                ";           
echo "	<div class=\"controls docs-input-sizes\">                                                                                             ";            
echo "		<textarea class=\"xxlarge\" name=\"hoppy\" maxlength=\"255\">{$hoppy}</textarea>                                                                         ";
echo "		<p class=\"help-block charsRemaining\"></p>";
echo "	</div>                                                                                                          ";            
echo "</div>                                                                                                            ";                                                                                
echo "<div class=\"control-group\">                                                                                            ";            
echo "	<label>{$lang_occupation}:</label>                                                                                ";           
echo "	<div class=\"controls docs-input-sizes\">                                                                                             ";            
echo "		<input type=\"text\" name=\"occupation\" value=\"{$occupation}\">                                                                          ";
echo "	</div>                                                                                                          ";            
echo "<div class=\"control-group\">                                                                                            ";            
echo "</div>                                                                                                            ";                                              
echo "	<label>{$lang_more}</label>                                                                                ";           
echo "	<div class=\"controls docs-input-sizes\">                                                                                             ";            
echo "		<textarea class=\"xxlarge\" name=\"more\" maxlength=\"255\">{$more}</textarea>                                                                         ";
echo "		<p class=\"help-block charsRemaining\"></p>";
echo "	</div>                                                                                                          ";            
echo "</div>                                                                                                            ";                                                                                   
echo "<div class=\"form-actions\">                                                                                             ";            
echo "<input type=\"submit\" name=\"submit\" class=\"btn btn-primary\" value=\"{$lang_updateprofile}\">                             ";                
echo "<button type=\"reset\" class=\"btn\">{$lang_cancel}</button>                                                          ";                    
echo "</div>                                                                                                            ";            
echo "</form>                                                                                                           ";            
echo "</div>                                                                                                            ";            
echo "</div>";
?>