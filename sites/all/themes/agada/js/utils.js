 
 (function($) {
  
  $(document).ready(function(){
	$(".quicktabs-tabs.quicktabs-style-nostyle li a").each(function(i) {
	$(this).click(function() {
$(".quicktabs-tabpage").hide();
	$(".quicktabs-tabpage:eq("+i+")").fadeOut("fast");
	$(".quicktabs-tabpage:eq("+i+")").fadeIn(2000);

	

		});
	 
	 
	});
	// if($('#white_box .small_title').length !=0 )
  //  $('#white_box .field-label-hidden').addClass('narrow');
	
	
//	});
	
	
	
	
	
	
// console.log($(".quicktabs-tabs.quicktabs-style-nostyle li").length)
	

    $("li.pager-next a").html("&middot&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&middot");
	 $("li.pager-previous a").html("&middot&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&middot");
	 
// clickable div front page
	$(".js-small-content .js-small-caption a").each(function(){
		var path = $(this).attr("href");
//		console.log(path);
//		console.log(location.href)

		$(this).parent().parent().click(function(){
			location.href = location.href + path;

		});
	});
 

//end of clickable div front page

	$('.kids-body div.search_number').each(function(){
	str=$(this).html();

	str=str.split(")")[0];
	$(this).html(str);
		
		});
	
	
//$("#js-container").css("display","none");
//$(".expanded ").children("a").removeAttr("href");


	$("li.expanded >a").click(function(){
		$(this).next().slideToggle();
		$(this).parent().toggleClass("active");
		
		return false;
	})
	
	//Navigation	
	
	$(".sub").click(function(){							 
			if($(this).next(".submenu").css("display") != "block"){
				$(this).addClass("active");
				$(this).next(".submenu").slideDown(200);
			}
			else{
				$(this).next(".submenu").slideUp(100);
				$(this).addClass("default");
				$(this).removeClass("active");
				}			
		});
	
	//End of Navigation
	
	$(".page-visitors-page #container_visitors #page-visitors-page-left").height($(".page-visitors-page #container_visitors #page-visitors-page-right").innerHeight());

	
	$('.tooltip_code').tooltip({ 
		positionLeft: true 
		});
	
	$('.tooltip_source').tooltip({
		positionLeft: true,
		extraClass: "source_background" 
		});
	
	
	$(".list ").show();
	//Build Scroll Bars
	$('.list').jScrollPane()
	
	var api = $('.list').jScrollPane({showArrows: true}).data('jsp');
	
	$('#content_tabs div').bind(
		'click',
		function(){
			$("#content_tabs div").removeClass("active_story_type");
			$(this).addClass("active_story_type");
			api.getContentPane().html($("#"+$(this).attr("id")+"_hidden_content").attr("value"));
			api.reinitialise();
			return false;
			
		});
		//$('#content_tabs div#children_story').onclick=null alert('this');
		$("#content_tabs div#children_story").unbind();
		$("#content_tabs div#original_story").unbind();
	//End of Build Scroll Bars

	// Open Close Left Blocks
//	alert( $(".more").parent().parent().find(".content > div ").children().outerHeight())
  $(".more").parent().parent().find(".content > div ").each(function(i){		
	//  alert($(this).scrollHeight)

var scroller = $(this);
var contents = scroller.wrapInner('<div>').children(); // wrap a div around the contents
var height = contents.outerHeight(); // read the inner divs height

contents.replaceWith( contents.html() );

// alert(height)

	if(height>99 ) 						  	
	  {

	
		$(this).parent().parent().find(".open_close_block").show();	
			
	  }
		else
		$(this).parent().parent().find(".open_close_block").hide() ;		
    });
	
   $(".more").click(function(){							   
	  $(".sidebar .section .block > div").attr("current","");
	  $(this).parent().parent().attr("current","current");	
	    
	  $(".sidebar .section .block > div[current!='current']").slideUp(200);	
	  var cur = $(this).parent().parent().find(".content").filter(function(index){ return $(this).parent().attr("current")=="current"});
		cur.addClass("open_block_content").addClass("list");
		
		
	  $(this).parent().parent().animate({
		  height: '476px'
		}, 200, function() {
		});
		
	  $(this).hide();
	  $(".jspVerticalBar").show();
	  	//$(".view-content").addClass("list ");
		$('.list').jScrollPane()
	var api = $('.list').jScrollPane().data('jsp');
	
	$('#content_tabs div').bind(
		'click',
		function(){
			$("#content_tabs div").removeClass("active_story_type");
			$(this).addClass("active_story_type");
			api.getContentPane().html($("#"+$(this).attr("id")+"_hidden_content").attr("value"));
			api.reinitialise();
			return false;
		});
		$(".jspVerticalBar").parent(".jspContainer").addClass("vertical");
	  $(this).parent().find(".close").show();

	  });
    
   $(".close").click(function(){  		
	  $(this).parent().parent().find(".content").removeClass("open_block_content");
	  $(this).parent().parent().animate({
		  height: '119px'
		}, 200, function() {
		});
	  $(".sidebar .section .block > div").slideDown(200);
	  $(this).hide();
	  $(".region-sidebar-second .jspVerticalBar").hide();
	  $(this).parent().find(".more").show(); 
	  });
   //End of Open Close Left Blocks
	
   //Open Close Comments
   $(".more_comment").parent().parent().find(".content p").each(function(i){
		if($(this).innerHeight()>45) 
			$(this).parent().parent().parent().parent().parent().find(".open_close_comment").show();				
		});
   
  $(".more_comment").click(function(){
		var true_comment_height = $(this).parent().parent().find(".content p").innerHeight()+40;
		$(this).parent().parent().find(".content").animate({
			height: true_comment_height
			}, 500, function() {
		});
		
		$(this).hide();
		$(this).parent().find(".close_comment").show();				  
	});
  
  $(".close_comment").click(function(){
		$(this).parent().parent().find(".content").animate({
			height: "45px"
			}, 500, function() {
		});
		$(this).hide();
		$(this).parent().find(".more_comment").show();				  
	});
  //End of Open Close Comments	
  //a blank	

  $('#white_box a').attr('target', '_blank');
  $(".small_title_wide").parent().addClass("jsppadding");	
  $('#white_box .jspVerticalBar').parent().parent().parent().parent().addClass('scroll');
  $('li.menu-604 a').removeAttr("href");// תוכן גולשים מבוטל.!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!תוכן גולשים מבוטל
  $('li.menu-604 a').attr('title','בקרוב'); //תוכן גולשים מבוטל.!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!תוכן גולשים מבוטל
$('.node_pic p').wrap(function() {
  return '<div class="node_pic_p" />' + $(this).text() ;
}); if($('#white_box .small_title').length !=0 )
    $('#white_box .field-label-hidden').addClass('narrow');
	
	
	});
})(jQuery);
 
  function getParameterByName(name){
		name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
		var regexS = "[\\?&]" + name + "=([^&#]*)";
		var regex = new RegExp(regexS);
		var results = regex.exec(window.location.href);
		if(results == null)
		  return "";
		else
		  return decodeURIComponent(results[1].replace(/\+/g, " "));
	  }