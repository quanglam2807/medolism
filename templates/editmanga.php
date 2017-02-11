<form class="form-horizontal" action="editmanga?act=do&&id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
<div class="control-group">                  
	<label>Tên truyện <font style="color:red;">*</font>:</label>              
	<div class="controls docs-input-sizes">                  
		<input type="text" name="name" value="<?php echo $name; ?>"> 
	</div>                                                                  
</div>   
<div class="control-group">                  
	<label>Tên khác:</label>              
	<div class="controls docs-input-sizes">                  
		<input type="text" name="tenkhac" value="<?php echo $tenkhac; ?>"> 
		<p class="help-block">Ngăn cách bằng dấu dấu chấm phẩy <b><font color="red">;</font></b> .</p>
	</div>                                                                  
</div>  
<div class="control-group">                  
	<label>Tác giả <font style="color:red;">*</font>:</label>              
	<div class="controls docs-input-sizes">                  
		<input type="text" name="tacgia" value="<?php echo $tacgia; ?>"> 
	</div>                                                                  
</div>  
<div class="control-group">                  
	<label>Nguồn <font style="color:red;">*</font>:</label>              
	<div class="controls docs-input-sizes">                  
		<input type="text" name="nguon" value="<?php echo $nguon; ?>"> 
		<p class="help-block">Ngăn cách bằng dấu dấu chấm phẩy <b><font color="red">;</font></b> .</p>		
	</div>                                                                  
</div>  
<div class="control-group">                  
	<label>Danh sách cộng tác:</label>              
	<div class="controls docs-input-sizes">                  
		<input type="text" name="congtac" value="<?php echo $congtac; ?>"> 
		<p class="help-block">Điền vào các tài khoản bạn cho phép cùng tham gia đăng truyện. Ngăn cách bằng dấu dấu chấm phẩy <b><font color="red">;</font></b> .</p>
	</div>                                                                  
</div>  
<div class="control-group">                  
	<label>Giới thiệu <font style="color:red;">*</font>:</label>              
	<div class="controls docs-input-sizes">                  
		<textarea maxlength="1000" name="chuthich" class="xxlarge" style="background-color: white;"><?php echo $chuthich; ?></textarea>
	</div>                                                                  
</div>	
<div class="control-group">                  
	<label>Tình trạng <font style="color:red;">*</font>:</label>              
	<div class="controls docs-input-sizes">  
	<div class="btn-group" data-toggle-name="status" data-toggle="buttons-radio" >
		<button type="button" value="1" class="btn btn-small<?php if ($status==1) { echo ' btn-primary active'; } ?>" data-toggle="button">Đang cập nhật</button>
		<button type="button" value="2" class="btn btn-small<?php if ($status==2) { echo ' btn-primary active'; } ?>" data-toggle="button">Hoàn thành</button>
		<button type="button" value="3" class="btn btn-small<?php if ($status==3) { echo ' btn-primary active'; } ?>" data-toggle="button">One Shot</button>
		<button type="button" value="4" class="btn btn-small<?php if ($status==4) { echo ' btn-primary active'; } ?>" data-toggle="button">Tạm dừng</button>
	</div>
	<input type="hidden" name="status" value="<?php echo $status; ?>" />		
</div>                                                                  
</div>  
<div class="control-group">                  
	<label>Lứa tuổi:</label>              
	<div class="controls docs-input-sizes">                  
	<div class="btn-group" data-toggle-name="xxx" data-toggle="buttons-radio" >
		<button type="button" value="16" class="btn btn-small<?php if ($xxx>=16) { echo ' btn-primary active'; } ?>" data-toggle="button">Chỉ dành cho lứa tuổi 16+</button>
		<button type="button" value="1" class="btn btn-small<?php if ($xxx<=1) { echo ' btn-primary active'; } ?>" data-toggle="button">Mọi lứa tuổi</button>
	</div>
	<input type="hidden" name="xxx" value="<?php echo $xxx; ?>" />			
	<p class="help-block">Nếu truyện từ 16+ trở lên, sẽ bị ẩn khi chế độ Family Filter được bật</p> 
	</div>                                                                   
</div>
<div class="control-group">                  
	<label>Thể loại <font style="color:red;">*</font>:</label>              
	<div class="controls docs-input-sizes">           
		<p style="text-align:left;">
	<a rel="group_1" class="btn btn-small" href="#select_all">Chọn tất cả</a>
	<a rel="group_1" class="btn btn-small" href="#select_none">Bỏ chọn tất cả</a>
	<a rel="group_1" class="btn btn-small" href="#invert_selection">Đảo lựa chọn</a>	
	</p>   	
		<div id="group_1">	
<?php
$sql_cats = @mysqli_query($con, "SELECT * FROM cats");
while ($cats = @mysqli_fetch_array( $sql_cats )) {
?>		
		<div style="float:left;width:150px;"><input type="checkbox" name="cats[]" value="<?php echo $cats['id']; ?>" <?php if (in_array($cats['id'],$idCheck)) { ?>checked<?php } ?> /> <?php echo $cats['name']; ?></div>
<?php
}
?>
		</div> 
	</div>   
</div>	
<script>
function mode(a)
{
var data2 = "mode="+a;
$("#mode").empty().html('<div style="margin: auto auto 25px; width: 50%;" class="progress progress-info progress-striped active"><div style="width: 100%" class="bar"></div></div>');
$.ajax({
type: "GET",
url: "ajax/imgmode.php",
data: data2,
cache: false,
success: function(html){
$("#mode").empty().append(html);
}
});
}
</script>
<div class="control-group">                  
	<label>Ảnh bìa:</label>              
	<div class="controls docs-input-sizes" id="mode">      
<?php
if ($_POST['imgmode']==2) {
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
else {
?>
		<ul class="nav nav-pills" style="margin-bottom: 5px;">
			<li class="active"><a href="#">Upload ảnh</a></li>
			<li class=""><a onclick="mode(2)">Sử dụng URL</a></li>
		</ul>
		<p>Chỉ hỗ trợ định dạng PNG, JPG, GIF với dung lượng tối đa là 2Mb</p>
		<p>Ảnh lớn: <input type="file" name="bigimg" id="file" />
		<p>Size chuẩn: 336x480.</p> 
		<P>Ảnh nhỏ: <input type="file" name="smallimg" id="file2"/>
		<p>Size chuẩn: 175x250.</p> 
		<input type="hidden" name="imgmode" value="1">
<?php
}
?>
	</div>                                                                                      
</div>	
<div class="control-group">                  
	<label>Bạn có muốn xóa?</label>              
	<div class="controls docs-input-sizes">  
	<div class="btn-group" data-toggle-name="delete" data-toggle="buttons-radio" >
		<button type="button" value="1" class="btn btn-small" data-toggle="button">Có</button>
		<button type="button" value="0" class="btn btn-small btn-primary active" data-toggle="button">Không</button>
	</div>
	<input type="hidden" name="delete" value="0" />		
	</div>                                                                  
</div>
<div class="form-actions">                                                                                                      
<input type="submit" name="submit" class="btn btn-primary" value="Lưu thay đổi">                                         
<button type="reset" class="btn">Hủy</button>                                                     
</div> 
</form> 