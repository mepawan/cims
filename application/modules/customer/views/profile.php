<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php 
	if($profile) { $languages = explode(',', $profile['languages']); }
	if($profile) { $area_of_experience = explode(',', $profile['area_of_experience']); }
	if($profile) { $availabe_days_time = explode(',', $profile['availabe_days_time']); }
	if($profile) { $video_calling_feature = explode(',', $profile['video_calling_feature']); }
?>
<?php $this->load->view('part/head'); ?>
<body>
	<div class="contain_wrapper">
		<?php $this->load->view('part/header'); ?>
		
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
							</div>
							<section id="provider-details">
								<div class="col-md-2">
									<?php $this->load->view('part/user_left'); ?>
								</div>
								<div class="col-md-10">
									<?php $this->load->view('part/user_top'); ?>
								
								<?php if(isset($status) && $status == 'fail'){   ?>
										<div class="error">
											<?php echo $msg; ?>
										</div>
								<?php } ?>
								
								<?php if(isset($status) && $status == 'success'){   ?>
										<div class="success">
											<?php echo $msg; ?>
										</div>
								<?php }  ?> 
								<form method="POST" name="form-validation" id="provider-registration" enctype="multipart/form-data">
									
									<div id="top_move" class="btt">
										<p>Edit Profile</p>
									</div>
									<div class="form-group col-md-6">
										<label for="username" class="form-label col-sm-4">User Name<span class="red">*</span></label>
										<div class="col-sm-8">
											<input type="text" readonly  name="username" class="" id="username" value="<?php echo $user['username']; ?>"  />
											
										</div>
									</div>
									<div class="form-group col-md-6">
										<label for="created_date_time" class="form-label col-sm-4">Date Registered<span class="red">*</span></label>
										<div class="col-sm-8">
											<input type="text" readonly  name="created_date_time" class="" id="created_date_time" value="<?php echo $user['created_date_time']; ?>"  />
											
										</div>
									</div>
									<div class="form-group col-md-6">
										<label for="status" class="form-label col-sm-4">Profile Status<span class="red">*</span></label>
										<div class="col-sm-8">
											<input type="text" readonly name="status" class="" id="status" value="<?php echo $user['status']; ?>"  />
											
										</div>
									</div>
									<div class="form-group col-md-6">
										<label for="email" class="form-label col-sm-4">Email<span class="red">*</span></label>
										<div class="col-sm-8">
											<input type="email" readonly name="email" class="" id="email"  value="<?php echo $user['email']; ?>" />
											
										</div>
									</div>
									<div class="clearfix clear"></div>
									<div id="top_move" class="btt">
										<p>Persnol Details</p>
									</div>
									
									<div class="form-group col-md-6">
										<label for="first_name" class="form-label col-sm-4">First Name<span class="red">*</span></label>
										<div class="col-sm-8">
											<input type="text" required placeholder="First Name" name="first_name" class="" id="first_name" value="<?php echo $user['first_name']; ?>"  />
											
										</div>
									</div>
									<div class="form-group col-md-6">
										<label for="last_name" class="form-label col-sm-4">Last Name<span class="red">*</span></label>
										<div class="col-sm-8">
											<input type="text" required placeholder="Last Name" name="last_name" class="" id="last_name" value="<?php echo $user['last_name']; ?>" />
											
										</div>
									</div>
									
									<div class="form-group col-md-6">
										<label for="address" class="form-label col-sm-4">Billing_Address</label>
										<div class="col-sm-8">
											<input type="text"  placeholder="Billing Address" name="address" class="" id="address" value="<?php echo $user['address']; ?>" />
											
										</div>
									</div>
									<div class="form-group col-md-6">
										<label for="city" class="form-label col-sm-4">City</label>
										<div class="col-sm-8">
											<input type="text"  placeholder="City" name="city" class="" id="city" value="<?php echo $user['city']; ?>"  />
											
										</div>
									</div>
									<div class="form-group col-md-6">
										<label for="country" class="form-label col-sm-4">Country </label>
										<div  class="col-sm-8">
											<select id="country" name="country" >
												<option value="">-Select-</option>
												<?php 
													foreach($countries as $c){
														echo '<option value="'.$c["iso_code_2"].'">'.$c["name"].'</option>';
													}
												?>
											</select>
										</div>
									</div>
									<div class="form-group col-md-6">
										<label for="state" class="form-label col-sm-4">State</label>
										<div  class="col-sm-8">
											<select id="state" name="state" >
												<option value="">Select One</option>
												
											</select>
										</div>
									</div>
									<div class="form-group col-md-6">
										<label for="zipcode" class="form-label col-sm-4">Zip_Code </label>
										<div class="col-sm-8">
											<input type="text"  placeholder="Zip Code" name="zipcode" class="" id="zipcode" value="<?php echo $user['zipcode']; ?>" />
											
										</div>
									</div>
									
									<div class="form-group col-md-6">
										<label for="phone" class="form-label col-sm-4">Phone_Number</label>
										<div class="col-sm-8">
											<input type="text" placeholder="Phone Number" name="phone" class="" id="phone" value="<?php echo $user['phone']; ?>" />
											
										</div>
									</div>
									<div class="form-group col-md-12">
										<label for="bio" class="form-label col-sm-1">Bio</label>
										<div class="col-sm-11">
											<textarea placeholder="Bio" name="bio" class="" id="bio" rows="5" /><?php echo $user['bio']; ?></textarea>
											
										</div>
									</div>
									
									
									
									
									<div class="form-group ">
										<label for="confirm_password" class="form-label col-sm-3"></label>
										<div class="col-sm-12">
											<?php echo recaptcha_form();?>
											<div class="form-input-error"><?php echo form_error('g-recaptcha-response'); ?></div>
										</div>
									</div>
									<div class="form-actions text-center col-md-12">
										<button class="btn btn-primary width-150" type="submit">Register</button>
									</div>
								</form>
								
							</div>
							</section>
						</div>
					</div>
				</section>
			</main>
		</div>
		<?php $this->load->view('part/footer'); ?>
	</div>
	<script type="text/javascript">
		jQuery(document).ready(function(){
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
