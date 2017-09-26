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
									<p>Provider</p>
								</div>
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
								<form method="POST" name="form-validation" id="provider-registration">
									<div class="form-group col-md-6">
										<label for="created_date_time" class="form-label col-sm-4">Date Registered<span class="red">*</span></label>
										<div class="col-sm-8">
											<input type="text" required placeholder="Date Registered [dd-mm-yyyy]" name="created_date_time" class="form-control" id="created_date_time"  />
											
										</div>
										<div class="clearfix clear"></div>
									</div>
									<div class="form-group col-md-6">
										<label for="status" class="form-label col-sm-4">Profile Status<span class="red">*</span></label>
										<div  class="col-sm-8">
											<select name="status" required="required">
												<option value="usa">Pending</option>
												<option value="canada">Active</option>
												<option value="usa">Suspend</option>
											</select>
										</div>
										<div class="clearfix clear"></div>
									</div>
									<div class="form-group col-md-6">
										<label for="email" class="form-label col-sm-4">Email<span class="red">*</span></label>
										<div class="col-sm-8">
											<input type="text" required placeholder="Email" name="email" class="form-control" id="email"  />
											
										</div>
										<div class="clearfix clear"></div>
									</div>
									<div class="form-group col-md-6">
										<label for="bio" class="form-label col-sm-4">Bio<span class="red">*</span></label>
										<div class="col-sm-8">
											<textarea required placeholder="Bio" name="bio" class="form-control" id="bio"  /></textarea>
											
										</div>
										<div class="clearfix clear"></div>
									</div>
									<div class="form-group col-md-6">
										<label for="first_name" class="form-label col-sm-4">First Name<span class="red">*</span></label>
										<div class="col-sm-8">
											<input type="text" required placeholder="First Name" name="first_name" class="form-control" id="first_name"  />
											
										</div>
										<div class="clearfix clear"></div>
									</div>
									<div class="form-group col-md-6">
										<label for="last_name" class="form-label col-sm-4">Last Name<span class="red">*</span></label>
										<div class="col-sm-8">
											<input type="text" required placeholder="Last Name" name="last_name" class="form-control" id="last_name"  />
											
										</div>
										<div class="clearfix clear"></div>
									</div>
									
									<div class="form-group col-md-6">
										<label for="address" class="form-label col-sm-4">Billing_Address<span class="red">*</span></label>
										<div class="col-sm-8">
											<input type="text" required placeholder="Billing Address" name="address" class="form-control" id="address"  />
											
										</div>
										<div class="clearfix clear"></div>
									</div>
									<div class="form-group col-md-6">
										<label for="city" class="form-label col-sm-4">City<span class="red">*</span></label>
										<div class="col-sm-8">
											<input type="text" required placeholder="City" name="city" class="form-control" id="city"  />
											
										</div>
										<div class="clearfix clear"></div>
									</div>
									<div class="form-group col-md-6">
										<label for="state" class="form-label col-sm-4">State<span class="red">*</span></label>
										<div  class="col-sm-8">
											<select name="state" required="required">
												<option value="">-Select-</option>
												<option value="state1">state1</option>
												<option value="state2">state2</option>
											</select>
										</div>
										<div class="clearfix clear"></div>
									</div>
									<div class="form-group col-md-6">
										<label for="zipcode" class="form-label col-sm-4">Zip_Code<span class="red">*</span></label>
										<div class="col-sm-8">
											<input type="text" required placeholder="Zip Code" name="zipcode" class="form-control" id="zipcode"  />
											
										</div>
										<div class="clearfix clear"></div>
									</div>
									<div class="form-group col-md-6">
										<label for="country" class="form-label col-sm-4">Country<span class="red">*</span></label>
										<div  class="col-sm-8">
											<select name="country" required="required">
												<option value="">-Select-</option>
												<option value="usa">USA</option>
												<option value="canada">Canada</option>
											</select>
										</div>
										<div class="clearfix clear"></div>
									</div>
									<div class="form-group col-md-6">
										<label for="phone" class="form-label col-sm-4">Phone_Number<span class="red">*</span></label>
										<div class="col-sm-8">
											<input type="text" required placeholder="Phone Number" name="phone" class="form-control" id="phone"  />
											
										</div>
										<div class="clearfix clear"></div>
									</div>
									
									<div class="form-group col-md-6">
										<label for="have_license_certification" class="form-label col-sm-4">Do you have any Licenses or Certifications?<span class="red">*</span></label>
										<div  class="col-sm-8">
											<select name="profile[have_license_certification]" required="required">
												<option value="">-Select-</option>
												<option value="yes">Yes</option>
												<option value="no">No</option>
											</select>
										</div>
										<div class="clearfix clear"></div>
									</div>
									<div class="form-group col-md-6">
										<label for="license_certification_name" class="form-label col-sm-4">Certifications/License Number</label>
										<div class="col-sm-8">
											<input type="text" placeholder="Certifications/License Number" name="profile[license_certification_name]" class="form-control" id="license_certification_name"  />
											
										</div>
										<div class="clearfix clear"></div>
									</div>
									<div class="form-group col-md-6">
										<label for="license_certification_number" class="form-label col-sm-4">Certifications or License Name</label>
										<div class="col-sm-8">
											<input type="text" placeholder="Certifications or License Name" name="profile[license_certification_number]" class="form-control" id="license_certification_number"  />
											
										</div>
										<div class="clearfix clear"></div>
									</div>
									<div class="form-group col-md-6">
										<label for="state_of_license_certification" class="form-label col-sm-4">State or county of License/Certifications</label>
										<div class="col-sm-8">
											<input type="text" placeholder="State or county of License/Certifications" name="profile[state_of_license_certification]" class="form-control" id="state_of_license_certification"  />
											
										</div>
										<div class="clearfix clear"></div>
									</div>
									<div class="form-group col-md-6">
										<label for="have_license_certification" class="form-label col-sm-4">Languages Spoken<span class="red">*</span></label>
										<div  class="col-sm-8">
											<select name="profile[languages]" multiple required>
											  <option value="akan">Akan</option>
											  <option value="amharic">Amharic</option>
											  <option value="arabic">Arabic</option>
											  <option value="assamese">Assamese</option>
											</select>
										</div>
										<div class="clearfix clear"></div>
									</div>
									<div class="form-group col-md-6">
										<label for="resume" class="form-label col-sm-4">Resume</label>
										<div class="col-sm-8">
											<input type="file" name="profile[resume]" class="form-control" id="resume"  />
										</div>
										<div class="clearfix clear"></div>
									</div>
									<div class="form-group col-md-6">
										<label for="area_of_experience" class="form-label col-sm-4">Area of Experience<span class="red">*</span></label>
										<div  class="col-sm-8">
											<select name="profile[area_of_experience]" multiple required>
											  <option value="ability">Ability to work under pressure</option>
											  <option value="adaptability">Adaptability</option>
											  <option value="administering">Administering medication</option>
											  <option value="advising">Advising people</option>
											</select>
										</div>
										<div class="clearfix clear"></div>
									</div>
									<div class="form-group col-md-6">
										<label for="education" class="form-label col-sm-4">Education</label>
										<div  class="col-sm-8">
											<select name="profile[education]">
											  <option value="">-Select-</option>
											  <option value="education1">education1</option>
											  <option value="education2">education2</option>
											  <option value="education3">education3</option>
											  <option value="education4">education4</option>
											</select>
										</div>
										<div class="clearfix clear"></div>
									</div>
									<div class="form-group col-md-6">
										<label for="area_of_experience_other" class="form-label col-sm-4">Area of Experience other</label>
										<div class="col-sm-8">
											<input type="text" placeholder="Area of Experience other" name="profile[area_of_experience_other]" class="form-control" id="area_of_experience_other"  />
										</div>
										<div class="clearfix clear"></div>
									</div>
									<div class="form-group col-md-6">
										<label for="years_of_experience" class="form-label col-sm-4">Number of Years of Experience<span class="red">*</span></label>
										<div class="col-sm-8">
											<input type="text" required placeholder="Number of Years of Experience" name="profile[years_of_experience]" class="form-control" id="years_of_experience"  />
										</div>
										<div class="clearfix clear"></div>
									</div>
									<div class="form-group col-md-6">
										<label for="availabe_days_time" class="form-label col-sm-4">Days and Times you are available<span class="red">*</span></label>
										<div  class="col-sm-8">
											<select name="profile[availabe_days_time]" multiple required>
											  <option value="Sunday_12AM_2AM">Sunday 12 AM - 2 AM</option>
											  <option value="Sunday_2AM_4AM">Sunday 2 AM - 4 AM</option>
											  <option value="Sunday_4AM_6AM">Sunday 4 AM - 6 AM</option>
											  <option value="Sunday_6AM_8AM">Sunday 6 AM - 8 AM</option>
											</select>
										</div>
										<div class="clearfix clear"></div>
									</div>
									<div class="form-group col-md-6">
										<label for="pictures_of_work" class="form-label col-sm-4">Pictures of Work</label>
										<div class="col-sm-8">
											<input type="file" name="profile[pictures_of_work]" class="form-control" id="pictures_of_work"  />
										</div>
										<div class="clearfix clear"></div>
									</div>
									<div class="form-group col-md-6">
										<label for="video_calling_feature" class="form-label col-sm-4">What video calling feature do you use?<span class="red">*</span></label>
										<div  class="col-sm-8">
											<select name="profile[video_calling_feature]" multiple required>
											  <option value="facetime">Face Time</option>
											  <option value="tango">Tango</option>
											  <option value="skype">Skype</option>
											  <option value="android_video_calling">Android Video Calling</option>
											</select>
										</div>
										<div class="clearfix clear"></div>
									</div>
									<div class="form-group col-md-6">
										<label for="video_calling_feature_other" class="form-label col-sm-4">Video Calling Feature Other</label>
										<div class="col-sm-8">
											<input type="text" placeholder="Video Calling Feature Other" name="profile[video_calling_feature_other]" class="form-control" id="video_calling_feature_other"  />
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
									<div class="form-actions text-center col-md-12">
										<button class="btn btn-primary width-150" type="submit">Register</button>
									</div>
								</form>
								<?php } ?>
							</div>
						</div>
					</div>
				</section>
			</main>
		</div>
		<?php $this->load->view('part/footer'); ?>
	</div>


</body>
</html>
