<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//echo "<pre>"; print_r($providers[0]); die;
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
											<div class="setting-row provider_pro">
												
												<div class="col-md-9 ">
													<?php foreach($providers as $prv){ ?>
														<div class="col-md-3">
															<?php if(!empty($prv['profile_pic'])){ ?>
																<img src="<?php echo $prv['profile_pic']; ?>" height="100px" width="100%">
															<?php } else { ?>
																<img src="<?php echo ci_base_url('public/upload'); ?>/default_profile_pic.png" height="100px" width="100%">
															<?php } ?>
														</div>
														<div class="col-md-9">
															<h3><?php echo $prv['first_name'] . ' ' . $prv['last_name'];?> </h3>
															<p><?php echo $prv['bio']; ?></p>
														</div>
													<?php } ?>
												</div>
												<div class="col-md-3">
												</div>
												<div class="clearfix clear"></div>
												
												<div class="col-md-6">
													<h4>Areas of Expertise</h4>
													<ul>
													 <?php $areaexp = explode(",", $prv['area_of_experience']); 
														foreach($areaexp as $areaexp){ 
													 ?>
														<li><?php echo ucfirst(str_replace("_", " ", $areaexp)); ?> </li>
													<?php } ?>
													 </ul>
													
													<?php if(!empty($prv['availabe_days_time'])){ ?>
														<h4>Days and Times available</h4>
														 <ul>
													 <?php $day_time = explode(",", $prv['availabe_days_time']); 
														foreach($day_time as $day_time){ 
													 ?>
														<li><?php echo ucfirst(str_replace("_", " ", $day_time)); ?> </li>
													<?php } ?>
													 </ul>
													<?php } ?>
													<?php if(!empty($prv['preferred_contact_method'])){ ?>
														<h4>Preferred Contact Method</h4>
														 <p><?php echo ucwords(str_replace(",", ", ", $prv['preferred_contact_method'])); ?></p>
													<?php } ?>
													 
												</div>
												<div class="col-md-6">
													<?php if(!empty($prv['area_of_experience_other'])){ ?>
														 <h4>Areas of Experience other</h4>
														 <p><?php echo $prv['area_of_experience_other']; ?></p>
													<?php } ?>
													<?php if(!empty($prv['years_of_experience'])){ ?>
														<h4>Year Of Experience</h4>
														 <p><?php echo $prv['years_of_experience']; ?></p>
													<?php } ?>
													<?php if(!empty($prv['education'])){ ?>
														<h4>Education</h4>
														 <p><?php echo $prv['education']; ?></p>
													<?php } ?>
													<?php if(!empty($prv['languages'])){ ?>
														<h4>Languages Spoken</h4>
														 <p><?php echo ucwords(str_replace(",", ", ", $prv['languages'])); ?></p>
													<?php } ?>
												</div>
												
											</div> <!-- end setting-row -->
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
			jQuery(".pref-item").change(function(e){
				e.preventDefault();
				var key = jQuery(this).attr('name');
				var val = jQuery(this).is(':checked')?jQuery(this).val():'';
				
				jQuery.post(ci_base_url+'provider/save-prefs',{key:key,val:val},function(resp){

				},'json');
			});
		});
	</script>

</body>
</html>