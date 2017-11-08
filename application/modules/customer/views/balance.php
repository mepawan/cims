<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if($user_profile) { $preferred_contact_method = explode(',', $user_profile['preferred_contact_method']); }
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
											<div class="setting-row">
												<div class="col-md-9 left">
													<?php
														$bal = (float) ($user['balance'])?$user['balance']:'0';
													?>
													<h3> Available Credit Balance: $<?php echo $bal;?> </h3>
												</div>
												<div class="col-md-9 left">
													<a class="edit-setting-btn" href="<?php echo ci_base_url();?>customer/transactions"> View Transactions </a>
												</div>

												<div class="clearfix clear"></div>	
												<div class="col-md-12 ">
													<div class="form-section1">
															<span class="msg-wrap"></span>
															<form method="post" action="<?php echo ci_base_url();?>customer/process_payment" name="form-validation" class="setting-form" id="form_personal_info" enctype="multipart/form-data">
																<div class="form-group col-sm-6">
																	<label for="amount" class="form-label col-sm-3">Amount($)<span class="red">*</span></label>
																	<div class="col-sm-8">
																		<input required type="number" value="5"  min="5" max="1000000" name="amount" placeholder="Enter Amount" class="" id="amount"  />
																	</div>
																
																	<div class="form-group text-center">
																		<button class="btn btn-primary width-150" type="submit">Deposit from Paypal </button>
																		<!--button class="btn btn-primary width-150" type="submit">Deposit from Credit Card </button-->
																	</div>
																</div>
																<div class="clearfix clear"></div>	
															</form>
													</div>
												</div>
												<div class="clearfix clear"></div>
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

			
		});
	</script>

</body>
</html>
