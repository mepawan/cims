<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if($user_profile) { $preferred_contact_method = explode(',', $user_profile['preferred_contact_method']); }
?>

<?php $this->load->view('part/head'); ?>
<body>
	<div class="contain_wrapper">
		<?php $this->load->view('part/header'); ?>
		<div class="wrapper">
			<main class="background_container">
				<section class="general-message ands_work">
					<div class="container">
						<div class="row">

							<section id="content">
								<div class="col-md-2 left-section">
									<?php $this->load->view('part/user_left'); ?>
								</div>
								<div class="col-md-10 content-section">
										<?php if(isset($heading) && $heading){ ?>
											<span id="mm_title">
												<h2 class="title_s"> <?php echo $heading; ?></h2>
											</span>
										<?php } ?>
										<div class="content-wrap">
											<div class="setting-row">
												<div class="col-md-4 left">
													<h3> Personal Information </h3>
												</div>
												<div class="col-md-8 right ">
													<div class="view-section">
														<div class="col-md-10">
															<label class="view-item"> <?php echo $user['first_name'] . ' ' . $user['last_name']; ?> </label>
															<label class="view-item"> <?php echo $user['email']; ?> </label>
															<label class="view-item"> <?php echo $user['username'] ; ?> </label>
															<label class="view-item"> <?php echo $user['phone'] ; ?> </label>
														</div>
														<div class="col-md-2">
															<a class="edit-setting-btn" href="javascript:void(0);"> Edit </a>
														</div>
														<div class="clearfix clear"></div>
													</div>
													<div class="form-section">
														<div class="col-md-10">
															<span class="msg-wrap"></span>
															<form method="post" action="#" name="form-validation" class="setting-form" id="form_personal_info" enctype="multipart/form-data">
																<div class="form-group">
																	<label for="first_name" class="form-label col-sm-4">First Name<span class="red">*</span></label>
																	<div class="col-sm-8">
																		<input required type="text"  name="first_name" class="" id="first_name" value="<?php echo $user['first_name']; ?>"  />
																		
																	</div>
																</div>
																<div class="form-group">
																	<label for="last_name" class="form-label col-sm-4">Last Name<span class="red">*</span></label>
																	<div class="col-sm-8">
																		<input required type="text"  name="last_name" class="" id="last_name" value="<?php echo $user['last_name']; ?>"  />
																	</div>
																</div>
																<div class="form-group">
																	<label for="email" class="form-label col-sm-4">Email<span class="red">*</span></label>
																	<div class="col-sm-8">
																		<input required type="email"  name="email" class="" id="email" value="<?php echo $user['email']; ?>"  />
																	</div>
																</div>
																<div class="form-group">
																	<label for="username" class="form-label col-sm-4">Username<span class="red">*</span></label>
																	<div class="col-sm-8">
																		<input required type="text"  name="username" class="" id="username" value="<?php echo $user['username']; ?>"  />
																	</div>
																</div>
															
															
																<div class="form-group text-center">
																	<button class="btn btn-primary width-150" type="submit">Save</button>
																	<button class="btn btn-warning width-150 close-form-view-btn" type="button">Cancel</button>
																</div>
															</form>
														</div>
														<div class="col-md-2"></div>
													</div>
												</div>
												<div class="clearfix clear"></div>
											</div>
												
											<div class="setting-row">
												<div class="col-md-4 left">
													<h3> Password </h3>
												</div>
												<div class="col-md-8 right ">
													<div class="view-section">
														<div class="col-md-10">
															<label class="view-item"> ************** </label>
														</div>
														<div class="col-md-2">
															<a class="edit-setting-btn" href="javascript:void(0);"> Edit </a>
														</div>
														<div class="clearfix clear"></div>
													</div>
													<div class="form-section">
														<div class="col-md-10">
															<span class="msg-wrap"></span>
															<form method="post" action="#" name="form-validation" class="setting-form" id="form_personal_info" enctype="multipart/form-data">
																
																<div class="form-group">
																	<label for="password" class="form-label col-sm-4">New Password<span class="red">*</span></label>
																	<div class="col-sm-8">
																		<input required type="password"  name="password" class="" id="password" value=""  />
																	</div>
																</div>
																<div class="form-group">
																	<label for="confirm_password" class="form-label col-sm-4">Confirm Password<span class="red">*</span></label>
																	<div class="col-sm-8">
																		<input required type="password"  name="confirm_password" class="" id="confirm_password" value=""  />
																	</div>
																</div>
																<div class="form-group text-center">
																	<button class="btn btn-primary width-150" type="submit">Save</button>
																</div>
															</form>
														</div>
														<div class="col-md-2">
															<button class="btn btn-warning width-150 close-form-view-btn" type="button">Cancel</button>
														</div>
													</div>
												</div>
												<div class="clearfix clear"></div>
											</div> <!-- end setting-row -->
											<div class="setting-row">
												<div class="col-md-4 left">
													<h3> Address </h3>
												</div>
												<div class="col-md-8 right ">
													<div class="view-section">
														<div class="col-md-10">
															<label class="view-item"> <?php echo $user['address'] ; ?> </label>
															<label class="view-item"> <?php echo $user['city'] .', ' . $user['state']; ?> </label>
															<label class="view-item"> <?php echo $user['country'] . ' - ' . $user['zipcode']; ?> </label>
														</div>
														<div class="col-md-2">
															<a class="edit-setting-btn" href="javascript:void(0);"> Edit </a>
														</div>
														<div class="clearfix clear"></div>
													</div>
													<div class="form-section">
														<div class="col-md-10">
															<span class="msg-wrap"></span>
															<form method="post" action="#" name="form-validation" class="setting-form" id="form_personal_info" enctype="multipart/form-data">
																<div class="form-group">
																	<label for="address" class="form-label col-sm-4">Address </label>
																	<div class="col-sm-8">
																		<input  type="text"  name="address" class="" id="address" value="<?php echo $user['address']; ?>"  />
																	</div>
																	<div class="clearfix clear"></div>
																</div>
																<div class="form-group">
																	<label for="city" class="form-label col-sm-4">City </label>
																	<div class="col-sm-8">
																		<input type="text"  name="city" class="" id="city" value="<?php echo $user['city']; ?>"  />
																	</div>
																	<div class="clearfix clear"></div>
																</div>
																<div class="form-group">
																	<label for="country" class="form-label col-sm-4">Country </label>
																	<div class="col-sm-8">
																		<select  name="country" class="" id="country">
																			<option value=""> Select One </option>
																			<?php 
																				foreach($countries as $c){
																					$sel = ($c['iso_code_2'] == $user['country'])?' selected="selected" ':'';
																					echo '<option value="'.$c["iso_code_2"].'" '.$sel.'>'.$c["name"].'</option>';
																				}
																			?>
																		</select>
																		<div class="clearfix clear"></div>
																	</div>
																</div>
																<div class="form-group">
																	<label for="state" class="form-label col-sm-4">State  </label>
																	<div class="col-sm-8">
																		<select  name="state" data-val="<?php echo $user['state'];?>" class="" id="state">
																			<option value=""> Select One </option>
																			
																		</select>
																	</div>
																	<div class="clearfix clear"></div>
																</div>
																<div class="form-group">
																	<label for="zipcode" class="form-label col-sm-4">Zip Code </label>
																	<div class="col-sm-8">
																		<input type="text"  placeholder="Zip Code" name="zipcode" class="" id="zipcode" value="<?php echo $user['zipcode']; ?>" />
																	</div>
																	<div class="clearfix clear"></div>
																</div>
															
																<div class="form-group text-center">
																	<button class="btn btn-primary width-150" type="submit">Save</button>
																	
																</div>
															</form>
														</div>
														<div class="col-md-2">
															<button class="btn btn-warning width-150 close-form-view-btn" type="button">Cancel</button>
														</div>
													</div>
												</div>
												<div class="clearfix clear"></div>
											</div> <!-- end setting-row -->
											
											<div class="setting-row">
												<div class="col-md-4 left">
													<h3> Payment Info </h3>
												</div>
												<div class="col-md-8 right ">
													<div class="view-section">
														<div class="col-md-10">
															<?php
																$cnt = 1;
																if(isset($user_cards)){
																	foreach($user_cards as $card){
																		echo '<label class="view-item"> *********'.substr($card["number"],-4).' '.$card["type"].'</label>';
																		$cnt++;
																		if($cnt >3) {
																			break;
																		}
																	}
																}
															?>
															
														</div>
														<div class="col-md-2">
															<a class="edit-setting-btn" href="javascript:void(0);"> Edit </a>
														</div>
														<div class="clearfix clear"></div>
													</div>
													<div class="form-section">
														<div class="col-sm-8">
															<span class="card-msg-wrap"></span>
														</div>
														<div class="col-sm-4 pull-right text-right">
															<button type="button" class="btn btn-info width-150 add-new-card-btn" >Add New</button>
															<button class="btn btn-warning width-150 close-form-view-btn" type="button">Cancel</button>
														</div>
														<div class="clearfix clear"></div>
														<div class="col-md-12">
															<table class="cards-listing-tbl">
															<colgroup>
																<col width="22%">
																<col width="15%">
																<col width="25%">
																<col width="10%">
																<col width="10%">
																<col width="20%">
																
															</colgroup>
																<tr><th>Card Number</th><th>Type</th><th>Name on Card</th><th>Expiry </th><th>CVV</th><th></th></tr>
																<?php
																	$cnt = 1;
																	if(isset($user_cards)){
																		foreach($user_cards as $card){
																?>
																			<tr id="card_<?php echo $card['id'];?>" data-id="<?php echo $card['id'];?>"><td><?php echo $card['number'];?></td><td><?php echo $card['type'];?></td><td><?php echo $card['name'];?></td><td><?php echo $card['exp'];?></td><td><?php echo $card['code'];?></td><td> <a class="btn btn-info edit-card-btn" href="javascript:void(0);"><i class="fa fa-pencil" aria-hidden="true"></i></a> <a class="btn btn-danger delete-card-btn" href=""><i class="fa fa-trash" aria-hidden="true"></i></a> </td></tr>
																<?php
																		}
																	}
																?>
															</table>
															
																	
														</div>
													</div>
												</div>
												<div class="clearfix clear"></div>
											</div>
											<div class="setting-row">
												<div class="col-md-4 left">
													<h3> Profile </h3>
												</div>
												<div class="col-md-8 right ">
													<div class="view-section">
														<div class="col-md-10">
															<label class="view-item"> 
																 
															</label>
															<label class="view-item"> <?php echo $user_profile['preferred_contact_method']; ?> </label>
															
														</div>
														<div class="col-md-2">
															<a class="edit-setting-btn" href="javascript:void(0);"> Edit </a>
														</div>
														<div class="clearfix clear"></div>
													</div>
													<div class="form-section">
														<div class="col-md-10">
															<span class="msg-wrap"></span>
															<form method="post" action="#" name="form-validation" class="setting-form" id="form_personal_info" enctype="multipart/form-data">
																<div class="form-group">
																	<label for="bio" class="form-label col-sm-4">Timezone </label>
																	<div class="col-sm-8">
																	<?php 
																		$zones = get_timezones();
																	?>
																		<select name="profile[timezone]">
																		<?php
																			foreach($zones as $k => $v){
																				$sel = ($user_profile && $user_profile['timezone'] == $k)?' selected="selected" ':'';
																				echo '<option value="'.$k.'" '.$sel.'>' . $k . ' '.$v.'</option>';
																			}
																		?>
																		</select>
																	</div>
																	<div class="clearfix clear"></div>
																</div>
																
																<div class="form-group ">
																	<label for="preferred_contact_method" class="form-label col-sm-4">Preferred Contact Method?</label>
																	<div  class="col-sm-8">
																		<select name="profile[preferred_contact_method][]" multiple id="preferred_contact_method">
																			<option value="facetime" <?php if($user_profile && in_array('facetime',$preferred_contact_method)){ echo "selected";} ?>>Face Time</option>
																			<option value="tango" <?php if($user_profile && in_array('tango',$preferred_contact_method)) { echo "selected";} ?>>Tango</option>
																			<option value="skype" <?php if($user_profile && in_array('skype',$preferred_contact_method)) { echo "selected";} ?>>Skype</option>
																			<option value="android_video_calling" <?php if($user_profile && in_array('android_video_calling',$preferred_contact_method)) { echo "selected";} ?>>Android Video Calling</option>
																		</select>
																	</div>
																</div>
																<div class="form-group text-center">
																	<button class="btn btn-primary width-150" type="submit">Save</button>
																	
																</div>
															</form>
														</div>
														<div class="col-md-2">
															<button class="btn btn-warning width-150 close-form-view-btn" type="button">Cancel</button>
														</div>
													</div>
												</div>
												<div class="clearfix clear"></div>
											</div> <!-- end setting-row -->
											
										</div>
									
									
								</div>
								<!-- end .content-section -->
								<div class="clearfix clear"></div>
							</section>
							
						</div>
					</div>
				</section>
			</main>
		</div>
		<?php $this->load->view('part/footer'); ?>
		
		
		<div id="cards-modal" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<form method="post" action="#" name="form-validation"  id="form_card" enctype="multipart/form-data">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Manage Cards</h4>
						</div>
						<div class="modal-body">
							<span class="msg-wrap"></span>
							
								<div class="form-group">
									<label for="card-type" class="form-label col-sm-3">Card Type<span class="red">*</span></label>
									<div class="col-sm-8">
										<select required name="type" id="card-type" required>
											<option value=""> Select One </option>
											<option value="visa" >Visa</option>
											<option value="mastercard" >MasterCard</option>
											<option value="maestro" >Maestro</option>
											<option value="amex" >American Express</option>
											<option value="rupay" >RuPay</option>
										</select>
									</div>
									<div class="clearfix clear"></div>
								</div>
								<div class="form-group">
									<label for="card-number" class="form-label col-sm-3">Card Number<span class="red">*</span></label>
									<div class="col-sm-8">
										<input type="text" required id="card-number" placeholder="Card Number"  name="number" class=""  />
									</div>
									<div class="clearfix clear"></div>
								</div>
								<div class="form-group">
									<label for="card-exp-month" class="form-label col-sm-3">Expiry Date<span class="red">*</span></label>
									<div class="col-sm-8">
										<select required name="exp_month" id="card-exp-month"  class="col-sm-4">
											<option value=""> Month </option>
											<?php
												for($i = 1;$i <= 12; $i++){
													echo '<option value="'.$i.'">'.$i.'</option>';
												}
											?>
										</select>
										<select required name="exp_year" id="card-exp-year"  class="col-sm-4">
											<option value=""> Year </option>
											<?php
												$cy = date('Y');
												for($i = $cy; $i <= ($cy + 20); $i++){
													echo '<option value="'.$i.'">'.$i.'</option>';
												}
											?>
										</select>
										<div class="clearfix clear"></div>
									</div>
									<div class="clearfix clear"></div>
								</div>
								
								
								<div class="form-group">
									<label for="card-code" class="form-label col-sm-3">Security Code (CVV)<span class="red">*</span></label>
									<div class="col-sm-8">
										<input type="text" required id="card-code" placeholder="Security Code (CVV)"  name="code" class=""  />
									</div>
									<div class="clearfix clear"></div>
								</div>
								
								<div class="form-group">
									<label for="card-hname" class="form-label col-sm-3">Card Hoder's Name<span class="red">*</span></label>
									<div class="col-sm-8">
										<input type="text" required placeholder="Card Hoder's Name" id="card-hname"  name="name" class=""  />
									</div>
									<div class="clearfix clear"></div>
								</div>
								
							
						</div>
						<div class="modal-footer">
							<button class="btn btn-primary width-150" type="submit">Save</button>
							<button type="button" class="btn btn-warning width-150" data-dismiss="modal">Close</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		
		
	</div>
	<script>
		jQuery(document).ready(function(e){
			jQuery(".add-new-card-btn").click(function(e){
				e.preventDefault();
				jQuery("#cards-modal .modal-title").html('Add New Card');
				
				jQuery("#form_card #card-number").val('');
				jQuery("#form_card #card-hname").val('');
				jQuery("#form_card #card-type").val('');
				jQuery("#form_card #card-exp-month").val('');
				jQuery("#form_card #card-exp-year").val('');
				jQuery("#form_cardl .cardid").remove();
				
				
				jQuery("#cards-modal").modal('show');
			});
			
			jQuery(".edit-card-btn").click(function(e){
				e.preventDefault();
				var tr = jQuery(this).parents('tr');
				var id = jQuery(tr).attr('data-id');
				var exp = jQuery('td:nth-child(4)',jQuery(tr)).html();
				exparr = exp.split('/');
				jQuery("#cards-modal .modal-title").html('Update Card Info');
				jQuery("#form_card #card-number").val(jQuery('td:nth-child(1)',jQuery(tr)).html());
				jQuery("#form_card #card-hname").val(jQuery('td:nth-child(3)',jQuery(tr)).html());
				jQuery("#form_card #card-type").val(jQuery('td:nth-child(2)',jQuery(tr)).html());
				jQuery("#form_card #card-exp-month").val(exparr[0]);
				jQuery("#form_card #card-exp-year").val(exparr[1]);
				jQuery("#form_card").append('<input type="hidden" name="id" value="'+id+'" />');
				jQuery("#cards-modal ").modal('show');
				
			});
			jQuery(".delete-card-btn").click(function(e){
				e.preventDefault();
				var tr = jQuery(this).parents('tr');
				var id = jQuery(tr).attr('data-id');
				if(confirm("Are you sure to delete this card?\This action can't be undone")){
					jQuery.post(ci_base_url+'customer/delete-card',{id:id},function(resp){
						var msgtype = resp.status;
						if(resp.status == 'fail'){
							msgtype = 'danger';
						} 
						jQuery('.card-msg-wrap').html('<div class="alert alert-'+msgtype+'"> <a href="#" class="close" data-dismiss="alert">&times;</a><strong>'+msgtype.toUpperCase()+'!</strong> '+resp.msg+'  </div>');
						
						if(resp.status == 'success'){
							jQuery(tr).remove();
						}
					},'json');
				}
			});
			
			jQuery("#form_card").submit(function(e){
				e.preventDefault();
				var dis = jQuery(this);
				jQuery('button[type="submit"]',jQuery(dis)).html('Please wait...');
				jQuery.post(ci_base_url+'customer/save-card',jQuery(this).serialize(),function(resp){
					var msgtype = resp.status;
					if(resp.status == 'fail'){
						msgtype = 'danger';
					} 
					if(resp.msg != undefined){
						jQuery('.msg-wrap',jQuery(dis)).html('<div class="alert alert-'+msgtype+'"> <a href="#" class="close" data-dismiss="alert">&times;</a><strong>'+msgtype.toUpperCase()+'!</strong> '+resp.msg+'  </div>');
						jQuery('.card-msg-wrap').html('<div class="alert alert-'+msgtype+'"> <a href="#" class="close" data-dismiss="alert">&times;</a><strong>'+msgtype.toUpperCase()+'!</strong> '+resp.msg+'  </div>');
						
					} 
					
					if(resp.form_errors != undefined){
						for(var i in resp.form_errors ){
							var msg = resp.form_errors[i];
							jQuery("#"+i).popover({ title: '', placement:'right', content: msg});
							jQuery("#"+i).popover("show");
							
							jQuery(".popover-content",jQuery(dis)).html(msg).css('color','red');
							jQuery(".popover",jQuery(dis)).addClass("form");
						}
					}
					if(resp.status == 'success'){
						
					}
					jQuery('button[type="submit"]',jQuery(dis)).html('Save');
					
					
				},'json');
				
			});
			jQuery(".edit-setting-btn").click(function(e){
				e.preventDefault();
				var view_section = jQuery(this).parents('.view-section');
				var form_section = jQuery(view_section).next();
				jQuery(view_section).addClass('close');
				jQuery(form_section).addClass('open');
			});
			jQuery(".close-form-view-btn").click(function(e){
				e.preventDefault();
				var form_section  = jQuery(this).parents('.form-section');
				var view_section = jQuery(form_section).prev();
				jQuery(form_section).removeClass('open');
				jQuery(view_section).removeClass('close');
			});
			jQuery(".setting-form").submit(function(e){
				e.preventDefault();
				var dis = jQuery(this);
				jQuery('button[type="submit"]',jQuery(dis)).html('Please wait...');
				jQuery.post(ci_base_url+'customer/save-setting',jQuery(this).serialize(),function(resp){
					
					var msgtype = resp.status;
					if(resp.status == 'fail'){
						msgtype = 'error';
					} 
					if(resp.msg != undefined){
						jQuery(dis).prev('.msg-wrap').html('<div class="alert alert-'+msgtype+'"> <a href="#" class="close" data-dismiss="alert">&times;</a><strong>'+msgtype.toUpperCase()+'!</strong> '+resp.msg+'  </div>');
					} 
					if(resp.form_errors != undefined){
						for(var i in resp.form_errors ){
							var msg = resp.form_errors[i];
							//jQuery("#"+i).popover('destroy');
							
							jQuery("#"+i).popover({ title: '', placement:'right', content: msg});
							jQuery("#"+i).popover("show");
							
							jQuery(".popover-content",jQuery(dis)).html(msg).css('color','red');
							jQuery(".popover",jQuery(dis)).addClass("form");
						}
					}
					jQuery('button[type="submit"]',jQuery(dis)).html('Save');
				},'json');
				
				
				
			});
			jQuery("input,select,textarea").click(function(e){
				if(jQuery(this).next('.popover').length) { jQuery(this).next('.popover').remove(); }
			});
			jQuery("#country").change(function(e){
				jQuery("#state").html('<option> Please wait....</option>');
				var cid = jQuery(this).val();
				var sid = jQuery('#state').attr('data-val');
				jQuery.post(ci_base_url + "welcome/states-ajax",{country_id:cid}, function(resp){
					jQuery("#state").html('<option> Select One </option>');
					if(resp.status == 'success'){
						for(var i in resp.states){
							var st = resp.states[i];
							var sel = (st.code == sid)?' selected="selected" ':'';
							var optstr = '<option value="'+st.code+'" '+ sel + '>'+st.name+'</option>';
							jQuery("#state").append(optstr);
						}
					} else {
						
					}
				},'json');
			});
			jQuery("#country").trigger("change");
			
		});
	</script>

</body>
</html>
