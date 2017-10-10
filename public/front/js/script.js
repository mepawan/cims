
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
  
function pvn_notify(msg,type,title){
	if(title == null || title == undefined || !title){ title = ''; }
	if(type == null || type == undefined || !type){ type = 'info'; }
	if(type == 'fail' ){ type = 'danger'; }
	
	$.notify({
		// options
		icon: 'glyphicon glyphicon-'+type+'-sign',
		title: title,
		message: msg,
		//url: 'https://github.com/mouse0270/bootstrap-notify',
		//target: '_blank'
	},{
		// settings
		element: 'body',
		position: null,
		type: type,
		allow_dismiss: true,
		newest_on_top: true,
		showProgressbar: false,
		placement: {
			from: "top",
			align: "right"
		},
		offset: 20,
		spacing: 10,
		z_index: 1031,
		delay: 5000,
		timer: 1000,
		url_target: '_blank',
		mouse_over: null,
		animate: {
			enter: 'animated fadeInDown',
			exit: 'animated fadeOutUp'
		},
		/*onShow: null,
		onShown: null,
		onClose: null,
		onClosed: null,
		icon_type: 'class',
		template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
			'<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
			'<span data-notify="icon"></span> ' +
			'<span data-notify="title">{1}</span> ' +
			'<span data-notify="message">{2}</span>' +
			'<div class="progress" data-notify="progressbar">' +
				'<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
			'</div>' +
			'<a href="{3}" target="{4}" data-notify="url"></a>' +
		'</div>' */
	});
}

jQuery(document).ready(function(){
	jQuery("#frm-top-login, #frm-main-login").submit(function(e){
		e.preventDefault();
		var dis = jQuery(this);
		jQuery('input[type="submmit"]',jQuery(dis)).val('Please wait...');
		jQuery.post(ci_base_url+'auth/login',jQuery(dis).serialize(),function(resp){
			var msg_type = '';
			if(resp.loggedin == 'yes'){
				if(resp.redirect){
					window.location = resp.redirect;
				}
			} 
			if(resp.msg != null || resp.msg != undefined){
				pvn_notify(resp.msg,resp.status);
			}
			
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


	jQuery(document).ready(function(e){
		var rh = jQuery(".right-bar").height();
		var lh = jQuery(".left-bar").height();
		console.log(rh);
		console.log(lh);
		if(lh < rh){
			jQuery(".left-bar").height(rh);
		} else {
			jQuery(".right-bar").height(lh);
		}
		
		
	});

