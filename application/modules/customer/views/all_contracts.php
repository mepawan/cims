<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php 
	//echo "<pre>"; print_r($users); die;
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
							
							<section id="provider-details">
								<div class="col-md-2 left-bar">
									<?php $this->load->view('part/user_left'); ?>
								</div>
								<div class="col-md-10 right-bar">
									<div class="col-md-12 " >
										<?php if(isset($heading) && $heading){ ?>
											<span id="mm_title">
												<h2 class="title_s"> <?php echo $heading; ?></h2>
											</span>
										<?php } ?>
									</div>
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
									
									
									<div class="all_contracts">
										<div class="contract_row headings">
											<div class="col-md-2">Date</div>
											<div class="col-md-6">Project</div>
											<div class="col-md-4">Project Status</div>
										</div>
										<hr>
										<?php foreach($contracts as $contracts){ ?>
											<div class="contract_data">
												<div class="col-md-2"><?php print date('m-d-Y', strtotime($contracts['created_date'])); ?></div>
												<div class="col-md-6"><a href="<?php echo ci_base_url();?>customer/contracts?area_exp=<?php echo $contracts['area_of_experience']; ?>&id=<?php echo $contracts['id']; ?>"><?php print str_replace("_", " ", $contracts['area_of_experience']); ?></a></div>
												<div class="col-md-4">View project profile</div>
											</div>
											<hr>
										<?php } ?>
									
									</div>
									
									<?php if($users){ ?>
										<div class="suggestion">
											<div class="suggestion_head">
												<h3>Pros from the Hands Across Hands Network</h3>
												<p>The pros below, while not an exact match for your request, may be able to help. Please contact them directly.</p>
											</div>
											<div class="suggestion_data">
												<?php foreach($users as $users){  ?>
													<div class="sugg_result">
														<div class="col-md-6">
															<p><?php echo $users[0]['first_name']." ".$users[0]['last_name']; ?></p>
															<span><strong>Area of experience: </strong></span>
															<?php foreach($provider as $providers){ 
																if($users['0']['id'] == $providers['uid']){
																	echo "<span>".str_replace("_", " ", $providers['area_of_experience'])."</span>";
																}
																?>
															<?php } ?>
														</div>
														<div class="col-md-6">
															<?php if(!empty($users[0]['phone'])){ ?><span><strong>Phone:</strong> <?php echo $users[0]['phone']; ?></span> <?php } ?>
														</div>
														<div class="clearfix clear"></div>
													</div>
												
												<?php } ?>
											</div>
										</div>
									<?php }?>
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
