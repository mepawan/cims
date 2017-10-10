jQuery(document).ready(function() {
	if(jQuery(".select2-single").length){
		jQuery(".select2-single").select2({
			//minimumResultsForSearch: -1
		});
	}
	jQuery('.pvngen-buttons-wrap .action-add, .pvngen-buttons-wrap .action-edit, .pvngen-buttons-wrap .action-delete').click(function(e){
		var modal_id = jQuery(this).attr('data-target');
		var type = jQuery(this).attr('data-type');
		var frm = jQuery('form', jQuery(modal_id));
		if(jQuery(this).hasClass('action-edit')){
			if(jQuery("#dt_"+entity+" tbody tr.success").length == 1){
				var row = oTable.row( jQuery("#dt_"+entity+" tbody tr.success").eq(0) ).data();
				jQuery.fn.fill_form(frm,row);
			} else if(jQuery("#dt_"+entity+" tbody tr.success").length > 1){
				alert('Multiple selection not allowed');
				return false;
			} else if(jQuery("#dt_"+entity+" tbody tr.success").length == 0){
				alert('Select atleat one field');
				return false;
			}
		}
		
		jQuery(modal_id).modal('show');
		
	});
	jQuery(".pvngen-frm").submit(function(e){
		e.preventDefault();
		var dis = jQuery(this);
		var type = jQuery(dis).attr('data-type');
		if(!jQuery('input[name="pvngen_action"]',jQuery(this)).val()){
			jQuery('input[name="pvngen_action"]',jQuery(this)).val(type);
		}
		
		
		jQuery('button[type="submit"]', jQuery(dis)).html('Please wait...');
		if(type == 'add' || type == 'edit'){
			if(jQuery('.pvngen_ckeditor').length){
				jQuery('.pvngen_ckeditor').each(function(){
					var id = jQuery(this).attr('id');
					var editor = CKEDITOR.instances[id];
					jQuery(this).val(editor.getData());
				});
			}
			var formData = new FormData(this);
			console.log(formData);
			jQuery.ajax({
				url: ci_base_url + 'admin/' + entity + '/process_ajax',
				data: formData,
				dataType : 'json', 
				cache: false,
				contentType: false,
				processData: false,
				type: 'POST',
				success: function(resp){
					
					jQuery.fn.pvngen_notify(resp.status,resp.msg);
					if(resp.status,resp.status != 'error'){
						jQuery(".mfp-close", jQuery(dis).parents('.allcp-form')).click();
						oTable.ajax.reload(function ( json ) {
							jQuery.fn.dt_loaded("dt_"+entity);
						});
					}
					jQuery('button[type="submit"]', jQuery(dis)).html('Save Data');
					
				}
			});
			/*jQuery.post(ci_base_url + 'admin/' + entity + '/process_ajax', formData, function(resp){
				jQuery.fn.pvngen_notify(resp.status,resp.msg);
				jQuery(".mfp-close", jQuery(dis).parents('.pvngen-frm-modal')).click();
				oTable.ajax.reload(function ( json ) {
					jQuery.fn.dt_loaded("dt_"+entity);
				});
				jQuery('button[type="submit"]', jQuery(dis)).html('Save Data');
			}, 'json');*/
			
		} else if(type == 'delete'){
			if(jQuery("#dt_"+entity+" tbody tr.success").length < 1){
				alert('Select atleat ONE row to delete.');
				return false;
			} else {
				var ids = '';
				jQuery("#dt_"+entity+" tbody tr.success").each(function(){
					ids += jQuery(this).attr('id')+",";
				});
				jQuery.post(ci_base_url + 'admin/' + entity + '/process_ajax', {pvngen_action:'delete',ids:ids}, function(resp){
					jQuery.fn.pvngen_notify(resp.status,resp.msg);
					jQuery(".mfp-close", jQuery(dis).parents('.pvngen-frm-modal')).click();
					oTable.ajax.reload(function ( json ) {
						jQuery.fn.dt_loaded("dt_"+entity);
					});
					jQuery('button[type="submit"]', jQuery(dis)).html('Save Data');
				},'json');
			}
		}
	});
	if(jQuery('.show-hide-pwd-wrap').length){
		jQuery('.show-hide-pwd-wrap i').click(function(e){
			e.preventDefault();
			if(jQuery(this).hasClass('fa-eye')){
				jQuery(this).removeClass('fa-eye').addClass('fa-eye-slash');
				jQuery('input.show-hide-pwd', jQuery(this).parents('label')).attr('type','password');
			} else {
				jQuery(this).removeClass('fa-eye-slash').addClass('fa-eye');
				jQuery('input.show-hide-pwd', jQuery(this).parents('label')).attr('type','text');
			}
		});
	}
	if(jQuery('.show-hide-pwd-view').length){
		jQuery('.show-hide-pwd-view i').click(function(e){
			e.preventDefault();
			jQuery('.show-hide-pwd-view span').toggleClass('hide');
		});
	}
	
	jQuery('.file.pvngen input[type="file"]').change(function(e){
		var files_str = '';
		for (var i = 0; i < this.files.length; i++) {
			files_str += (files_str)?', '+this.files[i].name:this.files[i].name;
		}
		jQuery(this).next().val(files_str);
	});
	
	jQuery('.pvngen_ckeditor').each(function(){
		var id = jQuery(this).attr('id');
		CKEDITOR.replace( id,{ allowedContent:true } );
	});
	
	
	
	
	
}); // end juery ready

jQuery.fn.pvngen_notify = function(type, msg){
	if(type == 'fail'){
		type = 'error';
	}
	new PNotify({
				title: jQuery.fn.capitalize(type),
				text: msg,
				shadow: true,
				opacity: '0.75',
				addclass: 'stack_top_right',
				type: type, //"notice", "info", "success", or "error"
				stack: {"dir1": "down","dir2": "left","push": "top","spacing1": 10,"spacing2": 10}, // top_right
				width: '290px',
				delay: 12000
			});
};

jQuery.fn.capitalize = function (str) {
	if(!str){ return false;}
    strVal = '';
    str = str.split(' ');
    for (var chr = 0; chr < str.length; chr++) {
        strVal += str[chr].substring(0, 1).toUpperCase() + str[chr].substring(1, str[chr].length) + ' '
    }
    return strVal
}
jQuery.fn.fill_form = function(frm, data){
	jQuery("input, textarea, select", jQuery(frm)).each(function(){
		var nm = jQuery(this).attr('name');
		var tg = jQuery(this).prop("tagName").toLowerCase();
		var vl = (data[nm+"_pk"])?data[nm+"_pk"]:data[nm];

		switch(tg){
			case 'select':
				jQuery(this).val(vl).change();
				jQuery('option[value="'+vl+'"]', jQuery(this)).attr('selected','selected');
				break;
			case 'textarea':
				jQuery(this).val(vl);
				if(jQuery('.pvngen_ckeditor').length){
					jQuery('.pvngen_ckeditor').each(function(){
						var id = jQuery(this).attr('id');
						var editor = CKEDITOR.instances[id];
						editor.setData(vl);
					});
				}
				break;
			case 'input':
				var typ = jQuery(this).attr('type');
				switch(typ){
					case 'text':
					case 'password':
					case 'email':
					case 'tel':
					case 'number':
					case 'url':
					case 'hidden':
						jQuery(this).val(vl);
						break;
					case 'file':
						console.log('file');
						console.log(jQuery(this).next());
						console.log(vl);
						jQuery(this).next().val(vl);
						jQuery(this).removeAttr('required');
						break;
				}
				break;
		}
	});
};
/// INIT AFTER DATA TABLE LOADED

jQuery.fn.dt_loaded = function(tblid){
	if(!tblid){
		tblid = 'dt_'+entity;
	}
	if(!row_selection){
		row_selection = 'no';
	}
	//alert('tblid:'+tblid);
	jQuery('.dt_video_wrap .close, .dt_img_wrap .close').unbind('click').bind('click',function(e){
		jQuery(this).parent().removeClass('popup');
	});
	jQuery('.dt_video_wrap video, .dt_img_wrap img').unbind('click').bind('click',function(e){
		jQuery(this).parent().addClass('popup');
	});	

	if(row_selection == undefined || row_selection != 'no'){
		jQuery(".menu-items").click( function(e){
			e.preventDefault();
			var id = $(this).parent().parent().attr('id');
			
			window.location = ci_base_url+"/admin/menuitems/"+id;
		});
		
		jQuery("#"+tblid+" tbody tr").unbind('click').bind('click',function(e){
			jQuery(this).toggleClass('success');
			var sl = jQuery("#"+tblid+" tbody tr.success").length;
			if( sl == 1){
				jQuery('.action-edit').removeAttr('disabled');
				jQuery('.action-delete').removeAttr('disabled');
			} else if( sl > 1){
				jQuery('.action-edit').attr('disabled','disabled');
				jQuery('.action-delete').removeAttr('disabled');
			} else {
				jQuery('.action-edit').attr('disabled','disabled');
				jQuery('.action-delete').attr('disabled','disabled');
			}
		});	}
};

jQuery.fn.reset = function(){
	jQuery('input,textarea,select', jQuery(this)).each(function(){
		var nm = jQuery(this).attr('name');
		switch(jQuery(this).prop("tagName").toLowerCase()){
			case 'select':
				jQuery(this).val('').change();
				jQuery('option', jQuery(this)).removeAttr('selected');
				break;
			case 'textarea':
				jQuery(this).val('');
				break;
			case 'input':
				var typ = jQuery(this).attr('type');
				switch(typ){
					case 'text':
					case 'password':
					case 'tel':
					case 'number':
					case 'url':
					case 'hidden':
						jQuery(this).val('');
						break;
					case 'hidden':
						jQuery(this).next().val('');
						break;
				}
				break;
		}
	});
};
jQuery.fn.render_image = function(data, type, full, meta){
	if(!data){ return '';}
	if(jQuery.isArray(data)){
		var data_str = '';
		for(var i in data){
			var img = data[i];
			data_str += '<div class="dt_img_wrap"><span class="close"> x </span><img class="dt_img"  src="'+ci_base_url+'/assets/uploads/'+img+'" /></div>';
		}
		return data_str;
	} else {
		return '<div class="dt_img_wrap"><span class="close"> x </span><img class="dt_img"  src="'+ci_base_url+'/assets/uploads/'+data+'" /></div>';
	}
	
};
jQuery.fn.render_video = function(data, type, full, meta){
	if(!data){ return '';}
	return type === 'display' && data.length > 4 ?prepare_video(data): data;
};
jQuery.fn.ci_currency = function(amount){
	return currency_symbol+amount+ ' ' + currency_code;
}
function prepare_video(videofile, thumbfile){
	var parts = videofile.split('.');
	var ext = parts[parts.length-1];

	videofile = ci_base_url + 'assets/uploads/'+videofile;
	thumbfile = (thumbfile != undefined)?ci_base_url + 'assets/uploads/'+thumbfile:'';
	
	var str = '<div class="dt_video_wrap"><span class="close"> x </span><video autoplay="" loop="" muted="" class="article-item__video" poster="'+thumbfile+'">';
	str += '<source src="'+videofile+'" type="video/'+ext+'"></source>';
	str += '</video></div>';
	return str;
}


