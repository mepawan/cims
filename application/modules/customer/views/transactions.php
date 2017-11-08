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
												<div class="col-md-12">
													<table class="cards-listing-tbl">
														<colgroup>
															<col width="22%">
															<col width="15%">
															<col width="25%">
															<col width="10%">
															<col width="10%">
															<col width="20%">
														</colgroup>
														<thead>
														<tr><th>Date Time</th><th>Amount</th><th>Status</th><th>Transaction Id </th><th>Paypal Fee</th><th>Balance</th></tr>
														</thead>
													</table>
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
