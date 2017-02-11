<?php
require_once('../includes/config.php');
$id = $_GET['id'];
$sql_viewmanga = @mysqli_query($con, "SELECT chuxi,congtac FROM manga WHERE id='{$id}'");
$manga = @mysqli_fetch_array( $sql_viewmanga );
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
<?php
if ($_GET['act']==1) {
?>
<font style="color: #DA4F49; font-weight: bold;">LỚN NHẤT TRƯỚC</font>
<?php
}
else {
?>
<a onclick="orderby(1,<?php echo $id; ?>)">LỚN NHẤT TRƯỚC</a> 
<?php
}
?>
 || 
<?php
if ($_GET['act']==2) {
?>
<font style="color: #DA4F49; font-weight: bold;">NHỎ NHẤT TRƯỚC</font>
<?php
}
else {
?>
<a onclick="orderby(2,<?php echo $id; ?>)">NHỎ NHẤT TRƯỚC</a>
<?php
}
?> 
|| 
<?php
if ($_GET['act']==3) {
?>
<font style="color: #DA4F49; font-weight: bold;">MỚI CẬP NHẬT</font>
<?php
}
else {
?>
<a onclick="orderby(3,<?php echo $id; ?>)">MỚI CẬP NHẬT</a></p>
<?php
}
?> 
<table class="table table-striped" style="margin-bottom:0 !important; width: 640px;">
        <thead>
          <tr>
            <th style="width: 100px;">Chapter</th>
            <th style="width: 300px;">Thông tin</th>
            <th style="width: 120px;">Ngày đăng</th>
<?php if ($no_per == 1) { ?>
            <th style="width: 70px;">Download</th>
			<th style="width: 50px;">...</th>
<?php } else { ?>
            <th style="width: 120px;">Download</th>
<?php } ?>
          </tr>	  
        </thead>
</table>
<div class="insidechap">
<table class="table table-striped" style="margin-bottom:0 !important; width:640px;">
<?php
if ($_GET['act']==1) {
$sql_chapter = @mysqli_query($con, "SELECT * FROM chapter WHERE `manga_id`='{$id}' ORDER BY chap DESC");
}
if ($_GET['act']==2) {
$sql_chapter = @mysqli_query($con, "SELECT * FROM chapter WHERE `manga_id`='{$id}' ORDER BY chap");
}
if ($_GET['act']==3) {
$sql_chapter = @mysqli_query($con, "SELECT * FROM chapter WHERE `manga_id`='{$id}' ORDER BY id DESC");
}
while ($chapter = @mysqli_fetch_array( $sql_chapter )) {
$sochu = strlen($chapter['bosung']);
if ($sochu>45) {
$chuthich = substr($chapter['bosung'],0,30)."...";
}
else {
$chuthich = $chapter['bosung'];
}
?>	
          <tr>
            <td style="width: 100px;"><a href="viewchapter?manga_id=<?php echo $id; ?>&chap=<?php echo $chapter['chap']; ?>">Chapter <?php echo $chapter['chap']; ?></a></td>
            <td style="width: 300px;"><?php echo $chuthich ?></td>
            <td style="width: 120px;"><?php echo $chapter['ngaydang']; ?></td>
<?php if ($no_per == 1) { ?>				
            <td style="width: 70px;">		
<?php } else { ?>
            <td style="width: 120px;">
<?php } ?>
<?php
if (!$chapter['download']) {
echo "Không có";
}
else {
?>
<a href="<?php echo $chapter['download']; ?>">Download</a>
<?php
}
 ?>			
		</td>
<?php if ($no_per == 1) { ?>		
		<td>
		<a href="editchapter?id=<?php echo $chapter['id']; ?>" class="btn btn-primary btn-small">SỬA</a>
		</td>
<?php } ?>
          </tr>
<?php
}
?>
        </tbody>
      </table>