<?php
if ($_GET['mode']==2) {
?>
		<ul class="nav nav-pills" style="margin-bottom: 5px;">
			<li><a onclick="mode(1)">Upload ảnh</a></li>
			<li class="active"><a href="#">Sử dụng URL</a></li>
		</ul>
		<p>Ảnh lớn: <input type="text" name="bigimg" value="<?php echo $_POST['bigimg']; ?>"></p>
		<p>Size chuẩn: 336x480.</p> 
		<P>Ảnh nhỏ: <input type="text" name="smallimg" value="<?php echo $_POST['bigimg']; ?>"></P>
		<p>Size chuẩn: 175x250.</p> 
		<input type="hidden" name="imgmode" value="2">
<?php
}
else if ($_GET['mode']==1) {
?>
		<ul class="nav nav-pills" style="margin-bottom: 5px;">
			<li class="active"><a href="#">Upload ảnh</a></li>
			<li class=""><a onclick="mode(2)">Sử dụng URL</a></li>
		</ul>
				<p>Chỉ hỗ trợ định dạng PNG, JPG, GIF với dung lượng tối đa là 2Mb</p>
		<p>Ảnh lớn: <input type="file" name="bigimg" id="file" />
		<p>Size chuẩn: 336x480.</p> 
		<P>Ảnh nhỏ: <input type="file" name="smallimg" id="file" />
		<p>Size chuẩn: 175x250.</p> 
		<input type="hidden" name="imgmode" value="1">
<?php
}
else {
?>
Access Denied
<?php } ?>