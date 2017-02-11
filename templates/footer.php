		</div>                                  	                                                                                                                                                
	</div>												
</div>																																															
	<div id="footer">                            
		<div class="container2">                                              
<div class="right">  
Tài trợ bởi <a href="http://netcarevn.com"><img style="height: 65px !important;" src="image/nhataitro.png"></a>                                   				</div>
			<p>                     
			<?php echo $lang_licenses_footer; ?>
			</p>                                  
		</div>                                      
	</div>  
<script src="js/fileinput/js/enhance.min.js" type="text/javascript"></script>
<script src="js/fileinput/js/fileinput.jquery.js" type="text/javascript"></script>
<script>
$("#chosesearch button").click(function () {
	$("#chosesearch button").removeClass("btn-success active");
	$(this).addClass("btn-success active");
	var typesearch = $(this).attr("value");
	if (typesearch==1) { var textsearch = 'tên truyện'; }
	if (typesearch==2) { var textsearch = 'tên tác giả'; }
	if (typesearch==3) { var textsearch = 'thể loại'; }
	if (typesearch==4) { var textsearch = 'tài khoản thành viên'; }
	var placeholder ='Nhập '+textsearch+' cần tìm tại đây...';
	var search_url = "ajax/headfind/"+typesearch+".php";
	$("#topmenu_search_query").attr("search-url", search_url);
	$("#topmenu_search_query").attr("search-type", typesearch);
	$("#topmenu_search_query").attr("placeholder", placeholder);
});
// ĐOẠN 2
</script>	
</body>   

                                          