<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php $this->load->view('part/head'); ?>
<body>
	<div class="contain_wrapper">
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
									<div class="col-sm-6">
											<?php if(isset($status) && $status == 'fail'){   ?>
													<div class="error">
														<?php echo $msg; ?>
													</div>
											<?php } ?>
											
											<?php if(isset($status) && $status == 'success'){   ?>
													<div class="success">
														<?php echo $msg; ?>
													</div>
											<?php } else { ?> 
											<form method="POST" name="form-validation" id="form-registration ">
												<?php if(isset($role) && $role){   ?>
													<input type="hidden"  name="role" value="<?php echo $role;?>" />
												<?php } ?>
												<div class="form-group">
													<label for="first_name" class="form-label col-sm-3">First Name <span class="red">*</span></label>
													<div class="col-sm-9">
														<input type="first_name" required placeholder="First Name" data-validation="[L&gt;=2, MIXED]" name="first_name" class="form-control" id="first_name" value="<?php echo set_value('first_name', ''); ?>" />
														<div class="form-input-error"><?php echo form_error('first_name'); ?></div>
													</div>
													<div class="clearfix clear"></div>
												</div>
												<div class="form-group">
													<label for="last_name" class="form-label col-sm-3">Last Name <span class="red">*</span></label>
													<div class="col-sm-9">
														<input type="last_name" required placeholder="Last Name" data-validation="[L&gt;=2, MIXED]" name="last_name" class="form-control" id="last_name" value="<?php echo set_value('last_name', ''); ?>" />
														<div class="form-input-error"><?php echo form_error('last_name'); ?></div>
													</div>
													<div class="clearfix clear"></div>
												</div>
												
												
												<div class="form-group">
													<label for="email" class="form-label col-sm-3">Email <span class="red">*</span></label>
													<div class="col-sm-9">
														<input type="email" required placeholder="Email" data-validation="[EMAIL]" name="email" class="form-control" id="email" value="<?php echo set_value('email', ''); ?>" />
														<div class="form-input-error"><?php echo form_error('email'); ?></div>
													</div>
													<div class="clearfix clear"></div>
												</div>
												<div class="form-group">
													<label for="username" class="form-label col-sm-3">Username <span class="red">*</span></label>
													<div class="col-sm-9">
														<input type="text" required placeholder="Username"  data-validation-message="$ must be between 6 and 18 characters. No special characters allowed." data-validation="[L&gt;=4, L&lt;=18, MIXED]" name="username" class="form-control" id="username" value="<?php echo set_value('username', ''); ?>" />
														<div class="form-input-error"><?php echo form_error('username'); ?></div>
													</div>
													<div class="clearfix clear"></div>
												</div>
												<div class="form-group">
													<label for="password" class="form-label col-sm-3">Password <span class="red">*</span></label>
													<div class="col-sm-9">
														<input type="password" required placeholder="Password" data-validation-message="$ must be at least 6 characters" data-validation="[L&gt;=6]" name="password" class="form-control" id="password">
														<div class="form-input-error"><?php echo form_error('password'); ?></div>
													</div>
												</div>
												<div class="form-group">
													<label for="confirm_password" class="form-label col-sm-3">Confirm Password <span class="red">*</span></label>
													<div class="col-sm-9">
														<input type="password" required placeholder="Confirm Password" data-validation-message="$ does not match the password" data-validation="[V==validation[password]]" name="confirm_password" class="form-control" id="confirm_password">
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
									<div class="col-sm-6">
										<?php echo bybridauth_links();?>
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
</body>
</html>





