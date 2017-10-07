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
															<form method="post" action="#" name="form-validation" class="setting-form" id="form_personal_info" enctype="multipart/form-data">
																<div class="form-group">
																	<label for="first_name" class="form-label col-sm-4">First Name<span class="red">*</span></label>
																	<div class="col-sm-8">
																		<input type="text"  name="first_name" class="" id="first_name" value="<?php echo $user['first_name']; ?>"  />
																	</div>
																</div>
																<div class="form-group">
																	<label for="last_name" class="form-label col-sm-4">Last Name<span class="red">*</span></label>
																	<div class="col-sm-8">
																		<input type="text"  name="last_name" class="" id="last_name" value="<?php echo $user['last_name']; ?>"  />
																	</div>
																</div>
																<div class="form-group">
																	<label for="email" class="form-label col-sm-4">Email<span class="red">*</span></label>
																	<div class="col-sm-8">
																		<input type="email"  name="email" class="" id="email" value="<?php echo $user['email']; ?>"  />
																	</div>
																</div>
																<div class="form-group">
																	<label for="username" class="form-label col-sm-4">Username<span class="red">*</span></label>
																	<div class="col-sm-8">
																		<input type="text"  name="username" class="" id="username" value="<?php echo $user['username']; ?>"  />
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
															<form method="post" action="#" name="form-validation" class="setting-form" id="form_personal_info" enctype="multipart/form-data">
																<div class="form-group">
																	<label for="password" class="form-label col-sm-4">New Password<span class="red">*</span></label>
																	<div class="col-sm-8">
																		<input type="password"  name="password" class="" id="password" value=""  />
																	</div>
																</div>
																<div class="form-group">
																	<label for="confirm_password" class="form-label col-sm-4">Confirm Password<span class="red">*</span></label>
																	<div class="col-sm-8">
																		<input type="confirm_password"  name="confirm_password" class="" id="confirm_password" value=""  />
																	</div>
																</div>
																<div class="form-group">
																	<label for="email" class="form-label col-sm-4">Email<span class="red">*</span></label>
																	<div class="col-sm-8">
																		<input type="email"  name="email" class="" id="email" value="<?php echo $user['email']; ?>"  />
																	</div>
																</div>
																<div class="form-group">
																	<label for="username" class="form-label col-sm-4">Username<span class="red">*</span></label>
																	<div class="col-sm-8">
																		<input type="text"  name="username" class="" id="username" value="<?php echo $user['username']; ?>"  />
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
				jQuery.post(ci_base_url+'customer/save-setting',jQuery(this).serialize(),function(e){
					
				},'json');
				
				
				
			});
		});
	</script>

</body>
</html>
