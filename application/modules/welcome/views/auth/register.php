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
										<h2 class="title_s"> <?php echo $heading; ?></h2>
									</span>
								<?php } ?>
								<div id="top_move" class="btt">
									<div class="col-sm-6 col-sm-offset-3">
											<div class="error">
												<?php 	echo $this->ciauth->get_auth_error();
														if(isset($recaptcha_error) && $recaptcha_error){ echo $recaptcha_error; }
														if(isset($error) && $recaptcha_error){ echo $error; }
												 ?>
											</div>
											<?php if(isset($success) && $success){   ?>
													<div class="success">
														<?php echo $success; ?>
													</div>
											<?php } else { ?> 
											<form method="POST" name="form-validation" id="form-validation">
												<div class="form-group">
													<label for="first_name" class="form-label">First Name</label>
													<input type="first_name" required placeholder="First Name" data-validation="[L&gt;=2, MIXED]" name="first_name" class="form-control" id="first_name" value="<?php echo set_value('first_name', ''); ?>" />
													<div class="form-input-error"><?php echo form_error('first_name'); ?></div>
												</div>
												<div class="form-group">
													<label for="last_name" class="form-label">Last Name</label>
													<input type="last_name" required placeholder="Last Name" data-validation="[L&gt;=2, MIXED]" name="last_name" class="form-control" id="last_name" value="<?php echo set_value('last_name', ''); ?>" />
													<div class="form-input-error"><?php echo form_error('last_name'); ?></div>
												</div>
												
												
												<div class="form-group">
													<label for="email" class="form-label">Email</label>
													<input type="email" required placeholder="Email" data-validation="[EMAIL]" name="email" class="form-control" id="email" value="<?php echo set_value('email', ''); ?>" />
													<div class="form-input-error"><?php echo form_error('email'); ?></div>
												</div>
												<div class="form-group">
													<label for="username" class="form-label">Username</label>
													<input type="text" required placeholder="Username"  data-validation-message="$ must be between 6 and 18 characters. No special characters allowed." data-validation="[L&gt;=4, L&lt;=18, MIXED]" name="username" class="form-control" id="username" value="<?php echo set_value('username', ''); ?>" />
													<div class="form-input-error"><?php echo form_error('username'); ?></div>
												</div>
												<div class="form-group">
													<label for="password" class="form-label">Password</label>
													<input type="password" required placeholder="Password" data-validation-message="$ must be at least 6 characters" data-validation="[L&gt;=6]" name="password" class="form-control" id="password">
													<div class="form-input-error"><?php echo form_error('password'); ?></div>
												</div>
												<div class="form-group">
													<label for="confirm_password" class="form-label">Confirm Password</label>
													<input type="password" required placeholder="Confirm Password" data-validation-message="$ does not match the password" data-validation="[V==validation[password]]" name="confirm_password" class="form-control" id="confirm_password">
													<div class="form-input-error"><?php echo form_error('confirm_password'); ?></div>
												</div>
												<div class="form-group">
													<?php echo recaptcha_form();?>
													<div class="form-input-error"><?php echo form_error('g-recaptcha-response'); ?></div>
												</div>
												
												<div class="form-actions text-center">
													<button class="btn btn-primary width-150" type="submit">Sign Up</button>
												</div>
											</form>
										<?php } ?>
									</div>
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





