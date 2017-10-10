<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php $this->load->view('part/head'); ?>
<body>
	<div class="contain_wrapper sign-up">
		<?php $this->load->view('part/header'); ?>
		
		<?php print_r($page[0]['content']); ?>
  
		<div class="wrapper">
			<main class="background_container">
				<section class="content-section">
					<div class="container">
						<div class="row">
							<div class="col-md-12 <?php if(isset($msg_type) && $msg_type){ echo $msg_type; }?>" >
								<?php if(isset($heading) && $heading){ ?>
									<span id="mm_title">
										<h2 class="title_s"> <?php echo $heading; if(isset($role) && $role){ echo ' as ' . ucwords($role); }?></h2>
									</span>
								<?php } ?>
								<div id="top_move" class="btt">
									
									<div class="col-sm-6 reg-wrap">
										<h3> <?php if(isset($role) && $role){ echo ucfirst($role); } ?> Registration <?php 
												if(isset($role) && $role == 'customer'){
													echo '<a class="btn btn-primary pull-right" href="'.ci_base_url().'auth/register/provider">Become Provider</a>';
												} else {
													echo '<a class="btn btn-primary pull-right" href="'.ci_base_url().'auth/register">Customer Registration</a>';
												}

											?><div class="clearfix clear"></div>
										</h3>
											
											
											<?php if(isset($status) && $status == 'success'){   ?>
													<div class="success">
														<?php echo $msg; ?>
													</div>
											<?php } else { ?> 
											<div class="social-login"><?php echo bybridauth_links();?></div>
											<div class="l-login-padding login-big-or horizontal-or">
												<div class="t-middle-line">
												   <div class="login-big-or-circle"></div>
												</div>
											 </div>
											<form method="POST" name="form-validation" id="form-registration ">
											
												<?php if(isset($status) && $status == 'fail'){   ?>
													<div class="form-group">
														<div class="error">
															<?php echo $msg; ?>
														</div>
													</div>
												<?php } ?>
											
												<?php if(isset($role) && $role){   ?>
													<input type="hidden"  name="role" value="<?php echo $role;?>" />
												<?php } ?>
												<div class="form-group">
													<label for="first_name" class="form-label col-sm-3">First Name <span class="red">*</span></label>
													<div class="col-sm-9">
														<input type="text" required placeholder="First Name" data-validation="[L&gt;=2, MIXED]" name="first_name" class="" id="first_name" value="<?php echo set_value('first_name', ''); ?>" />
														<div class="form-input-error"><?php echo form_error('first_name'); ?></div>
													</div>
													<div class="clearfix clear"></div>
												</div>
												<div class="form-group">
													<label for="last_name" class="form-label col-sm-3">Last Name <span class="red">*</span></label>
													<div class="col-sm-9">
														<input type="text" required placeholder="Last Name" data-validation="[L&gt;=2, MIXED]" name="last_name" class="" id="last_name" value="<?php echo set_value('last_name', ''); ?>" />
														<div class="form-input-error"><?php echo form_error('last_name'); ?></div>
													</div>
													<div class="clearfix clear"></div>
												</div>
												
												
												<div class="form-group">
													<label for="email" class="form-label col-sm-3">Email <span class="red">*</span></label>
													<div class="col-sm-9">
														<input type="email" required placeholder="Email" data-validation="[EMAIL]" name="email" class="" id="email" value="<?php echo set_value('email', ''); ?>" />
														<div class="form-input-error"><?php echo form_error('email'); ?></div>
													</div>
													<div class="clearfix clear"></div>
												</div>
												<div class="form-group">
													<label for="username" class="form-label col-sm-3">Username <span class="red">*</span></label>
													<div class="col-sm-9">
														<input type="text" required placeholder="Username"  data-validation-message="$ must be between 6 and 18 characters. No special characters allowed." data-validation="[L&gt;=4, L&lt;=18, MIXED]" name="username" class="" id="username" value="<?php echo set_value('username', ''); ?>" />
														<div class="form-input-error"><?php echo form_error('username'); ?></div>
													</div>
													<div class="clearfix clear"></div>
												</div>
												<div class="form-group">
													<label for="password" class="form-label col-sm-3">Password <span class="red">*</span></label>
													<div class="col-sm-9">
														<input type="password" required placeholder="Password" data-validation-message="$ must be at least 6 characters" data-validation="[L&gt;=6]" name="password" class="" id="password">
														<div class="form-input-error"><?php echo form_error('password'); ?></div>
													</div>
												</div>
												<div class="form-group">
													<label for="confirm_password" class="form-label col-sm-3">Confirm Password <span class="red">*</span></label>
													<div class="col-sm-9">
														<input type="password" required placeholder="Confirm Password" data-validation-message="$ does not match the password" data-validation="[V==validation[password]]" name="confirm_password" class="" id="confirm_password">
														<div class="form-input-error"><?php echo form_error('confirm_password'); ?></div>
													</div>
													<div class="clearfix clear"></div>
												</div>
												<div class="form-group">
													<label for="confirm_password" class="form-label col-sm-3"></label>
													<div class="col-sm-9">
														<?php echo recaptcha_form();?>
														<div class="form-input-error"><?php echo form_error('g-recaptcha-response'); ?></div>
													</div>
													<div class="clearfix clear"></div>
												</div>
												
												<div class="form-actions text-center">
													<button class="btn btn-primary width-150" type="submit">Sign Up</button>
												</div>
											</form>
										<?php } ?>
									</div>
									<div class="col-sm-6 login-wrap">
										<h3> <?php if(isset($role) && $role){ echo ucfirst($role); } ?> Login <?php 
												if(isset($role) && $role == 'customer'){
													echo '<a class="btn btn-primary pull-right" href="'.ci_base_url().'auth/register/provider">Login As Provider</a>';
												} else {
													echo '<a class="btn btn-primary pull-right" href="'.ci_base_url().'auth/register">Login As Customer</a>';
												}

											?><div class="clearfix clear"></div>
										</h3>
										<div class="social-login"><?php echo bybridauth_links();?></div>
										<div class="l-login-padding login-big-or horizontal-or">
											<div class="t-middle-line">
											   <div class="login-big-or-circle"></div>
											</div>
										 </div>
										 
										<form id="frm-main-login" action="#" method="post">
											<input required="required" name="loginkey" type="text" placeholder="Username/Email/Phone">
											<input required="required" name="password" type="password" placeholder="Password">
											<div class="form-actions text-center">
												<input name="submit" class="btn btn-primary" type="submit" value="login">
											</div>
										</form>
									
									</div>
									<div class="clearfix clear"></div>
								</div>
							</div>
						</div>
					</div>
				</section>
			</main>
		</div>
		<?php $this->load->view('part/footer'); ?>
	</div>

<style>
	form{text-align:left;}
</style>
<script>
	jQuery(document).ready(function(e){
		var rh = jQuery(".reg-wrap").height();
		var lh = jQuery(".login-wrap").height();
		console.log(rh);
		console.log(lh);
		if(lh < rh){
			jQuery(".login-wrap").height(rh);
		} else {
			jQuery(".reg-wrap").height(lh);
		}
		
		
	});
</script>
</body>
</html>





