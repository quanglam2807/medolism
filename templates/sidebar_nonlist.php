<div class="span4">   
	<div style="padding: 8px 0; background-color: #FFF !important" class="well">
        <ul class="nav nav-list">
          <li class="nav-header">DANH MỤC</li>
          <li class="<? if ($id==0) { ?>active<? } ?>"><a href="list">Tất cả</a></li>
<?
$sql_cats = @mysql_query("SELECT * FROM cats");
while ($cats = @mysql_fetch_array( $sql_cats )) {
?>
          <li><a href="list?id=<? echo $cats['id']; ?>"><? echo $cats['name']; ?></a></li>
<?
}
?>
        </ul>
      </div>
	</div>