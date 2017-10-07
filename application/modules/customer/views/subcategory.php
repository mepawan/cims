<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php 
	//echo "<pre>"; print_r($category); die;
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
								
								<h3>Select a Category Below to Get Started</h3>
								
								<?php foreach($category as $category){ ?>
									<a href="<?php echo ci_base_url();?>customer/finder"><?php echo $category['title']; ?></a>
									
								<?php } ?>
								
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
