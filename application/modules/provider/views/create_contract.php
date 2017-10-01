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
								
								
								<form method="POST" name="form-validation" id="provider-registration" enctype="multipart/form-data">
									<div class="form-group col-md-6">
										<label for="paypal" class="form-label col-sm-4">Title<span class="red">*</span></label>
										<div class="col-sm-8">
											<input type="text" placeholder="Title"  name="title" class="" id="title" />
										</div>
										<div class="clearfix clear"></div>
									</div>
									<div class="clearfix clear"></div>
									<div class="form-group col-md-6">
										<label for="paypal" class="form-label col-sm-4">Area of Experience<span class="red">*</span></label>
										<div class="col-sm-8">
											<select    name="area_of_experience" class="" id="area_of_experience">
												<option value=""> Select One </option>
											</select>
										</div>
										<div class="clearfix clear"></div>
									</div>
									<div class="clearfix clear"></div>
									
									
									
									
									
									<div class="form-actions text-center col-md-12">
										<button class="btn btn-primary width-150" type="submit">Create Contract</button>
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


</body>
</html>
