	$(function() {

	$( ".datepicker" ).datepicker({
		dateFormat:'dd/mm/yy'
	});
	
	$('select').selectmenu({
	style:'dropdown',
	maxHeight: 150
	});
	

	
	$("img.tn123").lazyload({});

	});

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-30891898-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

// Tìm truyện  

$(function() {
	$("#topmenu_search_query").autocomplete(($("#topmenu_search_query").attr("search-url")), {
		matchContains: true,
		minChars: 0,
		resultsClass: "acResults",
		width:597
	});
	$("#topmenu_search_query").result(function(event, data, formatted) {
	if (($("#topmenu_search_query").attr("search-type"))==1) {
	var result_url = 'viewmanga?id=';
	}
	if (($("#topmenu_search_query").attr("search-type"))==3) {
	var result_url = 'list?id=';
	}
	if (($("#topmenu_search_query").attr("search-type"))==4) {
	var result_url = 'user?username=';
	}
	if (($("#topmenu_search_query").attr("search-type"))==2) {
	var result_url = 'author?name=';
	}
		location.href = result_url+data[1];
	});
});	
// ĐOẠN 1


	
$().ready(function() {	
			
	$().UItoTop({ easingType: 'easeOutQuart' });
			
});

jQuery(function($) {
  $('div.btn-group[data-toggle-name=*]').each(function(){
    var group   = $(this);
    var form    = group.parents('form').eq(0);
    var name    = group.attr('data-toggle-name');
    var hidden  = $('input[name="' + name + '"]', form);
    $('button', group).each(function(){
      var button = $(this);
      button.live('click', function(){
          hidden.val($(this).val());
      });
      if(button.val() == hidden.val()) {
        button.addClass('btn-primary active');
      }
    });
  });
});

$(document).ready( function() {
 
        // Select all
        $("A[href='#select_all']").click( function() {
            $("#" + $(this).attr('rel') + " INPUT[type='checkbox']").attr('checked', true);
            return false;
        });
 
        // Select none
        $("A[href='#select_none']").click( function() {
            $("#" + $(this).attr('rel') + " INPUT[type='checkbox']").attr('checked', false);
            return false;
        });
 
        // Invert selection
        $("A[href='#invert_selection']").click( function() {
            $("#" + $(this).attr('rel') + " INPUT[type='checkbox']").each( function() {
                $(this).attr('checked', !$(this).attr('checked'));
            });
            return false;
        });
		
 
});
	
	