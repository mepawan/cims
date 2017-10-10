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
