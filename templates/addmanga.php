<form class="form-horizontal" action="addmanga?act=do" method="post" enctype="multipart/form-data">
<div class="control-group">                  
	<label>Tên truyện <font style="color:red;">*</font>:</label>              
	<div class="controls docs-input-sizes">                  
		<input type="text" name="name" value="<? echo $_POST['name']; ?>"> 
	</div>                                                                  
</div>   
<div class="control-group">                  
	<label>Tên khác:</label>              
	<div class="controls docs-input-sizes">                  
		<input type="text" name="tenkhac" value="<? echo $_POST['tenkhac']; ?>"> 
		<p class="help-block">Ngăn cách bằng dấu dấu chấm phẩy <b><font color="red">;</font></b> .</p>
	</div>                                                                  
</div>  
<div class="control-group">                  
	<label>Tác giả <font style="color:red;">*</font>:</label>              
	<div class="controls docs-input-sizes">                  
		<input type="text" name="tacgia" value="<? echo $_POST['tacgia']; ?>"> 
	</div>                                                                  
</div>  
<div class="control-group">                  
	<label>Nguồn <font style="color:red;">*</font>:</label>              
	<div class="controls docs-input-sizes">                  
		<input type="text" name="nguon" value="<? echo $_POST['nguon']; ?>"> 
		<p class="help-block">Ngăn cách bằng dấu dấu chấm phẩy <b><font color="red">;</font></b> .</p>		
	</div>                                                                  
</div>  
<div class="control-group">                  
	<label>Danh sách cộng tác:</label>              
	<div class="controls docs-input-sizes">                  
		<input type="text" name="congtac" value="<? echo $_POST['congtac']; ?>"> 
		<p class="help-block">Điền vào các tài khoản bạn cho phép cùng tham gia đăng truyện. Ngăn cách bằng dấu dấu chấm phẩy <b><font color="red">;</font></b></p>
	</div>                                                                  
</div>  
<div class="control-group">                  
	<label>Giới thiệu <font style="color:red;">*</font>:</label>              
	<div class="controls docs-input-sizes">                  
		<textarea maxlength="1000" name="chuthich" class="xxlarge" style="background-color: white;"><? echo $_POST['chuthich']; ?></textarea>
	</div>                                                                  
</div>	
<div class="control-group">                  
	<label>Tình trạng <font style="color:red;">*</font>:</label>              
	<div class="controls docs-input-sizes">  
	<div class="btn-group" data-toggle-name="status" data-toggle="buttons-radio" >
		<button type="button" value="1" class="btn btn-small<?php if ($_POST['status']==1) { echo ' btn-primary active'; } ?>" data-toggle="button">Đang cập nhật</button>
		<button type="button" value="2" class="btn btn-small<?php if ($_POST['status']==2) { echo ' btn-primary active'; } ?>" data-toggle="button">Hoàn thành</button>
		<button type="button" value="3" class="btn btn-small<?php if ($_POST['status']==3) { echo ' btn-primary active'; } ?>" data-toggle="button">One Shot</button>
		<button type="button" value="4" class="btn btn-small<?php if ($_POST['status']==4) { echo ' btn-primary active'; } ?>" data-toggle="button">Tạm dừng</button>
	</div>
	<input type="hidden" name="status" value="<? echo $_POST['status']; ?>" />		
	</div>                                                                  
</div>  
<div class="control-group">                  
	<label>Lứa tuổi:</label>              
	<div class="controls docs-input-sizes">                  
	<div class="btn-group" data-toggle-name="xxx" data-toggle="buttons-radio" >
		<button type="button" value="16" class="btn btn-small<?php if ($xxx>=16) { echo ' btn-primary active'; } ?>" data-toggle="button">Chỉ dành cho lứa tuổi 16+</button>
		<button type="button" value="1" class="btn btn-small<?php if ($xxx<=1) { echo ' btn-primary active'; } ?>" data-toggle="button">Mọi lứa tuổi</button>
	</div>
	<input type="hidden" name="xxx" value="<? echo $_POST['xxx']; ?>" />			
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
<?
$sql_cats = @mysql_query("SELECT * FROM cats");
while ($cats = @mysql_fetch_array( $sql_cats )) {
?>		
		<div style="float:left;width:150px;"><input type="checkbox" name="cats[]" value="<? echo $cats['id']; ?>" /> <? echo $cats['name']; ?></div>
<?
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
<?
if ($_POST['imgmode']==2) {
?>	
		<ul class="nav nav-pills" style="margin-bottom: 5px;">
			<li><a onclick="mode(1)">Upload ảnh</a></li>
			<li class="active"><a href="#">Sử dụng URL</a></li>
		</ul>
		<p>Ảnh lớn: <input type="text" name="bigimg" value="<? echo $_POST['bigimg']; ?>"></p>
		<p>Size chuẩn: 336x480.</p> 
		<P>Ảnh nhỏ: <input type="text" name="smallimg" value="<? echo $_POST['bigimg']; ?>"></P>
		<p>Size chuẩn: 175x250.</p> 
		<input type="hidden" name="imgmode" value="2">
<?
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
<?
}
?>
	</div>                                                                  
</div>	
<div class="form-actions">                                                                                                      
<input type="submit" name="submit" class="btn btn-primary" value="Gửi">                                         
<button type="reset" class="btn">Hủy</button>      
<losepass>Sau khi đăng truyện, bạn cần phải chờ sự xét duyệt của BQT để truyện được đưa vào danh sách.</losepass>                                                                    
</div> 
</form> 