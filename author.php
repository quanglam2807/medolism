<?
require_once('includes/config.php');
$colummn=1;
$authorname = $_GET['name'];
$lang_page_title="Truyện của tác giả ".$authorname;
require_once('includes/detectlang.php');
require_once('includes/getdata.php');
include_once('templates/header.php');
$sql = "SELECT id,name,tenkhac,status FROM `manga` WHERE `tacgia`='{$authorname}'"; 
$a = @mysql_query($sql);
?>
<div class="spanspecial introduce" style="width:660px;">
<table class="table table-striped">
<thead>
          <tr>
            <th>#</th>
            <th>Tên truyện</th>
            <th>Tình trạng</th>
          </tr>
</thead>
<?
$c=0;
while ($b = @mysql_fetch_array( $a )) {
$c++;
$sql_max = @mysql_query("SELECT chap FROM chapter WHERE id=(SELECT MAX(id) FROM chapter WHERE manga_id='{$b['id']}')");
$max = @mysql_fetch_array( $sql_max );
$sql_count = @mysql_query("SELECT COUNT(*) FROM chapter WHERE manga_id='{$b['id']}'");
$count = @mysql_fetch_array( $sql_count );
?>
<tr>
            <td><? echo $c; ?></td>
            <td><a href="viewmanga?id=<? echo $b['id']; ?>">
			<? echo $b['name']; ?>
			<?
				if ($b['tenkhac']) {
				echo " - ".$b['tenkhac']; 
				}
			?>
			</a></td>
            <td>
<?
if ($b['status']==1) {
?>
			<font class="mangastatus mangastatus-primary">Updating: Chapter <? echo $max['0']; ?></font>
<?
}
?>	
<?
if ($b['status']==2) {
?>
			<font class="mangastatus mangastatus-success">Complete: <? echo $count['0']; ?> chapters</font>
<?
}
?>	
<?
if ($b['status']==3) {
?>
			<font class="mangastatus mangastatus-info">One Shot</font>
<?
}
?>
<?
if ($b['status']==4) {
?>
			<font class="mangastatus mangastatus-inverse">Drop: <? echo $count['0']; ?> chapters</font>
<?
}
?>
			</td>
          </tr>
<?
}
?>
</table>
</div>
<?
include_once('templates/sidebar_nonlist.php');
include_once('templates/footer.php');
?>