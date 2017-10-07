<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php 
	//echo "<pre>"; print_r($area_of_exap); die;
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
										<div class="form-group col-md-6">
										<label for="area_of_experience" class="form-label col-sm-4">Area of Experience</label>
										<div  class="col-sm-8">
												<select name="area_of_experience" >
												  <option value="ability_to_work_under_pressure" >Ability to work under pressure</option>
												  <option value="adaptability" >Adaptability</option>
												  <option value="administering_medication">Administering medication</option>
												  <option value="advising_people" >Advising people</option>
												</select>
											</div>
										</div>
										<div class="form-group col-md-6">
											<label for="years_of_experience" class="form-label col-sm-4">Number of Years of Experience</label>
											<div class="col-sm-8">
												<select name="years_of_experience" >
												  <option value="0-5" >0-5</option>
												  <option value="5-10" >5-10</option>
												  <option value="10-15">10-15</option>
												  <option value="15-20" >15-20</option>
												</select>
											</div>
										</div>
																				
										
										<div class="form-actions text-center col-md-12">
											<button class="btn btn-primary width-150" type="submit"><?php echo $submit_text; ?></button>
										</div>
									</form>
									
									<?php if($result){ ?>
										<h3>Result</h3>
										<?php foreach($result as $result){ ?>
											
											<p><?php echo $result['uid']; ?></p>
											
									<?php } }?>
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
