<?php
require_once('includes/config.php');
$colummn=1;
$authorname = $_GET['name'];
$lang_page_title="Truyện của tác giả ".$authorname;
require_once('includes/detectlang.php');
require_once('includes/getdata.php');
include_once('templates/header.php');
$sql = "SELECT id,name,tenkhac,status FROM `manga` WHERE `tacgia`='{$authorname}'"; 
$a = @mysqli_query($sql);
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
<?php
$c=0;
while ($b = @mysqli_fetch_array( $a )) {
$c++;
$sql_max = @mysqli_query($con, "SELECT chap FROM chapter WHERE id=(SELECT MAX(id) FROM chapter WHERE manga_id='{$b['id']}')");
$max = @mysqli_fetch_array( $sql_max );
$sql_count = @mysqli_query($con, "SELECT COUNT(*) FROM chapter WHERE manga_id='{$b['id']}'");
$count = @mysqli_fetch_array( $sql_count );
?>
<tr>
            <td><?php echo $c; ?></td>
            <td><a href="viewmanga?id=<?php echo $b['id']; ?>">
			<?php echo $b['name']; ?>
			<?php
				if ($b['tenkhac']) {
				echo " - ".$b['tenkhac']; 
				}
			?>
			</a></td>
            <td>
<?php
if ($b['status']==1) {
?>
			<font class="mangastatus mangastatus-primary">Updating: Chapter <?php echo $max['0']; ?></font>
<?php
}
?>	
<?php
if ($b['status']==2) {
?>
			<font class="mangastatus mangastatus-success">Complete: <?php echo $count['0']; ?> chapters</font>
<?php
}
?>	
<?php
if ($b['status']==3) {
?>
			<font class="mangastatus mangastatus-info">One Shot</font>
<?php
}
?>
<?php
if ($b['status']==4) {
?>
			<font class="mangastatus mangastatus-inverse">Drop: <?php echo $count['0']; ?> chapters</font>
<?php
}
?>
			</td>
          </tr>
<?php
}
?>
</table>
</div>
<?php
include_once('templates/sidebar_nonlist.php');
include_once('templates/footer.php');
?>