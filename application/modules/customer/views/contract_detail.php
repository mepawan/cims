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
							
							<section id="content" >
								<div class="col-md-2 left-section ">
									<?php $this->load->view('part/user_left'); ?>
								</div>
								<div class="col-md-10 content-section">
										<?php if(isset($heading) && $heading){ ?>
											<span id="mm_title">
												<h2 class="title_s"> <?php echo $heading; ?></h2>
											</span>
										<?php } ?>
										<div class="content-wrap">
												
												<div class="col-sm-1"></div>
												<div class="contract col-sm-10">
													
													<div class="contract-info">
														<ul >
															<li><?php echo ucwords(str_replace("_"," ",$contract['area_of_experience']));?> </li>
															<li> &nbsp;&nbsp; |  &nbsp;&nbsp;</li>
															<li><?php echo $contract['years_of_experience'];?> years </li>
														</ul>
													</div>
													<div class="suggestion">
														<div class="suggestion_head">
															<h3>Providers from the Hands Across Hands Network</h3>
															<p>The providers below, while not an exact match for your request, may be able to help. Please contact them directly.</p>
														</div>
														<div class="suggestion_data">
															<?php 
																foreach($providers as $provider){  
																	$yrs = ($provider['years_of_experience'])? '('.$provider['years_of_experience'].')':'';
																	$exp = ($provider['area_of_experience'])? '('.$provider['area_of_experience'].')':'';
																	$exp = ($exp)?explode(',', $exp):array();
																	$exp_str = '';
																	array_walk($exp , function($itm) use(&$exp_str){
																		$exp_str .= str_replace("_"," ",$itm) . ',';
																	});
																	$exp_str = ($exp_str)?rtrim($exp_str,","):'';
																	
															?>
																<div class="sugg_result">
																	<div class="col-md-6">
																		<p><strong><?php echo $provider['first_name']." ".$provider['last_name'] . $yrs; ?></strong></p>
																		<p><?php echo $exp_str;?></p>
																		
																	</div>
																	<div class="col-md-6">
																		<?php if(!empty($provider['phone'])){ ?><span><strong>Phone:</strong> <?php echo $provider['phone']; ?></span> <?php } ?>
																	</div>
																	<div class="clearfix clear"></div>
																</div>
															
															<?php } ?>
														</div>
													</div>
													
													
												</div>
												<div class="col-sm-1"></div>
												<div class="clearfix"></div>
												
													
										</div>
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
