<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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

							<section id="setting-wrap">
								<div class="col-md-2">
									<?php $this->load->view('part/user_left'); ?>
								</div>
								<div class="col-md-10">
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
													<h3> Address </h3>
												</div>
												<div class="col-md-8 right ">
													<div class="view-section">
														<div class="col-md-10">
															<label class="view-item"> <?php echo $user['address'] ; ?> </label>
															<label class="view-item"> <?php echo $user['city']; ?> </label>
															<label class="view-item"> <?php echo $user['state'] ; ?> </label>
															<label class="view-item"> <?php echo $user['country'] ; ?> </label>
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
																					echo '<option value="'.$c["iso_code_2"].'">'.$c["name"].'</option>';
																				}
																			?>
																		</select>
																		<div class="clearfix clear"></div>
																	</div>
																</div>
																<div class="form-group">
																	<label for="state" class="form-label col-sm-4">State  </label>
																	<div class="col-sm-8">
																		<select  name="state" class="" id="state">
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
																	<button class="btn btn-warning width-150 close-form-view-btn" type="button">Cancel</button>
																</div>
															</form>
														</div>
														<div class="col-md-2"></div>
													</div>
												</div>
												<div class="clearfix clear"></div>
											</div>
											
											
											
										</div>
									
									
								</div>
								<div class="clearfix clear"></div>
							</section>
							
						</div>
					</div>
				</section>
			</main>
		</div>
		<?php $this->load->view('part/footer'); ?>
	</div>
	<script>
		jQuery(document).ready(function(e){
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
				jQuery.post(ci_base_url + "welcome/states-ajax",{country_id:cid}, function(resp){
					jQuery("#state").html('<option> Select One </option>');
					if(resp.status == 'success'){
						for(var i in resp.states){
							var st = resp.states[i];
							jQuery("#state").append('<option value="'+st.code+'">'+st.name+'</option>');
						}
					} else {
						
					}
				},'json');
			});
			
			
		});
	</script>

</body>
</html>
