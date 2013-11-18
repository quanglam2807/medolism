<?
require_once('../includes/config.php');
$id = $_GET['id'];
$sql_viewmanga = @mysql_query("SELECT chuxi,congtac FROM manga WHERE id='{$id}'");
$manga = @mysql_fetch_array( $sql_viewmanga );
			$chuxi = $manga['chuxi'];
			$congtac = $manga['congtac'];
$lang_page_title="";			
$no_per = 0;
$idCheck = explode(",",$congtac);
for($i=0;$i<count($idCheck);$i++){
		$idlan=$idCheck[$i];
		if (( $_SESSION['user_id'] == $chuxi  ) || ( $user['username'] == $idlan ) || ( $user['level'] == 10)) {
    		$no_per = 1;
		}
		else {
			$no_per = 0;
		}
}
?>
<p style="padding-left: 20px;"><b>Sắp xếp:</b> 
<?
if ($_GET['act']==1) {
?>
<font style="color: #DA4F49; font-weight: bold;">LỚN NHẤT TRƯỚC</font>
<?
}
else {
?>
<a onclick="orderby(1,<? echo $id; ?>)">LỚN NHẤT TRƯỚC</a> 
<?
}
?>
 || 
<?
if ($_GET['act']==2) {
?>
<font style="color: #DA4F49; font-weight: bold;">NHỎ NHẤT TRƯỚC</font>
<?
}
else {
?>
<a onclick="orderby(2,<? echo $id; ?>)">NHỎ NHẤT TRƯỚC</a>
<?
}
?> 
|| 
<?
if ($_GET['act']==3) {
?>
<font style="color: #DA4F49; font-weight: bold;">MỚI CẬP NHẬT</font>
<?
}
else {
?>
<a onclick="orderby(3,<? echo $id; ?>)">MỚI CẬP NHẬT</a></p>
<?
}
?> 
<table class="table table-striped" style="margin-bottom:0 !important; width: 640px;">
        <thead>
          <tr>
            <th style="width: 100px;">Chapter</th>
            <th style="width: 300px;">Thông tin</th>
            <th style="width: 120px;">Ngày đăng</th>
<? if ($no_per == 1) { ?>
            <th style="width: 70px;">Download</th>
			<th style="width: 50px;">...</th>
<? } else { ?>
            <th style="width: 120px;">Download</th>
<? } ?>
          </tr>	  
        </thead>
</table>
<div class="insidechap">
<table class="table table-striped" style="margin-bottom:0 !important; width:640px;">
<?
if ($_GET['act']==1) {
$sql_chapter = @mysql_query("SELECT * FROM chapter WHERE `manga_id`='{$id}' ORDER BY chap DESC");
}
if ($_GET['act']==2) {
$sql_chapter = @mysql_query("SELECT * FROM chapter WHERE `manga_id`='{$id}' ORDER BY chap");
}
if ($_GET['act']==3) {
$sql_chapter = @mysql_query("SELECT * FROM chapter WHERE `manga_id`='{$id}' ORDER BY id DESC");
}
while ($chapter = @mysql_fetch_array( $sql_chapter )) {
$sochu = strlen($chapter['bosung']);
if ($sochu>45) {
$chuthich = substr($chapter['bosung'],0,30)."...";
}
else {
$chuthich = $chapter['bosung'];
}
?>	
          <tr>
            <td style="width: 100px;"><a href="viewchapter?manga_id=<? echo $id; ?>&chap=<? echo $chapter['chap']; ?>">Chapter <? echo $chapter['chap']; ?></a></td>
            <td style="width: 300px;"><? echo $chuthich ?></td>
            <td style="width: 120px;"><? echo $chapter['ngaydang']; ?></td>
<? if ($no_per == 1) { ?>				
            <td style="width: 70px;">		
<? } else { ?>
            <td style="width: 120px;">
<? } ?>
<?
if (!$chapter['download']) {
echo "Không có";
}
else {
?>
<a href="<? echo $chapter['download']; ?>">Download</a>
<?
}
 ?>			
		</td>
<? if ($no_per == 1) { ?>		
		<td>
		<a href="editchapter?id=<? echo $chapter['id']; ?>" class="btn btn-primary btn-small">SỬA</a>
		</td>
<? } ?>
          </tr>
<?
}
?>
        </tbody>
      </table>