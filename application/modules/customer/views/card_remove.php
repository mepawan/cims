<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php 
	//echo "<pre>"; print_r($card); die;
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
									<form method="POST" name="form-validation" id="provider-registration" enctype="multipart/form-data">
										
										<p>Are you sure you want to remove card</p>
										<input type="hidden"  name="id"   value="<?php echo $id; ?>" />
										<div class="form-actions text-center col-md-12">
											<button class="btn btn-primary width-150" type="submit">Remove</button>
										</div>
									</form>
									<?php if(isset($cards)){ ?>
										<div class="clearfix clear"></div>
										<h3>Cards</h3>
										
										<div class="cards-details">
											<div class="col-md-2"><strong>Card Number</strong></div>
											<div class="col-md-2"><strong>Expiry Date</strong></div>
											<div class="col-md-2"><strong>Name On Card</strong></div>
											<div class="col-md-2"><strong>Card Type</strong></div>
											<div class="col-md-2"><strong>Action</strong></div>
											<div class="clearfix clear"></div>
											<?php foreach($cards as $card){ ?>
												<div class="col-md-2"><?php echo $card['card_number']; ?></div>
												<div class="col-md-2"><?php echo $card['exp_date']; ?></div>
												<div class="col-md-2"><?php echo $card['name_on_card']; ?></div>
												<div class="col-md-2"><?php echo str_replace("_", " ", $card['card_type']); ?></div>
												<div class="col-md-2"><a href="card_edit?id=<?php echo $card['id']; ?>">Edit</a> | <a href="card_remove?id=<?php echo $card['id']; ?>">Remove</a></div>
												<div class="clearfix clear"></div>
											<?php } ?>
										</div>
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
