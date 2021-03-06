<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$this->load->view('part/head'); 

	if($user_profile) { $languages = explode(',', $user_profile['languages']); }
	if($user_profile) { $area_of_experience = explode(',', $user_profile['area_of_experience']); }
	if($user_profile) { $availabe_days_time = explode(',', $user_profile['availabe_days_time']); }
	if($user_profile) { $preferred_contact_method = explode(',', $user_profile['preferred_contact_method']); }
	if($user_profile) { $work_samples = ($user_profile['work_samples']) ? explode(',', $user_profile['work_samples']) : ''; }

?>
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
													<h3> Profile Picture </h3>
												</div>
												<div class="col-md-8 right ">
													<div class="view-section">
														<div class="col-md-10">
															<label class="view-item"> 
																<?php
																	$pic = ( $user['profile_pic'] ) ? $user['profile_pic'] : ci_base_url . 'public/upload/default_profile_pic.png';
																	
																?>
																<img class="profilepic" style="max-width:80px;" id="profilepic" src="<?php echo $pic;?>" />
															</label>
														</div>
														<div class="col-md-2">
															<a class="edit-setting-btn" href="javascript:void(0);"> Edit </a>
														</div>
														<div class="clearfix clear"></div>
													</div>
													<div class="form-section">
														<div class="col-md-10">
															<span class="msg-wrap"></span>
															<form method="post" action="#" name="form-validation" class="setting-form" id="form_profile_pic" enctype="multipart/form-data">
																
																<div class="form-group">
																	<label for="profile_pic" class="form-label col-sm-4">Upload Picture<span class="red">*</span></label>
																	<div class="col-sm-8">
																		<input required type="file"  name="profile_pic" class="" id="profile_pic" value=""  />
																	</div>
																</div>
																<div class="form-group">
																	<div class="col-sm-8">
																		<img class="profilepic" style="max-width:80px;margin: 10px;" id="profilepic2" src="<?php echo $pic;?>" />
																	</div>
																</div>
																<div class="form-group text-center">
																	<button class="btn btn-primary width-150" type="submit">Upload</button>
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
																if(isset($user_profile)){
																	echo '<label class="view-item"> '.$user_profile['paypal_email'].'</label>';
																}
															?>
															
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
																	<label for="paypal-email" class="form-label col-sm-4">Paypal Email </label>
																	<div class="col-sm-8">
																		<input  type="text"  name="profile[paypal_email]" class="" id="paypal-email" value="<?php echo $user_profile['paypal_email']; ?>"  />
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
											</div>
											
											<div class="setting-row">
												<div class="col-md-4 left">
													<h3> Profile </h3>
												</div>
												<div class="col-md-8 right ">
													<div class="view-section">
														<div class="col-md-10">
														
															<label class="view-item"> <?php echo $user_profile['languages'] ; ?> </label>
															<label class="view-item"> <?php echo $user_profile['education'] ; ?> </label>
															<?php
																if($user_profile['have_license_certification'] == 'yes'){
																	echo '<label class="view-item"> Have license/certification </label>';
																}
															?>
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
																	<label for="bio" class="form-label col-sm-4">Bio </label>
																	<div class="col-sm-8">
																		<textarea name="profile[bio]" ><?php echo $user_profile['bio']; ?></textarea>
																	</div>
																	<div class="clearfix clear"></div>
																</div>
																
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
																
																<div class="form-group">
																	<label for="education" class="form-label col-sm-4">Education </label>
																	<div class="col-sm-8">
																		<select name="profile[education]">
																			<option value="">Select One</option>
																			<option value="education1" <?php if($user_profile['education'] == "education1"){ echo "selected"; } ?>>education1</option>
																			<option value="education2" <?php if($user_profile['education'] == "education2"){ echo "selected"; } ?>>education2</option>
																			<option value="education3" <?php if($user_profile['education'] == "education3"){ echo "selected"; } ?>>education3</option>
																			<option value="education4" <?php if($user_profile['education'] == "education4"){ echo "selected"; } ?>>education4</option>
																		</select>
																	</div>
																	<div class="clearfix clear"></div>
																</div>
																<div class="form-group">
																	<label for="have_license_certification" class="form-label col-sm-4">Do you have any Licenses or Certifications</label>
																	<div  class="col-sm-8">
																		<select name="profile[have_license_certification]" >
																			<option value="">-Select-</option>
																			<option value="yes" <?php if($user_profile['have_license_certification'] == "yes"){ echo "selected"; } ?>>Yes</option>
																			<option value="no" <?php if($user_profile['have_license_certification'] == "no"){ echo "selected"; } ?>>No</option>
																		</select>
																	</div>
																	<div class="clearfix clear"></div>
																</div>
																<div class="form-group">
																	<label for="license_certification_name" class="form-label col-sm-4">Certifications or License Name</label>
																	<div class="col-sm-8">
																		<input type="text" placeholder="Certifications or License Name" name="profile[license_certification_name]" class="" id="license_certification_name" value="<?php if($user_profile) echo $user_profile['license_certification_name']; ?>"  />
																	</div>
																	<div class="clearfix clear"></div>
																</div>
																<div class="clearfix clear"></div>
																<div class="form-group">
																	<label for="license_certification_number" class="form-label col-sm-4">Certifications/License Number</label>
																	<div class="col-sm-8">
																		<input type="text" placeholder="Certifications/License Number" name="profile[license_certification_number]" class="" id="license_certification_number"  value="<?php if($user_profile) echo $user_profile['license_certification_number']; ?>" />
																		
																	</div>
																	<div class="clearfix clear"></div>
																</div>
																<div class="form-group ">
																	<label for="state_of_license_certification" class="form-label col-sm-4">State or county of License/Certifications</label>
																	<div class="col-sm-8">
																		<input type="text" placeholder="State or county of License/Certifications" name="profile[state_of_license_certification]" class="" id="state_of_license_certification" value="<?php if($user_profile) echo $user_profile['state_of_license_certification']; ?>" />
																	</div>
																	<div class="clearfix clear"></div>
																</div>
																<div class="form-group ">
																	<label for="availabe_days_time" class="form-label col-sm-4">Days and Times you are available</label>
																	<div  class="col-sm-8">
																		<select name="profile[availabe_days_time][]" multiple >
																		  <option value="Sunday_12AM_2AM" <?php if($user_profile  && in_array('Sunday_12AM_2AM',$availabe_days_time )) { echo "selected";} ?> >Sunday 12 AM - 2 AM</option>
																		  <option value="Sunday_2AM_4AM" <?php if($user_profile  && in_array('Sunday_2AM_4AM',$availabe_days_time )) { echo "selected";} ?> >Sunday 2 AM - 4 AM</option>
																		  <option value="Sunday_4AM_6AM" <?php if($user_profile  && in_array('Sunday_4AM_6AM',$availabe_days_time )) { echo "selected";} ?> >Sunday 4 AM - 6 AM</option>
																		  <option value="Sunday_6AM_8AM" <?php if($user_profile  && in_array('Sunday_6AM_8AM',$availabe_days_time )) { echo "selected";} ?> >Sunday 6 AM - 8 AM</option>
																		</select>
																	</div>
																	<div class="clearfix clear"></div>
																</div>
																
																<div class="form-group">
																	<label for="languages" class="form-label col-sm-4">Languages Spoken</label>
																	<div  class="col-sm-8">
																		<select name="profile[languages][]" multiple id="languages">
																		  <option value="akan" <?php if($user_profile && in_array('akan',$languages)) { echo "selected";} ?>>Akan</option>
																		  <option value="amharic" <?php if($user_profile && in_array('amharic',$languages)) { echo "selected";} ?>>Amharic</option>
																		  <option value="arabic" <?php if($user_profile && in_array('arabic',$languages)) { echo "selected";} ?>>Arabic</option>
																		  <option value="assamese" <?php if($user_profile && in_array('assamese',$languages)) { echo "selected";} ?>>Assamese</option>
																
																		</select>
																	</div>
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
											
											
											
											<div class="setting-row">
												<div class="col-md-4 left">
													<h3> Work Experience </h3>
												</div>
												<div class="col-md-8 right ">
													<div class="view-section">
														<div class="col-md-10">
															<label class="view-item"> 
																<?php 
																	$aoe = $user_profile['area_of_experience'];
																	$aoe = ($aoe)?str_replace(";",',',$aoe):'';
																	$aoe = ($aoe)?ucwords(str_replace("_", " ",$aoe)):'';
																	echo $aoe;
																?> 
															</label>
															<label class="view-item"> <?php echo $user_profile['years_of_experience']; ?> Years</label>
															
														</div>
														<div class="col-md-2">
															<a class="edit-setting-btn" href="javascript:void(0);"> Edit </a>
														</div>
														<div class="clearfix clear"></div>
													</div>
													<div class="form-section">
														<div class="col-md-10">
															
															<span class="msg-wrap"></span>
															<form method="post" action="#" name="form-validation" class="setting-form" id="form_work_samples" enctype="multipart/form-data">
																<div class="form-group">
																	<label for="area_of_experience" class="form-label col-sm-4">Area of Experience </label>
																	<div class="col-sm-8">
																		<select name="profile[area_of_experience][]" multiple >
																			<option value="ability_to_work_under_pressure" <?php if($user_profile && in_array('ability_to_work_under_pressure',$area_of_experience)) { echo "selected";} ?> >Ability to work under pressure</option>
																			<option value="adaptability" <?php if($user_profile && in_array('adaptability',$area_of_experience)) { echo "selected";} ?> >Adaptability</option>
																			<option value="administering_medication" <?php if($user_profile && in_array('administering_medication',$area_of_experience)) { echo "selected";} ?> >Administering medication</option>
																			<option value="advising_people" <?php if($user_profile && in_array('advising_people',$area_of_experience)) { echo "selected";} ?> >Advising people</option>
																		</select>
																	</div>
																	<div class="clearfix clear"></div>
																</div>
																<div class="form-group">
																	<label for="area_of_experience_other" class="form-label col-sm-4">Area of Experience other </label>
																	<div class="col-sm-8">
																		<input type="text" placeholder="Area of Experience other" name="profile[area_of_experience_other]" class="" id="area_of_experience_other" value="<?php if($user_profile) echo $user_profile['area_of_experience_other'];  ?>" />
																	</div>
																	<div class="clearfix clear"></div>
																</div>
																<div class="form-group">
																	<label for="years_of_experience" class="form-label col-sm-4">Years of Experience </label>
																	<div class="col-sm-8">
																		<input type="text"  placeholder="Years of Experience" name="profile[years_of_experience]" class="" id="years_of_experience" value="<?php if($user_profile) echo $user_profile['years_of_experience']; ?>" />
																	</div>
																	<div class="clearfix clear"></div>
																</div>
																<div class="form-group">
																	<label for="work_samples" class="form-label col-sm-4">Work Samples </label>
																	<div class="col-sm-8">
																		<?php 
																			if($work_samples){
																				foreach($work_samples as $ws){
																		?>
																					<div class="work-sample-wrap" data-val="<?php echo $ws;?>">
																						<div class="ws-item col-sm-10">
																							<img style="max-width:80%;" src="<?php echo $ws;?>" />
																						</div>
																						<div class="ws-action col-sm-2">
																							<a href="javascript:void(0);" class="btn btn-danger ws-rm" > x </a>
																						</div>
																						<div class="clearfix clear"></div>
																					</div>
																		<?php 
																				}
																			}
																		?>
																		<input type="hidden" id="oldws" name="oldws" value="<?php echo $user_profile['work_samples'];?>" />
																		<input type="hidden" id="rmws" name="rmws" />
																		<div class="work-sample-wrap">
																			<div class="ws-item col-sm-10">
																				<input type="file" name="work_samples[]" />
																			</div>
																			<div class="ws-action col-sm-2">
																				<a href="javascript:void(0);" class="btn btn-success ws-add" > + </a>
																			</div>
																			<div class="clearfix clear"></div>
																		</div>
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
											</div>
											
											
											
											
											
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
		
		
	</div>
	<script>
		jQuery(document).ready(function(e){
			
			init_remove_ws();
			jQuery(".ws-add").click(function(e){
				var prt = jQuery(this).parents('.work-sample-wrap');
				var nrow = '<div class="work-sample-wrap">';
				 nrow += '<div class="ws-item col-sm-10">';
				nrow += '<input type="file" name="work_samples[]" />';
				nrow += '</div>';
				nrow += '<div class="ws-action col-sm-2">';
				nrow += '<a href="javascript:void(0);" class="btn btn-danger ws-rm" > x </a>';
				nrow += '</div>';
				nrow += '<div class="clearfix clear"></div>';
				nrow += '</div>';
				jQuery(prt).after(nrow);
				init_remove_ws();
			});
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
					jQuery.post(ci_base_url+'provider/delete-card',{id:id},function(resp){
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
				jQuery.post(ci_base_url+'provider/save-card',jQuery(this).serialize(),function(resp){
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
				if(jQuery(this).attr('id') == 'form_profile_pic' || jQuery(this).attr('id') == 'form_work_samples'){
					var formData = new FormData(this);
					//formData.append('profile_pic', jQuery('#profile_pic')[0].files[0]); 
					jQuery.ajax({
						url: ci_base_url+'provider/save-setting',
						type: "POST",
						dataType:'json',
						data: formData,
						processData: false,
						contentType: false,
						success: function(resp) {
							var msgtype = resp.status;
							if(resp.status == 'fail'){
								msgtype = 'error';
							} 
							if(resp.status == 'success'){
								if(jQuery(this).attr('id') == 'form_profile_pic'){
									var reader = new FileReader();
									reader.onload = function(e) {
										jQuery('#profilepic').attr('src', e.target.result);
										jQuery('#profilepic2').attr('src', e.target.result);
									}
									reader.readAsDataURL(jQuery('#profile_pic')[0].files[0]);
								} else if(jQuery(this).attr('id') == 'form_work_samples'){
									var wscnt = 0;
									jQuery('.work-sample-wrap input[type="file"]').each(function(){
										var img = jQuery('<img style="max-width:80%;">');
										var reader = new FileReader();
										reader.onload = function(e) {
											img.attr('src', e.target.result);
										}
										reader.readAsDataURL(jQuery(this)[0].files[0]);
									});
								}
							}
							if(resp.msg != undefined){
								jQuery(dis).prev('.msg-wrap').html('<div class="alert alert-'+msgtype+'"> <a href="#" class="close" data-dismiss="alert">&times;</a><strong>'+msgtype.toUpperCase()+'!</strong> '+resp.msg+'  </div>');
								pvn_notify(resp.msg,msgtype);
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
						},
						error: function(jqXHR, textStatus, errorMessage) {
							console.log(errorMessage); // Optional
						}
					});
					
				} else {
					jQuery.post(ci_base_url+'provider/save-setting',  jQuery(this).serialize() ,function(resp){
						var msgtype = resp.status;
						if(resp.status == 'fail'){
							msgtype = 'error';
						} 
						if(resp.msg != undefined){
							jQuery(dis).prev('.msg-wrap').html('<div class="alert alert-'+msgtype+'"> <a href="#" class="close" data-dismiss="alert">&times;</a><strong>'+msgtype.toUpperCase()+'!</strong> '+resp.msg+'  </div>');
							pvn_notify(resp.msg,msgtype);
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
				
				}
				

				
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
		
		function init_remove_ws(){
			jQuery(".ws-rm").unbind('click').bind('click',function(e){
				var prt = jQuery(this).parents('.work-sample-wrap');
				var vl = jQuery(prt).attr('data-val');
				if(vl){
					var oldws = jQuery('#oldws').val();
					oldws = oldws.replace(vl+',','');
					oldws = oldws.replace(vl,'');
					jQuery('#oldws').val(oldws);
					
					var rmws = jQuery('#rmws').val();
					if(rmws){
						rmws =+ ',' + vl;
					} else {
						rmws = vl;
					}
					jQuery('#rmws').val(rmws);
				}
				jQuery(prt).remove();
				
			});
		}
	</script>

</body>
</html>
