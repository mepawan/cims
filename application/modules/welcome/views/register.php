<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style><?php print_r($page[0]['content_css']); ?></style>
<?php $this->load->view('head'); ?>
<body>
	<div class="contain_wrapper">
		<?php $this->load->view('header'); ?>
		
		<div class="wrapper">
			<section class="inner_con">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						
						<div class="signup-error"><?php echo validation_errors(); ?></div>
						<h3 class="text-center">
							<i class="icmn-lock3 margin-right-10"></i>
							Register
						</h3>
						<form id="signup-form" name="form-validation" method="POST" action="/handsacross/register">
							<div class="form-group">
								<input id="validation-username" class="form-control" placeholder="Username"  name="username" type="text" >
							</div>
							<div class="form-group">
								<input id="validation-first_name" class="form-control" placeholder="First Name"  name="first_name" type="text" >
							</div>
							<div class="form-group">
								<input id="validation-last_name" class="form-control" placeholder="Last Name"  name="last_name" type="text" >
							</div>
							<div class="form-group">
								<input id="validation-email" class="form-control" placeholder="Email"  name="email" type="text" >
							</div>
							<div class="form-group">
								<input id="validation-password" class="form-control" placeholder="Password"  name="password" type="password" >
							</div>
							<div class="form-group">
								<input id="validation-confirm-pass" class="form-control" placeholder="Confirm Password"  name="confirm_password" type="password" >
							</div>
							<div class="form-actions">
								<input type="submit" class="btn btn-primary width-150" value="Sign Up">
							</div>
						</form>
					</div>
				</div>
			</div>
			</section>
		</div>
		
		<?php $this->load->view('footer'); ?>
	</div>


</body>
</html>
