<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
												<div class="col-md-2">
												</div>
												<div class="col-md-10 ">
													<table class="pref-tbl">
														<colgroup>
															<col width="60%">
															<col width="15%">
															<col width="15%">
														</colgroup>
														<tr><th>Actions</th><th>Email</th><th>SMS</th></tr>
														<tr>
															<td><label for="contract_invitation">Contract Invitation<label></td>
															<td>
																<div class="pcheckbox">
																	<input class="pref-item" type="checkbox" name="contract_invitation_email" id="contract_invitation_email" <?php if(isset($preferences['contract_invitation_email']) && $preferences['contract_invitation_email'] == 'yes'){ echo ' checked="checked" '; } ?> value="yes" />
																	<label for="contract_invitation_email"></label>
																</div>
															</td>
															<td>
																<div class="pcheckbox">
																	<input class="pref-item" type="checkbox" name="contract_invitation_sms" id="contract_invitation" <?php if(isset($preferences['contract_invitation_sms']) && $preferences['contract_invitation_sms'] == 'yes'){ echo ' checked="checked" '; } ?>  value="yes" />
																	<label for="contract_invitation_sms"></label>
																</div>
															</td>
														</tr>
														
														
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
