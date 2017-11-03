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
											<h3 class="find-providers-title">Find Service Providers </h3>
											<div class="search-provider-wrap">
												<div class="search-form-wrap">
													<form method="post" action="">
														<input required type="text" class="search-box inline" name="keywords" placeholder="Keywords" value="<?php if(isset($_POST['keywords'])) { echo $_POST['keywords']; } ?>" />
														<input type="submit" class="search-btn inline" name="search-provider" value="Search" />
													</form>
												</div>
												<div class="search-results-wrap">
												<?php
													if(isset($providers)){
												?>	
														<h3>Search Result</h3>
														<?php if(empty($providers)){ echo "No search result found with your Keyword"; } ?>
														<div class="row grid">
														<?php
															foreach($providers as $prv){
														?>	
															<div class="col-md-3 provider">
																
																<?php if(!empty($prv['profile_pic'])){ ?>
																	<a href="<?php echo ci_base_url('customer/provider/'.$prv['id']); ?>"><img src="<?php echo $prv['profile_pic']; ?>" height="100px" width="100%"></a>
																<?php } else { ?>
																	<a href="<?php echo ci_base_url('customer/provider/'.$prv['id']); ?>"><img src="<?php echo ci_base_url('public/upload'); ?>/default_profile_pic.png" height="100px" width="100%"></a>
																<?php } ?>
																<a href="<?php echo ci_base_url('customer/provider/'.$prv['id']); ?>"><h4><?php echo $prv['first_name'] . ' ' . $prv['last_name'];?> <?php if(!empty($prv['years_of_experience'])){ ?> ( <?php echo $prv['years_of_experience']; ?> years ) <?php } ?><h4></a>
																<p><?php echo str_replace("_", " ", $prv['area_of_experience']); ?></p>
																
																
																	
															</div>
														<?php
															}
														?>
														</div>
												<?php
													}
													
												?>
												</div>
											</div>
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
