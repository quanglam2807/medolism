<div class="span4">   
	<div style="padding: 8px 0; background-color: #FFF !important" class="well">
        <ul class="nav nav-list">
          <li class="nav-header">DANH MỤC</li>
          <li class="<?php if ($id==0) { ?>active<?php } ?>"><a href="list">Tất cả</a></li>
<?php
$sql_cats = @mysqli_query($con, "SELECT * FROM cats");
while ($cats = @mysqli_fetch_array( $sql_cats )) {
?>
          <li><a href="list?id=<?php echo $cats['id']; ?>"><?php echo $cats['name']; ?></a></li>
<?php
}
?>
        </ul>
      </div>
	</div>