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
								<div class="col-md-2 left-bar">
									<?php $this->load->view('part/user_left'); ?>
								</div>
								<div class="col-md-10 right-bar">
									<?php $this->load->view('part/user_top'); ?>
								<div class="sub-cat">
									<h3>Get Matched to Top-Rated <?php echo $parent['0']['title'] ?></h3>
									
									<?php foreach($category as $category){ ?>
										<a href="<?php echo ci_base_url();?>customer/contract?id=<?php echo $category['id']; ?>&parent=<?php echo $category['parent']; ?>"><?php echo $category['title']; ?></a>
										
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
