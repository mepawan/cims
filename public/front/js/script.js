
$(document).ready(function(){
    $(".togglebutton button").click(function(){
        $("#nav-primary ul.menu").slideToggle();
       $(this).toggleClass('btn-open').toggleClass('btn-close');
	   //$( "#nav-primary ul" ).toggle( "slide" ); -Left to right slide-
    });

	$(window).scroll(function () {
		if ($(window).scrollTop() > 60) { //--Acording to header height 100px--//
			$('#nav-primary').addClass('sticky');
		}
		if ($(window).scrollTop() < 61) {
			$('#nav-primary').removeClass('sticky');
		}
	});
});



 $(function () {
	  
	   var element = $("#mm_title h2");
    $(window).scroll(function () {
      if($(window).scrollTop() > 0) {
        element.addClass("title_s");
      }  

    });
  });





  $(function () {
    var element = $("#top_move");
    $(window).scroll(function () {
      if($(window).scrollTop() > 0) {
        element.addClass("btt");
      }

    });
  });
  
  
  
  
    $(function () {
    var element = $(".ser_items");
    $(window).scroll(function () {
      if($(window).scrollTop() > 0) {
        element.addClass("ser_animation");
      }

    });
  });
  
  
  
  $(function () {
	  
	   var element = $("#slogan_1 p, #slogan_1 span");
    $(window).scroll(function () {
      if($(window).scrollTop() > 0) {
        element.addClass("title_s2");
      }  

    });
  });
 
  
  
  
   $(function () {
    var element = $("#icon_anim ");
    $(window).scroll(function () {
      if($(window).scrollTop() > 0) {
        element.addClass("t_top_2");
      }

    });
  }); 
  
  

jQuery(document).ready(function(){
	jQuery("#frm-top-login").submit(function(e){
		e.preventDefault();
		var dis = jQuery(this);
		jQuery('input[type="submmit"]',jQuery(dis)).val('Please wait...');
		jQuery.post(ci_base_url+'auth/login',jQuery(dis).serialize(),function(resp){
			
		},'json');
	});
	jQuery(".full_screen_toggle").hide();
	
    jQuery(".tog_icon, .tog_icon_cross").click(function(){
		jQuery(".full_screen_toggle").fadeToggle(); 
		jQuery( ".side_navigation" ).toggle('slide', { direction: 'right'});
    });
	
	jQuery(".full_screen_toggle").click(function(){
		jQuery(".full_screen_toggle").fadeToggle();
		jQuery( ".side_navigation" ).toggle('slide', { direction: 'right'});
	});	
	
});

