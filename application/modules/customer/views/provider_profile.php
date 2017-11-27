<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//print_r($me);
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
								<div class="col-md-10 content-left">
										<?php if(isset($heading) && $heading){ ?>
											<span id="mm_title">
												<h2 class="title_s"> <?php echo $heading; ?></h2>
											</span>
										<?php } ?>
										<div class="content-wrap">
											<div class="setting-row provider_pro">
												
											<div class="col-md-9 content-left">
													
												<div class="col-md-3">
													<?php if(!empty($provider['profile_pic'])){ ?>
														<img src="<?php echo $provider['profile_pic']; ?>" height="100px" width="100%">
													<?php } else { ?>
														<img src="<?php echo ci_base_url('public/upload'); ?>/default_profile_pic.png" height="100px" width="100%">
													<?php } ?>
												</div>
												<div class="col-md-9">
													<h3><?php echo $provider['first_name'] . ' ' . $provider['last_name'];?> </h3>
													<p><?php echo $provider['bio']; ?></p>
												</div>
													
												<div class="clearfix clear"></div>
												
												<div class="col-md-6">
													<h4>Areas of Expertise</h4>
													<ul>
													 <?php $areaexp = explode(",", $provider['area_of_experience']); 
														foreach($areaexp as $areaexp){ 
													 ?>
														<li><?php echo ucfirst(str_replace("_", " ", $areaexp)); ?> </li>
													<?php } ?>
													<?php if(!empty($provider['area_of_experience_other'])){ ?>
														 <li><?php echo $provider['area_of_experience_other']; ?></li>
													<?php } ?>
													 </ul>
													
													<?php if(!empty($provider['availabe_days_time'])){ ?>
														<h4>Days and Times available</h4>
														 <ul>
													 <?php $day_time = explode(",", $provider['availabe_days_time']); 
														foreach($day_time as $day_time){ 
													 ?>
														<li><?php echo ucfirst(str_replace("_", " ", $day_time)); ?> </li>
													<?php } ?>
													 </ul>
													<?php } ?>
													<?php if(!empty($provider['preferred_contact_method'])){ ?>
														<h4>Preferred Contact Method</h4>
														 <p><?php echo ucwords(str_replace(",", ", ", $provider['preferred_contact_method'])); ?></p>
													<?php } ?>
													 
												</div>
												<div class="col-md-6">
													
													<?php if(!empty($provider['years_of_experience'])){ ?>
														<h4>Years Of Experience</h4>
														 <p><?php echo $provider['years_of_experience']; ?> years</p>
													<?php } ?>
													<?php if(!empty($provider['education'])){ ?>
														<h4>Education</h4>
														 <p><?php echo $provider['education']; ?></p>
													<?php } ?>
													<?php if(!empty($provider['languages'])){ ?>
														<h4>Languages</h4>
														 <p><?php echo ucwords(str_replace(",", ", ", $provider['languages'])); ?></p>
													<?php } ?>
													
													
														<h4>Timezone</h4>
														 <?php if(!empty($provider['timezone'])){ ?>
															<p><?php echo $provider['timezone']; ?></p>
														 <?php } else { echo 'Not Available';} ?>
													
												</div>
											</div>
											<div class="col-md-3 sidebar">
												<ul>
													<li>
														<?php  ?>
													</li>
													<li>
														<?php 
															if(!$conversation){
																echo '<a href="javascript:void(0);" class="btn btn-warning text-center start-cong-btn">Contact to '.$provider['first_name'].'</a> <br />';
																echo '<span style="color:#ddd;"></span>';
															} else if($conversation && ($conversation['status'] == 'pending' || $conversation['status'] == 'reopened') ){
																echo '<a href="javascript:void(0);" class="btn btn-warning text-center ">Contact to '.$provider['first_name'].'</a> <br />';
																echo '<span style="color:#ddd;">Your request is pending</span>';
															} else if($conversation && $conversation['status'] == 'rejected'){
																echo '<a href="javascript:void(0);" class="btn btn-danger text-center start-cong-btn">Contact to '.$provider['first_name'].'</a> <br />';
																echo '<span style="color:#ddd;">Provider rejected your request</span>';
															} else if($conversation && ($conversation['status'] == 'closed1' || $conversation['status'] == 'closed2')){
																echo '<a href="javascript:void(0);" class="btn btn-warning text-center start-cong-btn">Contact to '.$provider['first_name'].'</a> <br />';
																echo '<span style="color:#ddd;">Conversations is closed. </span>';
															} else {
																echo '<a href="javascript:void(0);" class="btn btn-success text-center provider-contact-btn">Contact to '.$provider['first_name'].'</a> <br />';
																echo '<span style="color:#ddd;">Your Credit Balance $<span id="credit_balance">'.$me['balance'].'</span></span>';
															}
														?>
														
													</li>
													<?php 
														if($conversation && $conversation['status'] == 'active'){
													?>
															<li>
																<div class="chat-server-status-wrap"><span>Server Status: <span id="chat-server-status">Connecting<span class="load-dots">....</span></span></div>
															</li>
															<li>
																<div class="call-btns-wrap" >
																	<button class="btn btn-success btn-sm initCall" id="initAudio"><i class="fa fa-phone"></i></button>
																	<button class="btn btn-info btn-sm initCall" id="initVideo"><i class="fa fa-video-camera"></i></button>
																</div>
															</li>
															<li>
																<button type="button" class="btn btn-danger btn-sm" id='endCall' style="display:none;">
																	<i class="fa fa-times-circle"></i> End Call
																</button>
															</li>
													<?php } ?>
												</ul>
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
		<?php 
			$this->load->view('part/footer'); 
			if($conversation && $conversation['status'] == 'active'){
				//$this->load->view('videocall/wrapper'); 
		?>
					<div class="video-on-call-wrap">
						<!-- Remote Video -->
							<div class="remote-video-wrap">
								<video id="peerVid"  playsinline autoplay></video>
							</div>
						<!-- Remote Video -->
						
						<!-- Local Video -->
							<div class="local-video-wrap">
								<video id="myVid"  muted autoplay></video>
							</div>
						<!-- Local Video -->
						<button class="btn btn-danger btn-sm" id="terminateCall" disabled><i class="fa fa-phone-square"></i></button>	
					</div>
		<?php
			}
		?>
	</div>

	<script type="text/javascript" src="<?php echo ci_public('front'); ?>js/base64.js"></script>
	<script>
		var provider_id = '<?php echo $provider['id'];?>';
		var chrm = '<?php echo base64_encode($this->ciauth->get_user_id() . '_' . $provider['id']);?>';
		var chrm_text = '<?php echo $this->ciauth->get_user_id() . '_' . $provider['id'];?>';
		var conversation = '<?php echo ($conversation)?'1':'0';?>';
		var connectivity = 0;
		var myunique = '<?php echo base64_encode($this->ciauth->get_user_id());?>';
		var remote_end = 'customer';
		
		var chsrvsts = 0;
		var chremotename = '<?php echo $provider['first_name'];?>';
		jQuery(document).ready(function(e){
			if(jQuery('.load-dots').length > 0) { jQuery('.load-dots').start_load_dots(); }
			jQuery(".pref-item").change(function(e){
				e.preventDefault();
				var key = jQuery(this).attr('name');
				var val = jQuery(this).is(':checked')?jQuery(this).val():'';
				
				jQuery.post(ci_base_url+'provider/save-prefs',{key:key,val:val},function(resp){

				},'json');
			});
			jQuery(".provider-contact-btn").click(function(e){
				var cb = jQuery("#credit_balance").html();
				console.log(cb);
				cb = parseFloat(cb);
				if(cb <= 5 ){
					alert("You don't have enough credit balance to contact to provider");
					return false;
				} else if(chsrvsts != 1){
					alert("Message/Video call server is down. \nPlease contact to administrator");
					return false;
				} else {
					//jQuery(".chat-window").toggleClass('show');
					window.location = ci_base_url + 'customer/conversation/'+provider_id;
				}
			});
			jQuery(".start-cong-btn").click(function(e){
				var dis = jQuery(this);
				var dis_text = jQuery(dis).html();
				jQuery(dis).html('please wait...');
				jQuery.post(ci_base_url+'customer/start_conv',{uid2:provider_id}, function(resp){
					if(resp.status == 'success'){
						jQuery(dis).next().next('span').html('Request sent successfully');
						jQuery(dis).removeClass('start-cong-btn');
						jQuery(dis).unbind('click');
					} else {
						alert(resp.msg);
					}
					jQuery(dis).html(dis_text);
				},'json');
			});
		});
		
	</script>
	
	<?php 
		
		if($conversation && $conversation['status'] == 'active'){
			$this->load->view('videocall/parts/assets');
		}
	?>
	
</body>
</html>
