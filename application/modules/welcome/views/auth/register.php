<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php $this->load->view('head'); ?>
<body>
	<div class="contain_wrapper">
		<?php $this->load->view('header'); ?>
		
		<?php print_r($page[0]['content']); ?>
  
		<div class="wrapper">
			<main class="background_container">
				<section class="general-message ands_work">
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
														
														echo form_error('password');
														echo form_error('g-recaptcha-response');
														if(isset($recaptcha_error) && $recaptcha_error){ echo $recaptcha_error; }
														if(isset($error) && $recaptcha_error){ echo $error; }
												 ?>
											</div>
										
										
											<form method="POST" name="form-validation" id="form-validation">
												<div class="form-group">
													<label for="email" class="form-label">Email</label>
													<input type="email" required placeholder="Email" data-validation="[EMAIL]" name="email" class="form-control" id="email">
													<div class="error"><?php echo form_error('email'); ?></div>
												</div>
												<div class="form-group">
													<label for="username" class="form-label">Username</label>
													<input type="text" required placeholder="Username"  data-validation-message="$ must be between 6 and 18 characters. No special characters allowed." data-validation="[L&gt;=6, L&lt;=18, MIXED]" name="username" class="form-control" id="username">
													<div class="error"><?php echo form_error('username'); ?></div>
												</div>
												<div class="form-group">
													<label for="password" class="form-label">Password</label>
													<input type="password" required placeholder="Password" data-validation-message="$ must be at least 6 characters" data-validation="[L&gt;=6]" name="password" class="form-control" id="password">
													<div class="error"><?php echo form_error('username'); ?></div>
												</div>
												<div class="form-group">
													<label for="confirm_password" class="form-label">Confirm Password</label>
													<input type="password" required placeholder="Confirm Password" data-validation-message="$ does not match the password" data-validation="[V==validation[password]]" name="confirm_password" class="form-control" id="confirm_password">
												</div>
												<div class="form-group">
													<?php echo recaptcha_form();?>
												</div>
												
												<div class="form-actions text-center">
													<button class="btn btn-primary width-150" type="submit">Sign Up</button>
												</div>
											</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
			</main>
		</div>
		<?php $this->load->view('footer'); ?>
	</div>

<style>
	form{text-align:left;}
</style>
</body>
</html>





